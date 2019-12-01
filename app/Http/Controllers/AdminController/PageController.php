<?php

namespace App\Http\Controllers\AdminController;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Important_link;
use App\Page;
use DB;
use Auth;
use App\Permission;

class PageController extends Controller
{
    //
    public function index()
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "pages.pages_view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


            $pages = Page::orderBy('id','desc')->where('main',0)->get();
            return view('admin.pages.index',compact('pages'));

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
            if ($permission->permission_name === "pages.pages_create"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            return view('admin.pages.create');

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
            "text"  => "required",

        ]);

        Page::create($request->all());

        return redirect('admin/setting/pages');

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
            if ($permission->permission_name === "pages.pages_edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $page = Page::findOrfail($id);
            return view('admin.pages.edit', compact('page'));

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
            "title"  => "required|string|max:255",
            "text"  => "required",

        ]);

        Page::where('id',$id)->first()->update($request->all());

        DB::table('important_links')
            ->where('page_id',$id)
            ->update(['name'=> $request->title]);
        return redirect('admin/setting/pages');
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
            if ($permission->permission_name === "pages.pages_delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $page = Page::findOrfail($id);
            $page->delete();
            return back();

//
        }else{
            return view('errors.503');
        }


    }

    // add links to pages
    public function links_index()
    {
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "important_links.view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $important_links= Important_link::orderBy('id','desc')->get();
            return view('admin.pages.links_page',compact('important_links'));

//
        }else{
            return view('errors.503');
        }

    }
    public function add_link_page()
    {
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "important_links.create"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

            $pages= Page::get(['id','title']);
            return view('admin.pages.create_link',compact('pages'));

//
        }else{
            return view('errors.503');
        }

    }
    public function store_link(Request $request)
    {
        $this->validate($request, [
            "page"  => "required",
            "place"  => "required",
            "order"  => "required|integer",

        ]);

        $request['link']="/page/".request('page');
        $request['page_id']=request('page');
        $page =Page::find($request->page);
        $request['name']=$page->title;
        Important_link::create($request->all());


        return redirect('admin/setting/pageLinks');
    }
    public function edit_link($id)
    {
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "important_links.edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {
            $link = Important_link::find($id);
            $pages= Page::get(['id','title']);
            return view('admin.pages.edit_link', compact('link','pages'));

//
        }else{
            return view('errors.503');
        }

    }
    public function update_link(Request $request, $id)
    {
        $this->validate($request, [
            "page"  => "required",
            "place"  => "required",
            "order"  => "required|integer",

        ]);

        $request['link']="/page/".request('page');
        $request['page_id']=request('page');
        $page =Page::find($request->page);
        $request['name']=$page->title;
        Important_link::where('id',$id)->first()->update($request->all());
        return redirect('admin/setting/pageLinks');
    }

    //main pages
    public function main_page_index()
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "pages.main_pages_view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {
            $pages = Page::orderBy('id','desc')->where('main',1)->get();
            return view('admin.pages.main_page',compact('pages'));
//
        }else{
            return view('errors.503');
        }

    }
    public function edit_main_page($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "pages.main_pages_edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {
            $page = Page::find($id);
            //main 1 for mainpage 0 for pages
            return view('admin.pages.edit_main_page',compact('page'));
//
        }else{
            return view('errors.503');
        }

    }
    public function update_main_page(Request $request, $id)
    {
        //
        $this->validate($request, [
            "title"  => "required|string|max:255",

        ]);

        $request['main']=1;
        Page::where('id',$id)->first()->update($request->all());


        DB::table('important_links')
            ->where('page_id',$id)
            ->update(['name'=> $request->title]);
        return redirect('admin/setting/mainPages');
    }
    public function destroy_link($id)
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "important_links.delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {
            $page = Important_link::findOrfail($id);
            $page->delete();
            return back();

//
        }else{
            return view('errors.503');
        }


    }
}
