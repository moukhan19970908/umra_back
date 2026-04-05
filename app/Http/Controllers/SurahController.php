<?php

namespace App\Http\Controllers;

use App\Models\Surah;
use App\Models\Verse;
use Illuminate\Http\Request;

class SurahController extends Controller
{
    public function surah(){
        return response()->json(['data' => Surah::all()]);
    }

    public function surahGetId($id){
        return response()->json(['data' => Verse::where('surah_id',$id)->get()]);
    }
}
