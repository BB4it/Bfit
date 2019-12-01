<?php

namespace App\Http\Controllers\AdminController;

use App\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ad;
use App\Country;
use App\User;
use Illuminate\Support\Facades\Redirect;
use DB;
use Auth;
use App\Permission;

class CityController extends Controller
{
    //
    public function index()
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "countries.city_view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $cities = City::orderBy('id','desc')->paginate(10);
//        dd($cities);
            return view('admin.cities.index',compact('cities'));

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
            if ($permission->permission_name === "countries.city_create"){
                $true = 'true';
            }
        }
        if ($true == 'true') {
            $countries = Country::orderBy('id','desc')->get();
            return view('admin.cities.create',compact('countries'));

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
            "name_ar"       => "required|string|max:255",
            "country_id"    => "required",
            "code"          => "required",

        ]);

        Country::create($request->all());

        return redirect('admin/city');

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
            if ($permission->permission_name === "countries.city_edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {
            $city= City::findOrfail($id);
            $countries = Country::orderBy('id','desc')->get();
            return view('admin.cities.edit',compact('countries','city'));
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
            "name_ar"       => "required|string|max:255",
            "country_id"    => "required",
            "code"          => "required",

        ]);
        $city = City::find($id);
        $city->name_ar = $request->name_ar;
        $city->country_id = $request->country_id;
        $city->code = $request->code;
        $city->save();
        return redirect('admin/city');
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
            if ($permission->permission_name === "countries.city_delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {
            $cities = City::findOrfail($id);
//          s
                $cities->delete();
                return back();

        }else{
            return view('errors.503');
        }

    }
}
