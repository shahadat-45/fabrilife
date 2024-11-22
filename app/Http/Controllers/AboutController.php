<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class AboutController extends Controller
{
    function about_page(){
        $data = About::find(1);
        return view('the_mart_control.about_page',[
            'data' => $data,
        ]);
    }
    function about_update(Request $request){
        if ($request->photo) {
            $pre_img = public_path('uploads/theMart/'. About::find(1)->photo );
            unlink($pre_img);
            
            $photo = $request->photo;
            $ext = $photo->extension();
            $file_name = 'about_page_banner' . '.' . $ext;
            Image::make($photo)->save(public_path('uploads/theMart/'. $file_name));
        
            About::find(1)->update([
                'photo' => $file_name,
            ]);
        }
        About::find(1)->update([
            'headding' => $request->headding,
            'title' => $request->title,
            'description' => $request->description,
            'updated_at' => Carbon::now(),
        ]);

        if ($request->title2 || $request->desp2 || $request->link2) {
            About::find(1)->update([
                'title2' => $request->title2,
                'desp2' => $request->desp2,
                'link2' => $request->link2,
            ]);
            session()->flash('success2', 'Update Successfully');
        }  

        return back()->with('success' , 'Update Successfully');
    }
    public function settings(){
        $settings = Setting::find(1);
        return view('the_mart_control.settings', ['data' => $settings ]);
    }
    function settings_update(Request $request){
        // echo '<pre>';
        // print_r($request->all());
        // die();
        if ($request->header_logo) {
            if (file_exists(public_path('uploads/theMart/'. Setting::find(1)->header_logo ))) {
                $pre_img = public_path('uploads/theMart/'. Setting::find(1)->header_logo );
                unlink($pre_img);                
            }            
            $photo = $request->header_logo;
            $ext = $photo->extension();
            $file_name = Str::lower(str_replace(' ', '-', 'header_logo')) . '.' . $ext;
            Image::make($photo)->save(public_path('uploads/theMart/'. $file_name));
        
            Setting::find(1)->update([
                'header_logo' => $file_name,
            ]);
        }
        Setting::find(1)->update([
            'event_text' => $request->event_text,
            'contact' => $request->contact,
            'address' => $request->address,
            'arrival_link' => $request->arrival_link,
            'facebook' => $request->facebook,
            'whatsapp' => $request->whatsapp,
            'messenger' => $request->messenger,
            'copyright' => $request->copyright,
            'footer_text' => $request->footer_text,
            'order_place' => $request->order_place,
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('success' , 'Update Successfully');
    }
}
