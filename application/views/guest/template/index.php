<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <?= $header ?>
</head>

<body>

	<!-- Start Header Area -->
	<header id="header">
		<div class="container">
			<div class="row align-items-center justify-content-between d-flex">
				<div id="logo">
					<a href="index.php"><img src="img/logoTI.png" alt="" title="" /></a>
				</div>
				<nav id="nav-menu-container">
					<ul class="nav-menu">
						<li class="<?= $this->uri->segment(1) == 'home' ? 'menu-active' : '' ?>"><a href="<?=base_url ('home') ?>">Home</a></li>
						<li class="<?= $this->uri->segment(1) == 'adart' ? 'menu-active' : '' ?>"><a href="<?=base_url ('adart') ?>">AD/ART</a></li>
                        <li class="<?= $this->uri->segment(1) == 'struktur_organisasi' ? 'menu-active' : '' ?>"><a href="<?=base_url ('struktur_organisasi') ?>">Struktur Organisasi</a></li>
						<li class="menu-has-children <?= $this->uri->segment(2) == 'reservasi' || $this->uri->segment(2) == 'pembatalan' ? 'menu-active' : '' ?>"><a href="">Layanan</a>
							<ul>
								<li><a href="<?=base_url ('reservasi/reservasi') ?>">Reservasi</a></li>
								<li><a href="<?=base_url ('reservasi/pembatalan') ?>">Pembatalan</a></li>
							</ul>
						</li>
                        <li class="<?= $this->uri->segment(2) == 'penjadwalan' ? 'menu-active' : '' ?>"><a href="<?=base_url ('reservasi/penjadwalan') ?>">Penjadwalan</a></li>
						<?php if($this->session->userdata('is_logged_in') == true): ?>
							<li><a href="<?=base_url ('login') ?>"><?=$this->session->userdata('nama')?></a></li>
						<?php else: ?>	
							<li><a href="<?=base_url ('login') ?>">Login</a></li>
						<?php endif; ?>

					</ul>
				</nav><!-- #nav-menu-container -->
			</div>
		</div>
	</header>
	<!-- End Header Area -->


	<!-- Start Banner Area -->
	<section class="home-banner-area relative">
		<div class="container">
			<div class="row fullscreen d-flex align-items-center justify-content-center">
				<div class="banner-content col-lg-8 col-md-12">
                <br>
                <br>
                <br>
                <br>
                <br>
					<h1 class="wow fadeIn" data-wow-duration="4s">Sistem Informasi Reservasi Seni Pertunjukan Wayang <br> Paguyuban Bima Laras</h1>
					<p class="text-white">
						kosong
					</p>
                    
					<h4 class="text-white">Sekilas Info</h4>

					<div class="courses pt-15">
						<a href="#" data-wow-duration="1s" data-wow-delay=".3s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Januari</a>
						<a href="#" data-wow-duration="1s" data-wow-delay=".6s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Februari</a>
						<a href="#" data-wow-duration="1s" data-wow-delay=".9s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Maret</a>
						<a href="#" data-wow-duration="1s" data-wow-delay="1.2s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">April</a>
						<a href="#" data-wow-duration="1s" data-wow-delay="1.5s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Mei</a>
                        <a href="#" data-wow-duration="1s" data-wow-delay="1.5s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Juni</a>
                        <a href="#" data-wow-duration="1s" data-wow-delay="1.5s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Juli</a>
                        <a href="#" data-wow-duration="1s" data-wow-delay="1.5s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Agustus</a>
                        <a href="#" data-wow-duration="1s" data-wow-delay="1.5s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">September</a>
                        <a href="#" data-wow-duration="1s" data-wow-delay="1.5s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Oktober</a>
                        <a href="#" data-wow-duration="1s" data-wow-delay="1.5s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">November</a>
                        <a href="#" data-wow-duration="1s" data-wow-delay="1.5s" class="primary-btn transparent mr-10 mb-10 wow fadeInDown">Desember</a>
					</div>
				</div>
			</div>
		</div>
		<div class="rocket-img">
			<img src="img/rocket.png" alt="">
		</div>
	</section>
	<!-- End Banner Area -->


	<?= $content ?>

	<!-- Start Footer Area -->
	<footer class="footer-area section-gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 single-footer-widget">
					<h4>Alamat</h4>
					<ul>
						<li><a>Sekertariat</a></li>
						<li><a>Jl.Kemerdekaan Barat No. 631 RT 04 Rw 05</a></li>
						<li><a>Desa Kesugihan Kabupaten Cilacap</a></li>
						<li><a>(53274)</a></li>
					</ul>
				</div>
				
				<div class="col-lg-3 col-md-6 single-footer-widget">
					<h4>Kontak Kami</h4>
					<ul>
						<li><a>Hp 0812296824222</a></li>
						<li><a>Fax. (0282)537992</a></li>
						<li><a>Email : poltec@politeknikcilacap.ac.id</a></li>
					</ul>
				</div>
				<div class="col-lg-2 col-md-6 single-footer-widget">
					<h4>Kegiatan</h4>
					<ul>
						<li><a>Kegiatan Mahasiswa</a></li>
						<li><a>Kurikulum</a></li>
						<li><a>News</a></li>
						<li><a>Prestasi Mahasiswa</a></li>
					</ul>
				</div>
			</div>
			<div class="footer-bottom row align-items-center">
				<p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Paguyuban Seni Pertunjukan Wayang Bima Laras</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
				<div class="col-lg-4 col-md-12 footer-social">
					<a href="#"><i class="fa fa-facebook"></i></a>
					<a href="#"><i class="fa fa-twitter"></i></a>
					<a href="#"><i class="fa fa-dribbble"></i></a>
					<a href="#"><i class="fa fa-behance"></i></a>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer Area -->

	<!-- ####################### Start Scroll to Top Area ####################### -->
	<div id="back-top">
		<a title="Go to Top" href="#"></a>
	</div>
	<!-- ####################### End Scroll to Top Area ####################### -->

	<script src="<?= base_url ('assets/guest/') ?>js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
	 crossorigin="anonymous"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/vendor/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/easing.min.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/hoverIntent.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/superfish.min.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/jquery.ajaxchimp.min.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/jquery.magnific-popup.min.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/owl.carousel.min.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/owl-carousel-thumb.min.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/jquery.sticky.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/jquery.nice-select.min.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/parallax.min.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/waypoints.min.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/wow.min.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/jquery.counterup.min.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/mail-script.js"></script>
	<script src="<?= base_url ('assets/guest/') ?>js/main.js"></script>
	<script src="<?= base_url('assets/admin/assets/js/lodash.js') ?>"></script>
</body>

</html>