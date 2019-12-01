<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Country;
use App\Setting;
use App\DoctorRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserLoginResource;
use App\Mail\ConfirmCode;
use App\PhoneVerification;
use App\User;
use App\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Validator;
use Auth;
class AuthController extends Controller
{
    //
    public function login(Request $request){

        if ($request->type == 1){
            $rules = [
                'email'         => 'required|email',
                'password'      => 'required',
                'type'          => 'required',
                'device_token'          => 'required',
                'device_type'          => 'required|in:1,2',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
                return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));


            if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'type'=>$request->type])) {

                if (Auth::user()->active == 0){
                    $errors = "عذرا ، تم إيقاف عضويتك من قبل الإدارة";
                    return ApiController::respondWithErrorObject($errors);
                }

                //save_device_token....
                $created = ApiController::createUserDeviceToken(Auth::user()->id, $request->device_token, $request->device_type);

                $all = User::where('email', $request->email)->first();
                $all->update(['api_token' => generateApiToken($all->id, 10)]);
                $user =  User::where('email', $request->email)->first();


                $data = new UserLoginResource($user);

                return $created
                    ? ApiController::respondWithSuccess($data)
                    : ApiController::respondWithServerErrorObject();
            }else{
                $errors = "بيانات الاعتماد هذه غير متطابقة مع البيانات المسجلة لدينا.";
                return ApiController::respondWithErrorNOTFoundObject($errors);
            }
        }elseif ($request->type == 2){
            $rules = [
                'phone'         => 'required',
                'password'      => 'required',
                'type'          => 'required',
                'device_token'          => 'required',
                'device_type'          => 'required|in:1,2',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
                return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));


            if (Auth::attempt(['phone' => $request->phone, 'password' => $request->password, 'type'=>$request->type])) {

                if (Auth::user()->active == 0){
                    $errors = "عذرا ، تم إيقاف عضويتك من قبل الإدارة";
                    return ApiController::respondWithErrorObject($errors);
                }

                //save_device_token....
                $created = ApiController::createUserDeviceToken(Auth::user()->id, $request->device_token, $request->device_type);

                $all = User::where('phone', $request->phone)->first();
                $all->update(['api_token' => generateApiToken($all->id, 10)]);
                $user =  User::where('phone', $request->phone)->first();


                $data = new UserLoginResource($user);

                return $created
                    ? ApiController::respondWithSuccess($data)
                    : ApiController::respondWithServerErrorObject();
            }else{
                $errors = "بيانات الاعتماد هذه غير متطابقة مع البيانات المسجلة لدينا.";
                return ApiController::respondWithErrorNOTFoundObject($errors);
            }
        }else{
            $rules = [
                'type'          => 'required',
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails())
                return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        }

    }
    public function register(Request $request){

        $rules = [
            'phone'                     => 'required|unique:users',
            'name'                      => 'required',
            'city_id'                   => 'required|exists:cities,id',
            'country_id'                => 'required|exists:countries,id',
            'device_token'              => 'required',
            'device_type'               => 'required',
            'email'                     => 'required|email|unique:users',
            'password'                  => 'required|string|min:6',
            'password_confirmation'     => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $user = new User();
        $user->name         = $request->name;
        $user->phone        = $request->phone;
        $user->type         = 2;
        $user->email        = $request->email;
        $user->city_id      = $request->city_id;
        $user->country_id   = $request->country_id;
        $user->active       = 1;
        $user->password     = bcrypt($request->password);
        $user->save();

        //save_device_token....
        $created = ApiController::createUserDeviceToken($user->id, $request->device_token, $request->device_type);

        $user->update(['api_token' => generateApiToken($user->id, 10)]);
        $updatedUser = User::find($user->id);

        $data = new UserLoginResource($updatedUser);

        return ApiController::respondWithSuccess($data);

    }

    /**
     * @param Request $request
     * @return ApiController|\Illuminate\Http\JsonResponse
     */
    public function checkPhone(Request $request){
        $rules = [
            'phone'                    => 'required|unique:users',
            'calling_code'             => 'required',
            'country_id'               => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

         $code =  rand(1000,9999);
        $newUser = PhoneVerification::updateOrCreate([
            'phone'         => $request->phone,
            'code'          => $code,

        ]);

        /*send sms */
        $callingCode = $request->calling_code;
        $settings = Setting::find(1);
        $client = new \GuzzleHttp\Client();
        $url = "$settings->sms_url?username=$settings->sms_user_name&password=$settings->sms_password&message=$code&numbers=$callingCode.$request->phone&sender=$settings->sms_sender";
        $res = $client->get($url);
        //
        $res->getStatusCode(); // 200
        $ans=$res->getBody();
        /*end send sms*/

        return ApiController::respondWithSuccess(null);

    }

    public function verifyPhone(Request $request){
        $rules = [
            'phone'              => 'required',
            'code'               => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $data = PhoneVerification::where('phone',$request->phone)->latest()->first();


        if ($data == null){
            return ApiController::respondWithErrorNOTFoundObject("الرقم الذي ادخلته غير موجود");
        }
        if($data->code == $request->code){
            PhoneVerification::where('phone',$request->phone)->delete();
            return ApiController::respondWithSuccess([]);
        }else{
            $errors = "عفواً الكود غير متطابق";
            return ApiController::respondWithErrorObject($errors);
        }
    }


    /*doctors*/
    public function forgetPasswordDoctor(Request $request) {
        $rules = [
            'email' => 'required|email',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $user = User::where('email',$request->email)->first();

        if($user) {

            $saved = $this->sendResetPasswordCode($user);

            $success = "لقد تم ارسال كود الاسترجاع على البريد الالكتروني الخاص بك ";

            return $saved
                ? ApiController::respondWithMessageObject($success)
                : ApiController::respondWithServerErrorObject();

        }
        $email_error ="البريد الالكتروني غير موجود";


        return ApiController::respondWithErrorNOTFoundObject($email_error);
    }
    public function confirmResetCodeDoctor(Request $request) {

        $rules = [
            'email'             => 'required|email',
            'reset_code'        => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $data = ResetPassword::where([ ['email', $request->email], ['token', $request->reset_code] ])->first();

        $code= "كود الاسترجاع صحيح";
        $code_error="كود الاسترجاع غير صحيح";
        return $data
            ? ApiController::respondWithMessageObject($code)
            : ApiController::respondWithErrorObject($code_error);
    }
    public function resetPasswordDoctor(Request $request) {

        $rules = [
            'email'                 => 'required|email',
            //'phone'                 => 'required',
            'password'              => 'required',
            'password_confirmation' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $user = User::where('email',$request->email)->first();
        //        $user = User::wherePhone($request->phone)->first();
        $email_error = "البريد الالكتروني غير موجود";

        if($user)
            $updated = $user->update(['password' => bcrypt($request->password)]);
        else
            return ApiController::respondWithErrorNOTFoundObject($email_error);

        $success_password ="تم تغيير كلمة المرور بنجاح";
        return $updated
            ? ApiController::respondWithMessageObject($success_password)
            : ApiController::respondWithServerErrorObject();
    }

    /*users*/

    public function forgetPasswordUser(Request $request) {
        $rules = [
            'phone'                 => 'required',
            'calling_code'          => 'required',
            'country_id'            => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $user = User::where('phone',$request->phone)->first();

        if($user) {

            $saved = rand(1000,9999);
            $updated = User::where('phone',$request->phone)->first()->update([
                'confirmation_code'=> $saved,
            ]);

            $success = "لقد تم ارسال كود الاسترجاع الخاص بك ";

            return $updated
                ? ApiController::respondWithMessageObject($success)
                : ApiController::respondWithServerErrorObject();

        }
        $phone_error =" رقم الهاتف غير موجود";


        return ApiController::respondWithErrorNOTFoundObject($phone_error);
    }

    public function confirmResetCodeUser(Request $request) {

        $rules = [
            'phone'             => 'required',
            'reset_code'        => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $data = User::where([ ['phone', $request->phone], ['confirmation_code', $request->reset_code] ])->first();
        if ($data){
            User::where([ ['phone', $request->phone], ['confirmation_code', $request->reset_code] ])->update(['confirmation_code'=>null]);
            $code= "كود الاسترجاع صحيح";
            return  ApiController::respondWithMessageObject($code);
        }


        $code_error="كود الاسترجاع غير صحيح";
        return  ApiController::respondWithErrorObject($code_error);

    }

    public function resetPasswordUser(Request $request) {

        $rules = [
            'phone'                 => 'required',
            'password'              => 'required',
            'password_confirmation' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $user = User::where('phone',$request->phone)->first();
        $phone_error = "رقم الهاتف غير موجود";

        if($user)
            $updated = $user->update(['password' => bcrypt($request->password)]);
        else
            return ApiController::respondWithErrorNOTFoundObject($phone_error);

        $success_password ="تم تحديث البيانات بنجاح";
        return $updated
            ? ApiController::respondWithMessageObject($success_password)
            : ApiController::respondWithServerErrorObject();
    }
    
    protected function sendResetPasswordCode($user) {

        $code = randNumber(4);
        //delete-old...
        ResetPassword::where('email', $user->email)->delete();
        //create-new...
        $created = ResetPassword::create([ 'email' => $user->email, 'token' => $code ]);

        //-------Send-Email--------
        $headingTitle = 'Confirmation Code For Resetting Password';
        $this->sendEmail($user->email, $code, $headingTitle);

        return $created;
    }
    protected function sendEmail($userEmail, $code, $headingTitle) {

        $data = [
            'mailSubject'   => 'Confirmation Code',
            'code'          => $code,
            'headingTitle'  => $headingTitle,
            'messagesTitle' => "الأطباء",
        ];


        Mail::to($userEmail)->send(new ConfirmCode($data));

        if( count(Mail::failures()) > 0 ) {
            Mail::to($userEmail)->send(new ConfirmCode($data));

            if( count(Mail::failures()) > 0 ) {
                Mail::to($userEmail)->send(new ConfirmCode($data));
            }
        }
    }

    // Edit User Profile "Phone"

    public function checkUserPhone(Request $request){

        $current_user = Auth::guard('api')->user();

        $rules = [
            'phone'                    => 'required|unique:users',
            'calling_code'             => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));


        $newUser = User::find($current_user->id)->update([
            'confirmation_code'          =>  rand(1000,9999),

        ]);

        /*send sms */
        $callingCode = $request->calling_code;
        /*end send sms*/

        $message = "تم إرسال الكود إلى الموبايل الخاص بك";
        return ApiController::respondWithSuccessMessage($message);


    }

    public function verifyUserPhone(Request $request){
        $current_user = Auth::guard('api')->user();

        $rules = [
            'phone'              => 'required',
            'code'               => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));


       $user=  User::find($current_user->id);
        if($user->confirmation_code == $request->code){
            User::where('id',$current_user->id)->update(['phone'=>$request->phone , 'confirmation_code'=>null]);
            $message = "تم تغير رقم الهاتف بنجاح";
            return ApiController::respondWithSuccessMessage($message);
        }else{
            $errors = "عفواً الكود غير متطابق";
            return ApiController::respondWithErrorObject($errors);
        }
    }

    // end Editing

    //Edit Password

    public function changePassword(Request $request){

        $current_user = Auth::guard('api')->user();

        $rules = [
            'oldPassword'           => 'required',
            'password'              => 'required',
            'password_confirmation' => 'required|same:password',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $oldPassword =  bcrypt($request->oldPassword);
        if($oldPassword == $current_user->password){

            User::find($current_user->id)->update([
                'password'          => bcrypt($request->password),
            ]);

            $message = "تم تغير كلمة المرور بنجاح";
            return ApiController::respondWithSuccessMessage($message);
        }

        $errors = "عفوًا كلمة المرور القديمة غير صحيحة";

        return ApiController::respondWithMessageObject($errors);

    }

    public function changeEmail(Request $request) { // Editing mail in profile
        $rules = [
            'email' => 'required|email',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $current_user = Auth::guard('api')->user();

        $email = $request->email;
        $saved = $this->sendResetEmailCode($email);

        $success = "لقد تم ارسال كود الاسترجاع على البريد الالكتروني الجديد";

        return ApiController::respondWithSuccessMessage($success);

    }

    public function confirmResetCodeEmail(Request $request) { // Editing mail in profile

        $rules = [
            'email'             => 'required|email',
            'reset_code'        => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $current_user = Auth::guard('api')->user();

        $data = User::find($current_user->id)->first();

        if($current_user->confirmation_code == $request->reset_code){
            $code= "كود الاسترجاع صحيح، لقد تم تغير البريد الإلكترونى";
            $updated = User::where('id',$current_user->id)->first()->update([
                'confirmation_code'=> null,
                'email' => $request->email
            ]);
            return  ApiController::respondWithSuccessMessage($code);
        }else{
            $errors="كود الاسترجاع غير صحيح";
            return  ApiController::respondWithMessageObject($errors);
        }




    }
    protected function sendResetEmailCode($email) {

        $code = randNumber(4);
        $current_user = Auth::guard('api')->user();
        $updated = User::where('id',$current_user->id)->first()->update([
            'confirmation_code'=> $code,
        ]);
        //-------Send-Email--------
        $headingTitle = 'كود التأكيد الخاص بتغير بريدك الإلكترونى';
        $this->sendConfirmationEmail($email, $code, $headingTitle);

        return $updated;
    }
    protected function sendConfirmationEmail($email, $code, $headingTitle) {

        $data = [
            'mailSubject'   => 'Confirmation Code',
            'code'          => $code,
            'headingTitle'  => $headingTitle,
            'messagesTitle' => "المستخدمين",
        ];


        Mail::to($email)->send(new ConfirmCode($data));

        if( count(Mail::failures()) > 0 ) {
            Mail::to($email)->send(new ConfirmCode($data));

            if( count(Mail::failures()) > 0 ) {
                Mail::to($email)->send(new ConfirmCode($data));
            }
        }
    }
    // End Editing

    public function doctorRequest(Request $request){
        $rules = [
            'name'          => 'required',
            'phone'         => 'required|string',
            'email'         => 'required|email',
            'spcializtion'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));
        }

        $doctor = new DoctorRequest();
        $doctor->name = $request->name;
        $doctor->phone = $request->phone;
        $doctor->email = $request->phone;
        $doctor->email = $request->email;
        $doctor->spcializtion = $request->spcializtion;
        $doctor->save();

        $message = "تم إرسال البيانات للإدارة وسيتم التواصل معك فى أقرب وقت";
        return ApiController::respondWithSuccessMessage($message);
    }


    public function countries(){

        $countries = Country::select('id','name_ar','callingcode','flag')->get();
        return ApiController::respondWithSuccess($countries);

    }

    public function cities($id){

        $cities = City::where('country_id',$id)->select('id','name_ar')->get();
        return ApiController::respondWithSuccess($cities);

    }
    public function send_sms($code,$number){
        $settings = App\Setting::find(1);
        $client = new \GuzzleHttp\Client();
        $url = "$settings->url?username=$settings->username&password=$settings->password&message=$code&numbers=$number&sender=$settings->sender";
        $res = $client->get($url);
        //
        $res->getStatusCode(); // 200
        $ans=$res->getBody();


    }

    public function uploadImage(Request $request){

        $rules = [
            'image'   => 'required|mimes:jpeg,bmp,png,jpg|max:5000',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $current_user = Auth::guard('api')->user();

        if($request->image != null){
            $image1 = $request->image;
            $imageName  = md5(uniqid(mt_rand())) . '.' . $image1->getClientOriginalExtension();
            $path = public_path('uploads/users/' . $imageName);
            Image::make($image1->getRealPath())->save($path);
            $request['image'] = $imageName;
        }

        $user= User::find($current_user->id)->first()->update([
            'image' => $imageName !== "" ? $imageName : $user->image,
        ]);

        if ($user){
            $message = "تم تغير الصورة بنجاح";
            return ApiController::respondWithSuccessMessage($message);
        }


    }
}
