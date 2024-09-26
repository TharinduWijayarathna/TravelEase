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
                        A Bootstrap theme that's both stylish and functional,
                        perfect for any type of technology or corporate website.
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
                                    <Link class="nav-link" :href="route('products.index')">Buses</Link>
                                </li>
                                <li class="nav-item">
                                    <Link class="nav-link" :href="route('categories')">My Bookings
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
                                <!-- <li class="nav-item">
                                    <Link class="nav-link pt-0" :href="route('cart.index')">Cart</Link>
                                </li> -->
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
                    Copyrights ©2024 E-commerce.
                </div>
                <!-- copyright links-->
                <div class="nav mt-2 mt-lg-0">
                    <ul class="list-inline mx-auto mb-0">
                        <li class="list-inline-item me-0">
                            <a class="nav-link py-0 pe-0" href="#" @click="PrivacymModel">Privacy policy</a>
                        </li>
                        <li class="list-inline-item me-0">
                            <a class="nav-link py-0 pe-0" href="#" @click="TermsConditions">Terms &amp; conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Privacy policy Modal -->
        <div class="modal fade" id="PrivacyPolicy" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title " id="exampleModalLongTitle">Privacy policy</h5>
                    </div>
                    <div class="modal-body">
                        <p>Privacy Policy for [Your Website Name]</p>
                        <p>
                            Effective Date: [Date]
                        </p>
                        <p>At [Your Website Name] ("we," "us," "our"), we are committed to protecting your privacy. This
                            Privacy Policy explains how we collect, use, disclose, and safeguard your information when
                            you visit our website [Website URL] and use our ticket booking services (the "Service").
                            Please
                            read this privacy policy carefully. If you do not agree with the terms of this policy,
                            please do
                            not access or use our Service.
                        </p>

                        <h5>1. Information We Collect</h5>
                        <p>We collect the following types of information to provide and improve our services:</p>

                        <h6>a. Personal Information</h6>
                        <p>When you book tickets through our website, we may collect the following personal information:
                        </p>
                        <ul>
                            <li>Full Name</li>
                            <li>Email Address</li>
                            <li>Phone Number</li>
                            <li>Payment Information (e.g., credit card details)</li>
                            <li>Billing and Shipping Address</li>
                            <li>User Account Information (if you register for an account)</li>
                        </ul>

                        <h6>b. Non-Personal Information</h6>
                        <p>We may also collect non-personal information about your interaction with the website,
                            including:
                        </p>
                        <ul>
                            <li>Browser Type and Version</li>
                            <li>Device Information</li>
                            <li>IP Address</li>
                            <li>Cookies and Tracking Technologies</li>
                            <li>Usage Data (e.g., pages visited, actions taken on the site)</li>
                        </ul>

                        <h5>2. How We Use Your Information</h5>
                        <p>We use the information we collect for the following purposes:</p>

                        <ul>
                            <li>To process ticket bookings: Your personal and payment information is necessary for
                                completing and managing your ticket purchases.</li><br />
                            <li>To communicate with you: We may send booking confirmations, event updates, and customer
                                service responses via email or phone.</li><br />
                            <li>To improve our services: Usage data helps us understand how customers interact with our
                                website so we can enhance the user experience.</li><br />
                            <li>To send promotional offers: With your consent, we may send marketing emails about
                                upcoming events, promotions, or special offers.</li><br />
                            <li>For security purposes: We may use information to protect our website from fraud and
                                unauthorized access.</li>
                        </ul>

                        <h5>3. How We Share Your Information</h5>
                        <p>We may share your information in the following ways:</p>

                        <h6>a. Service Providers</h6>
                        <p>We may share your personal information with third-party service providers that assist us in
                            delivering our services, including payment processors, event organizers, and email marketing
                            services.</p>

                        <h6>b. Legal Obligations</h6>
                        <p>We may disclose your personal information when required by law, such as to comply with a
                            subpoena or similar legal process.</p>

                        <h6>c. Business Transfers</h6>
                        <p>In the event of a merger, acquisition, or sale of all or part of our business, your
                            information may be transferred as part of that transaction.</p>

                        <h5>4. Cookies and Tracking Technologies</h5>
                        <p>We use cookies and similar technologies to track user activity on our website. Cookies help
                            us remember your preferences, provide a customized experience, and analyze traffic patterns.
                            You can disable cookies in your browser settings, but doing so may limit the functionality
                            of our website.</p>

                        <h5>5. Security of Your Information</h5>
                        <p>We implement security measures to protect your personal information from unauthorized access,
                            use, or disclosure. However, no method of transmission over the Internet or method of
                            electronic storage is 100% secure, so we cannot guarantee absolute security.</p>

                        <h5>6. Your Data Protection Rights</h5>
                        <p>Depending on your location, you may have the following rights regarding your personal
                            information:</p>

                        <ul>
                            <li>Access: You can request a copy of the personal information we hold about you.</li><br />
                            <li>Correction: You can request that we correct any inaccuracies in your personal data.</li>
                            <br />
                            <li>Deletion: You can request that we delete your personal information.</li><br />
                            <li>Objection: You can object to certain data processing practices or opt-out of marketing
                                communications.</li>
                        </ul>
                        <p>If you would like to exercise any of these rights, please contact us at [email address].</p>

                        <h5>7. Third-Party Links</h5>
                        <p>Our website may contain links to third-party websites. We are not responsible for the privacy
                            practices or content of these external websites, so we recommend reviewing their privacy
                            policies.</p>

                        <h5>8. Changes to This Privacy Policy</h5>
                        <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page
                            with an updated "Effective Date." We encourage you to review this policy regularly to stay
                            informed about how we are protecting your information.</p>

                        <h5>9. Contact Us</h5>
                        <p>If you have any questions or concerns about this Privacy Policy, please contact us at:</p>

                        <ul>
                            <li>Email: [Your Email Address]</li><br />
                            <li>Phone: [Your Contact Number]</li><br />
                            <li>Mailing Address: [Your Mailing Address]</li>

                        </ul>

                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end-->

        <!-- Terms & conditions Modal -->
        <div class="modal fade" id="TermsConditions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Terms &amp; Conditions</h5>
                    </div>
                    <div class="modal-body">
                        <p>erms and Conditions for [Your Website Name]</p>
                        <p>
                            Effective Date: [Date]
                        </p>

                        <h5>1. Acceptance of Terms</h5>
                        <p>By using our website and purchasing tickets, you accept these Terms, our Privacy Policy, and
                            any additional terms that may apply to specific events or services.</p>

                        <h5>2. Eligibility</h5>
                        <p>You must be at least 18 years of age or the legal age of majority in your jurisdiction to use
                            our Service. By using the Service, you represent that you have the legal capacity to enter
                            into a binding contract.</p>

                        <h5>3. Ticket Purchase</h5>
                        <h6>a. Ticket Availability</h6>
                        <p>Ticket availability is subject to change without notice, and we do not guarantee that tickets
                            will be available at any given time. All ticket purchases are subject to availability, and
                            we reserve the right to cancel or refuse any ticket order for any reason, including but not
                            limited to event cancellation or fraud prevention.</p>

                        <h6>b. Pricing and Fees</h6>
                        <p>All ticket prices are displayed in [Currency] and are inclusive of applicable taxes unless
                            otherwise noted. In addition to the ticket price, service fees and processing fees may be
                            charged. You agree to pay all applicable charges and fees at the time of purchase.</p>

                        <h6>c. Payment</h6>
                        <p>We accept payments via [list payment methods: credit card, PayPal, etc.]. You authorize us to
                            charge the payment method provided for the total amount of the transaction. If your payment
                            is declined or fails, your order will not be processed.</p>

                        <h6>d. Order Confirmation</h6>
                        <p>After your purchase, you will receive a confirmation email with details of your booking.
                            Please check all the information carefully. If you do not receive a confirmation email,
                            please contact us immediately. Your booking is only considered confirmed once you have
                            received the confirmation email.</p>

                        <h5>Event Changes and Cancellations</h5>
                        <h6>a. Event Cancellations</h6>
                        <p>In the event of cancellation, postponement, or rescheduling by the event organizer, we will
                            notify you as soon as possible. Refunds, rescheduling, or exchanges will be handled
                            according to the event organizer’s policy. We are not responsible for any incidental
                            expenses you incur due to event changes, including travel and accommodation costs.</p>

                        <h6>b. Refund Policy</h6>
                        <p>All sales are final, and tickets are non-refundable unless otherwise specified in the event’s
                            terms or by applicable law. In certain cases, tickets may be eligible for refund or exchange
                            at the event organizer’s discretion.</p>

                        <h5>5. User Accounts</h5>
                        <p>To access certain features of our Service, you may be required to create an account. You
                            agree to provide accurate and complete information when registering and to keep your account
                            information up to date. You are responsible for maintaining the confidentiality of your
                            account and password, and for all activities that occur under your account.</p>
                        <p>If you suspect unauthorized use of your account, you must notify us immediately.</p>

                    </div>
                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal end-->


    </footer>
    <!-- =======================
