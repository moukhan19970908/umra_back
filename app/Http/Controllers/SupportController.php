<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupportRequestStore;
use App\Models\SupportRequest;

class SupportController extends Controller
{
    public function index()
    {
        return view('support', ['subjects' => SupportRequest::SUBJECTS]);
    }

    public function store(SupportRequestStore $request)
    {
        SupportRequest::create($request->validated());

        return redirect()->route('support')->with('success', true);
    }
}
