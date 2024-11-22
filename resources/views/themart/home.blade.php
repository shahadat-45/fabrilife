@extends('themart.master')
@section('content')
    <section>
        <div id="banner" class="owl-carousel">
            @foreach ($banners as $item)
            <div class="item"><a href="{{ $item->link }}"><img src="{{ asset('uploads/TheMart/banner/' . $item->image) }}" alt="Slide_{{ $item->image }}"></a></div>                
            @endforeach
            <!-- Add more slides as needed -->
        </div>
        <div class="body-menu">
            <div class="body-menu-item row">
                <div class="col-lg-1"></div>
                <div class="skew col-lg-2 col-12">
                    <a class="no-style-link unskew" href="{{ route('shop') }}">SHOP NOW</a>
                </div>
                <div class="col-lg-2 col-4">
                    <a class="no-style-link" href="">MEN</a>
                </div>
                <div class=" col-lg-2 col-4">
                    <a class="no-style-link" href="">WOMEN</a>
                </div>
                <div class=" col-lg-2 col-4">
                    <a class="no-style-link" href="">KIDS</a>
                </div>
                <div class="no-style-link skew col-lg-3 col-12" href="">
                    <span>GET 5% OFF ON APP</span>                  
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container px-0">
            <div class="event_target">
            <strong>Event T-shirt <i class="fa fa-caret-right" aria-hidden="true"></i></strong>&nbsp;
            <span>
                {{ $setting->event_text }}
                <strong>Click here <i class="fa fa-chevron-circle-right" aria-hidden="true"></i></strong>
            </span>
            </div>
            <div class="campaign shoptop">
            <a class="hot-container-link mindfordesign" href="{{ $setting->arrival_link }}">
                <div class="hot-image-title light">
                    NEW ARRIVAL
                </div>
            </a>
            </div>
        </div>
    </section>
    <section id="category">
        <div class="container px-1">
            <div class="row">
                <div id="cat_mobile" class="owl-carousel">
                    @foreach ($categories as $category)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 col-xs-6">
                        <div class="flex-cat-block">
                            <div class="flex-cat-img">
                                <a href="">
                                    <img src="{{ asset('uploads/category/' . $category->image) }}">
                                </a>
                                <div class="flex-cat-button">
                                    <a href="">{{ $category->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>   
                @foreach ($categories as $category)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-xs-6">
                        <div class="flex-cat-block">
                            <div class="flex-cat-img">
                                <a href="">
                                    <img src="{{ asset('uploads/category/' . $category->image) }}">
                                </a>
                                <div class="flex-cat-button">
                                    <a href="">{{ $category->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="poster">
        <div class="container">
            <div class="row">
                @foreach (App\Models\Poster::where('status' , 1)->get() as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a class="product-link" href="">
                            <div>
                                <img src="{{ asset('uploads/TheMart/poster/' . $item->image) }}">
                            </div>
                            <div class="hero-link" style="width: 100%">
                                {{ $item->title }}
                            </div>
                        </a>
                    </div>                    
                @endforeach
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <a class="product-link" href="">
                    <div>
                        <img src="{{ asset('TheMart/Images/638938e7d0d50-square.jpg') }}">
                    </div>
                    <div class="hero-link">
                        Designer Edition
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <a class="product-link" href="">
                    <div>
                        <img src="{{ asset('TheMart/Images/638938e7d0d50-square.jpg') }}">
                    </div>
                    <div class="hero-link">
                        Short Sleeve Blanks
                    </div>
                </a>
            </div>
        </div>
        </div>
    </section>
    <section id="poster_product">
        <div class="container">
            <div class="row">
                @foreach (App\Models\Poster::where('status' , 2)->get() as $item)
                <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <!-- Product item -->
                    <a class="product-link" href="">
                        <div>
                            <img src="{{ asset('uploads/TheMart/poster/' . $item->image) }}">
                        </div>
                        <div class="hero-link">
                            {{ $item->title }}
                        </div>
                    </a>
                </div>
                @endforeach                
                <!-- Repeat for other products -->
                <div class="col-xl-8 d-flex flex-wrap" id="poster_prd01">
                    @foreach ($all_product as $product)
                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                            <a class="product-link" href="{{ route('product.details' , $product->slug) }}">
                                <div class="home-product">
                                    <img src="{{ asset('uploads/product/' . $product->thumbnail) }}">
                                    <div class="product-info">
                                        <div class="product-name">{{ $product->product_name }}</div>
                                    </div>
                                    <div class="product-price">
                                        <div><strong>৳ 640.00</strong><strike>৳ 785.00</strike></div>
                                    </div>
                                </div>
                            </a>
                        </div>                        
                    @endforeach
                <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                    <a class="product-link" href="/product/72713-mens-metro-edition-premium-full-sleeve-t-shirt-twilight">
                        <div class="home-product">
                            <img src="{{ asset('TheMart/Images/638a77dd0caa8-square.jpg') }}">
                                                            <div class="product-info">
                                <div class="product-name">Mens Metro Edition Premium Full Sleeve T-shirt - Twilight </div>
                            </div>
                            <div class="product-price">
                                <div>
                                                                    <strong>৳ 640.00</strong> <strike>৳ 795.00</strike>
                                                                    </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- <div class="col-xl-2 col-lg-3 col-md-4 col-sm-3 col-xs-6">
                    <a class="product-link" href="/product/71735-premium-full-sleeve-raglan-t-shirt-navy">
                        </a><div class="home-product"><a class="product-link" href="/product/71735-premium-full-sleeve-raglan-t-shirt-navy">
                            <img src="{{ asset('TheMart/Images/638a77dd0caa8-square.jpg') }}">
                                                            </a><a class="hot-container-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Mens%20%3E%20Full%20Sleeve%20T-shirt"><div class="hot-image-title"><span>View</span><span>More</span></div></a>
                                                            <div class="product-info">
                                <div class="product-name">Premium Full Sleeve Raglan T-Shirt - Navy</div>
                            </div>
                            <div class="product-price">
                                <div>
                                                                    <strong>৳ 595.00</strong> <strike>৳ 685.00</strike>
                                                                    </div>
                            </div>
                        </div>
                    
                </div> -->
                </div>
            </div>
        </div>
    </section>
    <section id="fabric"> 
        <div class="container">
            <div class="row comfort-flex">
                <div class="col-lg-8 col-sm-12">
                    <div class="comfort">
                        <div class="comfort-heading">{{ $about->headding }} <i style="color: #5cb85c;" class="fa fa-angle-right" aria-hidden="true"></i></div>
                        <div class="comfort-subheading">{{ $about->title }} </div>
                        <span> {{ $about->description }} </span>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <a class="product-link" href="#">
                        <div>
                            <img src="{{ asset('uploads/TheMart/'. $about->photo) }}">
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <section id="poster_product">
        <div class="container">
            <div class="row">
                @foreach (App\Models\Poster::where('status' , 2)->get() as $item)
                <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                    <!-- Product item -->
                    <a class="product-link" href="">
                        <div>
                            <img src="{{ asset('uploads/TheMart/poster/' . $item->image) }}">
                        </div>
                        <div class="hero-link">
                            {{ $item->title }}
                        </div>
                    </a>
                </div>
                @endforeach                
                <!-- Repeat for other products -->
                <div class="col-xl-8 d-flex flex-wrap" id="poster_prd02">
                    @foreach ($all_product as $product)
                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                            <a class="product-link" href="{{ route('product.details' , $product->slug) }}">
                                <div class="home-product">
                                    <img src="{{ asset('uploads/product/' . $product->thumbnail) }}">
                                    <div class="product-info">
                                        <div class="product-name">{{ $product->product_name }}</div>
                                    </div>
                                    <div class="product-price">
                                        <div><strong>৳ 640.00</strong><strike>৳ 785.00</strike></div>
                                    </div>
                                </div>
                            </a>
                        </div>                        
                    @endforeach
                <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                    <a class="product-link" href="{{ route('product.details' , $product->slug) }}">
                        <div class="home-product">
                            <img src="{{ asset('TheMart/Images/638a77dd0caa8-square.jpg') }}">
                                                            <div class="product-info">
                                <div class="product-name">Mens Metro Edition Premium Full Sleeve T-shirt - Twilight </div>
                            </div>
                            <div class="product-price">
                                <div>
                                                                    <strong>৳ 640.00</strong> <strike>৳ 795.00</strike>
                                                                    </div>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- <div class="col-xl-2 col-lg-3 col-md-4 col-sm-3 col-xs-6">
                    <a class="product-link" href="/product/71735-premium-full-sleeve-raglan-t-shirt-navy">
                        </a><div class="home-product"><a class="product-link" href="/product/71735-premium-full-sleeve-raglan-t-shirt-navy">
                            <img src="{{ asset('TheMart/Images/638a77dd0caa8-square.jpg') }}">
                                                            </a><a class="hot-container-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Mens%20%3E%20Full%20Sleeve%20T-shirt"><div class="hot-image-title"><span>View</span><span>More</span></div></a>
                                                            <div class="product-info">
                                <div class="product-name">Premium Full Sleeve Raglan T-Shirt - Navy</div>
                            </div>
                            <div class="product-price">
                                <div>
                                                                    <strong>৳ 595.00</strong> <strike>৳ 685.00</strike>
                                                                    </div>
                            </div>
                        </div>
                    
                </div> -->
                </div>
            </div>
        </div>
    </section>
    <section id="poster">
        <div class="container">
            <div class="row">
                @foreach (App\Models\Poster::where('status' , 1)->get() as $item)
                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <a class="product-link" href="">
                            <div>
                                <img src="{{ asset('uploads/TheMart/poster/' . $item->image) }}">
                            </div>
                            <div class="hero-link" style="width: 100%">
                                {{ $item->title }}
                            </div>
                        </a>
                    </div>                    
                @endforeach
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <a class="product-link" href="">
                    <div>
                        <img src="{{ asset('TheMart/Images/638938e7d0d50-square.jpg') }}">
                    </div>
                    <div class="hero-link">
                        Designer Edition
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <a class="product-link" href="">
                    <div>
                        <img src="{{ asset('TheMart/Images/638938e7d0d50-square.jpg') }}">
                    </div>
                    <div class="hero-link">
                        Short Sleeve Blanks
                    </div>
                </a>
            </div>
        </div>
        </div>
    </section>
    <section id="premium">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoptop" style="min-height: 100px;">
                        <a class="hot-container-link mindfordesign" href="{{ $about->link2 }}">
                            <div class="hot-image-title light">
                                <div class="hot-title">{{ $about->desp2 }}</div>
                                <div class="hot-topic">{{ $about->title2 }}</div>
                                <div class="hot-link">Visit Store&nbsp;&nbsp;&nbsp;&gt;</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="poster_product" style="margin-top: 5px;">
        <div class="container">
            <div class="row">
                @foreach (App\Models\Poster::where('status' , 2)->get() as $item)
                    <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <!-- Product item -->
                        <a class="product-link" href="">
                            <div>
                                <img src="{{ asset('uploads/TheMart/poster/' . $item->image) }}">
                            </div>
                            <div class="hero-link">
                                {{ $item->title }}
                            </div>
                        </a>
                    </div>
                @endforeach  
                <!-- Repeat for other products -->
                <div class="col-xl-8 d-flex flex-wrap" id="poster_prd03">
                    @foreach ($all_product as $product)
                        <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                            <a class="product-link" href="/product/72275-mens-metro-edition-premium-full-sleeve-t-shirt-endless">
                                <div class="home-product">
                                    <img src="{{ asset('uploads/product/' . $product->thumbnail) }}">
                                    <div class="product-info">
                                        <div class="product-name">{{ $product->product_name }}</div>
                                    </div>
                                    <div class="product-price">
                                        <div><strong>৳ 640.00</strong><strike>৳ 785.00</strike></div>
                                    </div>
                                </div>
                            </a>
                        </div>                        
                    @endforeach
                <div class="col-lg-3 col-md-4 col-sm-3 col-xs-6">
                    <a class="product-link" href="{{ route('product.details' , $product->slug) }}">
                        <div class="home-product">
                            <img src="{{ asset('TheMart/Images/638a77dd0caa8-square.jpg') }}">
                                                            <div class="product-info">
                                <div class="product-name">Mens Metro Edition Premium Full Sleeve T-shirt - Twilight </div>
                            </div>
                            <div class="product-price">
                                <div>
                                                                    <strong>৳ 640.00</strong> <strike>৳ 795.00</strike>
                                                                    </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>    
@endsection
@section('footer')

@endsection