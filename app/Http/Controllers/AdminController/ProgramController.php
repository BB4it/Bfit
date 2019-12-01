<?php

namespace App\Http\Controllers\AdminController;

use App\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Auth;
use App\Permission;
use DB;
class ProgramController extends Controller
{
    //
    public function index(){
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "programs.view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $programs = Program::orderBY('id','desc')->get();
            return view('admin.programs.index',compact('programs'));

            //
        }else{
            return view('errors.503');
        }
    }
    public function create(){
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "programs.create"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            return view('admin.programs.create');

            //
        }else{
            return view('errors.503');
        }
    }

    public function store(Request $request){
        $this->validate($request, [
            "title"         => "required|string|max:255",
            "price"         => "required",
            "description"   => "required",
            "period"        => "required",
            "user_id"       => "required",
            "photo"         => "required|image|mimes:jpeg,bmp,png,jpg|max:5000",

        ]);
//        return "Okay validation ";

        $image = $request->file('photo');
        $imageName  = md5(uniqid(mt_rand())) . '.' . $image->getClientOriginalExtension();
        $path = public_path('uploads/programs/' . $imageName);
        Image::make($image->getRealPath())->save($path);


        $request['image']   = $imageName;
        $request['user_id'] = $request->user_id;
        Program::create($request->all());

        return redirect('admin/programs');
    }

    public function edit($id){
            //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "programs.edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $program = Program::findOrfail($id);
            return view('admin.programs.edit',compact('program'));
            //
        }else{
            return view('errors.503');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "title"         => "required|string|max:255",
            "price"         => "required",
            "description"   => "required",
            "period"        => "required",
            "user_id"       => "required",
            "photo"         => "nullable|image|mimes:jpeg,bmp,png,jpg|max:5000",

        ]);
        $program = Program::findOrfail($id);
        if ($request->photo !== null){
            $image = $request->photo;
            $imageName  = md5(uniqid(mt_rand())) . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/programs/' . $imageName);
            Image::make($image->getRealPath())->save($path);
            @unlink(public_path('uploads/programs/'.$program->image));
            $program->image = $imageName;
        }else{
//            @unlink(public_path('img/'.$settings->fav_icon));
            $program->image=$program->image;
        }

        $program->title         = $request->title;
        $program->price         = $request->price;
        $program->description   = $request->description;
        $program->period        = $request->period;
        $program->user_id       = $request->user_id;
        $program->save();
        return redirect('admin/programs');
    }

    public function destroy($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "programs.delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $program = Program::find($id);
            @unlink(public_path('uploads/programs/'.$program->image));
            $program->delete();
            return back();

        }else{
            return view('errors.503');
        }



    }
}
