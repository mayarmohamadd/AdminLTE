<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    // Get all Categories
    public function index(){
        $categories = Category::on('english')->get();
        return ApiResponse::sendResponse(200,'This is all Categories',CategoryResource::collection($categories));

    }

    // Get special Categories
    public function show($id){
        $category=Category::find($id);
        if(!$category){
            return ApiResponse::sendResponse(404,'Category not found');
        }
        return ApiResponse::sendResponse(200,'This is Category',new CategoryResource($category));

    }

    //Create new Category
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255|unique:english.categories,name',
        ]);
        if($validator->fails()){
            return ApiResponse::sendResponse(404,'Validation error',$validator->errors());
        }
        $category=Category::on('english')->create(['name' => $request->name]);
        return ApiResponse::sendResponse(201, 'Created Successfully', new CategoryResource($category));
    }

    // Update Category
    public function update(Request $request,$id){
        $category=Category::find($id);
        if(!$category){
            return ApiResponse::sendResponse(404,'Category not found');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255|unique:english.categories,name',
        ]);
        if($validator->fails()){
            return ApiResponse::sendResponse(404,'Validation error',$validator->errors());
        }
        $category->update(['name' => $request->name]);
        return ApiResponse::sendResponse(201, 'Category Updated Successfully', new CategoryResource($category));
    }

    //Delete Specific Category
    public function delete($id){
        $category=Category::find($id);
        if(!$category){
            return ApiResponse::sendResponse(404,'Category not found');
        }
        $category->delete();
        return ApiResponse::sendResponse(200,'Category Deleted Successfully');

    }

}

