<?php


namespace App\Http\Controllers\AdminController;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Auth;
use App\Permission;
use DB;
class OrdersController extends Controller
{
    //
    public function orders(){
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "orders.view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $orders = Order::orderBY('id','desc')->get();
            return view('admin.orders.index',compact('orders'));

            //
        }else{
            return view('errors.503');
        }
    }

    public function show($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "orders.show"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $order = Order::findOrfail($id);
            return view('admin.orders.edit', compact('order'));

        //
        }else{
            return view('errors.503');
        }

    }

    public function destroy($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "orders.delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {
            $order = Order::findOrfail($id);
            $order->delete();
            return back();

        //
        }else{
            return view('errors.503');
        }


    }
}
