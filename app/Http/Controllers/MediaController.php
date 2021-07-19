<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MediaController extends Controller
{
    public function store(Request $request)
    {
        $project = Auth::user()->group->project;
        $project->addMediaFromRequest('file-upload')
            ->toMediaCollection();
            return redirect()->back()->with('success','File uploaded successfully');
    }
}
