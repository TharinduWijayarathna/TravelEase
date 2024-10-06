<template>
    <!-- =======================
Footer START -->
    <footer class="bg-dark position-relative" data-bs-theme="dark">
        <div class="container position-relative">


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
