<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="app-url" content="{{ getBaseURL() }}">
    <meta name="admin-url" content="{{ getBaseURL() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/svg" href="{{ asset('assets/img/favicon.ico') }}">
    <title>{{ env('APP_NAME') }}</title>

    <!-- google font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700">

    <!-- aiz core css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/aiz-core.css') }}">
   
  
    @yield('header')
    <style>
        body {
            font-size: 14px;
        }
        @media (min-width: 1200px) {
            .aiz-content-wrapper {
                padding-left: 0px;
            }
            .aiz-topbar {
                width: 100%;
                left: 0px;
            }
        }

        /* Category Section */
        .category-section {
            padding: 10px;
            /* background-color: #f8f9fa; */
            border-radius: 8px;
            /* border: 1px solid #ddd; */
            margin-bottom: 30px;
        }

        /* Category Title */
        .category-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        /* Portfolio List */
        .portfolio-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Space between portfolio cards */
        }

        /* Portfolio Card */
        .portfolio-card {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            width: 200px;
            transition: transform 0.3s ease;
        }

        /* Portfolio Link */
        .portfolio-link {
            color: #007bff;
            font-size: 18px;
            text-decoration: none;
            display: block;
            font-weight: 600;
        }

        /* Hover effect for portfolio card */
        /* .portfolio-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        } */

        /* Portfolio Link Hover */
        .portfolio-link:hover {
            text-decoration: underline;
            color: #0056b3;
        }

        .aiz-main-content{
            /* padding: 2% 10% 0%; */
            align-items: center;
            background: white;
        }

        @media (min-width: 992px) {
            .aiz-content-wrapper {
                padding-top: 65px;
            }
        }

       
    </style>
    <script>
        var AIZ = AIZ || {};
        AIZ.local = {
            nothing_selected: '{!!  trans('messages.nothing_selected') !!}',
            nothing_found: '{!!  trans('messages.nothing_found') !!}'
        }
    </script>

</head>

<body class="">

    <div class="aiz-main-wrapper" style="background: white;">
        <div class="aiz-content-wrapper">
            <div class="aiz-topbar px-15px px-lg-25px align-items-stretch justify-content-between">
                <div class="justify-content-between align-items-stretch flex-grow-xl-1">
                    <div class="justify-content-around align-items-center align-items-stretch">
                        <div class="justify-content-around align-items-center align-items-stretch ml-3">
                            <div class="aiz-topbar-item">
                                <div class="align-items-center">
                                    <div class="text-center">
                                        <a href="{{ route('home') }}" class="d-block text-left">
                                            <img class="mw-100" height="60" src="{{ asset('assets/images/logo.png') }}" 
                                                    alt="{{ env('APP_NAME') }}">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .aiz-topbar -->
            
            <div class="aiz-main-content" >
                <div class="px-15px px-lg-25px row mt-4">
                    @yield('content')
                </div>
                <div class="bg-white text-center py-3 px-15px px-lg-25px mt-auto">
                    <p class="mb-0">&copy; {{ date('Y') }} {{ env('APP_NAME') }}</p>
                </div>
            </div><!-- .aiz-main-content -->
        </div><!-- .aiz-content-wrapper -->
    </div><!-- .aiz-main-wrapper -->

    @yield('modal')


    <script src="{{ asset('assets/js/vendors.js') }}"></script>
    <script src="{{ asset('assets/js/aiz-core.js') }}"></script>

    @yield('script')

    <script type="text/javascript">
       
    </script>

</body>

</html>
