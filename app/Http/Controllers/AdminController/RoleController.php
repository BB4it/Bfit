<?php

namespace App\Http\Controllers\AdminController;

use App\Admin;
use App\Permission;
use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function index()
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "roles.view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $data = Role::all();
            return view('admin.admins.groups.index', compact('data'));
//
//
        }else{
            return view('errors.503');
        }
    }
    public function show($id)
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "roles.show"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $item = Role::find($id);

            $data = DB::table('permission_role')->where('role_id', $item->id)
                ->get();
            $permissions = DB::table('permissions')->get();
            $members = DB::table('admin_role')->where('role_id' , $id)->count();
            return view('admin.admins.groups.show', compact('item', 'data', 'members', 'permissions'));


        }else{
            return view('errors.503');
        }
    }
    public function create()
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "roles.create"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $data = Permission::all();
            return view('admin.admins.groups.create', compact('data'));


        }else{
            return view('errors.503');
        }

    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'role_name' => 'required',
        ]);

        $permission_role = Role::create([
            'role_name' => $request->role_name
        ]);

        $permission_role->permissions()->attach($request->permission);

        return redirect(url('/admin/roles'))->with('msg', 'تم الاضافه بنجاح');
    }
    public function edit(Request $request, $id)
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "roles.edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $item = Role::find($id);
            $data = DB::table('permission_role')->where('role_id', $item->id)
                ->get();
            $permissions = DB::table('permissions')->get();
            $members = DB::table('admin_role')->where('role_id' , $id)->count();
            return view('admin.admins.groups.edit', compact('item', 'data', 'members', 'permissions'));


        }else{
            return view('errors.503');
        }
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'role_name' => 'required',
        ]);

        Role::where('id',$id)->first()->update($request->all());

        $permission_role = Role::find($id);
        $permission_role->permissions()->sync($request->permission);

        if ($permission_role){
            $role = DB::table('admin_role')->where('role_id', $id)->get();
            foreach ($role as $item){
                $permission_role = Admin::where('id',$item->admin_id)->first();

                $permission_role->permissions()->sync($request->permission);
            }
        }
        return redirect(url('/admin/roles'))->with('msg', 'تم التعديل بنجاح');
    }
    public function update_permission(Request $request, $id)
    {
        $permission_role = Role::find($id);
        $permission_role->permissions()->sync($request->permission);

        if ($permission_role){
            $role = DB::table('admin_role')->where('role_id', $id)->get();
            foreach ($role as $item){
                $permission_role = Admin::where('id',$item->admin_id)->first();

                $permission_role->permissions()->sync($request->permission);
            }
        }
        return redirect(url('/admin/roles'))->with('msg', 'تم التعديل بنجاح');
    }
    public function destroy($id)
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "roles.delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            DB::table('permission_role')->where('role_id', $id)->delete();
            Role::where('id', $id)->delete();
            return back()->with('msg', 'تم الحذف بنجاح');


        }else{
            return view('errors.503');
        }

    }
    public function roles_members($id)
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "roles.show_admins_group"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $role = Role::find($id);
            $data = DB::table('admin_role')
                ->where('role_id', $id)
                ->join('admins', 'admin_role.admin_id', '=', 'admins.id')->get();
            return view('admin.admins.groups.group_members', compact('data', 'role'));


        }else{
            return view('errors.503');
        }

    }
}
