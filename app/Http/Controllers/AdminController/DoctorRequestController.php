<?php
namespace App\Http\Controllers\AdminController;

use App\City;
use App\Country;
use App\DoctorRequest;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Permission;
use Image;
use Illuminate\Support\Facades\Storage;

class DoctorRequestController extends Controller
{
    //
    public function index()
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "doctorRequest.view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $requests = DoctorRequest::orderBY('id','desc')->get();
            return view('admin.doctorRequest.index',compact('requests'));

            //
        }else{
            return view('errors.503');
        }
    }

    public function show($id){
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "doctorRequest.show"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $request = DoctorRequest::findOrfail($id);
            return view('admin.doctorRequest.show',compact('request'));
            //
        }else{
            return view('errors.503');
        }
    }
    public function destroy($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "doctorRequest.delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $request = DoctorRequest::find($id);
            $request->delete();
            return back();

        }else{
            return view('errors.503');
        }



    }
}
