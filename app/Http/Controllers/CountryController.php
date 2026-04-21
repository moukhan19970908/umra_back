<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function getCountry(){
        return response()->json(['success' => true,'data' => Country::all()]);
    }
}
