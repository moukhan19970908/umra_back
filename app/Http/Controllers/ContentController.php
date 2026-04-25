<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentCategory;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function getCategories(){
        return response()->json(['data' => ContentCategory::select(['id','name'])->get()]);
    }

    public function getContentByCategory($id){
        return response()->json(['data' => Content::with('images')->where('category_id',$id)->paginate()]);
    }

    public function getContentAllCategory(){
        return response()->json(['data' => Content::with('images')->paginate()]);
    }
}
