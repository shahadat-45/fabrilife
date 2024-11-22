@extends('themart.master')
@section('content')
<main id="shop-content">
    <!-- Sidebar for Category List -->
    <aside class="sidebar">
        <h2>Categories</h2>
        <ul>
            @foreach ($categories as $index => $category)
            @php
                $cat = App\Models\Products::where('product_type', 1)->where('category_id' , $category->id)->count();
            @endphp
            <li class="ais-RefinementList-item ais-RefinementList-item--selected {{ $cat == 0 ? 'd-none' : '' }}">
                <div>
                    <div onclick="scrollToTop({{ $category->id }},'')" class="facet-item level2">
                        <input type="checkbox" class="ais-RefinementList-checkbox {{ $index == 0 ? 'usual-checkbox' : '' }}" value="Half Sleeve T-shirt" checked >
                            {{ $category->name }}
                        <span class="facet-count">{{ $cat }}</span>
                    </div>
                </div>
            </li>
                @foreach (App\Models\SubCategory::where('category_id' , $category->id)->get() as $subCategory)
                @php
                    $sub = App\Models\Products::where('product_type', 1)->where('subcategory_id' , $subCategory->id)->count();
                @endphp
                <li class="ais-RefinementList-item {{ $sub == 0 ? 'd-none' : '' }}">
                    <div>
                        <div onclick="scrollToTop({{ $category->id }},{{ $subCategory->id }})" class="facet-item level3">
                            <input type="checkbox" class="ais-RefinementList-checkbox" value="Blank">
                                {{ $subCategory->sub_category_name }}
                            <span class="facet-count">{{ $sub }}</span>
                        </div>
                    </div>
                </li>                
                @endforeach                
            @endforeach
        </ul>
    </aside>

    <!-- Main Section for Products -->
    <section id="shop-products">
        <div class="product-filters">
            <div id="tagbox">
                <span class="ais-tag-item header">Tags</span>
                @foreach ($tags as $tag)
                    <span class="ais-tag-item tag" value="{{ $tag->id }}">{{ $tag->tag_name }}</span>                    
                @endforeach
                <span class="ais-tag-item clear">Clear Tags</span>
            </div>
        </div>

        <div class="product-grid row">
            <!-- Product Items -->
            @foreach ($products as $product)
                <div class="col-lg-3 p-2 pt-0 col-6 col-6">
                    <div class="card product-card">
                        <a class="no-style-link" href="{{ route('product.details' , $product->slug) }}">
                            <div class="gallerythumbWrapper gallerythumbWrapperLoaded" style="background: url('/img/product-loader.svg') no-repeat center, linear-gradient(135deg, #111111 0%, #e0e0e0 100%);">
                                <img class="gallerythumb gallerythumbLoaded" src="{{ asset('uploads/product/' . $product->thumbnail) }}" width="100%" alt="Card image">
                                <h6 class="truncate">{{ Illuminate\Support\Str::limit($product->product_name, 30); }}</h6>
                                <p class="non_mediacal d-none">Non Medical</p>
                                <div style="display:block" class="discounted_amount">
                                    @php
                                        $discount = $product->rel_to_inventory->min('new_price') - $product->rel_to_inventory->min('after_discount');
                                    @endphp
                                    <span class="{{ $discount < 1 ? 'd-none' : '' }}">Save Tk. {{ $discount }}</span>
                                </div>
                                <p class="card-text">
                                <span></span>
                                <br>
                                <span class="{{ $discount < 1 ? 'd-none' : '' }}">৳{{ $product->rel_to_inventory->min('new_price') ?? '' }}</span>
                                    ৳{{ $product->rel_to_inventory->min('after_discount') }}
                            </p>
                                <!-- <div class="like-box-gallery" style="padding: 0px;">
                                    <span  class="like-count likes-for-72641"> 0</span>
                                </div> -->
                            </div>
                        </a>
                        <div class="sale {{ $discount < 1 ? 'd-none' : '' }}"><span>SALE</span></div>
                        <div style="{{ $product->free_delivery == 1 ? 'display:block' : 'display:none' }}" class="free_delivery"><img src="{{ asset('TheMart/Images/external-flash.png') }}"><span>FREE DELIVERY</span></div>
                        <!-- <div class="products-like-button like-id-72641 d-none" >
                            <i class="fa fa-heart-o"></i>
                            <span> 0</span>
                        </div>
                        <div class="products-share-button d-none">
                            <i class="fa fa-share"></i> 
                            Share
                        </div> -->
                        <a href="{{ route('product.details' , $product->slug) }}">
                            <div class="products-cart-button">
                            <!-- data-productkey="72641" data-image="/products/65708ff07a95b-square.jpg" data-title="Mens Premium T-Shirt - Vibrant" data-color="#111111" data-url="/product/72641-mens-premium-t-shirt-vibrant" -->
                                <i class="fa fa-cart-plus"></i>
                                    Buy Now 
                                    <!-- <i class="products-cart-button-loader fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i> -->
                            </div>
                        </a>
                    </div>
                </div>                    
            @endforeach
            <!-- More products as needed -->
        </div>
    </section>
</main>
@endsection
@section('footer')
<script>
    function scrollToTop(id , sub) {
        var link = '{{ route('shop') }}' + '?ctd=' + id + '?&sub=' + sub;             
        window.location.href = link;
    }
</script>
<script>
    $('.tag').click(function(){
        var tag = $(this).attr('value');
        var link = '{{ route('shop') }}' + '?tag=' + tag ;
        window.location.href = link ;
    })
</script>
<script>
    $('.clear').click(function(){
        var link = '{{ route('shop') }}';
        window.location.href = link ;
    })
</script>
@endsection