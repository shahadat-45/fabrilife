@extends('themart.master')
@section('header')
    <style>
        /* General Styles for the Error Page */
        .wpo-page-title {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }

        .wpo-page-title h2 {
            display: none; /* Hiding the title */
        }

        .wpo-breadcumb-wrap {
            text-align: center;
            font-size: 16px;
            color: #6c757d;
        }

        .wpo-breadcumb-wrap a {
            color: #007bff;
            text-decoration: none;
        }

        .wpo-breadcumb-wrap a:hover {
            text-decoration: underline;
        }

        /* Error Section Styles */
        .error-404-section {
            text-align: center;
            padding: 10px 15px 50px;
            background-color: #fff;
        }

        .error img {
            max-width: 100%;
            height: auto;
            margin-bottom: 20px;
            max-width: 300px;
        }

        .error-message {
            margin-top: 20px;
        }

        .error-message h3 {
            font-size: 28px;
            color: #333;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .error-message p {
            font-size: 16px;
            color: #6c757d;
            line-height: 1.5;
        }

        .theme-btn {
            display: inline-block;
            padding: 12px 25px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .theme-btn:hover {
            background-color: #0056b3;
            color: #fff;
            text-decoration: none;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .error-404-section {
                padding: 30px 10px;
            }

            .error-message h3 {
                font-size: 24px;
            }

            .error-message p {
                font-size: 14px;
            }

            .theme-btn {
                font-size: 14px;
                padding: 10px 20px;
            }

            .wpo-breadcumb-wrap {
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .error-message h3 {
                font-size: 20px;
            }

            .error-message p {
                font-size: 12px;
            }

            .theme-btn {
                font-size: 12px;
                padding: 8px 15px;
            }
        }
    </style>
@endsection
@section('content')
<section class="wpo-page-title">
    <h2 class="d-none">Hide</h2>
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="wpo-breadcumb-wrap">
                    <ol class="wpo-breadcumb-wrap d-flex gap-2 mb-0">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><i class="fa-solid fa-angle-right"></i></li>
                        <li>Order Placed</li>
                    </ol>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end page-title -->

<!-- start error-404-section -->
<section class="error-404-section pb-5">
    <div class="container">
        <div class="row">
            <div class="col col-xs-12">
                <div class="content clearfix">
                    <div class="error">
                        <img src="{{ asset('TheMart/Images/successful-handy-pack-delivery.webp') }}" alt>
                    </div>
                    <div class="error-message mt-0">
                        <h3>Your Order Placed Successfully.</h3>
                        <p>{{ App\Models\Setting::find(1)->order_place }}</p>
                        <a href="{{ route('home') }}" class="theme-btn">Back to home</a>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->
    </div> <!-- end container -->
</section>
<!-- end error-404-section -->    
@endsection
