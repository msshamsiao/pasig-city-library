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
                  @if(isset($NotFoundBook) && $NotFoundBook)
                      <div class="alert alert-warning" role="alert">
                          Book does not belong to the specified member library. Try another member library.
                      </div>
                  @endif

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

                  @if (isset($SuccessReserve) && $SuccessReserve)
                    <div class="alert alert-warning" role="alert">
                      Book reserved successfully.
                    </div>
                  @endif

                  @if (isset($SuccessBorrow) && $SuccessBorrow)
                    <div class="alert alert-warning" role="alert">
                        Book borrowed successfully.
                    </div>
                  @endif

                  @if (session()->has('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @endif

                  @if ($errors->any())
                      <div class="alert alert-danger" role="alert">
                          @foreach ($errors->all() as $error)
                              {{ $error }}
                          @endforeach
                      </div>
                  @endif

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="category">Filter by Member Library:</label>
                        <select class="form-control" name="member_library" id="member_library">
                          <option value="">All Member Libraries</option>
                          @php
                              $memberLibraries = \App\Models\MemberLibrary::get();
                          @endphp
                            @foreach($memberLibraries as $memberLibrary)
                                <option value="{{ $memberLibrary->id }}">{{ $memberLibrary->name }}</option>
                            @endforeach
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
            <h5>Search Results for "{{ $searchTerm }}"</h5>

            <div class="row">
                @foreach($books as $book)
                    <div class="card">
                        <h5 class="card-header">Title: {{ $book->title }}</h5>
                        <div class="card-body">
                          <h5 class="card-title">Author: {{ $book->author }}</h5>
                          <p class="card-text">Subject: {{ $book->subject }}.</p>
                          <p class="card-text">ISBN: {{ $book->isbn }}</p>
                          <p class="card-text">ISSN: {{ $book->issn }}</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#borrowModal" data-bookid="{{ $book->id }}">
                              Reserve Book
                            </button>
                        </div>
                    </div>
                @endforeach

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
                            <form id="borrowForm" action="{{ route('reserve', ['bookId' => $book->id]) }}" method="post">
                                  @csrf
                                  <input type="hidden" name="book_id" value="{{ $book->id ?? null }}">
                                  <!-- Other form fields go here -->
                                  <div class="mb-3">
                                      <label for="user_name" class="form-label">Your Name</label>
                                      <input type="text" class="form-control" id="user_name" name="user_name" required>
                                  </div>
                                  <div class="mb-3">
                                      <label for="user_email" class="form-label">Your Email</label>
                                      <input type="email" class="form-control" id="user_email" name="user_email" required>
                                  </div>
                                  <div class="mb-3 row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="user_email" class="form-label">Please choose date</label>
                                        <input type="date" class="form-control" id="date" name="date" required>
                                      </div>
                                    </div>
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label for="user_email" class="form-label">Please choose time session</label>
                                        <select class="form-select" id="ampm_select" name="ampm_select" required>
                                          <option value="AM">AM</option>
                                          <option value="PM">PM</option>
                                      </select>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="mb-3">
                                      <label for="school" class="form-label">Member Library</label>
                                      <select class="form-control" name="member_library" id="member_library" required>
                                          <option value="">All Member Libraries</option>
                                          @php
                                              $memberLibraries = \App\Models\MemberLibrary::get();
                                          @endphp
                                            @foreach($memberLibraries as $memberLibrary)
                                                <option value="{{ $memberLibrary->id }}">{{ $memberLibrary->name }}</option>
                                            @endforeach
                                      </select>
                                  </div>
                                  <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                              <br/>
                              <p id="newUserMessage" class="text-muted">Don't have an account? You will be registered when submitting the reserve request.</p>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        @elseif(isset($searchTerm))
            <p>{{ $searchTerm }}</p>
        @elseif(isset($message))
            <p>{{ $message }}</p>
        @endif


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
            <p>A collaborative network of libraries. It promotes literacy, education, and community engagement in Pasig City. Through our combined efforts, we strive to provide access to a wide range of resources, including books, digital media, and educational programs, to enrich the lives of our residents. The Consortium serves as a hub for learning and knowledge-sharing, fostering a vibrant and inclusive community of lifelong learners. Join us in exploring the world of information and ideas as we work together to build a brighter future for Pasig City.</p>
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

    // Get the time input element
    var timeInput = document.getElementById('time_session');

    // Add change event listener to the time input
    timeInput.addEventListener('change', function() {
        // Get the selected time value
        var selectedTime = this.value;

        // Extract the AM/PM value from the selected time
        var ampm = selectedTime.split(' ')[1];

        // Display the AM/PM value
        document.getElementById('ampm_display').textContent = ampm;
    });
</script>

</body>

</html>