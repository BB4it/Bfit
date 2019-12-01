<?php

namespace App\Http\Controllers\AdminController;

use App\Q_A;
use App\Setting;
use App\TermsCondition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Illuminate\Support\Facades\Redirect;
use Image;
use Auth;
use App\AboutApp;
use App\Permission;

class SettingController extends Controller
{
    //
    public function index()
    {

        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "settings.settings_view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $settings =settings();
            return view('admin.settings.index',compact('settings'));

//
        }else{
            return view('errors.503');
        }
    }
    public function store(Request $request)
    {
        $this->validate($request, [

            "name"          => "required|string|max:255",
            "description"   => "nullable",
            "keywords"      => "nullable",
            'phone'         => 'required|numeric',
            'email'         => 'required|string|email|max:255',


        ]);
        $data = request()->except(['_token']);
        Setting::where('id',1)->update($data);

        return Redirect::back()->with('success', 'تم حفظ البيانات بنجاح');


    }

    public function aboutApp()
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "settings.aboutApp_view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $aboutApp = AboutApp::find(1);
            return view('admin.settings.aboutApp',compact('aboutApp'));

            //
        }else{
            return view('errors.503');
        }

    }
    public function store_aboutApp(Request $request)
    {
        $this->validate($request, [

            "about"    => "required|string|max:255",

        ]);
        $data = request()->except(['_token']);
        AboutApp::where('id',1)->update($data);

        return Redirect::back()->with('success', 'تم حفظ البيانات بنجاح');

    }

    public function conditions_terms()
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "settings.conditions_view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $conditions = TermsCondition::find(1);
            return view('admin.settings.conditions',compact('conditions'));

            //
        }else{
            return view('errors.503');
        }

    }
    public function store_conditions_terms(Request $request)
    {
        $this->validate($request, [

            "terms"    => "required|string|max:255",

        ]);
        $data = request()->except(['_token']);
        TermsCondition::where('id',1)->update($data);

        return Redirect::back()->with('success', 'تم حفظ البيانات بنجاح');

    }


    public function questionAnswer()
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "settings.questionAnswer_view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            return view('admin.settings.questions',compact('questions'));
            //
        }else{
            return view('errors.503');
        }
    }

    public function store_questionAnswer(Request $request)
    {

        $this->validate($request, [

            'faq.*.question'    => 'required',
            'faq.*.answer'         => 'required|string|max:191',

        ]);


        $user= Q_A::find(1)->update([
            'q_a'=> serialize($request->faq),
        ]);

        if($user){
            return Redirect::back()->with('success', 'تم حفظ البيانات بنجاح');
        }


    }

}
