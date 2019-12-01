<?php

namespace App\Http\Controllers\Api;

use App\Article;
use App\Http\Controllers\Controller;
use App\Slider;
use App\User;


class ArticleController extends Controller
{
    //
    public function main(){

//        $articles = Article::orderBy('id','desc')->select('id','title','date','summary','image')->paginate(10);
//
//        $articles->map(function ($data){
//            $data['doctor_img_path']='/uploads/articles/';
//        });

        $data = [
            'sliders_img_path' => '/uploads/sliders/',
            'sliders'            => Slider::orderBy('order','asc')->select('id','title','image')->take(5)->get(),
            'articles_img_path' => '/uploads/articles/',
            'articles'          => Article::orderBy('id','desc')->select('id','title','date','summary','image')->take(5)->get(),
            'doctors_img_path'  => '/uploads/doctors/',
            'doctors'           => User::where('active', 1)->where('type',1)->select('id','name','image','specialization')->inRandomOrder()->take(10)->get(),
        ];

        return ApiController::respondWithSuccess($data);
    }

    public function articles(){

        $articles = Article::orderBy('id','desc')->select('id','title','date','summary','image')->paginate(10);

        $articles->map(function ($data){
            $data['articles_img_path']='/uploads/articles/';
        });


      return ApiController::respondWithSuccess($articles);
    }

    public function singleArticle($id){

        $article = Article::find($id);

        $data=[
            'id'=>$article->id,
            'title'=>$article->title,
            'description'=>$article->description,
            'article_img_path'=>'/uploads/articles/',
            'image'=>$article->image,
            'date'=> $article->date,
        ];

        return ApiController::respondWithSuccess($data);

    }
}
