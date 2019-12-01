<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Country;
use DB;
use Auth;
use App\Permission;
use Image;

class CountryController extends Controller
{
    //
    public function index()
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "countries.countries_view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $countries = Country::orderBY('id','desc')->paginate(10);
            return view('admin.countries.index',compact('countries'));

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
            if ($permission->permission_name === "countries.countries_create"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

        return view('admin.countries.create');

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
            "name"  => "required|string|max:255",
            "code"  => "required|numeric",
            "photo_flag"  => "required|image|mimes:jpeg,bmp,png,jpg|max:5000",

        ]);
        $image = $request->file('photo_flag');
        $imageName  = md5(uniqid(mt_rand())) . '.' . $image->getClientOriginalExtension();
        $path = public_path('flags/' . $imageName);
        Image::make($image->getRealPath())->save($path);
        $request['flag_icon'] = $imageName;
        Country::create($request->all());

        return redirect('admin/country');
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
            if ($permission->permission_name === "countries.countries_edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $country = Country::findOrfail($id);
            return view('admin.countries.edit',compact('country'));

//
        }else{
            return view('errors.503');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            "name_ar"      => "required|string|max:255",
            "status"    => "required|numeric",

        ]);
        $countries = Country::findOrfail($id);

        $countries->name_ar    = $request->name_ar;
        $countries->status      = $request->status;
        $countries->save();
        return redirect('admin/country');
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
            if ($permission->permission_name === "countries.country_delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {
            $countries = Country::find($id);
            $cities = Country::where('parent_id',$id)->get();
            if (count($cities) !== 0){
                return Redirect::back()->with('msg', 'لا تسطيع مسح الدولة لانها مستخدمة');
            }else{
                $countries->delete();
                return back();
            }
//
        }else{
            return view('errors.503');
        }


    }
}
