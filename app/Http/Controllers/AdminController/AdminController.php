<?php

namespace App\Http\Controllers\AdminController;

use App\Admin;
use App\Permission;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function my_profile()
    {

            $data = Admin::find(Auth::id());
            return view('admin.admins.profile.profile', compact('data'));

    }
    public function my_profile_edit(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:admins,email,'.Auth::id(),
//            'password' => 'required|string|min:6|confirmed',
//            'password_confirm' => 'required_with:password|same:password|min:4',
            'phone' => 'required',
        ]);
            $data = Admin::where('id',Auth::id())->update(['name'=>$request->name ,
                'email'=>$request->email,
                'phone'=>$request->phone
                ]);
        return redirect(url('/admin/profile'))->with('msg', 'تم التعديل بنجاح');

    }
    public function change_pass()
    {

        return view('admin.admins.profile.change_pass');

    }
    public function change_pass_update(Request $request)
    {
        $this->validate($request, [

            'password' => 'required|string|min:6|confirmed',

        ]);


        $updated = Admin::where('id',Auth::id())->update([
            'password'=>Hash::make($request->password)
        ]);

        return redirect(url('/admin/profileChangePass'))->with('msg', 'تم التعديل بنجاح');
    }
    public function index()
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "admin.view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $data = Admin::all();
            return view('admin.admins.admins.index', compact('data'));

        }else{
            return view('errors.503');
        }

    }
//    public function show($id)
//    {
//
//        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
//        $true = '';
//        foreach ($admin as $item){
//            $permission = Permission::find($item->permission_id);
//            if ($permission->permission_name === "admin.show"){
//                $true = 'true';
//            }
//        }
//        if ($true == 'true') {
//
//
//            $data = Admin::find($id);
//            $role_id = DB::table('admin_role')->where('admin_id', $id)->first();
//            $role = Role::where('id', $role_id->role_id)->first();
//            return view('admins.admins.show', compact('data', 'role'));
//
//
//        }else{
//            return view('errors.503');
//        }
//
//    }
    public function create()
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "admin.create"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $data = Role::all();
            return view('admin.admins.admins.create', compact('data'));


        }else{
            return view('errors.503');
        }

    }
    public function edit($id)
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "admin.edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $data = Admin::find($id);
            $role = Role::all();
            $admin = DB::table('admin_role')->where('admin_id', $id)->first();
            return view('admin.admins.admins.edit', compact('data', 'role', 'admin'));


        }else{
            return view('errors.503');
        }

    }
    public function store(Request $request)
    {
//        dd($request->role);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
//            'password_confirm' => 'required_with:password|same:password|min:4',
            'phone' => 'required',
            'role' => 'required',
        ]);



        $request['remember_token'] = Str::random(60);
        $request['password'] = Hash::make($request->password);

        $permission_role = Admin::create($request->all());

        $permission_role->roles()->attach($request->role);
        $array = [];
        $permission = DB::table('permission_role')->where('role_id', $request->role)->get();
        foreach ($permission as $perm){
            array_push($array, $perm->permission_id);
        }
        $permission_role->permissions()->attach($array);

        return redirect(url('/admin/admins'))->with('msg', 'تم الاضافه بنجاح');
    }
    public function update(Request $request, $id)
    {
//        dd($request->role);
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:admins,email,'.$id,
//            'password' => 'required|string|min:6|confirmed',
//            'password_confirm' => 'required_with:password|same:password|min:4',
            'phone' => 'required',
            'role' => 'required',
        ]);



        $request['remember_token'] = Str::random(60);
//        $request['password'] = Hash::make($request->password);

        Admin::where('id',$id)->first()->update($request->all());

        $permission_role = Admin::where('id',$id)->first();

        $permission_role->roles()->sync($request->role);

        $array = [];
        $permission = DB::table('permission_role')->where('role_id', $request->role)->get();
        foreach ($permission as $perm){
            array_push($array, $perm->permission_id);
        }
        $permission_role->permissions()->sync($array);

        return redirect(url('/admin/admins'))->with('msg', 'تم التعديل بنجاح');
    }
    public function admin_delete($id)
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "admin.delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {



            DB::table('admin_role')->where('admin_id', $id)->delete();
            DB::table('admin_permission')->where('admin_id', $id)->delete();
            Admin::where('id', $id)->delete();
            return back()->with('msg', 'تم الحذف بنجاح');


        }else{
            return view('errors.503');
        }

    }

    public function show_permissions($id)
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "admin.show_permissions"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $data = DB::table('admin_permission')->where('admin_id', $id)
                ->get();
            $permissions = DB::table('permissions')->get();
            return view('admin.admins.admins.show_permissions', compact('data', 'permissions', 'id'));

            //
        }else{
            return view('errors.503');
        }

    }
    public function update_admin_permission(Request $request, $id)
    {

        $permission_role = Admin::where('id',$id)->first();
        $permission_role->permissions()->sync($request->permission);

        return redirect(url('/admin/admins'))->with('msg', 'تم التعديل بنجاح');

    }
}
