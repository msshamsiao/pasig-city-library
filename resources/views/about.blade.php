<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pasig City Library</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/new-favicon.ico" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500&family=Inter:wght@400;500&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">  


  <!-- Template Main CSS Files -->
  <link href="assets/css/variables.css" rel="stylesheet">
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: ZenBlog
  * Updated: Jan 09 2024 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/zenblog-bootstrap-blog-template/
  * Author: BootstrapMade.com
  * License: https:///bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="home.html" class="logo d-flex align-items-center">
        <img src="{{ asset('assets/Pasig_Logo.png') }}" alt="Pasig Logo" width="50" height="80">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="home.html">Home</a></li>
          <li><a href="search.html">Search</a></li>
          <li><a href="member_libraries.html">Member Libraries</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="contact_us.html">Contact</a></li>
        </ul>
      </nav><!-- .navbar -->

      <div class="position-relative">
        <a href="#" class="mx-2"><span class="bi-facebook"></span></a>
        <a href="#" class="mx-2"><span class="bi-twitter"></span></a>
        <a href="#" class="mx-2"><span class="bi-instagram"></span></a>

        <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
        <i class="bi bi-list mobile-nav-toggle"></i>

        <!-- ======= Search Form ======= -->
        <div class="search-form-wrap js-search-form-wrap">
          <form action="search-result.html" class="search-form">
            <span class="icon bi-search"></span>
            <input type="text" placeholder="Search" class="form-control">
            <button class="btn js-search-close"><span class="bi-x"></span></button>
          </form>
        </div><!-- End Search Form -->

      </div>

    </div>

  </header><!-- End Header -->

  <main id="main">
    <section>
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-lg-12 text-center mb-5">
            <h1 class="page-title">About us</h1>
          </div>
        </div>

        <div class="row mb-5">

          <div class="d-md-flex post-entry-2 half">
            <a href="#" class="me-4 thumbnail">
              <img src="assets/img/images3.jpg" alt="" class="img-fluid">
            </a>
            <div class="ps-md-5 mt-4 mt-md-0">
              <div class="post-meta mt-4">About us</div>
              <h2 class="mb-4 display-4">Pasig City Library Consortium</h2>
              <p style="text-align: justify;">Welcome to the Pasig City Library Consortium (PCLC), a collaborative network of libraries. It promotes literacy, education, and community engagement in Pasig City. Through our combined efforts, we strive to provide access to a wide range of resources, including books, digital media, and educational programs, to enrich the lives of our residents. The Consortium serves as a hub for learning and knowledge-sharing, fostering a vibrant and inclusive community of lifelong learners. Join us in exploring the world of information and ideas as we work together to build a brighter future for Pasig City.</p>
            </div>
          </div>

          <div class="d-md-flex post-entry-2 half mt-5">
            <a href="#" class="me-4 thumbnail order-2">
              <img src="assets/img/images1.png" alt="" class="img-fluid">
            </a>
            <div class="pe-md-5 mt-4 mt-md-0">
              <div class="post-meta mt-4">Mission &amp; Vision</div>
              <h2 class="mb-4 display-4">Mission &amp; Vision</h2>

              <p style="text-align: justify;">To empower individuals through access to diverse resources, knowledge, and learning opportunities, fostering a culture of literacy, lifelong learning, and community engagement in Pasig City.</p>
              <p style="text-align: justify;">The Pasig City Library Consortium envisions a vibrant and inclusive community where every resident can access quality educational resources, innovative programs, and collaborative spaces that inspire curiosity, creativity, and continuous personal and professional growth. Through our efforts, we aim to cultivate a society of informed and empowered individuals who contribute to the progress and development of Pasig City.</p>
            </div>
          </div>

        </div>

      </div>
    </section>

    <section>
      <div class="container" data-aos="fade-up">
        <div class="row">
          <div class="col-12 text-center mb-5">
            <div class="row justify-content-center">
              <div class="col-lg-6">
                <h2 class="display-4">Our Team</h2>
              </div>
            </div>
          </div>
          <div class="col-lg-4 text-center mb-5">
            <img src="assets/img/RAC.jpeg" alt="" class="img-fluid rounded-circle w-50 mb-4">
            <h4>Racquel A. Cortez</h4>
            <span class="d-block mb-3 text-uppercase">Project Manager</span>
          </div>

          <div class="col-lg-4 text-center mb-5">
            <img src="assets/img/SAM.jpeg" alt="" class="img-fluid rounded-circle w-50 mb-4">
            <h4>Samantha Siao</h4>
            <span class="d-block mb-3 text-uppercase">Software Engineer</span>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">
        <div class="row g-5">
          <div class="row g-5">
            <div class="col-lg-12">
              <h3 class="footer-heading">About Pasig City Library</h3>
              <p>A collaborative network of libraries. It promotes literacy, education, and community engagement in Pasig City. Through our combined efforts, we strive to provide access to a wide range of resources, including books, digital media, and educational programs, to enrich the lives of our residents. The Consortium serves as a hub for learning and knowledge-sharing, fostering a vibrant and inclusive community of lifelong learners. Join us in exploring the world of information and ideas as we work together to build a brighter future for Pasig City.</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-legal">
      <div class="container">

        <div class="row justify-content-between">
          <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
            <div class="copyright">
              © Copyright <strong><span>Pasig City Library</span></strong>. All Rights Reserved
            </div>

          </div>

          <div class="col-md-6">
            <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bi bi-skype"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>

          </div>

        </div>

      </div>
    </div>

  </footer>

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>