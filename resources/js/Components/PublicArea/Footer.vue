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
                        Travel Ease is committed to protecting your privacy. This Privacy Policy explains our data processing practices and your options regarding the ways in which your personal data is used. If you have any requests concerning your personal information or any queries with regard to our processing, please contact us at
                    </p>
                    <p>
                        Travel Ease collects the details provided by you on registration together with information we learn about you from your use of our service and your visits to our web site and other sites accessible from them. We also collect information about the transactions you undertake including details of payment cards used.
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
                    Travel Ease has been designed to provide a platform for users to book and manage their travel plans. The platform is designed to provide a seamless experience for users to book flights, hotels, and car rentals. The platform is designed to provide a seamless experience for users to book flights, hotels, and car rentals. The platform is designed to provide a seamless experience for users to book flights, hotels, and car rentals. The platform is designed to provide a seamless experience for users to book flights, hotels, and car rentals. The platform is designed to provide a seamless experience for users to book flights, hotels, and car rentals. The platform is designed to provide a seamless experience for users to book flights, hotels, and car rentals. The platform is designed to provide a seamless experience for users to book flights, hotels, and car rentals. The platform is designed to provide a seamless experience for users to book flights, hotels, and car rentals.
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
