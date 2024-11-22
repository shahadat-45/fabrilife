<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Models\Billing;
use App\Models\Cart;
use App\Models\City;
use App\Models\Customer;
use App\Models\Inventory;
use App\Models\OrderedProduct;
use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    function order_confirm(Request $request){
        $data = $request->all(); 
       
        $existingCustomer = Customer::where('phone', $request->phone)->first();

        if ($existingCustomer) {
            $customer_info = $existingCustomer;
        }
        else{
            $customer_info = Customer::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'password' => bcrypt(random_int(1000, 99999)),
                'created_at' => Carbon::now(),
            ]);
        }
        $order_id = 'ORD-' . date('d') . '-' . strtoupper(Str::random(4));
        if ($data['payment'] == 'cod') {
                Orders::insert([
                    'customer_id' => $customer_info->id,
                    'order_id' => $order_id,
                    'discount' => $data['discount'],
                    'charge' => $data['delivery'],
                    'total' => $data['total'],
                    'created_at' => Carbon::now(),
                ]);
                Billing::insert([
                    'customer_id' =>  $customer_info->id,
                    'order_id' => $order_id,
                    'bill_fname' => $data['name'],
                    'bill_phone' => $data['phone'],
                    'bill_address' => $data['address'],
                    'notes' => $data['note'],
                    'created_at' => Carbon::now(),
                    // 'bill_lname' => $data['bill_lname'],
                    // 'bill_country' => $data['bill_country'],
                    // 'bill_city' => $data['bill_city'],
                    // 'bill_zip' => $data['bill_zip'],
                    // 'bill_company' => $data['bill_company'],
                    // 'bill_email' => $data['bill_email'],
                ]);
            $carts = session()->get('cart' , []);
                foreach ($carts as $cart) {
                    OrderedProduct::insert([
                        'customer_id' =>  $customer_info->id,
                        'product_id' => $cart['product'],
                        'order_id' => $order_id,
                        'price' => Inventory::where('color_id' , $cart['color'])->where('size_id' , $cart['size'])->first()->after_discount,
                        'color_id' => $cart['color'],
                        'size_id' => $cart['size'],
                        'quantity' => $cart['quantity'],
                        'created_at' => Carbon::now(),
                ]);
                //reduce the quantity from inventory
                // Inventory::where('product_id',$cart->product_id)->where('color_id',$cart->color_id)->where('size_id',$cart->size_id)->decrement('quantity' , $cart->quantity);
                //delete cart after order proccessed
                // Cart::find($cart->id)->delete();
                //Sending Mail --
                // Mail::to($request->bill_email)->send(new InvoiceMail($order_id));
            }             
            return response()->json([
                'message' => 'Your Order Successfully Placed',
                'redirect_url' => '/order_placed',
                ] , 200);
        }
        // elseif($request->payment == 2){
        //     $data = $request->all();
        //     return redirect('/pay')->with('data' , $data);
        // }
        // else{
        //     $data = $request->all();
        //     return redirect()->route('stripe')->with('data' , $data);
        // }               
}
    function get_cities(Request $request){
        $str = '';
        $cities = City::where('country_id', $request->country_id)->get();
        foreach($cities as $city){            
            $str .= '<option value='. $city->id .'>'. $city->name .'</option>';
        }
        echo $str;
    }
    function order_placed(){
        return view('themart.order_placed');
    }
}
