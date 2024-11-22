<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Color;
use App\Models\ContactMassage;
use App\Models\Country;
use App\Models\Delivery;
use App\Models\ExcitingOffers1;
use App\Models\ExcitingOffers2;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Inventory;
use App\Models\Newsletter;
use App\Models\OrderedProduct;
use App\Models\Products;
use App\Models\Setting;
use App\Models\Size;
use App\Models\Tags;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    function welcome(){
        $banner = Banner::where('status' , 1)->get();
        $about = About::find(1);
        $setting = Setting::find(1);
        $categories = Category::all();
        $offer = ExcitingOffers1::find(1);
        $offer2 = ExcitingOffers2::find(1);
        $product = Products::where('product_type', 1)->latest()->take(3)->get();
        $all_product = Products::where('product_type', 1)->latest()->get();
        $trendingProducts = Products::select('products.*')
            ->join('ordered_products', 'products.id', '=', 'ordered_products.product_id')
            // ->where('ordered_products.created_at', '>=', now()->subDays(7)) // Adjust timeframe as needed
            ->groupBy('products.id')
            ->orderByRaw('SUM(ordered_products.quantity) DESC')
            ->selectRaw('count(ordered_products.quantity) as total') // I made it.
            ->limit(3)
            ->get();
        $top_rated = Products::select('products.*')
            ->join('ordered_products', 'products.id', '=', 'ordered_products.product_id')
            ->groupBy('products.id')
            ->orderByRaw('SUM(ordered_products.star) DESC')
            ->limit(3)
            ->get();
        return view('themart.home' , [
            'banners' =>  $banner,
            'offers' =>  $offer,
            'offers2' =>  $offer2,
            'products' =>  $product,
            'trendingProducts' =>  $trendingProducts,
            'all_product' =>  $all_product,
            'top_rated' =>  $top_rated,
            'categories' => $categories,
            'about' => $about,
            'setting' => $setting,
        ]);
    }
    function product_details($slug){
        $product_info = Products::where('slug' , $slug)->get();
        $id = $product_info->first()->id;
        $product = Products::find($id);
        $color = Inventory::where('product_id' , $id)->groupBy('color_id')->selectRaw('count(*) as total, color_id')->get();
        $size = Inventory::where('product_id' , $id)->groupBy('size_id')->selectRaw('count(*) as total, size_id')->get();
        $gallery = Gallery::where('product_id' , $id)->get();
        $reviews = OrderedProduct::where('product_id' , $id)->whereNotNull('review')->latest()->get();
        $total_star = OrderedProduct::where('product_id' , $id)->whereNotNull('review')->sum('star');
        $all = Cookie::get('recent_view');
        if(!$all){
            $all = '[]';
        }
        $all_info = json_decode($all , true);
        $all_info = Arr::prepend($all_info , $id);
        $recent_product = json_encode($all_info);
        Cookie::queue('recent_view' , $recent_product , 100);        
        $related = Products::find($product->related);
        return view('themart.producu-detailes' , [
            'products' => $product,
            'colors' => $color,
            'galleries' => $gallery,
            'sizes' => $size,
            'reviews' => $reviews,
            'total_star' => $total_star,
            'related' => $related,
        ]);
    }
    public function get_color(Request $request) {
        $colors = DB::table('inventories')
            ->join('colors', 'inventories.color_id', '=', 'colors.id')
            ->where('inventories.product_id', $request->product_id)
            ->where('inventories.size_id', $request->size_id)
            ->select('colors.color_name', 'inventories.*') 
            ->get();
    
        return response()->json($colors, 200);
    }
    function get_stock(Request $request){
        $quantity = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->quantity;
        $str = '<span>Stock:</span>' . ' ' . $quantity . '';
        echo $str;
    }
    function get_price(Request $request){
        $price = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->after_discount;
        echo '$' . $price;
    }
    function old_price(Request $request){
        $price = Inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->new_price;
        echo '$' . $price;
    }
    function checkout(){
        $cart = session()->get('cart', []);
        $delivery = Delivery::all();
        return view('themart.checkout',[
            'cart' => $cart,
            'delivery' => $delivery,
        ]);
    }
    function about(){
        $data = About::find(1);
        return view('themart.about',[
            'data' => $data,
        ]);
    }
    function faq(){        
        $faqs = Faq::all();
        return view('themart.faq',[
            'faqs' => $faqs,
        ]);
    }
    function shop(Request $request){
        $categories = Category::all();
        $data = $request->all();
        $colors = Color::all();
        $sizes = Size::all();
        $tags = Tags::all()->take(30);
        
        $products = Products::where('product_type', 1)->where(function ($q) use ($data) {

        if (!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined') {
            $q->where(function ($q) use ($data){
                $q->where('product_name', 'like', '%' . $data['q'] . '%');
                $q->orWhere('long_desp', 'like', '%' . $data['q'] . '%');
            });
        }
        if(!empty($data['ctd']) && $data['ctd'] != '' && $data['ctd'] != 'undefined'){            
            if(!empty($data['sub']) && $data['sub'] != '' && $data['sub'] != 'undefined'){
                $q->where(function ($q) use ($data) {
                    $q->where('subcategory_id' , $data['sub']);
                });
            }else{
                $q->where(function ($q) use ($data) {
                    $q->where('category_id' , $data['ctd']);
                });  
            }
        }
        if (!empty($data['tag']) && $data['tag'] != '' && $data['tag'] != 'undefined') {
            $q->where(function ($q) use ($data) {
                $q->where('tags', 'like', '%' . $data['tag'] . '%'); // Matches tag within JSON-style format
            });
        }
        

        })->get();

        return view('themart.shop',[
            'categories' => $categories,
            'products' => $products,
            'colors' => $colors,
            'sizes' => $sizes,
            'tags' => $tags,
        ]);
    }
    function recent(){
        $data = json_decode(Cookie::get('recent_view') , true) ;
        $recent_viewed = '';
        if($data == Null){
            $recent_viewed = [];
        }else{
            $recent_viewed = array_unique($data);
            $recent_viewed = array_reverse($recent_viewed);
        }
        $recent_viewed = Products::find($recent_viewed);
        return view('themart.recent_view' , [
            'data' => $recent_viewed,
        ]);
    }
    function contact(){
        return view('themart.contact');
    }
    function contact_massage_store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'service' => 'required|string|max:255',
            'message' => 'required|string',
        ]);
        ContactMassage::insert([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'service' => $request->service,
            'message' => $request->message,
        ]);
        return back()->with('success' , 'Your Message Sent Successfully.');
    }
    function delivery(){
        $delivery = Delivery::all();
        return view('the_mart_control.delivery' , ['delivery' => $delivery]);
    }
    function delivery_insert(Request $request){
        $request->validate([
            'title'=> 'required',
            'charge'=> 'required',
        ]);
        Delivery::insert([
            'title' => $request->title,
            'charge' => $request->charge,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success', 'Delivery charge added successfully');
    }
    public function delivery_push(Request $request)
{
    $delivery = Delivery::find($request->id);

    return response()->json([
        'success' => true,
        'data' => $delivery,
    ], 200);
}
    public function delivery_update(Request $request , $id){
        Delivery::find($id)->update([
            'title' => $request->title,
            'charge' => $request->charge,
        ]);
        return back();
    }

}
