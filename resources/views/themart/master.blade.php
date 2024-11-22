<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FabriLife</title>
    <link rel="stylesheet" href="{{ asset('TheMart/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('TheMart/css/all.min.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('TheMart/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('TheMart/css/responsive.css') }}">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.min.css" rel="stylesheet">
    @yield('header')
</head>
<body>
    @php
        $setting = App\Models\Setting::find(1);
        $cart = session()->get('cart', []);
    @endphp
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid bg-white">
          <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('uploads/TheMart/'. $setting->header_logo) }}" alt="logo" width="180px" height="36px"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dropdown_mobile" aria-controls="navbarSupportedContent" aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="order-3 me-1 d-none ms-auto" href="{{ route('cart') }}"><button class="btn" type="button"><i class="fa-solid fa-cart-shopping"></i> <span>{{ count($cart) }}</span></button></a>
          <button class="border-0 bg-transparent order-4 d-none me-2" onclick="toggleForm()"><i class="fa-solid fa-magnifying-glass"></i></button>
          <div class="navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">              
              <li class="nav-item dropdown active" >
                <a class="nav-link dropdown-toggle d-none-mobile" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Shop
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="dropdown_mobile">
                    <div class="d-flex">
                        @foreach (App\Models\Category::take(5) as $key => $category)
                            <li style="{{ $key % 2 == 0 ? 'background-color: #f7f7f7' : '' }}" >
                                <ul>
                                    <li>{{ $category->name }}</li>
                                        @foreach (App\Models\SubCategory::where('category_id' , $category->id)->get() as $subcategory)
                                            <li>{{ $subcategory->sub_category_name }}</li>                                            
                                        @endforeach
                                </ul>
                            </li>                            
                        @endforeach
                    </div>
                </ul>
              </li>
            </ul>
            <form class="d-flex search-form" id="searchForm">
              <input class="form-control me-2" id="search_input" type="search" placeholder="Search Products by Titles or Tags" aria-label="Search" value="{{ @$_GET['q'] }}">
              <button class="border-0 bg-transparent" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>     
            <a href="{{ route('cart') }}"><button class="btn d-none-mobile" type="button"><i class="fa-solid fa-cart-shopping"></i> <span>{{ count($cart) }}</span></button></a>
          </div>
        </div>
    </nav>
    @yield('content')
    <footer>
        <div class="footer-container mt-4">
            <div id="footer" class="container-fluid no-margin-padding">
              <div class="row newsletter">
                  <div class="ftbl d-flex">
                      <div class="col-md-6 text-center">
                          <div class="pull-left">
                              <div class="ftbl-text"><i class="fa fa-envelope-o"></i>GET SPECIAL DISCOUNTS IN YOUR INBOX</div>
                              <div class="form-inline pull-left newsletter-form">
                                <input class="form-control mail-subscribe email-submit-input" type="email" name="email" placeholder="Enter email to get offers, discounts and more." required="">
                                <button class="btn btn-sm btn-warning mail-subscribe-btn" id="subscribeButton" type="submit">Subscribe</button>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6 text-center">
                          <div class="pull-left">
                              <div class="ftbl-text"><i class="fa fa-phone"></i>FOR ANY HELP YOU MAY CALL US AT</div>
                              <div style="text-align: left; color: #aaa; margin-left: 20px">
                                {{ $setting->contact }}<br>
                                {{ $setting->address }}
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="row footer_menu_item">
                  <div class="ftbl">
                      <div class="col-lg-3 col-md-6 col-sm-12 text-left">
                          <div style=" color: orange">FABRILIFE</div>
                          <li class="sub-item-list"><a class="no-style-link" href="/user-specification">ABOUT US</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="/terms">TERMS &amp; CONDITIONS</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="/privacy-policy">PRIVACY POLICY</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="/refund-policy">CANCELLATION &amp; RETURN POLICY</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="/faq">FAQS</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="/contact-us">CONTACT US</a></li>
                          <!-- <ul style="margin: 0px; padding: 15px 0 0 0;">
                              <li class="text-center" style="list-style:none; display: inline-block; background: #000; border-radius: .7rem; width: 1.4rem; height: 1.4rem;">
                                  <a class="fabrilife_social" style="color: white;" href="https://www.facebook.com/fabrilife" title="Facebook">
                                     <i class="fa fa-facebook"></i>
                                 </a>
                              </li>
                              <li class="text-center" style="list-style:none; display: inline-block; background: #000; border-radius: .7rem; width: 1.4rem; height: 1.4rem;">
                                  <a class="fabrilife_social" style="color: white;" href="https://twitter.com/fabrilife" title="Twitter">
                                     <i class="fa fa-twitter"></i>
                                 </a>
                              </li>
                              <li class="text-center" style="list-style:none; display: inline-block; background: #000; border-radius: .7rem; width: 1.4rem; height: 1.4rem;">
                                  <a class="fabrilife_social" style="color: white;" href="https://www.youtube.com/channel/UCLooFQFh-FJvbMKIBXQszxQ" title="Google Plus">
                                     <i class="fa fa-youtube"></i>
                                  </a>
                              </li>
                              <li class="text-center" style="list-style:none; display: inline-block; background: #000; border-radius: .7rem; width: 1.4rem; height: 1.4rem;">
                                  <a class="fabrilife_social" style="color: white;" href="https://www.instagram.com/fabrilife" title="Instagram">
                                     <i class="fa fa-instagram"></i>
                                 </a>
                              </li>
                              <li class="text-center" style="list-style:none; display: inline-block; background: #000; border-radius: .7rem; width: 1.4rem; height: 1.4rem;">
                                 <a class="fabrilife_social" style="color: white;" href="https://www.pinterest.com/shajgoj/?eq=shajgoj&amp;etslf=4683" title="Pinterest">
                                    <i class="fa fa-pinterest-p"></i>
                                </a>
                              </li>
                          </ul> -->
                      </div>
                      <div class="col-lg-3 col-md-6 col-sm-12 text-left">
                          <div>MEN</div>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Mens%20%3E%20Half%20Sleeve%20T-shirt">SHORT SLEEVE</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Mens%20%3E%20Full%20Sleeve%20T-shirt">LONG SLEEVE</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Mens%20%3E%20Polo%20T-shirt">POLO</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Mens%20%3E%20Shirt">SHIRT</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Mens%20%3E%20Hoodie">HOODIE</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Mens%20%3E%20Comfy%20Trouser">COMFY TROUSER</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Mens%20%3E%20Sports%20Trouser">SPORTS TROUSER</a></li>
                      </div>
                      <div class="col-lg-3 col-md-6 col-sm-12 text-left">
                          <div>W0MEN</div>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Womens%20%3E%20Comfy%20Trouser">COMFY TROUSER</a></li>
                          <div style="font-weight: bold; font-size: 1rem;">FACE MASK</div>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Face%20Mask%20%3E%20Professional%207%20Layer%20Mask">CLASSIC</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Face%20Mask%20%3E%20Womens%20Designer%20Edition">DESIGNER EDITION</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Face%20Mask%20%3E%20Kids%20Mask">KIDS MASK</a></li>
                          <div style="font-weight: bold; font-size: 1rem;">SPORTS</div>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Mens%20%3E%20Half%20Sleeve%20T-shirt%20%3E%20Sports">JERSEY</a></li>
                      </div>
                      <div class="col-lg-3 col-md-6 col-sm-12 text-left">
                          <div>KIDS</div>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Kids%20%3E%20Maggie">MAGGIE</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Kids%20%3E%20Half%20Sleeve%20T-shirt">SHORT SLEEVE</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Kids%20%3E%20Full%20Sleeve%20T-shirt">LONG SLEEVE</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Kids%20%3E%20Shorts">SHORTS</a></li>
                          <li class="sub-item-list"><a class="no-style-link" href="https://fabrilife.com/shop?refinementList%5Bcats%5D%5B0%5D=Kids%20%3E%20Trouser">TROUSER</a></li>
                      </div>
                  </div>
              </div>
              <div class="row copyright">
                  <div class="title">
                      {{ $setting->footer_text }}
                      <br>
                      <br>
                      <div>{{ $setting->copyright }}</div>
                  </div>
              </div>
            </div>
          </div>
    </footer>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <!-- jQuery (required by Owl Carousel) -->
    <script src="{{ asset('TheMart/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('TheMart/js/homepage.js') }}"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.0/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function () {
            $("#subscribeButton").click(function () {                
                const email = $(".email-submit-input").val();
                
                if (email.trim() === "") {
                    alert("Please enter a valid email.");
                    return;
                }
                $.ajaxSetup({
                    headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                });
                $.ajax({
                url: "{{ route('newsletter.store') }}", 
                type: "POST",
                data: { email: email }, 
                success: function (response) {                    
                    alert(response.message);
                    $(".email-submit-input").val("");                    
                },
                error: function (xhr) {                    
                    alert(xhr.responseJSON.message);
                },
                });
            });
        });

    </script>
    <script>
        $('#search_input').on('change', function () {
            var keyword = $(this).val();
            var link = '{{ route('shop') }}' + '?q=' + keyword;             
            window.location.href = link;
        });
    </script>
    @yield('footer')
</body>
</html>