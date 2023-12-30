<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>STOCK OPNAME</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=PT+Serif:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() . '/assets/lib/animate/animate.min.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . '/assets/lib/lightbox/css/lightbox.min.css' ?>" rel="stylesheet">
    <link href="<?= base_url() . '/assets/lib/owlcarouselassets/owl.carousel.min.css' ?>" rel="stylesheet">
    <script type="text/javascript" src="<?= base_url() . '/assets/lib/jquery-3.6.4.min.js' ?>"></script>
    <link rel="stylesheet" href="<?= base_url() . '/assets/lib/bootstrap.min.css' ?>">
    <link rel="stylesheet" href="<?= base_url() . '/assets/lib/dataTables.bootstrap5.min.css' ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url() . '/assets/css/bootstrap.min.css' ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url() . '/assets/css/style.css' ?>" rel="stylesheet">
</head>
</head>

<body>

    <!-- Spinner Start -->
    <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar start -->
    <?php include('navbar.php') ?>
    <!-- Navbar End -->


    <!-- Modal Search Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h4 class="modal-title mb-0" id="exampleModalLabel">Search by keyword</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Search End -->

    <!-- rendersection -->
    <?php $this->renderSection('main') ?>

    <!-- Carousel Start -->


    <!-- Footer Start -->
    <div class="container-fluid footer py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item">
                        <h4 class="mb-4 text-white">Newsletter</h4>
                        <p class="text-white">Dolor amet sit justo amet elitr clita ipsum elitr est.Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in tempor dui, non consectetur enim.</p>
                        <div class="position-relative mx-auto rounded-pill">
                            <input class="form-control rounded-pill border-0 w-100 py-3 ps-4 pe-5" type="text" placeholder="Enter your email">
                            <button type="button" class="btn btn-primary btn-primary-outline-0 rounded-pill position-absolute top-0 end-0 py-2 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">
                            Services
                        </h4>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Fassion</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Supermarket</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Houseware</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Aksesoris </a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Mr.Game</a>

                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Schedule</h4>
                        <p class="mb-0"><i class="fas fa-clock text-secondary me-2"></i> Monday - Friday: 09.00am to 05.00pm</p>
                        <h4 class="my-4 text-white">Address</h4>
                        <p class="mb-0"><i class="fas fa-map-marker-alt text-secondary me-2"></i> 123 ranking street North tower New York, USA</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item d-flex flex-column">
                        <h4 class="mb-4 text-white">Follow Us</h4>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Faceboock</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Instagram</a>
                        <a href=""><i class="fas fa-angle-right me-2"></i> Twitter</a>
                        <h4 class="my-4 text-white">Contact Us</h4>
                        <p class="mb-0"><i class="fas fa-envelope text-secondary me-2"></i> info@example.com</p>
                        <p class="mb-0"><i class="fas fa-phone text-secondary me-2"></i> (+012) 3456 7890 123</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->



    <!-- Copyright Start -->
    <div class="container-fluid copyright py-4">
        <div class="container">
            <div class="row g-4 align-items-center">
                <div class="col-md-4 text-center text-md-start mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-center">
                        <a href="" class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-2"><i class="fab fa-facebook-f"></i></a>
                        <a href="" class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-2"><i class="fab fa-twitter"></i></a>
                        <a href="" class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-2"><i class="fab fa-instagram"></i></a>
                        <a href="" class="btn btn-light btn-light-outline-0 btn-sm-square rounded-circle me-0"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-4 text-center text-md-end text-white">

                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() . '/assets/lib/wow/wow.min.js' ?>"></script>
    <script src="<?= base_url() . ' /assets/lib/easing/easing.min.js' ?>"></script>
    <script src="<?= base_url() . '/assets/lib/waypoints/waypoints.min.js' ?>"></script>
    <script src="<?= base_url() . ' /assets/lib/counterup/counterup.min.js' ?>"></script>
    <script src="<?= base_url() . '/assets/lib/lightbox/js/lightbox.min.js' ?>"></script>
    <script src="<?= base_url() . ' /assets/lib/owlcarousel/owl.carousel.min.js' ?>"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url() . '/assets/js/main.js' ?>"></script>
    <script src="<?= base_url() . '/assets/js/app.js' ?>"></script>
</body>

</html>