Footer END -->

    <!-- Offcanvas START -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu">
        <!-- Offcanvas header -->
        <div class="offcanvas-header justify-content-between border-bottom px-3">
            <h5 class="mb-0">Your Cart</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <!-- Offcanvas body -->
        <div class="offcanvas-body d-flex flex-column px-3">
            <div class="row g-3">
                <!-- Image -->
                <div class="col-4">
                    <img class="rounded-2 bg-light p-2" src="/assets/PublicArea/images/shop/02.png" alt="avatar" />
                </div>
                <div class="col-8">
                    <p class="heading-color fw-semibold mb-1">
                        Round neck cotton t-shirt
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Select item -->
                        <select class="form-select form-select-sm w-auto" aria-label="Default select example">
                            <option value="1">01</option>
                            <option value="2">02</option>
                            <option value="3">03</option>
                        </select>

                        <a href="#" class="btn btn-sm btn-link p-0">Remove</a>
                    </div>
                </div>
            </div>

            <!-- Button and price -->
            <div class="mt-auto">
                <div class="d-flex justify-content-between mb-2">
                    <span class="heading-color fw-semibold">Subtotal</span>
                    <h6 class="text-success mb-0">$103</h6>
                </div>
                <!-- Button -->
                <div class="d-grid">
                    <a href="checkout.html" class="btn btn-lg btn-dark mb-0">Continue to Checkout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Offcanvas END -->



    <!-- Back to top -->
    <div class="back-top"></div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import { onMounted } from "vue";




const PrivacymModel = async () => {
    try {
        new bootstrap.Modal(document.getElementById('PrivacyPolicy')).show();
    } catch (error) {
        console.log("Error", error);
    }
};
const TermsConditions = async () => {
    try {
        new bootstrap.Modal(document.getElementById('TermsConditions')).show();
    } catch (error) {
        console.log("Error", error);
    }
};
</script>