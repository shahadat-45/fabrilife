@extends('themart.master')
@section('content')
<section id="checkout">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-6">
                <h4 class="fw-bold text-center">Checkout Info</h4>
                <button type="button" class="btn btn-primary checkout_model_btn d-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Cart Overview
                </button>
                <form class="form-group">
                    <p style="font-weight:bold;">Contact Info</p>
                    <p>
                        <input autocomplete="off" class="form-control" type="text" name="name" placeholder="Full Name" value="">
                        <div class="row">
                            {{-- <div class="col-12"><input autocomplete="off" class="form-control width-half-left" type="text" name="email" placeholder="Email" value=""></div>                                                             --}}
                            <div class="col-12"><input autocomplete="off" class="form-control width-half-right" type="text" name="phone" placeholder="Phone Number" value=""></div>
                        </div>
                        <br>
                    </p>
                    <p style="font-weight:bold;">Shipping Info</p>
                    <input autocomplete="off" class="form-control" type="text" name="address" placeholder="Detailed Address">
                    <br>
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <select autocomplete="off" class="form-control width-half-left disctrict_select" name="district" id="district">
                                <option value="">Select City</option>
                                                                                    <option value="Dhaka">Dhaka</option>
                                                                                                            <option value="Savar">Savar</option>
                                                                                                            <option value="Nabinagar">Nabinagar</option>
                                                                                                            <option value="Ashulia">Ashulia</option>
                                                                                                            <option value="Keraniganj">Keraniganj</option>
                                                                                                            <option value="Tongi">Tongi</option>
                                                                                                            <option value="Bagerhat">Bagerhat</option>
                                                                                                            <option value="Bandarban">Bandarban</option>
                                                                                                            <option value="Barguna">Barguna</option>
                                                                                                            <option value="Barisal">Barisal</option>
                                                                                                            <option value="Bhola">Bhola</option>
                                                                                                            <option value="Bogra">Bogra</option>
                                                                                                            <option value="Brahmanbaria">Brahmanbaria</option>
                                                                                                            <option value="Chandpur">Chandpur</option>
                                                                                                            <option value="Chapainawabganj">Chapainawabganj</option>
                                                                                                            <option value="Chittagong">Chittagong</option>
                                                                                                            <option value="Chuadanga">Chuadanga</option>
                                                                                                            <option value="Comilla">Comilla</option>
                                                                                                            <option value="Coxs Bazar">Coxs Bazar</option>
                                                                                                            <option value="Dinajpur">Dinajpur</option>
                                                                                                            <option value="Faridpur">Faridpur</option>
                                                                                                            <option value="Feni">Feni</option>
                                                                                                            <option value="Gaibandha">Gaibandha</option>
                                                                                                            <option value="Gazipur">Gazipur</option>
                                                                                                            <option value="Gopalganj">Gopalganj</option>
                                                                                                            <option value="Habiganj">Habiganj</option>
                                                                                                            <option value="Jamalpur">Jamalpur</option>
                                                                                                            <option value="Jessore">Jessore</option>
                                                                                                            <option value="Jhalokathi">Jhalokathi</option>
                                                                                                            <option value="Jhenaidah">Jhenaidah</option>
                                                                                                            <option value="Joypurhat">Joypurhat</option>
                                                                                                            <option value="Khagrachari">Khagrachari</option>
                                                                                                            <option value="Khulna">Khulna</option>
                                                                                                            <option value="Kishoreganj">Kishoreganj</option>
                                                                                                            <option value="Kurigram">Kurigram</option>
                                                                                                            <option value="Kushtia">Kushtia</option>
                                                                                                            <option value="Lakshmipur">Lakshmipur</option>
                                                                                                            <option value="Lalmonirhat">Lalmonirhat</option>
                                                                                                            <option value="Madaripur">Madaripur</option>
                                                                                                            <option value="Magura">Magura</option>
                                                                                                            <option value="Manikganj">Manikganj</option>
                                                                                                            <option value="Meherpur">Meherpur</option>
                                                                                                            <option value="Moulvibazar">Moulvibazar</option>
                                                                                                            <option value="Munshiganj">Munshiganj</option>
                                                                                                            <option value="Mymensingh">Mymensingh</option>
                                                                                                            <option value="Naogaon">Naogaon</option>
                                                                                                            <option value="Narail">Narail</option>
                                                                                                            <option value="Narayanganj">Narayanganj</option>
                                                                                                            <option value="Narsingdi">Narsingdi</option>
                                                                                                            <option value="Natore">Natore</option>
                                                                                                            <option value="Netrokona">Netrokona</option>
                                                                                                            <option value="Nilphamari">Nilphamari</option>
                                                                                                            <option value="Noakhali">Noakhali</option>
                                                                                                            <option value="Pabna">Pabna</option>
                                                                                                            <option value="Panchagarh">Panchagarh</option>
                                                                                                            <option value="Patuakhali">Patuakhali</option>
                                                                                                            <option value="Pirojpur">Pirojpur</option>
                                                                                                            <option value="Rajbari">Rajbari</option>
                                                                                                            <option value="Rajshahi">Rajshahi</option>
                                                                                                            <option value="Rangamati">Rangamati</option>
                                                                                                            <option value="Rangpur">Rangpur</option>
                                                                                                            <option value="Satkhria">Satkhria</option>
                                                                                                            <option value="Shariatpur">Shariatpur</option>
                                                                                                            <option value="Sherpur">Sherpur</option>
                                                                                                            <option value="Sirajganj">Sirajganj</option>
                                                                                                            <option value="Sunamganj">Sunamganj</option>
                                                                                                            <option value="Sylhet">Sylhet</option>
                                                                                                            <option value="Tangail">Tangail</option>
                                                                                                            <option value="Thakurgaon">Thakurgaon</option>
                            </select>
                        </div>
                        <div class="col-lg-6">
                            <input autocomplete="off" class="form-control width-half-left" style="display:none" type="text" name="postcode" placeholder="Post Code" value="0000">
                            <input autocomplete="off" class="form-control width-half-right" type="text" name="alt_phone" placeholder="Alt. Phone (01XXXXXXXXX)">
                        </div> --}}
                        <div class="col-lg-12">
                            <select class="form-control width-half-left disctrict_select" id="delivery">
                                @foreach ($delivery->take(3) as $i => $item)
                                    <option value="{{ $item->charge }}" {{ $i == 0 ? 'selected' : '' }}>{{ $item->title }} (৳{{ $item->charge }})</option>                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <br>
                    <input autocomplete="off" class="form-control" type="text" name="note" placeholder="Note for Fabrilife (optional)">
                    <br> 
                    <p style="font-weight:bold; margin-bottom: 4px;">Payment Options</p>
                    <div class="payment-container mb-3">
                        <div class="form-check form-check-inline payment-method-selector me-0">
                            <label class="form-check-label">
                                <input class="form-check-input payment-method-radio ms-0" type="radio" name="payment_method" value="cod" checked="checked">
                                <img src="{{ asset('TheMart/Images/cod-pay.png') }}" class="payment-method-logo" alt="">
                            </label>
                        </div>
    
                        <!-- <div class="form-check form-check-inline payment-method-selector">
                            <label class="form-check-label">
                                <input class="form-check-input payment-method-radio" type="radio" name="payment_method" onclick="sslCard()" value="ssl_card">
                                <img src="/img/card-pay.png" class="payment-method-logo" alt="">
                            </label>
                        </div> -->
                        <div class="form-check form-check-inline payment-method-selector">
                            <label class="form-check-label">
                                <input class="form-check-input payment-method-radio ms-0" type="radio" name="payment_method" value="bkash">
                                <img src="{{ asset('TheMart/Images/64af92d32dde1.jpg') }}" class="payment-method-logo" alt="" style="top: calc(50% - 20px); ">
                                
                            </label>
                        </div>
                    </div>
                    <input class="tnc-check" style="display: inline-block" type="checkbox" checked="">
                    <span style="display: inline;">I agree to <a href="/terms" target="_blank">Terms &amp; Conditions</a>, <a href="/refund-policy" target="_blank">Refund Policy</a> and <a href="/privacy-policy" target="_blank">Privacy Policy</a> of Fabrilife.</span>
                    <button class="btn btn-block btn-success payment-confirm mt-3" style="background-color: #2bb673;" type="button" onclick="confirmOrder()">Confirm Order</button>
                </form>
            </div>
            @php $total = 0; @endphp
            <div class="col-lg-6">
                <div class="card">
                    <h4 class="mt-3 text-center">Cart Overview</h4>
                    <div class="card-body">
                        <table class="cart-table table table-hover table-condensed mb-3">
                            <thead>
                                <tr class="text-center">
                                    <th class="text-start" style="width:20%">Product</th>
                                    <th style="width:20%">Unit Price</th>
                                    <th style="width:35%">Size</th>
                                    <th style="width:5%">Quantity</th>
                                    <th style="width:5%">Action</th>
                                </tr>
                            </thead>
                            <tbody>  
                                @forelse ($cart as $cart)
                                    <tr class="new-designed-element text-center align-middle" style="position:relative">
                                        <td class="text-start" >
                                            <div class="row">
                                                <img class="img-responsive" src="{{ asset('uploads/product/' . App\Models\Products::where('id' , $cart['product'])->first()->thumbnail) }}" style="max-width: 90px;">
                                            </div>
                                        </td>
                                        @php
                                            $price = App\Models\Inventory::where('product_id' , $cart['product'])->where('size_id' , $cart['size'])->where('color_id' , $cart['color'])->first();
                                            $total += $price->after_discount * $cart['quantity'];
                                        @endphp
                                        <td data-th="Price" class="Price price-container">
                                            <span class="pull-right">৳ {{ $price->after_discount }}</span>
                                            <div class="pull-right">
                                                <span style="color:#000">৳</span>
                                                <span style="text-decoration: line-through;" class="cart_item_regular_price">{{ $price->new_price }}</span>
                                                &nbsp;
                                            </div>
                                        </td>
                                        <td data-th="Size">
                                            <select class="form-control cartinput-size-select" onchange="updateCart('event');">                                
                                                <option value="M">{{ App\Models\Size::find($cart['size'] )->size }}</option>
                                                {{-- <option value="L">Premium L</option>
                                                <option value="XL" selected="">Premium XL</option>
                                                <option value="2XL">Premium 2XL</option> --}}
                                            </select>
                                        </td>
                                        <td data-th="Quantity">
                                            <input type="number" class="form-control cartinput-quantity" onchange="updateCart('{{ $cart['id'] }}')" value="{{ $cart['quantity'] }}">                                
                                        </td>
                                        <td class="actions" data-th="">
                                            <a href="{{ route('delete.cart' , $cart['id']) }}"><button class="btn btn-danger btn-sm cart-buttons"><i class="fa fa-trash"></i></button></a>
                                        </td>
                                    </tr>                                    
                                @empty
                                    <p class="text-center">No Product Found</p>
                                @endforelse                                
                            </tbody>
                        </table>
                        {{-- <div class="col-lg-6 ms-auto">
                            <h6 class="me-4 d-flex justify-content-between align-items-center">Total :<span><h5 style="color: #209051;" class="pull-right"> ৳ <b class="adjusted">{{ $total }}</b></h5></span></h6>
                            <h6 class="me-4 d-flex justify-content-between align-items-center">Shipping (+): <span><h5 style="color: #209051;" class="pull-right"> ৳ <b class="adjusted">60</b></h5></span></h6>
                            <h5 class="me-4 d-flex justify-content-between align-items-center">Payable: <span><h5 style="color: #209051;" class="pull-right"> ৳ <b class="adjusted">640</b></h5></span></h5>
                        </div> --}}
                        <div class="mb-breakdown" style="background: #f8f8f8;padding: 15px;border-radius: 10px;">
                            <div class="text-center">Your total payable amount is
                                <div class="mb-grandtotal" style="color:green; font-weight:bold; text-align:center;font-size:35px">৳<span>{{ $total }}</span></div>
                                <table class="table table-sm table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Purpose</th>
                                            <th class="text-center">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">Total</td>
                                            <td class="mb-adjusted" style="text-align:center; color:green;">৳<span>{{ $total }}</span></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">Shipping</td>
                                            <td class="mb-shipping" style="text-align:center; color:green;">৳ <span></span></td>
                                        </tr>
                                        <tr style="display: none;">
                                            <td class="text-center">Discount</td>
                                            <td class="mb-discount" style="text-align:center; color:red;"></td>
                                        </tr>
                                        <tr style="display:none">
                                            <td class="text-center">Discount ()</td>
                                            <td class="mb-referral-discount" style="text-align:center; color:red;">৳</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="text-center">You will get the delivery <span class="mb-shipment" style="color:green; font-weight:bold;">within 2-3 Days</span> after confirmation.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
            
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Your Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                              <tr class="text-center">
                                <th class="text-start" scope="col">Product</th>
                                <th scope="col">Size</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr style="vertical-align: middle;" class="text-center">
                                <td class="text-start"><img src="{{ asset('TheMart/Images/61507e01f2680-square.jpg') }}" alt="cart_product_image" width="50"></td>
                                <td>XL</td>
                                <td>1</td>
                                <td>2500</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Update Cart</button>
                    </div>
                </div>
                </div>
            </div>
            <!-- End Modal -->
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
        function updateCart(id){
            var quantity = $('input.cartinput-quantity[type=number]').val();
            $.ajax({
                'url': '{{ route('update.cart') }}',
                'type': 'GET',
                data: {'id': id , 'quantity': quantity },
                success: function(data){                 
                    window.location.reload();                
                }
            });            
        }
        function confirmOrder() {
            const charge = $('#delivery').val();
            const total = {{ $total }};
            var orderData = {
                name: $('input[type=text][name=name]').val(),
                phone: $('input[type=text][name=phone]').val(),
                address: $('input[type=text][name=address]').val(),
                payment: $('input[type=radio][name=payment_method]:checked').val(),
                termsCondition: $('input.tnc-check[type=checkbox]:checked').val() ? true : false,
                note: $('input[type=text][name=note]').val(),
                delivery: $('#delivery').val(),
                total: parseInt(charge) + parseInt(total),
                discount: 0,
            };

            // AJAX request
            $.ajax({
                url: '{{ route('order.confirm') }}', 
                type: 'POST', 
                data: orderData, 
                success: function(response) {                    
                    window.location.href = response.redirect_url;
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText)
                }
            });
        }


    </script>
    <script>
        $(document).ready(function() {
            function updateDelivery() {
                const charge = $('#delivery').val();
                const total = {{ $total }};
                $('.mb-shipping > span').html(charge);
                $('.mb-grandtotal > span').html(parseInt(charge) + parseInt(total));
            }
            updateDelivery();
            $('#delivery').change(updateDelivery);
        });

    </script>


@endsection