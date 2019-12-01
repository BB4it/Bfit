<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use Auth;
use App\Permission;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReplyMessage;

class ContactController extends Controller
{
    //
    public function index()
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "contacts.view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $contacts= Contact::orderBy('id','desc')->get();
            return view('admin.contacts.index',compact('contacts'));

//
        }else{
            return view('errors.503');
        }

    }
    public function show($id) {

        $contactU= Contact::find($id);
        return view('admin.contacts.show', compact('contactU'));
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
            if ($permission->permission_name === "contacts.delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $contacts= Contact::find($id);
            $contacts->delete();
            return back();

//
        }else{
            return view('errors.503');
        }

    } public function destroy_details($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "contacts.delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $contacts= Contact::find($id);
            $contacts->delete();
           return  redirect('admin/contactUs');

//
        }else{
            return view('errors.503');
        }

    }
    public function replyMessage(Request $request) {

        $headingTitle = 'Reply Message From Admin To Your Message';
//        $return = $this->sendEmail($request->receiver_email, $request->msg_body, $headingTitle);
        $data = Contact::find($request->id);
        $updated = $data->update(['reply' => $request->msg_body]);

        $this->sendEmail($request->receiver_email, $request->msg_body, $headingTitle, $data->message);

        return  json_encode(['code' => $updated]);
    }
    protected function sendEmail($userEmail, $messageReply, $headingTitle, $userMessage) {

        $data = [
            'mailSubject'   => 'Contact Us Reply Message',
            'contactReply'  => $messageReply,
            'headingTitle'  => $headingTitle,
            'messagesTitle' => settings()['name'],
            'userMessage'  => $userMessage
        ];

        Mail::to($userEmail)->send(new ReplyMessage($data));

        if( count(Mail::failures()) > 0 ) {
            Mail::to($userEmail)->send(new ReplyMessage($data));

            if( count(Mail::failures()) > 0 ) {
                Mail::to($userEmail)->send(new ReplyMessage($data));
            }
        }

//        if($mailable->hasSent())
//            return true;
//        return false;
    }

}
