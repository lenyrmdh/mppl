<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Index - Strategy Bootstrap Template</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('front/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('front/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('front/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('front/assets/css/main.css') }}" rel="stylesheet">

<header id="header" class="header d-flex align-items-center fixed-top shadow-sm" style="background-color: #ffffff;">
  <div class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <!-- Logo -->
    <a href="#hero" class="logo d-flex align-items-center me-auto me-xl-0 text-decoration-none">
      <h1 class="sitename text-primary mb-0">PT.DigitalEdu</h1>
    </a>

    <!-- Menu Navigasi -->
    <nav id="navmenu" class="navmenu d-none d-lg-block">
      <ul class="d-flex gap-4 list-unstyled mb-0 align-items-center">
        <li><a href="#hero" class="nav-link scrollto active">Home</a></li>
        <li><a href="#direktur" class="nav-link scrollto">Profile</a></li>
        <li><a href="#about" class="nav-link scrollto">About</a></li>
        <li><a href="#produk" class="nav-link scrollto">Kata Mereka</a></li>
       
      </ul>
    </nav>

    <!-- Tombol Login -->
    <a class="btn btn-primary px-4 py-2 rounded-5" href="{{ route('filament.admin.auth.login') }}">Login</a>
  </div>
</header>


  {{ $slot }}

  <footer id="footer" class="footer">

   <footer class="pt-5 pb-4" style="background-color: #ffffff; color: #333;">
  <div class="container">
    <div class="row gy-4">
      
      <!-- Visi & Misi -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <h5 class="fw-bold mb-3 text-primary">Visi & Misi</h5>
        <p class="text-muted">
          Menjadi pelopor sistem informasi kepegawaian digital yang transparan, efisien, dan terpercaya di Indonesia.
        </p>
        <ul class="text-muted small ps-3">
          <li>Menyediakan akses data pegawai yang cepat dan akurat</li>
          <li>Mempermudah monitoring & pelaporan</li>
          <li>Mendukung transformasi digital SDM</li>
        </ul>
      </div>

      <!-- Fitur Unggulan -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <h6 class="fw-semibold mb-3 text-primary">Fitur Unggulan</h6>
        <ul class="list-unstyled small text-muted">
          <li>📊 Rekap Data Otomatis</li>
          <li>📁 Ekspor Excel & PDF</li>
          <li>🔍 Filter dan Pencarian Cepat</li>
          <li>⏱️ Monitoring Cuti & Lembur</li>
          <li>📱 Akses Multi Perangkat</li>
        </ul>
      </div>

      <!-- Kontak Kami -->
      <div class="col-lg-4 col-md-12" data-aos="fade-up" data-aos-delay="300">
        <h6 class="fw-semibold mb-3 text-primary">Kontak Kami</h6>
        <ul class="list-unstyled text-muted small">
          <li><strong>Nama Perusahaan:</strong> PT. DigitalEdu</li>
          <li><strong>Alamat:</strong> Tangerang, Indonesia</li>
          <li><strong>Telepon:</strong> +62 8821 4199 726</li>
          <li><strong>Email:</strong> digitaledu@gmail.com</li>
          <li><strong>Jam Operasional:</strong> Senin - Jumat, 09.00 - 17.00</li>
        </ul>
      </div>
    </div>

   
    <hr class="mt-5" style="border-color: #e0e0e0;" />

     <div class="container copyright text-center mt-4">
      <p>© <span>Pt.DigitalEdu</span> 
      <div class="credits">
        Designed by <a href="https://bootstrapmade.com/">Kelompok 9 </a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('front/assets/js/main.js') }}"></script>