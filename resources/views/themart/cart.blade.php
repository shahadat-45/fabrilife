@extends('themart.master')
@section('content')
    <section id="cart">
        <div class="container">
            <h3 style="text-align:center;">Your Cart</h3>
            {{-- <pre>{{ print_r($carts) }}</pre> --}}
            <br>
            <div class="row">
                <div class="table-responsive">
                    <table class="cart-table table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:35%">Product</th>
                                <th style="width:10%">Unit Price</th>
                                <th style="width:15%">Size</th>
                                <th style="width:8%">Quantity</th>
                                <th style="width:12%" class="text-center">Subtotal</th>
                                <th style="width:10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($carts as $cart)
                                @php
                                    $product = App\Models\Products::where('id' , $cart['product'])->first();
                                    $inventories = App\Models\Inventory::where('product_id' , $cart['product'])->get();
                                    $price = App\Models\Inventory::where('product_id' , $cart['product'])->where('size_id' , $cart['size'])->where('color_id' , $cart['color'])->first();
                                @endphp
                                <tr class="new-designed-element" style="position:relative">
                                    <td data-th="Product">
                                        <div class="row">
                                            <div class="col-sm-3 xs-product-photo product-photo">
                                                <img class="img-responsive" src="{{ asset('uploads/product/'. $product->thumbnail) }}" width="60" style="background-color:#FFFFFF;">
                                            </div>
                                            <div class="col-sm-9">
                                                <a href="{{ route('product.details' , $product->slug) }}"><h6 class="nomargin" style="text-wrap: wrap;">{{ $product->product_name }}</h6></a>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price" class="Price price-container">
                                        <span class="pull-right">৳ {{ $price->after_discount ?? 00 }}</span>
                                        <div class="pull-right">
                                            <span style="color:#000">৳</span>
                                            <span style="text-decoration: line-through;" class="cart_item_regular_price">{{ $price->new_price ?? 00 }}</span>
                                            &nbsp;
                                        </div>
                                    </td>
                                    <td data-th="Size" class="sizes">

                                        <select class="form-control cartinput-size-select" onchange="updateCart(event);">                                
                                            @forelse ($inventories as $size)
                                            <option value="XL" {{ $cart['size'] == $size->rel_to_size->id ? 'selected' : '' }}>{{ $size->rel_to_size->size }}</option>
                                            @empty
                                            <option value="">No Size</option>                                                
                                            @endforelse
                                        </select>
                                    </td>
                                    <td data-th="Quantity">
                                        <input type="number" class="form-control cartinput-quantity" onchange="updateCart(event);" value="{{ $cart['quantity'] }}">
                                    </td>
                                    <td data-th="Subtotal" class="text-center subtotal-container">
                                        <span class="cart_regular_price_field" style="text-decoration: line-through;"><span style="color:#000">৳</span> {{ $price->new_price ?? 00 * $cart['quantity'] }}</span><br>
                                        <span class="cartinput-price"><span style="color:#000">৳</span> {{ $price->after_discount ?? 00 * $cart['quantity'] }}</span>
                                    </td>
                                    <td class="actions" data-th="">
                                        <button class="btn btn-sm cart-buttons products-cart-button mb-2" style="background: #00aeef; color: #FFF; text-wrap: nowrap;"><i class="fa fa-plus"></i> Add another Size </button>
                                        <a href="{{ route('delete.cart' , $cart['id']) }}"><button class="btn btn-danger btn-sm cart-buttons"><i class="fa fa-trash"></i></button></a>
                                    </td>
                                </tr>                                
                            @empty
                                <p>No Product Found</p>
                            @endforelse                                         
                        </tbody>
                    </table>                    
                </div>
                <div style="text-align:center;">
                    <div>
                        <h4 style="padding-top: 15px;">Total Amount (৳): <del class="prev-total"></del>
                            <span class="checkout-total">1999</span>
                        </h4>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-sm-4"></div>
                    <div class="col-sm-4">
                    <a href="{{ route('checkout') }}"><button type="button" name="button" class="btnproceed btn btn-block btn-success">Place Order</button></a>
                                            <br>
                    <a href="{{ route('shop') }}" class="btn btn-block text-white" style="background-color: #f0ad4e;" role="button">Continue  Shopping</a>
                    </div>
                    <div class="col-sm-4"></div>
                    </div>
                </div>
                <br>
                <p class="mt-4" style="font-style:italic;text-align:center; margin: 15px; padding: 15px; background:#f6f6f6; border: 0px solid; border-radius:5px;">* If you wish to make a bulk order, please call us at <span style="font-weight:bold">+8809677666888 </span> or email
                    at <span style="font-weight:bold">cs@fabrilife.com</span> for more information.
                </p>
                <div class="row">
                  <div class="alert-container col-sm-12" style="position:fixed; left:calc(50% - 43%); top: 18%; width:85%"></div>
                </div>
                
            </div>

        </div>
    </section>
    <section id="youMayAlsoKnow">
        <div class="container">
            <div class="row">
                <h4 class="mb-3" style="text-align: center;">You May Also Like</h4>
                <hr class="my-3">
                @foreach (App\Models\Products::where('product_type' , 1)->take(12)->get() as $product)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-3 col-6">                
                        <div class="home-product">
                            <a class="product-link" href="{{ route('product.details' , $product->slug) }}">
                                <img src="{{ asset('uploads/product/' . $product->thumbnail) }}" width="100%">
                            </a>
                            <div class="product-price">
                                @php
                                    $after_discount = $product->rel_to_inventory->min('after_discount');
                                    $item = App\Models\Inventory::where('product_id' , $product->id)->where('after_discount' , $after_discount)->first();
                                    $discount = $item->new_price ?? 0 - $item->after_discount ?? 0;                                
                                @endphp
                                <div>
                                    <strong>৳ {{ $product->rel_to_inventory->min('after_discount') }}</strong> <strike class="{{ $discount < 1 ? 'd-none' : '' }}">৳
                                    {{ $product->rel_to_inventory->min('new_price') ?? '' }}</strike>
                                </div>
                            </div>
                        </div>
                        <button class="add2cartModal related_product_view btn btn-black btn-sm" 
                            style="margin-top: 15px; width: 100%"
                            onclick="miniCart({{ $item->product_id }} , {{ $item->color_id }} , {{ $item->size_id }})">
                            <i class="fa fa-plus"></i>&nbsp; Add to Cart
                        </button>
                    </div>
                @endforeach
                
            </div>
        </div>
    </section>   
@endsection
@section('footer')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function miniCart(product , color , size) {    
        $.ajax({
            'url': '/product/add_to_cart',
            'type': 'POST',
            data: {'color': color , 'product': product , 'size': size },
            success: function(data){                 
                Swal.fire({
                position: "center",
                icon: "success",
                title: "Product Added To Cart Successfully",
                showConfirmButton: false,
                timer: 1500
                }).then(function() {
                    window.location.reload();
                });             
            }
        });
    }
</script>
@endsection