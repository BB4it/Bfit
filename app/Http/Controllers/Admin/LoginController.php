<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }
    public function showLoginForm()
    {
        return view('admin.authAdmin.login');
    }
    public function login(Request $request)
    {
        App::setLocale('ar');
        $this->validate($request,[
            'email'=>'required|email',
            'password'=>'required|min:6',
            'g-recaptcha-response'=>'required',
        ]);

        $client = new \GuzzleHttp\Client();

        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['form_params'=>
                [
                    'secret'=>'6Ldd7IkUAAAAAOCiSdfIUjXIRz5gCBXo6N6zaVt4',
                    'response'=>$request['g-recaptcha-response']
                ]
            ]
        );

        $body = json_decode((string)$response->getBody());




        // Take action based on the score returned:
        if ($body->success == "true") {
            // Verified - send email
            $credential =[
                'email'=>$request->email,
                'password'=>$request->password
            ];
            if (Auth::guard('admin')->attempt($credential, $request->member)){
                return redirect()->intended(route('admin.home'));
            }
            return redirect()->back()->withInput($request->only(['email','remember']))->with('warning_login', trans('messages.warning_login'));
        } else {

            return back()->with('An_error_occurred', trans('messages.An_error_occurred'));
            // Not verified - show form error
        }


    }

    public function logout(Request $request)
    {
//        dd(Auth::guard('admin')->user()->id);
        Auth::guard('admin')->logout();

//        $request->session()->invalidate();

        return redirect('/admin/login');
    }
}
