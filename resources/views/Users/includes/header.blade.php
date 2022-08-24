<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="User Dashboard">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- PAGE TITLE HERE -->
    <title>
        @yield('title')
    </title>
	
	<!-- FAVICONS ICON -->
	<link href="{{ asset('vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/nouislider/nouislider.min.css') }}">
	
	<!-- Style css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style type="text/css">
    	@import url('https://fonts.googleapis.com/css2?family=Inder&family=Jost:ital,wght@0,400;0,500;0,600;1,400&display=swap');
    	*{
    		font-family: "Inder";
    	}
        .networks{
            
        }
    </style>
	
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
		<div class="lds-ripple">
			<div></div>
			<div></div>
		</div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    @include('Users.includes.nav')
@include('Users.includes.sidebar')

@yield('content')

@include('Users.includes.footer')


<!-- REQUIRED SCRIPTS -->
@yield('script')
 <!-- Required vendors -->
 {{-- <script src = {{ asset('frontend/js/bootstrap.bundle.min.js') }}></script> --}}
 <script src={{ asset("vendor/global/global.min.js") }}></script>
 <script src={{ asset("vendor/chart.js/Chart.bundle.min.js") }}></script>
 <script src={{ asset("vendor/jquery-nice-select/js/jquery.nice-select.min.js") }}></script>
 
 <!-- Apex Chart -->
 <script src={{ asset("vendor/apexchart/apexchart.js") }}></script>
 
 <script src={{ asset("vendor/chart.js/Chart.bundle.min.js") }}></script>
 
 <!-- Chart piety plugin files -->
 <script src={{ asset("vendor/peity/jquery.peity.min.js") }}></script>
 <!-- Dashboard 1 -->
 <script src={{ asset("js/dashboard/dashboard-1.js") }}></script>
 
 <script src={{ asset("vendor/owl-carousel/owl.carousel.js") }}></script>
 <script src={{ asset("js/custom.min.js") }}></script>
 <script src={{ asset("js/dlabnav-init.js") }}></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

 <script>
     function cardsCenter()
     {
         
         /*  testimonial one function by = owl.carousel.js */
         
 
         
         jQuery('.card-slider').owlCarousel({
             loop:true,
             margin:0,
             nav:true,
             //center:true,
             slideSpeed: 3000,
             paginationSpeed: 3000,
             dots: true,
             navText: ['<i class="fas fa-arrow-left"></i>', '<i class="fas fa-arrow-right"></i>'],
             responsive:{
                 0:{
                     items:1
                 },
                 576:{
                     items:1
                 },	
                 800:{
                     items:1
                 },			
                 991:{
                     items:1
                 },
                 1200:{
                     items:1
                 },
                 1600:{
                     items:1
                 }
             }
         })
     }
     
     jQuery(window).on('load',function(){
         setTimeout(function(){
             cardsCenter();
         }, 1000); 
     });
     
 </script>

</body>
</html>