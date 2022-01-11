<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="description" content="multikart">
    <meta name="keywords" content="multikart">
    <meta name="author" content="multikart">
    <link rel="icon" href="{{ url('multikart/assets/images/favicon/1.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ url('multikart/assets/images/favicon/1.png') }}" type="image/x-icon">
    <title>Multikart - Online Shop</title>

    <!--Google font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&amp;display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.0/css/all.min.css" integrity="sha512-gRH0EcIcYBFkQTnbpO8k0WlsD20x5VzjhOA1Og8+ZUAhcMUCvd+APD35FJw3GzHAP3e+mP28YcDJxVr745loHw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!--Slick slider css-->
    <link rel="stylesheet" type="text/css" href="{{ url('multikart/assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('multikart/assets/css/vendors/slick-theme.css') }}">

    <!-- Animate icon -->
    <link rel="stylesheet" type="text/css" href="{{ url('multikart/assets/css/vendors/animate.css') }}">

    <!-- Themify icon -->
    <link rel="stylesheet" type="text/css" href="{{ url('multikart/assets/css/vendors/themify-icons.css') }}">

    <!-- Bootstrap css -->
    <link rel="stylesheet" type="text/css" href="{{ url('multikart/assets/css/vendors/bootstrap.css') }}">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css" href="{{ url('multikart/assets/css/style.css') }}">



</head>

<body class="theme-color-1">

    @include('layouts.multikart.header')

    @yield('content')

    @include('layouts.multikart.footer')

    <!-- tap to top -->
    <div class="tap-top top-cls">
        <div>
            <i class="fa fa-angle-double-up"></i>
        </div>
    </div>
    <!-- tap to top end -->


    <!-- latest jquery-->
    <script src="{{ url('multikart/assets/js/jquery-3.3.1.min.js') }}"></script>

    <!-- fly cart ui jquery-->
    <script src="{{ url('multikart/assets/js/jquery-ui.min.js') }}"></script>

    <!-- exitintent jquery-->
    <script src="{{ url('multikart/assets/js/jquery.exitintent.js') }}"></script>
    <script src="{{ url('multikart/assets/js/exit.js') }}"></script>

    <!-- slick js-->
    <script src="{{ url('multikart/assets/js/slick.js') }}"></script>

    <!-- menu js-->
    <script src="{{ url('multikart/assets/js/menu.js') }}"></script>

    <!-- lazyload js-->
    <script src="{{ url('multikart/assets/js/lazysizes.min.js') }}"></script>

    <!-- Bootstrap js-->
    <script src="{{ url('multikart/assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Bootstrap Notification js-->
    <script src="{{ url('multikart/assets/js/bootstrap-notify.min.js') }}"></script>

    <!-- Fly cart js-->
    <script src="{{ url('multikart/assets/js/fly-cart.js') }}"></script>

    <!-- Theme js-->
    <script src="{{ url('multikart/assets/js/script.js') }}"></script>

    <script>
        $(window).on('load', function () {
            setTimeout(function () {
                $('#exampleModal').modal('show');
            }, 2500);
        });

        function openSearch() {
            document.getElementById("search-overlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("search-overlay").style.display = "none";
        }

    </script>

</body>


</html>
