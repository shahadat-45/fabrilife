@extends('themart.master')
@section('content')
<section id="details" class="my-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12">
                <!-- Main Image Display Carousel -->
                <div class="owl-carousel main-carousel">
                    <div class="item"><img src="{{ asset('uploads/product/' . $products->thumbnail) }}" alt="{{ $products->thumbnail }}"></div>
                    @foreach ($galleries as $item)
                        <div class="item"><img src="{{ asset('uploads/product/' . $item->images) }}" alt="{{ $item->images }}"></div>                            
                    @endforeach
                </div>

                <!-- Thumbnail Carousel -->
                <div class="owl-carousel thumbnail-carousel mb-3">
                    <div class="item"><img src="{{ asset('uploads/product/' . $products->thumbnail) }}" alt="{{ $products->thumbnail }}"></div>
                    @foreach ($galleries as $item)
                        <div class="item"><img src="{{ asset('uploads/product/' . $item->images) }}" alt="{{ $item->images }}"></div>                            
                    @endforeach
                </div>
                @if ($related)
                <div class="product-related hidden-sm-down d-none-mobile">
                    <h5 class="tiny-margin">Frequently Bought Together</h5>
                    <div class="hr"></div>
                    <div class="row">
                        @php
                            $after_discount = $related->rel_to_inventory->min('after_discount');
                            $frequent = App\Models\Inventory::where('product_id' , $related->id)->where('after_discount' , $after_discount)->first();
                            // $discount = $frequent->new_price ?? 0 - $frequent->after_discount ?? 0;                             
                        @endphp
                        <div class="d-flex">
                            <a class="product-link" href="{{ route('product.details' , $related->slug ) }}">
                                <img style="width: 170px" src="{{ asset('uploads/product/' . $related->thumbnail) }}">
                            </a>
                            <div class="product-related-desp">
                                <div><a class="product-link" href="{{ route('product.details' , $related->slug) }}">
                                        <h6 class="mb-1">{{ $related->product_name }}</h6>
                                </a></div>
                                <div>
                                    <div>
                                        <strong>{{ $related->rel_to_inventory->min('after_discount') }}</strong>
                                    </div>
                                <button class="add2cartModal btnAddToCart btn btn-black btn-sm px-4 ms-0 py-1 mt-3" style="font-size: 14px" onclick="miniCart({{ $related->id }} , {{ $frequent->color_id }} , {{ $frequent->size_id }})"><i class="fa fa-plus"></i>&nbsp; Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                    
                @endif
            </div>
            @php
                $min_id = App\Models\Inventory::where('product_id' , $products->id)->where('after_discount' , $products->rel_to_inventory->min('after_discount'))->first();
            @endphp
            <div class="col-lg-6 col-12 details_content">
                <h4 class="tiny-margin">{{ $products->product_name }}</h4>
                <div class="priceDiv">
                    <p>
                        <span>৳ </span><span class="price_field">{{ $products->rel_to_inventory->min('after_discount') }}</span>
                    </p>
                </div>
                <div class="sizes">
                    <strong style="width: 80px; line-height: 36px;font-family: 'Rajdhani', sans-serif;">Select Size: </strong>
                    <ul class="size-selectors-container list-inline asdf">
                        <div class="size-selectors-container list-inline" style="padding: 0px">
                            @foreach ($products->rel_to_inventory()->selectRaw('count(*) as total, size_id')->groupBy('size_id')->get() as $index => $size)                            
                                <input type="radio" id="size-{{ $index }}" name="size" value="{{ $size->rel_to_size->id }}" {{ $min_id->size_id == $size->rel_to_size->id ? 'checked' : '' }} onclick="getColor({{ $size->size_id }})">
                                <label for="size-{{ $index }}" class="size-selector list-inline-item {{ $min_id->size_id == $size->rel_to_size->id ? 'size-selector-selected' : '' }}">{{ $size->rel_to_size->size }}</label>
                            @endforeach                              
                        </div>
                        <span class="no-size-selected" style="color:rgb(230, 28, 28); display:none;">Please select a size &nbsp;<i class="fa fa-arrow-up" aria-hidden="true"></i></span>
                    </ul>
                </div>
                <input type="hidden" name="color" value="{{ $min_id->color_id }}">
                <div class="color"></div>
                {{-- <span class="no-size-selected" style="color: rgb(230, 28, 28);">Please select a size &nbsp;<i class="fa fa-arrow-up" aria-hidden="true"></i></span> --}}
                <div class="add2cartContainer">
                    <div class="number-input">
                        <button class="quantity-selector-step increase" onclick="minus()"><i class="fa fa-minus"></i></button>
                        <input class="quantity qty quantity-selector" min="1" name="quantity" value="1" type="number">
                        <button class="quantity-selector-step decrease" onclick="plus()"><i class="fa fa-plus"></i></button>
                    </div>
                    <button class="btnAddToCart btn btn-success btn-block main-btnAddToCart" onclick="AddToCart(this)" value="1"><i class="fa-solid fa-cart-plus me-1"></i> &nbsp;Add To Cart</button>
                </div>
                <button class="order_btn mt-3 btnAddToCart btn btn-success btn-block main-btnAddToCart" onclick="AddToCart(this)" value="2"><i class="fa-solid fa-cart-shopping me-1"></i></i> &nbsp;Order Now</button>
                <hr class="my-4" style="border-top: 1px solid #000;">               
                @if ($related)
                <div class="product-related hidden-sm-down product-related_mobile d-none">
                    <h5 class="tiny-margin">Frequently Bought Together</h5>
                    <div class="hr"></div>
                    <div class="row">
                        @php
                            $after_discount = $related->rel_to_inventory->min('after_discount');
                            $frequent = App\Models\Inventory::where('product_id' , $related->id)->where('after_discount' , $after_discount)->first();
                            // $discount = $frequent->new_price ?? 0 - $frequent->after_discount ?? 0;                             
                        @endphp
                        <div class="d-flex">
                            <a class="product-link" href="{{ route('product.details' , $related->slug ) }}">
                                <img style="width: 170px" src="{{ asset('uploads/product/' . $related->thumbnail) }}">
                            </a>
                            <div class="product-related-desp">
                                <div><a class="product-link" href="{{ route('product.details' , $related->slug) }}">
                                        <h6 class="mb-1">{{ $related->product_name }}</h6>
                                </a></div>
                                <div>
                                    <div>
                                        <strong>{{ $related->rel_to_inventory->min('after_discount') }}</strong>
                                    </div>
                                <button class="add2cartModal btnAddToCart btn btn-black btn-sm px-4 ms-0 py-1 mt-3" style="font-size: 14px" onclick="miniCart({{ $related->id }} , {{ $frequent->color_id }} , {{ $frequent->size_id }})"><i class="fa fa-plus"></i>&nbsp; Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                    
                @endif
                <div class="self-product-description">
                    {{-- {{ $products->short_desp }} --}}
                    {!! $products->long_desp !!}
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        {!! $products->additional_info !!}
    </div>
