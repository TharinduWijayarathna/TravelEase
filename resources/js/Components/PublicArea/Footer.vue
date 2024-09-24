<template>
    <!-- =======================
Footer START -->
    <footer class="bg-dark pt-6 position-relative" data-bs-theme="dark">
        <div class="container position-relative mt-5">

            <!-- Widgets -->
            <div class="row g-4 justify-content-between">
                <!-- Widget 1 START -->
                <div class="col-lg-5">
                    <!-- logo -->
                    <a href="index.html">
                        <img class="light-mode-item h-40px" src="/assets/PublicArea/images/logo.svg" alt="logo" />
                        <img class="dark-mode-item h-40px" src="/assets/PublicArea/images/logo-light.svg" alt="logo" />
                    </a>

                    <p class="mt-4 mb-2">
                        Simplify your online bus ticketing experience with us.
                    </p>
                    <!-- Social icon -->
                    <ul class="list-inline mb-0 mt-4">
                        <li class="list-inline-item">
                            <a class="btn btn-xs btn-icon btn-light" href="#"><i
                                    class="fab fa-fw fa-facebook-f lh-base"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-xs btn-icon btn-light" href="#"><i
                                    class="fab fa-fw fa-instagram lh-base"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-xs btn-icon btn-light" href="#"><i
                                    class="fab fa-fw fa-twitter lh-base"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-xs btn-icon btn-light" href="#"><i
                                    class="fab fa-fw fa-linkedin-in lh-base"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-xs btn-icon btn-light" href="#"><i
                                    class="fab fa-fw fa-youtube lh-base"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- Widget 1 END -->

                <!-- Widget 2 START -->
                <div class="col-lg-6 col-xxl-4">
                    <div class="row g-4">
                        <!-- Link block -->
                        <div class="col-6">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <Link class="nav-link pt-0" :href="route('home')">Home</Link>
                                </li>
                                <li class="nav-item">
                                    <Link class="nav-link" :href="route('buses.index')">Products</Link>
                                </li>
                                <li class="nav-item">
                                    <Link class="nav-link" :href="route('categories')">Categories
                                    <span class="badge text-bg-danger ms-2">2 New</span></Link>
                                </li>
                                <li class="nav-item">
                                    <Link class="nav-link" :href="route('contact')">Contact</Link>
                                </li>
                            </ul>
                        </div>

                        <!-- Link block -->
                        <div class="col-6">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <Link class="nav-link pt-0" :href="route('customer.index')">Profile</Link>
                                </li>
                                <li class="nav-item">
                                    <Link class="nav-link pt-0" :href="route('cart.index')">Cart</Link>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Supports
                                        <i class="bi bi-box-arrow-up-right small ms-1"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Widget 2 END -->
            </div>

            <!-- Divider -->
            <hr class="mt-4 mb-0" />

            <!-- Bottom footer -->
            <div class="d-md-flex justify-content-between align-items-center text-center text-lg-start py-4">
                <!-- copyright text -->
                <div class="text-body">
                    Copyrights ©2024 TravelEase
                </div>
                <!-- copyright links-->
                <div class="nav mt-2 mt-lg-0">
                    <ul class="list-inline mx-auto mb-0">
                        <li class="list-inline-item me-0">
                            <a class="nav-link py-0" href="#" data-bs-toggle="modal"
                                data-bs-target="#privacyPolicyModal">
                                Privacy Policy </a>
                        </li>
                        <li class="list-inline-item me-0">
                            <a class="nav-link py-0 pe-0" href="#" data-bs-toggle="modal"
                                data-bs-target="#termsConditionsModal">
                                Terms &amp; Conditions </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal fade" id="privacyPolicyModal" tabindex="-1" aria-labelledby="privacyPolicyModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="privacyPolicyModalLabel">
                        Privacy Policy
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Quisquam, voluptate, voluptatem, voluptatum, voluptates
                        quae quia quidem quibusdam autem. Quisquam, voluptate,
                        voluptatem, voluptatum, voluptates quae quia quidem
                        quibusdam autem.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Quisquam, voluptate, voluptatem, voluptatum, voluptates
                        quae quia quidem quibusdam autem. Quisquam, voluptate,
                        voluptatem, voluptatum, voluptates quae quia quidem
                        quibusdam autem.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="termsConditionsModal" tabindex="-1" aria-labelledby="termsConditionsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="termsConditionsModalLabel">
                        Terms &amp; Conditions
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Quisquam, voluptate, voluptatem, voluptatum, voluptates
                        quae quia quidem quibusdam autem. Quisquam, voluptate,
                        voluptatem, voluptatum, voluptates quae quia quidem
                        quibusdam autem.
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Quisquam, voluptate, voluptatem, voluptatum, voluptates
                        quae quia quidem quibusdam autem. Quisquam, voluptate,
                        voluptatem, voluptatum, voluptates quae quia quidem
                        quibusdam autem.
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>


    <!-- Back to top -->
    <div class="back-top"></div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
</script>
