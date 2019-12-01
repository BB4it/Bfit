<?php

namespace App\Http\Controllers\AdminController;

use App\User;
use App\UserDevice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Permission;
use Auth;
class NotificationController extends Controller
{
    public function create($type)
    {
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "notifications.create"){
                $true = 'true';
            }
        }
        if ($true == 'true') {
            $users = User::get()->pluck('email', 'id');

            return view('admin.notifications.create', compact('type', 'users'));

//
        }else{
            return view('errors.not_access');
        }

    }

    public function store(Request $request, $type)
    {
        if ($type == 'user' || $type == 'doctor') {
            $request->validate([
                'user' => 'required',
                'message' => 'required',
            ]);

            $notifTitle = ' رسالة من إدارة التطبيق ';
            $notifMessage = $request->message;

            if ($request->user == 'user') {
                $usersIds = User::where('type', 2)->get()->pluck('id')->toArray();
                $devicesTokens = UserDevice::whereIn('user_id', $usersIds)->where('is_open',1)->get()->pluck('device_token')->toArray();

                foreach ($usersIds as $id) {

                    saveNotification($id,'1', $notifTitle,  $notifMessage,null);
                }
            } elseif ($request->user == 'doctor') {
                $usersIds = User::where('type', 1)->get()->pluck('id')->toArray();
                $devicesTokens = UserDevice::whereIn('user_id', $usersIds)->where('is_open',1)->get()->pluck('device_token')->toArray();

                foreach ($usersIds as $id) {

                    saveNotification($id,'1', $notifTitle,  $notifMessage,null);
                }
            } else {

                saveNotification($request->user, '1',$notifMessage, $notifMessage,null);

                $devicesTokens = UserDevice::where([['user_id', $request->user]])->where('is_open',1)->get()->pluck('device_token')->toArray();
            }

            if ($devicesTokens) {
                $all_data = array(
                    'title'=>$notifTitle,
                    'body'=>$notifMessage,
                    'type'=>1,
                    'data_id'=>null,
                );
                sendMultiNotification($notifTitle, $notifMessage,$all_data, $devicesTokens);
            }



            return redirect()->route('notifications.create', $type)->with('success', 'تم الإرسال بنجاح');
        }

        abort('404');
    }
}
