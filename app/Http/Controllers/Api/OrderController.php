<?php

namespace App\Http\Controllers\Api;
use App\Order;
use App\Program;
use App\Sport;
use App\User;
use App\UserDevice;
use App\Weight;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use Illuminate\Support\Facades\Storage;
use Image;

class OrderController extends Controller
{
    //
    public function order_data(){
        $data=[
            'subscription_goals'=>Sport::whereType('goals')->select('id','text')->get(),
            'sports_levels'=>Sport::whereType('levels')->select('id','text')->get(),
            'sports_types'=>Sport::whereType('types')->select('id','text')->get(),
            'fats_area'=>Sport::whereType('fats')->select('id','text')->get(),
        ];
        return ApiController::respondWithSuccess($data);
    }
    public function add_order(Request $request)
    {
        $rules = [
            'program_id'            => 'required|exists:programs,id',
            'name'                  => 'required|string',
            'age'                   => 'required|numeric',
            'gender'                => 'required|numeric|in:1,2',
            'weight'                => 'required|numeric',
            'tall'                  => 'required|numeric',
            'health_diseases'       => 'required|in:0,1',
            'subscription_goals_id' => 'required|exists:sports,id',
            'sports_levels_id'      => 'required|exists:sports,id',
            'sports_types_id'       => 'required|exists:sports,id',
            'fats_area_id'          => 'required|exists:sports,id',
            'meals_number'          => 'nullable|numeric',
            'image'                 => 'nullable|image|mimes:jpeg,bmp,png,jpg|max:5000',
            'food_allergy'          => 'required|in:0,1',
            'medicine_status'       => 'required|in:0,1',
            'medicine_name'         => 'required_if:medicine_status,1',
            'right_arm'             => 'required|numeric',
            'left_arm'              => 'required|numeric',
            'chest'                 => 'required|numeric',
            'buttocks'              => 'required|numeric',
            'belly'                 => 'required|numeric',
            'right_thigh'           => 'required|numeric',
            'left_thigh'            => 'required|numeric',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        if ($request->file('image') !== null){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $path = public_path().'/uploads/orders';
            $file->move($path, $filename);
            $request['image'] = $filename;
        }
        $current_user = Auth::guard('api')->user();
        $request['user_id'] =  $current_user->id;
        $request['start_date'] = Carbon::now()->format('Y-m-d');
        $request['end_date'] = Carbon::now()->addMonths(Program::find($request->program_id)->period)->format('Y-m-d');
        $request['cost']=Program::find($request->program_id)->price;
        $request['period']=Program::find($request->program_id)->period;
        $data = Order::create($request->all());

        $success = "لقد تم ارسال البيانات بنجاح!";

        // doctor percentage in the order
        $program = Program::find($request->program_id);
        $doctorID = User::find($program->user_id);
        $doctorPercentage = $doctorID->percentage / 100 * 100 ;
        $doctorID->wallet = $doctorPercentage ;
        $doctorID->save();
        //
        /*doctors*/
        $doctor= Program::find($request->program_id);
        $doctorName= User::find($doctor->user_id);
        $doctorsToken=UserDevice::where('user_id',$doctor->user_id)
            ->where('is_open',1)
            ->get()
            ->pluck('device_token')
            ->toArray();
        $title = "اشتراك جديد";
        $message = " لقد اشترك ".$current_user->name." في برنامج ".$doctor->title." ,يمكنك المتابعه معه الآن. ";
        $allData=array(
            'title'=>$title,
            'message'=>$message,
            'type'=>2,
            'order_id'=>$data->id,
        );
        sendMultiNotification($title,$message,$allData,$doctorsToken);
        saveNotification($doctor->user_id, 2,$title,$message,$data->id);

      /*users */
        $usersToken=UserDevice::where('user_id',$current_user->id)
            ->where('is_open',1)
            ->get()
            ->pluck('device_token')
            ->toArray();
        $title = "اشتراك جديد";
        $message = " تم الاشترك بنجاح في برنامج ".$doctor->title." ,ويمكنك المتابعة الآن مع د. ".$doctorName->name;
        $allData=array(
            'title'=>$title,
            'message'=>$message,
            'type'=>2,
            'order_id'=>$data->id,
        );
        sendMultiNotification($title,$message,$allData,$usersToken);
        saveNotification($current_user->id, 2,$title,$message,$data->id);

        return $data
            ? ApiController::respondWithMessageObject($success)
            : ApiController::respondWithServerErrorObject();

    }

    public function allOrdersForUser(){
        $current_user = Auth::guard('api')->user();

        $orders   = Order::where('user_id',$current_user->id)->select('program_id','name','id','status')->paginate(10);
        $orders->map(function ($data){
            $data['title']=Program::find($data->program_id)->title;
        });
        $orders->makeHidden('program_id')->toArray();

        return ApiController::respondWithSuccess($orders);

    }
    public function allOrdersForDoctor(){
        $current_user = Auth::guard('api')->user();
        $orders = Order::whereHas('program', function($q) use($current_user) {
            $q->where('user_id', $current_user->id);
        })->select('program_id','name','id','status')->paginate(10);
        $orders->map(function ($data){
            $data['title']=Program::find($data->program_id)->title;
        });
        $orders->makeHidden('program_id')->toArray();


        return ApiController::respondWithSuccess($orders);

    }

    public function orderDetails($id){

        $order      = Order::find($id);
        $program    = Program::where('id',$order->program_id)->first();
        $doctor     = User::where('id',$program->user_id)->first();

        $data=[
            'order_id'              =>$order->id,
            'order_status'          =>$order->status,
            'order_start_date'      =>$order->start_date,
            'order_end_date'        =>$order->end_date,
            'program_id'            =>$program->id,
            'program_title'         =>$program->title,
            'program_period'        =>$order->period,
            'program_price'         =>$order->cost,
            'doctor_name'           =>$doctor->name,
            'doctor_specialization' =>$doctor->specialization,
            'doctor_img_path'       =>'/uploads/doctors/',
            'doctor_image'          =>$doctor->image,
        ];
        return ApiController::respondWithSuccess($data);
    }

    public function addWeight(Request $request){
        $rules = [
            'weight'    => 'required|numeric',
            'date'      => 'required|date',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));

        $current_user = Auth::guard('api')->user();
        if($current_user->type == 2){
            $request['user_id'] =  $current_user->id;
            $data = Weight::create($request->all());
            $success = "لقد تم حفظ البيانات بنجاح!";
            return ApiController::respondWithSuccessMessage($success);
        }else{
            $errors = "عفواً، لا يُسمح للطبيب بإدخال هذه البيانات";
            return ApiController::respondWithMessageObject($errors);
        }
    }
    public function weightHistory(){
        $current_user = Auth::guard('api')->user();
        $data = Weight::where('user_id', $current_user->id)->select('weight','date')->get();
         return ApiController::respondWithSuccess($data);

    }

}
