<?php


namespace App\Http\Controllers\AdminController;

use App\Sport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Auth;
use App\Permission;
use DB;

class SportsController extends Controller
{
    //
    public function index(){
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "sports.view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $sports = Sport::orderBY('id','desc')->get();
            return view('admin.sports.index',compact('sports'));

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
            if ($permission->permission_name === "sports.create"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            return view('admin.sports.create');

            //
        }else{
            return view('errors.503');
        }
    }

    public function store(Request $request){
        $this->validate($request, [

            "text"         => "required|string|max:255",
            "type"         => "required",

        ]);

        Sport::create($request->all());

        return redirect('admin/sports');
    }


    public function edit($id){
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "sports.edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $sport = Sport::findOrfail($id);
            return view('admin.sports.edit',compact('sport'));
            //
        }else{
            return view('errors.503');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            "text"         => "required|string|max:255",
            "type"         => "required",

        ]);

        $sport = Sport::findOrfail($id);

        $sport->text         = $request->text;
        $sport->type         = $request->type;
        $sport->save();
        return redirect('admin/sports');
    }

    public function destroy($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "sports.delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $sport = Sport::find($id);
            $sport->delete();
            return back();

        }else{
            return view('errors.503');
        }



    }
}
