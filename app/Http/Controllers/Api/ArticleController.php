<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Images;
use App\Models\news;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    // Get all Articles
    public function index(){
        $articles = Article::on('english')->with('category')->get();
        return ApiResponse::sendResponse(200,'All Articles',$articles);
    }


    // Store new article
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:english.categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',]);
            if($validator->fails()){
                return ApiResponse::sendResponse(404,'Validation error',$validator->errors());
            }
        $news=news::create([
            'name'=>$request->title,
            'user_id'=>Auth::id(),]);
        // Create new article
        $article = Article::on('english')->create([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'news_id'=>$news->id,
            ]);
        // multi image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('articles', 'public');
                Images::create([
                    'file_path' => $imagePath,
                    'news_id' => $news->id,]);}
        }
        return ApiResponse::sendResponse(201,'Article Created Successfully',$article);}

    //Delete Specific Article
    public function destroy($id){
        $englishArticle = Article::on('english')->find($id);
        if(!$englishArticle){
            return ApiResponse::sendResponse(404,'Article not found');
        }
        $news = news::find($englishArticle->news_id);
        if(!$news){
            return ApiResponse::sendResponse(404,'News not found');
        }
        // Delete related Img
        Images::where('news_id', $news->id)->delete();
        // delete article
        $englishArticle->delete();
        $news->delete();
        return ApiResponse::sendResponse(200,'Deleted Article');
    }

    // Update Article
    public function update(Request $request, $id){
        // get article
        $englishArticle = Article::on('english')->find($id);
        if(!$englishArticle){
            return ApiResponse::sendResponse(404,'Article not found');
        }
        //find news to this articles
        $news = news::find($englishArticle->news_id);
        if(!$news){
            return ApiResponse::sendResponse(404,'News not found');
        }
        $validator = Validator::make($request->all(),[
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:english.categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',]);
            if($validator->fails()){
                return ApiResponse::sendResponse(404,'Validation error',$validator->errors());
            }
        // Update news
        $news->update([
            'name' => $request->title,
            'user_id' => Auth::id(),
        ]);
        // Get article from db and update
        $englishArticle->update([
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $image->store('articles', 'public');
                Images::create([
                    'file_path' => $imagePath,
                    'news_id' => $news->id,]);}}
        return ApiResponse::sendResponse(200,'Updated Successfully',$englishArticle);
    }

}
