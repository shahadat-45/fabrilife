<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    public function add_to_cart(Request $request) {        
        $cart = session()->get('cart', []);
        if ($request->quantity) {
            $quantity = $request->quantity;
        } else { $quantity = 1 ; };
            
        $newItem = [
            'id' => uniqid(),
            'product' => $request->product,
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $quantity,
        ];
            
        $exists = false;
        foreach ($cart as $key => $item) {
            if (
                $item['product'] === $newItem['product'] &&
                $item['size'] === $newItem['size'] &&
                $item['color'] === $newItem['color']
            ) {                
                $cart[$key]['quantity'] += $newItem['quantity'];
                $exists = true;
                break;
            }
        }
            
        if (!$exists) {
            $cart[] = $newItem;
        }
            
        session()->put('cart', $cart);
    
        return response()->json([
            'message' => 'Product added to cart', 
            'cart' => $cart,
            'button' => $request->button,
        ], 200);
    }
    

    function delete_cart($id){        
        $cart = session()->get('cart', []);
        
        foreach ($cart as $key => $item) {
            if ($item['id'] == $id) {
                unset($cart[$key]);
            }
        }
        
        $cart = array_values($cart);
        
        session()->put('cart', $cart);

        return back()->with('message' , 'Product removed from cart');
    }
    function cart(){
        $cart_items = session()->get('cart', []);
        return view('themart.cart' , [
            'carts' => $cart_items,
        ]);
    }
    function update_cart(Request $request){
        $cart = session()->get('cart' , []);
        foreach ($cart as $i => $item) {
            if ($item['id'] == $request->id) {
                $cart[$i]['quantity'] = $request->quantity;
            }
        }
        // Save the updated cart back into the session
        session()->put('cart', $cart);
        
        return response()->json(['message' => 'Cart Updated'] , 200);
    }
}