</section>
<section id="youMayAlsoKnow">
    <div class="container">
        <div class="row">
            <h4 class="mb-3" style="text-align: center;">You May Also Like</h4>
            <hr class="my-3">
            @foreach (App\Models\Products::where('product_type' , 1)->take(12)->get() as $key => $product)
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
    function plus() {
        var avqty = $('.quantity').val();
        qty = Number(avqty) + 1;
        $('.quantity').val(qty);        
    }
    function minus() {
        var avqty = $('.quantity').val();
        if (avqty != 1) {
            qty = Number(avqty) - 1;
            $('.quantity').val(qty);
        }
    }
    function getColor(size_id){
        var product_id = {{ $products->id }};        
        $.ajax({
            'url': '/product/get_color',
            'type': 'POST',
            data: {'size_id': size_id , 'product_id': product_id},
            success: function(data){
                var div = `<strong style="width: 80px; line-height: 36px;font-family: 'Rajdhani', sans-serif;">Select Color: </strong>
                            <ul class="size-selectors-container list-inline asdf"> 
                                <div class="size-selectors-container list-inline color_list" style="padding: 0px"> </div>
                            </ul>`;
                var html = ``;
                data.forEach(function(color , i) {
                    html += ` <input type="radio" id="color${i}" name="color" value="${color.color_id}" ${i === 0 ? 'checked' : ''} onclick="getColorPrice(${color.after_discount})">
                                <label for="color${i}" class="size-selector list-inline-item ${i === 0 ? 'size-selector-selected' : ''}">${color.color_name}</label>
                            `;                            
                });
                var firstValue = data[0];
                $('.price_field').html(firstValue.after_discount);
                $('.color').html(div);
                $('.color_list').html(html);
            }
        });
    }
    function getColorPrice(price){
        $('.price_field').html(price);
    }
    function AddToCart(btn){
        var button = btn.getAttribute('value');
        var product = {{ $products->id }};   
        var size = $('input[type="radio"][name="size"]:checked').val();
        var quantity = $('input.quantity[type="number"]').val();
        if ($('input[type="radio"][name="color"]').length > 0) {            
            var color = $('input[type="radio"][name="color"]:checked').val();
        } else {            
            var color = $('input[type="hidden"][name="color"]').val();
        }  
        $.ajax({
            'url': '/product/add_to_cart',
            'type': 'POST',
            data: {'color': color , 'product': product , 'size': size , 'quantity': quantity ,'button': button },
            success: function(data){ 
                if (data.button == 2 ) {
                    window.location.href = '/product/checkout';
                }else{
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
            }
        });

    }
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
    <script>
        $(document).ready(function() {

        var sync1 = $(".main-carousel");
        var sync2 = $(".thumbnail-carousel");
        var slidesPerPage = 4; //globaly define number of elements per page
        var syncedSecondary = true;

        sync1.owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: false,
            autoplay: false, 
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: ['<svg width="100%" height="100%" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>', '<svg width="100%" height="100%" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
        }).on('changed.owl.carousel', syncPosition);

        sync2
            .on('initialized.owl.carousel', function() {
                sync2.find(".owl-item").eq(0).addClass("current");
            })
            .owlCarousel({
                items: 5,
                dots: false,
                nav: false,
                smartSpeed: 200,
                slideSpeed: 500,
                slideBy: slidesPerPage, //alternatively you can slide by 1, this way the active slide will stick to the first item in the second carousel
                responsiveRefreshRate: 100,
                responsive: {
                    0:{
                        items: 3
                    },
                    576:{
                        items: 4
                    },
                    800: {
                        items: 5
                    }
                }
            }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {

            //if you disable loop you have to comment this block
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);

            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }

            //end block

            sync2
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();

            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        }

        sync2.on("click", ".owl-item", function(e) {
            e.preventDefault();
            var number = $(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });
        });
    </script>
@endsection