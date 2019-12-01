<?php

namespace App\Http\Controllers\AdminController;

use App\City;
use App\Country;
use App\Http\Controllers\Controller;
use App\Order;
use App\Program;
use App\User;
use App\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Permission;
use Image;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';

            $cities = Country::all();
            if ($id == 1){
                //1 for doctor
                foreach ($admin as $item){
                    $permission = Permission::find($item->permission_id);
                    if ($permission->permission_name === "users.doctor_view"){
                        $true = 'true';
                    }
                }
                if ($true == 'true') {
                $users =User::orderBy('id','desc')->where('type',1)->get();
                return view('admin.users.index_doctor',compact('cities','users'));
                }else{
                    return view('errors.503');
                }
            }elseif ($id == 2){
                foreach ($admin as $item){
                    $permission = Permission::find($item->permission_id);
                    if ($permission->permission_name === "users.user_view"){
                        $true = 'true';
                    }
                }
                if ($true == 'true') {
                $users =User::orderBy('id','desc')->where('type',2)->get();
                return view('admin.users.index_user',compact('cities','users'));
                }else{
                    return view('errors.503');
                }
            }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
            $countries = Country::all();
            $cities = City::all();
            if ($id == 1){
                //1 for diploma
                foreach ($admin as $item){
                    $permission = Permission::find($item->permission_id);
                    if ($permission->permission_name === "users.doctor_create"){
                        $true = 'true';
                    }
                }
                if ($true == 'true') {
                return view('admin.users.create_doctor' ,compact('countries','cities'));
                }else{
                    return view('errors.503');
                }
            }elseif ($id == 2){
                foreach ($admin as $item){
                    $permission = Permission::find($item->permission_id);
                    if ($permission->permission_name === "users.user_create"){
                        $true = 'true';
                    }
                }
                if ($true == 'true') {

                $users =User::orderBy('id','desc')->where('type',2)->get();
                return view('admin.users.create_user',compact('countries','cities'));
                }else{
                    return view('errors.503');
                }
            }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$type)
    {
        //

        if($type == 1){
            $this->validate($request, [
                'name'                  => 'required|string|min:5|max:255|unique:users',
                'email'                 => 'required|string|email|max:255|unique:users',
                'phone'                 => 'required|numeric|unique:users',
                'city_id'               => 'required',
                'country_id'            => 'required',
                'notification'          => 'required', // 1 on , 0 off
                'active'                => 'required',
                'description'           => 'required',
                'percentage'            => 'required',
                'available'             => 'required',
                'specialization'        => 'required',
                'image'                 => 'nullable|mimes:jpeg,bmp,png,jpg|max:5000',
                'wallet'                => 'nullable|numeric',
                'password'              => 'required|string|min:6|confirmed',
                'password_confirmation' =>'required|same:password',

            ]);
            // to save profile_image
            if($request->image != null){
                $image1 = $request->image;
                $imageName  = md5(uniqid(mt_rand())) . '.' . $image1->getClientOriginalExtension();
                $path = public_path('uploads/users/' . $imageName);
                Image::make($image1->getRealPath())->save($path);
                $request['image'] = $imageName;
            }
            // end profile_image
            $user= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'city_id' => $request->city_id,
                'country_id' => $request->country_id,
                'description' => $request->description,
                'type' => 1,
                'wallet' => $request->wallet,
                'available' => $request->available,
                'specialization' => $request->specialization,
                'notification' => $request->notification,
                'password' => Hash::make($request->password),
                'active'=>$request->active,
                'percentage'=>$request->percentage,
            ]);

            return redirect('admin/user/1');
        }elseif ($type == 2){
            $this->validate($request, [
                'name'                  => 'required|string|min:5|max:255|unique:users',
                'email'                 => 'required|string|email|max:255|unique:users',
                'phone'                 => 'required|numeric|unique:users',
                'city_id'               => 'required',
                'country_id'            => 'required',
                'notification'          => 'required', // 1 on , 0 off
                'active'                => 'required',
                'image'                 => 'nullable|mimes:jpeg,bmp,png,jpg|max:5000',
                'password'              => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required|same:password',

            ]);

            if($request->image != null){
                $image1 = $request->image;
                $imageName  = md5(uniqid(mt_rand())) . '.' . $image1->getClientOriginalExtension();
                $path = public_path('uploads/users/' . $imageName);
                Image::make($image1->getRealPath())->save($path);
                $request['image'] = $imageName;
            }
            $user= User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'city_id' => $request->city_id,
                'country_id' => $request->country_id,
                'type' =>2,
                'notification' => $request->notification,
                'password' => Hash::make($request->password),
                'active'=>$request->active,
            ]);

            return redirect('admin/user/2');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,$type)
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
    
        $countries = Country::all();

        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "users.user_edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $user = User::findOrfail($id);
            return view('admin.users.show_user' ,compact('countries','user'));

        }else{
            return view('errors.503');
        }

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$type)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        

            $countries = Country::all();
            $cities = City::all();
            if ($type == 1){
                //1 for diploma
                foreach ($admin as $item){
                    $permission = Permission::find($item->permission_id);
                    if ($permission->permission_name === "users.doctor_edit"){
                        $true = 'true';
                    }
                }
                if ($true == 'true') {
                $user = User::findOrfail($id);
                return view('admin.users.edit_doctor' ,compact('countries','user','cities'));
                }else{
                    return view('errors.503');
                }
            }elseif ($type == 2){
                foreach ($admin as $item){
                    $permission = Permission::find($item->permission_id);
                    if ($permission->permission_name === "users.user_edit"){
                        $true = 'true';
                    }
                }
                if ($true == 'true') {
                $user = User::findOrfail($id);
                return view('admin.users.edit_user' ,compact('countries','user','cities'));
                }else{
                    return view('errors.503');
                }
            }
        //
        // }else{
        //     return view('errors.503');
        // }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id,$type)
    {

        //
        if($type == 1){
            $this->validate($request, [
                'name'                  => 'required|string|min:5|max:255',
                'phone'                 => 'required|numeric|unique:users,phone,'.$id,
                'email'                 => 'required|string|email|max:255|unique:users,email,'.$id,
                'city_id'               => 'required',
                'country_id'            => 'required',
                'description'           => 'required',
                'percentage'            => 'required',
                'specialization'        => 'required',
                'image'                 => 'nullable|mimes:jpeg,bmp,png,jpg|max:5000',
                'wallet'                => 'nullable|numeric',

            ]);
            $users = User::find($id);
            // to save profile_image
            $imageName="";
            if ($request->image !== null){
                @unlink(public_path('upload/'.$users->image));
                $image1 = $request->image;
                $imageName  = md5(uniqid(mt_rand())) . '.' . $image1->getClientOriginalExtension();
                $path = public_path('uploads/users/' . $imageName);
                Image::make($image1->getRealPath())->save($path);
            }
            // end profile_image


            User::where('id',$id)->first()->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => 1,
                'wallet' => $request->wallet,
                'specialization' => $request->specialization,
                'description' => $request->description,
                'image' => $imageName !== "" ? $imageName : $users->image,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
                'percentage' => $request->percentage,

            ]);

            return redirect()->back()->with('information', 'تم تعديل بيانات المستخدم');
        }elseif ($type == 2){
            $this->validate($request, [
                'name'                  => 'required|string|min:5|max:255',
                'phone'                 => 'required|numeric|unique:users,phone,'.$id,
                'email'                 => 'required|string|email|max:255|unique:users,email,'.$id,
                'city_id'               => 'required',
                'country_id'            => 'required',
                'image'                 => 'nullable|mimes:jpeg,bmp,png,jpg|max:5000',

            ]);
            $users = User::find($id);
            // to save profile_image
            $imageName="";
            if ($request->image !== null){
                @unlink(public_path('upload/'.$users->image));
                $image1 = $request->image;
                $imageName  = md5(uniqid(mt_rand())) . '.' . $image1->getClientOriginalExtension();
                $path = public_path('uploads/users/' . $imageName);
                Image::make($image1->getRealPath())->save($path);
            }
            // end profile_image

            $user= User::where('id',$id)->first()->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => 2,
                'image' => $imageName !== "" ? $imageName : $users->image,
                'country_id' => $request->country_id,
                'city_id' => $request->city_id,
            ]);

            return redirect()->back()->with('information', 'تم تعديل بيانات المستخدم');
        }
    }
    public function update_pass(Request $request, $id)
    {
        //
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',

        ]);
        $users = User::findOrfail($id);
        $users->password = Hash::make($request->password);

        $users->save();

        return redirect()->back()->with('information', 'تم تعديل كلمة المرور المستخدم');
    }
    public function update_privacy(Request $request, $id)
    {
        //
        $this->validate($request, [

            'active'        => 'required',
            'available'     => 'required_if:type,==,1',
            'notification'  => 'required',

        ]);
        $users = User::findOrfail($id);
        $users->active =$request->active;
        $users->notification =$request->notification;
        if($users->type == 1){
            $users->available =$request->available;
        }

        $users->save();

        return redirect()->back()->with('information', 'تم تعديل اعدادات المستخدم');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        
            $users = User::find($id);
            if($users->type == 1){
                foreach ($admin as $item){
                    $permission = Permission::find($item->permission_id);
                    if ($permission->permission_name === "users.doctor_delete"){
                        $true = 'true';
                    }
                }
                if ($true == 'true') {
                    @unlink(public_path('uploads/users/'.$users->image));
                    $users->delete();

                    return back();
                }else{
                    return view('errors.503');
                }
            }elseif ($users->type == 2){
                foreach ($admin as $item){
                    $permission = Permission::find($item->permission_id);
                    if ($permission->permission_name === "users.user_delete"){
                        $true = 'true';
                    }
                }
                if ($true == 'true') {

                    @unlink(public_path('uploads/users/'.$users->image));
                    $users->delete();
                    return back();
                }else{
                    return view('errors.503');
                }
            }

    }

    public function get_cities($id)
    {
        //
        $cities = City::where('country_id',$id)->get();

        $data['cities']= $cities;

        //dd($cities);

        return json_encode($data);

    }
    public function doctorDetails($id)
    {
        //
        $data = User::find($id);
        $current_order=Order::whereHas('program', function($q) use($id) {
            $q->where('user_id', $id);
        })->where('status',1)->count();
        $end_order=Order::whereHas('program', function($q) use($id) {
            $q->where('user_id', $id);
        })->where('status',0)->count();
        $all_order=Order::whereHas('program', function($q) use($id) {
            $q->where('user_id', $id);
        })->count();
        $programs= Program::where('user_id',$id)->count();

        return view('admin.users.doctor_details',compact('data','current_order','end_order','all_order',
            'programs'));

    }
    public function userDetails($id)
    {
        //
        $data = User::find($id);
        $current_order=Order::whereUserId($id)->where('status',1)->count();
        $end_order=Order::whereUserId($id)->where('status',0)->count();
        $all_order=Order::whereUserId($id)->count();
        $programs= Program::where('user_id',$id)->count();

        return view('admin.users.user_details',compact('data','current_order','end_order','all_order',
            'programs'));

    }
    public function doctorPrograms($id)
    {
        //
        $programs = Program::orderBY('id','desc')->where('user_id',$id)->get();
        return view('admin.users.programs',compact('programs'));

    }
    public function doctorOrders($id)
    {
        //
        $orders =Order::whereHas('program', function($q) use($id) {
            $q->where('user_id', $id);
        })->where('status',1)->get();
        return view('admin.users.orders',compact('orders'));

    }
    public function programDetails($id)
    {
        //
        $program = Program::findOrfail($id);
        return view('admin.users.program_details',compact('program'));

    }
    public function userWeight($id)
    {
        //
        $data = Weight::whereUserId($id)->paginate(10);
        return view('admin.users.weight_details',compact('data'));

    }
    public function userOrders($id)
    {
        //
        $orders =Order::where('user_id',$id)->get();
        return view('admin.users.orders',compact('orders'));

    }


    public function emptyWallet($id){

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';

        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "users.doctor_delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $user = User::find($id);
            $user->wallet = 0;
            $user->save();
            return back()->with('success','تم تصفير المحفظة بنجاح');

        }else{
            return view('errors.503');
        }
    }


}
