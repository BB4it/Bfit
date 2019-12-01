<?php

namespace App\Http\Controllers\AdminController;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Auth;
use App\Permission;
use DB;

class ArticleController extends Controller
{
    //
    public function index()
    {
        //
        $admin = DB::table('admin_permission')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        $true = '';
        foreach ($admin as $item){
            $permission = Permission::find($item->permission_id);
            if ($permission->permission_name === "articles.articles_view"){
                $true = 'true';
            }
        }
        if ($true == 'true') {


        $articles = Article::orderBY('id','desc')->get();
        return view('admin.articles.index',compact('articles'));

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
            if ($permission->permission_name === "articles.articles_create"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

        return view('admin.articles.create');

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
            "title"         => "required|string|max:255",
            "summary"       => "required",
            "description"   => "required",
            "date"          => "required|date",
            "photo"         => "required|image|mimes:jpeg,bmp,png,jpg|max:5000",

        ]);

        //return "Okay validation ";

        $image = $request->file('photo');
        $imageName  = md5(uniqid(mt_rand())) . '.' . $image->getClientOriginalExtension();
        $path = public_path('uploads/articles/' . $imageName);
        Image::make($image->getRealPath())->save($path);

        $request['image'] = $imageName;
        Article::create($request->all());

        return redirect('admin/article');
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
            if ($permission->permission_name === "articles.articles_edit"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

        $article = Article::findOrfail($id);
        return view('admin.articles.edit',compact('article'));

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
        //home_width
        //home_height
        $this->validate($request, [
            "title"         => "required|string|max:255",
            "summary"       => "required",
            "description"   => "required",
            "date"          => "required|date",
            "photo"         => "nullable|image|mimes:jpeg,bmp,png,jpg|max:5000",

        ]);
        $articles = Article::findOrfail($id);
        if ($request->photo !== null){
            $image = $request->photo;
            $imageName  = md5(uniqid(mt_rand())) . '.' . $image->getClientOriginalExtension();
            $path = public_path('uploads/articles/' . $imageName);
            Image::make($image->getRealPath())->save($path);
            @unlink(public_path('uploads/articles/'.$articles->image));
            $articles->image = $imageName;
        }else{
//            @unlink(public_path('img/'.$settings->fav_icon));
            $articles->image=$articles->image;
        }

        $articles->title = $request->title;
        $articles->summary = $request->summary;
        $articles->description = $request->description;
        $articles->date = $request->date;
        $articles->save();
        return redirect('admin/article');
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
            if ($permission->permission_name === "articles.articles_delete"){
                $true = 'true';
            }
        }
        if ($true == 'true') {

        $articles = Article::find($id);
        @unlink(public_path('uploads/articles'.$articles->image));
//        @unlink(public_path('upload/'.$articles->image2));
        $articles->delete();
        return back();

        }else{
            return view('errors.503');
        }



    }
}
