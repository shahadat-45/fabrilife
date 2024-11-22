<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PosterController extends Controller
{
    public function poster(){
        $poster = Poster::all();
        return view('the_mart_control.poster' , ['poster' => $poster]);
    }
    function poster_store(Request $request){
        $request->validate([
            'image' => 'required' ,
        ]);
        $image = $request->image;
        $ext = $image->extension();
        $file_name = uniqid() . '.' . $ext;
        Image::make($image)->save(public_path('uploads/theMart/poster/' . $file_name));
        Poster::insert([
            'title' => $request->title ?? '',
            'image' => $file_name,
            'link' => $request->link,
            'status' => 0,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success' , 'Poster added successfully');

    }
    function poster_status(Request $request , $id){
        Poster::find($id)->update([
            'status' => $request->status,
        ]);
        return back();
    }
}
