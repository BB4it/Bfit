<?php


namespace App\Http\Controllers\Api;


use App\Contact;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Validator;
use Auth;

class ContactController extends Controller
{
    //
    public function contact(Request $request){
        $rules = [
            'name'        => 'required|string',
            'phone'       => 'required|numeric',
            'email'       => 'required|email',
            'message'     => 'required',

        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails())
            return ApiController::respondWithErrorObject(validateRules($validator->errors(), $rules));


        $current_user = Auth::guard('api')->user();
        $data = new Contact();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->message = $request->message;
        $data->user_id = $current_user->id;
        $data->save();
        $success = "لقد تم الإرسال بنجاح!";

        return $data
            ? ApiController::respondWithSuccessMessage($success)
            : ApiController::respondWithServerErrorObject();
    }
}
