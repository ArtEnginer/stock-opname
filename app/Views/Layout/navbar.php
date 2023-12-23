<?php

use Illuminate\Support\Facades\Route;
?>
<div class="container-fluid sticky-top px-0">
    <div class="container-fluid topbar d-none d-lg-block">
        <div class="container px-0">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="d-flex flex-wrap">
                        <a href="#" class="me-4 text-light"><i class="fas fa-map-marker-alt text-primary me-2"></i>Find A Location</a>
                        <a href="#" class="me-4 text-light"><i class="fas fa-phone-alt text-primary me-2"></i>+01234567890</a>
                        <a href="#" class="text-light"><i class="fas fa-envelope text-primary me-2"></i>Example@gmail.com</a>
                    </div>

                </div>
                <div class="col-lg-4">
                    <div class="d-flex align-items-center justify-content-end">
                        <a href="#" class="me-3 btn-square border rounded-circle nav-fill"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-3 btn-square border rounded-circle nav-fill"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-3 btn-square border rounded-circle nav-fill"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="btn-square border rounded-circle nav-fill"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-light">
        <div class="container px-0">
            <nav class="navbar navbar-light navbar-expand-xl">
                <a href="index.html" class="navbar-brand">
                    <h2 class="text-primary display-8">ASS TOSERBA BMY</h2>
                </a>
                <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="fa fa-bars text-primary"></span>
                </button>
                <div class="collapse navbar-collapse bg-light py-3" id="navbarCollapse">
                    <div class="navbar-nav mx-auto border-top">
                        <a href="<?= base_url() ?>" class="nav-item nav-link active">Home</a>
                        <a href="<?= base_url() . 'item' ?>" class="nav-item nav-link">Data Barang</a>
                    </div>
                    <div class="d-flex align-items-center flex-nowrap pt-xl-0">
                        <button class="btn-search btn btn-primary btn-primary-outline-0 rounded-circle btn-lg-square" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i></button>
                        <a href="#!" class="btn btn-primary btn-primary-outline-0 rounded-pill py-3 px-4 ms-4">CEK BARANG</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>