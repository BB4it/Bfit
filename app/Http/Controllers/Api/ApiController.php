<?php

namespace App\Http\Controllers\Api;

use App\About;
use App\AppAdd;
use App\ContactUs;
use App\Education;
use App\Field;
use App\Group;
use App\GroupUser;
use App\Notification;
use App\Question;
use App\Rating;
use App\Setting;
use App\TermsCondition;
use App\UserDevice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Validator;

class ApiController extends Controller
{

    public function listNotifications(Request $request) {

        $data = Notification::Where('user_id', $request->user()->id)->select('id', 'type','order_id', 'title', 'message', 'created_at')->orderBy('id','desc')->get();

        return $this->respondWithSuccess($data);
    }

    public function delete_Notifications($id , Request $request) {

        $data = Notification::Where('id', $id)->where('user_id',$request->user()->id)->delete();
        return $data
            ? $this->respondWithSuccess([])
            :$this->respondWithServerErrorArray();
    }

    public static function createUserDeviceToken($userId, $deviceToken, $deviceType) {

        $created = UserDevice::create(['user_id' => $userId, 'device_type' => $deviceType, 'device_token' => $deviceToken]);

        return $created;
    }

    public static function respondWithSuccess($data) {
        http_response_code(200);
        return response()->json(['mainCode'=> 1,'code' =>  http_response_code()  , 'data' => $data, 'message' => ""])->setStatusCode(200);
    }

    public static function respondWithSuccessMessage($message) {
        http_response_code(200);
        return response()->json(['mainCode'=> 1,'code' =>  http_response_code()  , 'data' => null , 'message' => $message])->setStatusCode(200);
    }

    public static function respondWithMessageArray($errors) {
        http_response_code(422);  // set the code
        return response()->json(['mainCode'=> 0,'code' =>  http_response_code()  , 'data' => [], 'message' => $errors])->setStatusCode(422);
    }public static function respondWithMessageObject($errors) {
        http_response_code(422);  // set the code
        return response()->json(['mainCode'=> 0,'code' =>  http_response_code()  , 'data' => null, 'message' => $errors])->setStatusCode(422);
    }
    public static function respondWithErrorArray($errors) {
        http_response_code(422);  // set the code
        return response()->json(['mainCode'=> 0,'code' =>  http_response_code()  , 'data' => [], 'message' => $errors])->setStatusCode(422);
    }public static function respondWithErrorObject($errors) {
        http_response_code(422);  // set the code
        return response()->json(['mainCode'=> 0,'code' =>  http_response_code()  , 'data' => null, 'message' => $errors])->setStatusCode(422);
    }
    public static function respondWithErrorNOTFoundObject($errors) {
        http_response_code(404);  // set the code
        return response()->json(['mainCode'=> 0,'code' =>  http_response_code()  , 'data' => null, 'message' => $errors])->setStatusCode(404);
    }
    public static function respondWithErrorNOTFoundArray($errors) {
        http_response_code(404);  // set the code
        return response()->json(['mainCode'=> 0,'code' =>  http_response_code()  , 'data' => [], 'message' => $errors])->setStatusCode(404);
    }
    public static function respondWithErrorClient($errors) {
        http_response_code(400);  // set the code
        return response()->json(['mainCode'=> 0,'code' =>  http_response_code()  , 'data' => [], 'message' => $errors])->setStatusCode(400);
    }
    public static function respondWithErrorAuthObject($errors) {
        http_response_code(401);  // set the code
        return response()->json(['mainCode'=> 0,'code' =>  http_response_code()  , 'data' => null, 'message' => $errors])->setStatusCode(401);
    }
    public static function respondWithErrorAuthArray($errors) {
        http_response_code(401);  // set the code
        return response()->json(['mainCode'=> 0,'code' =>  http_response_code()  , 'data' => [], 'message' => $errors])->setStatusCode(401);
    }


    public static function respondWithServerErrorArray() {
        $errors = ['key'=>'message',
                    'value'=> 'Sorry something went wrong, please try again'
        ];
        http_response_code(500);
        return response()->json(['mainCode'=> 0,'code' =>  http_response_code()  , 'data' => [], 'message' => $errors])->setStatusCode(500);
    }
    public static function respondWithServerErrorObject() {
        $errors = ['key'=>'message',
                    'value'=> 'Sorry something went wrong, please try again'
        ];
        http_response_code(500);
        return response()->json(['mainCode'=> 0,'code' =>  http_response_code()  , 'data' => null, 'message' => $errors])->setStatusCode(500);
    }

}
