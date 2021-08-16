<?php

namespace App\Http\Controllers;

use App\Models\Directory;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Support\MediaStream;

class DirectoryController extends Controller
{
    public function store($id, Request $request)
    {
        Directory::create([
            'name' => $request->name,
            'parent_id' => $id
        ]);
        return redirect()->back()->with('success', 'Directory Successfully Created.');
    }
    public function destroy($id)
    {
        Directory::find($id)->delete();
        return redirect()->back()->with('success','Directory deleted successfully.');
    }
    public function download($id)
    {
        $directory = Directory::find($id);

        return MediaStream::create("$directory->name.zip")->addMedia($directory->media);
    }
    public function rename($id,Request $request)
    {
        Directory::find($id)->update(['name' => $request->name]);
        return redirect()->back()->with('success','Directory renamed successfully');
    }
}
