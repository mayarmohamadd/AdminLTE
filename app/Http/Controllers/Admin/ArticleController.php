<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Images;
use App\Models\Category;
use App\Models\news;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function index(){
        $articles = Article::on('english')->with('category')->get();
        return view('admin.articles.index', compact('articles'));
    }


    public function create(){
        $categories = Category::all();
        return view('admin.articles.create', compact('categories'));
    }


    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:english.categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',]);
        $news=news::create([
            'name'=>$request->title,
            'user_id'=>Auth::id(),

        ]);
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
                    'news_id' => $news->id,]);
            }
        }
        return redirect()->route('articles.index')->with('success', 'Article created successfully.');
    }

    public function show(Article $article){
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article){
        $categories = Category::all();
        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:english.categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',]);
        // find new related to article
        $news = news::findOrFail($article->news_id);
        // Update news
        $news->update([
            'name' => $request->title,
            'user_id' => Auth::id(),
        ]);
        // Get article from db and update
        $englishArticle = Article::on('english')->findOrFail($article->id);
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
        return redirect()->route('articles.index')->with('success', 'Article updated successfully.');
    }


    public function destroy(Article $article){
        $news = news::findOrFail($article->news_id);
        // Delete related Img
        Images::where('news_id', $news->id)->delete();
        // delete article
        $englishArticle = Article::on('english')->findOrFail($article->id);
        $englishArticle->delete();
        // Delete news related from common
        $news->delete();
        return redirect()->route('articles.index')->with('success', 'Article deleted successfully.');
    }



    }
