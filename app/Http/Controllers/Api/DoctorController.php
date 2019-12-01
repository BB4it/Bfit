<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Program;
use App\User;
use Illuminate\Support\Facades\Request;
use Auth;
use App\Order;
class DoctorController extends Controller
{
    public function allDoctors(){

        $doctors = User::where('type',1)->where('active',1)->inRandomOrder()->select('id','name','image','specialization')->paginate(10);
        $doctors->map(function ($data){
            $data['doctor_img_path']='/uploads/doctors/';
        });

        return ApiController::respondWithSuccess($doctors);
    }

    public function doctorDetails($id){

        $doctor = User::where('id',$id)->where('active',1)->first();
        if (!$doctor){
            $error ="هذا الدكتور غير موجود";
            return ApiController::respondWithErrorNOTFoundObject(array($error));
        }

        $data=[
            'doctor_id'=>$doctor->id,
            'doctor_name'=>$doctor->name,
            'doctor_description'=>$doctor->description,
            'doctor_available'=>$doctor->available,
            'doctor_img_path'=>'/uploads/doctors/',
            'doctor_image'=>$doctor->image,
            'program_count'=> Program::where('user_id',$doctor->id)->count(),
            'programs'=>Program::where('user_id',$doctor->id)->select('id','title','price','period')->paginate(10),
        ];
        if ($doctor)
            return $doctor
                ? ApiController::respondWithSuccess($data)
                : ApiController::respondWithServerErrorObject();

    }

    public function program_details($id){

        $program = Program::find($id);
        $doctor = User::where('id',$program->user_id)->first();

        $data=[
            'doctor_id'=>$doctor->id,
            'doctor_name'=>$doctor->name,
            'doctor_specialization'=>$doctor->specialization,
            'doctor_img_path'=>'/uploads/doctors/',
            'doctor_image'=>$doctor->image,
            'progam_title'=>$program->title,
            'progam_description'=>$program->description,
            'program_img_path'=>'/uploads/programs/',
            'progam_image'=>$program->image,
            'progam_period'=>$program->period,
            'progam_price'=>$program->price,
        ];

        if ($program)
            return ApiController::respondWithSuccess($data);

    }

    public function statistics(){
        $current_user = Auth::guard('api')->user();
        $current_order=Order::whereHas('program', function($q) use($current_user) {
                                    $q->where('user_id', $current_user->id);
                                })->where('status',1)->count();
        $end_order=Order::whereHas('program', function($q) use($current_user) {
                                    $q->where('user_id', $current_user->id);
                                })->where('status',0)->count();
        $all_order=Order::whereHas('program', function($q) use($current_user) {
                                    $q->where('user_id', $current_user->id);
                                })->count();
        $data=[
            'current_order_count'=>$current_order,
            'end_order_count'=>$end_order,
            'all_order_count'=>$all_order,
            'wallet'=>$current_user->wallet,
        ];
        return ApiController::respondWithSuccess($data);
    }

}
