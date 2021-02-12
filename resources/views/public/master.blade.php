<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
    <meta name="description" content="RJstore">
    <meta name="keywords" content="RJstore">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'RJstore') }}</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('ashion/css/bootstrap.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ashion/css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ashion/css/magnific-popup.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('ashion/css/swiper.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ashion/css/dark.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ashion/css/animate.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('ashion/css/responsive.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('ashion/css/font-icons.css') }}" type="text/css">
    <!-- <link rel="stylesheet" href="{{ asset('ashion/css/themify-icons.css') }}" type="text/css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<title>Alis</title>

</head>

<body class="device-lg relative" style="background: url({{ asset('ashion/images/pattern.png')}}) repeat fixed;">
	<div class="left-bg" style="background-image: url({{ asset('ashion/images/one/bg-1.png')}}) ; ">
	</div>
	<div class="right-bg" style="background-image: url({{ asset('ashion/images/one/bg-2.png')}});">
	</div>
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->
		

  <div id="preloder">
        <div class="loader"></div>
    </div>
<div class="offcanvas-menu-overlay"></div>




<div id="app">
<header-section></header-section>


  <!--================Header Menu Area =================-->

  <!--================Header Menu Area =================-->

  <router-view></router-view>


  <!--================ start footer Area  =================-->
  <footer-section></footer-section>
  <vue-progress-bar></vue-progress-bar>
  <!--================ End footer Area  =================-->



<script src="{{ asset('ashion/js/jquery.js')}}"></script>

<script src="{{ asset('ashion/js/plugins.js')}}"></script>
<script src="{{ asset('ashion/js/functions.js')}}"></script>

<script src="{{ asset('js/app.js')}}"></script>

<script type="text/javascript">
	$(document).ready(function () {
			alert(12);
			console.log($("#ftr").html());
			$("#tpr").html($("#ftr").html());
		});
		(function ($) {
			$.fn.clickToggle = function (func1, func2) {
				var funcs = [func1, func2];
				this.data('toggleclicked', 0);
				this.click(function () {
					var data = $(this).data();
					var tc = data.toggleclicked;
					$.proxy(funcs[tc], this)();
					data.toggleclicked = (tc + 1) % 2;
				});
				return this;
			};
		}(jQuery));

		(function ($) {

			$('#primary-menu-trigger').clickToggle(function () {
				$('#primary-menu-trigger').css('top', '-14%');


			},
				function () {
					$('#primary-menu-trigger').css('top', '-47%');


				});
		}(jQuery));
	</script><script type="text/javascript">
	$(document).ready(function () {

			// $("#tpr").html($("#ftr").html());
		});
		(function ($) {
			$.fn.clickToggle = function (func1, func2) {
				var funcs = [func1, func2];
				this.data('toggleclicked', 0);
				this.click(function () {
					var data = $(this).data();
					var tc = data.toggleclicked;
					$.proxy(funcs[tc], this)();
					data.toggleclicked = (tc + 1) % 2;
				});
				return this;
			};
		}(jQuery));

		(function ($) {

			$('#primary-menu-trigger').clickToggle(function () {
				$('#primary-menu-trigger').css('top', '-14%');


			},
				function () {
					$('#primary-menu-trigger').css('top', '-47%');


				});
		}(jQuery));
	</script>

</body>

</html>
