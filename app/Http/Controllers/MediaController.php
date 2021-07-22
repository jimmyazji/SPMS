<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function store($id)
    {
        dd($id);
        $directory = Directory::find($id);
        $directory->addMediaFromRequest('file-upload')
            ->toMediaCollection();
            return redirect()->back()->with('success','File uploaded successfully');
    }
    public function destroy($id){
        $media = Media::find($id);
        $media->delete();
        return redirect()->back()->with('success','Media deleted successfully');
    }
}
