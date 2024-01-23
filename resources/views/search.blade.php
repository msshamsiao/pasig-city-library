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

      <a href="index.html" class="logo d-flex align-items-center">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="{{ asset('Pasig_Logo.png') }}" alt="Pasig Logo" width="50" height="80">
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
          <div class="col-12 text-center mb-5">
            <div class="row justify-content-center">
              <div class="col-lg-6">
                <h2 class="display-4">Search</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nihil sint sed, fugit distinctio ad eius itaque deserunt doloribus harum excepturi laudantium sit officiis et eaque blanditiis. Dolore natus excepturi recusandae.</p>
              </div>
            </div>
          </div>
        </div>
        <form action="{{ route('search') }}" method="get">
            <div class="row">
                  {{-- @if(isset($NotFoundBook) && $NotFoundBook)
                      <div class="alert alert-warning" role="alert">
                          Book does not belong to the specified member library. Try another member library.
                      </div>
                  @endif --}}

                  @if(isset($BookNotAvailable) && $BookNotAvailable)
                      <div class="alert alert-warning" role="alert">
                        Book is not available for borrowing.
                      </div>
                  @endif

                  @if(isset($BookNotFound) && $BookNotFound)
                      <div class="alert alert-warning" role="alert">
                        Book not found.
                      </div>
                  @endif

                  @if(isset($MaxBookAllowed) && $MaxBookAllowed)
                      <div class="alert alert-warning" role="alert">
                        User has already borrowed the maximum allowed number of books.
                      </div>
                  @endif

                  @if(isset($SuccessBorrow) && $SuccessBorrow)
                      <div class="alert alert-success" role="alert">
                        Book borrowing request submitted. Awaiting librarian approval.
                      </div>
                  @endif
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="category">Filter by Member Library:</label>
                        <select class="form-control" name="school" id="school">
                            <option value="">All Member Library</option>
                            <option value="PLP">Pamantasan ng Lungsod ng Pasig</option>
                            <option value="RHS">Rizal High School</option>
                            <option value="PCSHS">Pasig City Science High School</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="category">Filter by Category:</label>
                        <select class="form-control" name="category" id="category">
                            <option value="">All Categories</option>
                            <option value="title">Title</option>
                            <option value="author">Author</option>
                            <option value="subject">Subject</option>
                            <option value="isbn">ISBN</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8">
                    <label for="query">Search for a Book:</label>
                    <div class="input-group mb-3">
                        <input type="text" name="query" class="form-control" placeholder="Search products">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @if(isset($books) && count($books) > 0 && $searchTerm)
            <h2>Search Results for "{{ $searchTerm }}"</h2>
        
            <div class="row">
                @foreach($books as $book)
                    <div class="card">
                        <h5 class="card-header h5">Title: {{ $book->title }}</h5>
                        <div class="card-body">
                          <h5 class="card-title">Author: {{ $book->author }}</h5>
                          <p class="card-text">Subject: {{ $book->subject }}.</p>
                          <p class="card-text">ISBN: {{ $book->isbn }}</p>
                          <p class="card-text">ISSN: {{ $book->issn }}</p>
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#borrowModal" data-bookid="{{ $book->id }}">
                            Borrow Book
                        </button>
                        </div>
                      </div>
                @endforeach
            </div>
        @elseif(isset($books) && count($books) == 0 && $searchTerm)
            <p>No results found for "{{ $searchTerm }}"</p>
        @endif
    
        <!-- Add this at the beginning of your view file -->
        <div class="modal fade" id="borrowModal" tabindex="-1" aria-labelledby="borrowModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal content goes here -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="borrowModalLabel">Reserve Book</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @include('partials.borrow-form') <!-- Include the borrow form partial --><br/>
                        <p id="newUserMessage" class="text-muted">Don't have an account? You will be registered when submitting the borrow request.</p>
                    </div>
                </div>
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
          <div class="col-lg-12">
            <h3 class="footer-heading">About Pasig City Library</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam ab, perspiciatis beatae autem deleniti voluptate nulla a dolores, exercitationem eveniet libero laudantium recusandae officiis qui aliquid blanditiis omnis quae. Explicabo?</p>
            <p><a href="about.html" class="footer-link-more">Learn More</a></p>
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

  <script>
    $(document).ready(function() {
        // Update form action when modal is shown
        $('#borrowModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var bookId = button.data('bookid');
            var form = $('#borrowForm');
            var action = form.attr('action');
            form.attr('action', action + '/' + bookId);
        });
    });
</script>

</body>

</html>