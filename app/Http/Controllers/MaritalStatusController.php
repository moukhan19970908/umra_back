<?php

namespace App\Http\Controllers;

use App\Models\MaritalStatus;
use Illuminate\Http\Request;

class MaritalStatusController extends Controller
{
    public function getMarital(){
        return response()->json(['success' => true,'data'=>MaritalStatus::all()]);
    }
}
