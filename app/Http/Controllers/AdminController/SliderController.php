<?php

namespace App\Http\Controllers\AdminController;

use App\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Auth;
use App\Permission;
use DB;

class SliderController extends Controller
{
    //
    public function index()
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "sliders.sliders_view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


        $sliders = Slider::orderBY('order','asc')->get();
        return view('admin.sliders.index',compact('sliders'));

        //
        }else{
            return view('errors.503');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "sliders.sliders_create"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

        return view('admin.sliders.create');

//
        }else{
            return view('errors.503');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $this->validate($request, [
            "title"  => "required|string|max:255",
            "order"  => "required",
            "file_upload"  => "required|image|mimes:jpeg,bmp,png,jpg|max:5000",

        ]);
        $image = $request->file('file_upload');
        $imageName  = md5(uniqid(mt_rand())) . '.' . $image->getClientOriginalExtension();
        $path = public_path('uploads/sliders/' . $imageName);
        Image::make($image->getRealPath())->save($path);

        $request['image'] = $imageName;
        Slider::create($request->all());

        return redirect('admin/slider');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "sliders.sliders_edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

        $slider = Slider::findOrfail($id);
        return view('admin.sliders.edit',compact('slider'));

//
        }else{
            return view('errors.503');
        }

    }


    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            "title"  => "required|string|max:255",
            "order"  => "required",
            "photo"  => "required|image|mimes:jpeg,bmp,png,jpg|max:5000",

        ]);
        $sliders = Slider::findOrfail($id);
        if ($request->photo !== null){
            $image = $request->photo;
            $imageName  = md5(uniqid(mt_rand())) . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/sliders/' . $imageName);
            Image::make($image->getRealPath())->resize(1850, 545.22)->save($path);
            @unlink(public_path('upload/'.$sliders->image));
            $sliders->image = $imageName;
        }else{
//            @unlink(public_path('img/'.$settings->fav_icon));
            $sliders->image=$sliders->image;
        }
        $sliders->title = $request->title;
        $sliders->order = $request->order;
        $sliders->save();
        return redirect('admin/slider');
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
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "sliders.sliders_delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

        $sliders = Slider::find($id);
        @unlink(public_path('upload/'.$sliders->image));

        $sliders->delete();
        return back();


        //
        }else{
            return view('errors.503');
        }



    }
}
