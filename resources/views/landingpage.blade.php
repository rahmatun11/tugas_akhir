<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
		<meta name="description" content="Kelsey : Blog HTML Template" />
	<meta property="og:title" content="Kelsey : Blog HTML Template" />
	<meta property="og:description" content="Kelsey : Blog HTML Template" />
	<meta property="og:image" content="http://kelsey.dexignzone.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">
	
	<!-- FAVICONS ICON -->
	<link rel="icon" href="assets/user/xhtml/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/user/xhtml/images/favicon.png" />
	
	<!-- PAGE TITLE HERE -->
	<title>Stunances App</title>
	
	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!--[if lt IE 9]>
	<script src="js/html5shiv.min.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	
	<!-- STYLESHEETS -->
	<link rel="stylesheet" type="text/css" href="../../../user/xhtml/css/plugins.css">
	<link rel="stylesheet" type="text/css" href="../../../user/xhtml/css/style.css">
	<link rel="stylesheet" type="text/css" href="../../../user/xhtml/css/templete.css">
	<link class="skin" rel="stylesheet" type="text/css" href="../../../user/xhtml/css/skin/skin-1.css">
</head>
<body id="bg">
<div class="page-wraper">
<div id="loading-area"></div>
	<!-- header -->
    <header class="site-header mo-left header-full header">
		<!-- main header -->
        <div class="sticky-header main-bar-wraper navbar-expand-lg">
            <div class="main-bar clearfix ">
                <div class="container-fluid">
					<div class="header-content-bx">
						<!-- website logo -->
						<div class="logo-header">
							<a href="index.html"><img src="images/logo.png" alt=""/></a>
						</div>
						<!-- nav toggle button -->
						<button class="navbar-toggler collapsed navicon justify-content-end kk" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
							<span></span>
							<span></span>
							<span></span>
						</button>
						<!-- extra nav -->
						<div class="extra-nav">
							<div class="extra-cell">
								<ul>
									<a  href="{{ url('login') }}"  class="btn radius-xl gray">Log in</a>	
								</ul>
							</div>
						</div>
						<!-- Quik search -->
						<div class="dlab-quik-search">
							<form action="#">
								<input name="search" value="" type="text" class="form-control" placeholder="enter your keyword ...">
								<span  id="quik-search-remove"><i class="ti-close"></i></span>
							</form>
						</div>
						<!-- main nav -->
						<div class="header-nav navbar-collapse collapse justify-content-center nav-dark" id="navbarNavDropdown">
							<ul class="nav navbar-nav">
								<li><a href="gallery.html">Gallery</a></li>	
								<li><a href="about-us.html">About</a></li>
								<li><a href="contact.html">Contact</a></li>
							</ul>
							<div class="social-menu">
								<ul>
									<li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
									<li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
									<li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
        <!-- main header END -->
    </header>
    <!-- header END -->
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- Slider Banner -->
        <div class="main-slide p-t30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="post-slide-show alignwide m-b0">
							<div class="post-slide owl-carousel">
								<div class="item">
									<img alt="" src="{{ asset('user/xhtml/images/category/Landing-Page.jpg') }}">
								</div>
								<div class="item">
									<img alt="" src="{{ asset('user/xhtml/images/category/Landing-Page.jpg') }}">
								</div>
							</div>
							<div class="post-slide-info">
								<h2 class="post-title">APLIKASI MANAJEMEN KEUANGAN AL-URWATUL WUTSQO</h2>
								<p>Aplikasi untuk membantu pihak pengelola untuk me-manajemen keuangan sekolah</p>
								<div class="date">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Slider Banner -->
		<div class="content-block">
            <!-- About Us -->
            <div class="section-full bg-white content-inner-1">
                <div class="container">
                    <div class="row">
						<div class="col-lg-3 col-md-6 col-sm-6 col-6">
							<div class="category-box overlay m-b30">
								<div class="category-media">
									<img src="{{ asset('user/xhtml/images/category/ponpes.jpg') }}" alt=""/>
								</div>
								<div class="category-info">
									<a href="javascript:void(0);" class="category-title">Pondok Pesantren</a>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 col-6">
							<div class="category-box overlay m-b30">
								<div class="category-media">
									<img src="{{ asset('user/xhtml/images/category/ponpes2.jpg') }}" alt=""/>
								</div>
								<div class="category-info">
									<a href="javascript:void(0);" class="category-title">Asrama</a>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 col-6">
							<div class="category-box overlay m-b30">
								<div class="category-media">
									<img src="{{ asset('user/xhtml/images/category/ponpes3.jpg') }}" alt=""/>
								</div>
								<div class="category-info">
									<a href="javascript:void(0);" class="category-title">Pendidik</a>
								</div>
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6 col-6">
							<div class="category-box overlay m-b30">
								<div class="category-media">
									<img src="{{ asset('user/xhtml/images/category/ponpes4.jpg') }}" alt=""/>
								</div>
								<div class="category-info">
									<a href="javascript:void(0);" class="category-title">Santri</a>
								</div>
							</div>
						</div>
					</div>
				</div>
            </div>
		<!--about us-->
		<div class="content-block">
            <!-- About Us -->
            <div class="section-full bg-white content-inner-2 about-us">
                <div class="min-container">
					<div class="row">
						<div class="col-md-12">
							<h4>Pondok Pesantren Al-Urwatul Wutsqo, Pondok pesantren ini berdiri di bawah Yayasan Pendidikan Islam (YPI).</h4>
							<div class="dlab-divider divider-2px bg-gray-dark"><i class="icon-dot c-square"></i><div></div></div>
							<p class="first-content">Sejak awal berdiri, pesantren ini beralamat di Jl.Sempurna No.32 RT/RW 04/02 Desa Terusan, Sindang, Indramayu. Pondok pesantren ini didirikan oleh KH.Drs.Muhammad Yunus Rasyidi beserta majelis ta'lim yang di naunginya. Pondok pesantren ini adalah pondok pesantren modern yang ber-madzhab salafi, mengembangkan pola Tarbiyah Islamiyah, Fikriyah, dan Jasadiyah. pondok peantren ini memiliki tujuan khusus agar pondok pesantren ini menciptakan lulusan yang berakhlak mulia, beraqidah yang lurus, berwawasan luas, serta istiqomah di jalan Allah.</p>
							<p>Santri Ikhwan maupun santriwati diwajibkan untuk dapat membaca kitab Al-Quran dengan lancar, Mahir berbahasa Arab dan Inggris, dapat berdakwah sesuai dengan acaran islam . diharapkan dengan adanya pondok pesantren ini yang memiliki lokasi dekat dengan warga maka dapat saling membantu serta bergotong royong dengan segala aspek.</p>
							<div class="text-center">
								<ul class="list-inline m-b0">
									<li><a href="javascript:void(0);" class="btn-link black"><i class="fa fa-facebook"></i></a></li>
									<li><a href="javascript:void(0);" class="btn-link black"><i class="fa fa-google-plus"></i></a></li>
									<li><a href="javascript:void(0);" class="btn-link black"><i class="fa fa-instagram"></i></a></li>
									<li><a href="javascript:void(0);" class="btn-link black"><i class="fa fa-twitter"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
            </div>
			<!-- About Us End -->
        </div>
        </div>
		<!-- contact area END -->
    </div>
    <!-- Content END-->
	<!-- Footer -->
    <footer class="site-footer">
        <div class="footer-top">
            <div class="container">
				<div class="row">
					<div class="col-12">
						<h4 class="footer-title text-center"><span>Trending Stories</span></h4>
					</div>
					<div class="col-12">
						<div class="trending-stories owl-loaded owl-theme owl-carousel owl-btn-center-lr owl-btn-2">
							<div class="item">
								<div class="blog-card blog-grid no-gap">
									<div class="blog-card-media">
										<img src="images/blog/grid/pic1.jpg" alt=""/>
									</div>
									<div class="blog-card-info">
										<h4 class="title"><a href="post-slide-show.html">New York with Sezane</a></h4>
										<div class="date">
											03 <span></span> 2020
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="blog-card blog-grid no-gap">
									<div class="blog-card-media">
										<img src="images/blog/grid/pic2.jpg" alt=""/>
									</div>
									<div class="blog-card-info">
										<h4 class="title"><a href="post-with-small-side-image.html">Perfect Travel Essentials</a></h4>
										<div class="date">
											14 <span></span> 2020
										</div>
									</div>
								</div>
							</div>
							<div class="item">
								<div class="blog-card blog-grid no-gap">
									<div class="blog-card-media">
										<img src="images/blog/grid/pic3.jpg" alt=""/>
									</div>
									<div class="blog-card-info">
										<h4 class="title"><a href="post-gallery.html">The Perfect Sweatshirt</a></h4>
										<div class="date">
											22 <span></span> 2020
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="footer-bottom">
							<div class="footer-copy">
								<span>©2020. All Rights Reserved.</span>
							</div>
							<div class="footer-logo">
								<a href="index.html"><img src="images/logo.png" alt=""/></a>
							</div>
							<div class="footer-social">
								<ul>
									<li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
									<li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
									<li><a href="javascript:void(0);"><i class="fa fa-pinterest-p"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
    </footer>
    <!-- Footer END-->
    <button class="scroltop fa fa-chevron-up" ></button>
