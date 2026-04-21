<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Verse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function addFavorites($id){
        $userId = Auth::user()['id'];
        $success = Favorite::create([
            'user_id' => $userId,
            'verse_id' => $id,
        ]);
        if (!$success){
            return response()->json(['messages' => 'Попробуйте позже'],500);
        }
        return response()->json(['success' => true]);
    }

    public function getFavorites(){
        $userId = Auth::user()['id'];
        $verseIds = Favorite::where('user_id',$userId)->pluck('verse_id');
        $data = Verse::with('surah')->whereIn('id',$verseIds)
            ->select('verses.surah_id','verses.verse_number','verses.text_ar','verses.text_ru')
            ->get();
        return response()->json(['data' => $data]);
        //return response()->json(['data' => ])
    }

    public function removeFavorite($id){
        $userId = Auth::user()['id'];
        $remove = Favorite::where('verse_id',$id)->where('user_id',$userId)->delete();
        if (!$remove){
            return response()->json(['messages' => 'Попробуйте позже'],500);
        }
        return response()->json(['success' => true]);
    }

}