</div>
<!-- JAVASCRIPT FILES ========================================= -->
<script src="../../../user/xhtml/js/jquery.min.js"></script><!-- JQUERY.MIN JS -->
<script src="../../../user/xhtml/plugins/bootstrap/js/popper.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="../../../user/xhtml/plugins/bootstrap/js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="../../../user/xhtml/plugins/bootstrap-select/bootstrap-select.min.js"></script><!-- FORM JS -->
<script src="../../../user/xhtml/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script><!-- FORM JS -->
<script src="../../../user/xhtml/plugins/magnific-popup/magnific-popup.js"></script><!-- MAGNIFIC POPUP JS -->
<script src="../../../user/xhtml/plugins/counter/waypoints-min.js"></script><!-- WAYPOINTS JS -->
<script src="../../../user/xhtml/plugins/counter/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="../../../user/xhtml/plugins/imagesloaded/imagesloaded.js"></script><!-- IMAGESLOADED -->
<script src="../../../user/xhtml/plugins/masonry/masonry-3.1.4.js"></script><!-- MASONRY -->
<script src="../../../user/xhtml/plugins/masonry/masonry.filter.js"></script><!-- MASONRY -->
<script src="../../../user/xhtml/plugins/owl-carousel/owl.carousel.js"></script><!-- OWL SLIDER -->
<script src="../../../user/xhtml/js/custom.js"></script><!-- CUSTOM FUCTIONS  -->
<script src="../../../user/xhtml/js/dz.carousel.js"></script><!-- SORTCODE FUCTIONS -->
<script src="../../../user/xhtml/js/dz.ajax.js"></script><!-- CONTACT JS  -->
</body>
</html>
