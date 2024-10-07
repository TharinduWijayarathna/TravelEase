<template>
    <AppLayout>
        <template #content>
            <main>
                <section class="pb-5 pb-sm-7">
                    <div class="container">
                        <nav aria-label="breadcrumb" style="margin-top: 80px;">
                            <ol class="breadcrumb breadcrumb-dots pb-0 mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Contact
                                </li>
                            </ol>
                        </nav>
                        <h1 class="h3 mb-0 mt-3">
                            Get in touch with us today.
                        </h1>
                    </div>
                </section>
                <Section class="pt-0">
                    <div class="container">
                        <div class="row row-cols-1 row-cols-lg-3 g-4">
                            <div class="col">
                                <div class="card card-body bg-light border p-sm-5">
                                    <div class="mb-4">
                                        <i class="bi bi-geo-alt fa-xl text-primary"></i>
                                    </div>
                                    <h6 class="mb-4">Office Address</h6>

                                    <div class="d-flex align-items-center mb-2">

                                        <span class="heading-color fw-semibold mb-0">Main office:</span>
                                    </div>
                                    <address class="mb-0">
                                        TravelEase, Sri Lanka
                                    </address>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card card-body bg-light border p-sm-5">
                                    <div class="mb-4">
                                        <i class="bi bi-envelope fa-xl text-primary"></i>
                                    </div>
                                    <h6 class="mb-3">Email us</h6>
                                    <p>
                                        We're on top of things and aim to
                                        respond to all inquiries within 24
                                        hours.
                                    </p>
                                    <a href="#"
                                        class="heading-color text-primary-hover text-decoration-underline mb-0">travelease@gmail.com</a>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card card-body bg-light border p-sm-5">
                                    <div class="mb-4">
                                        <i class="bi bi-telephone fa-xl text-primary"></i>
                                    </div>
                                    <h6 class="mb-3">Call us</h6>
                                    <p>
                                        Let's work together towards a common
                                        goal - get in touch!
                                    </p>
                                    <a href="#"
                                        class="heading-color text-primary-hover text-decoration-underline mb-0">(76)
                                        578-1398</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <iframe class="w-100 h-200px h-lg-400px grayscale d-block mt-8"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.9663095343008!2d-74.00425878428698!3d40.74076684379132!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259bf5c1654f3%3A0xc80f9cfce5383d5d!2sGoogle!5e0!3m2!1sen!2sin!4v1586000412513!5m2!1sen!2sin"
                            style="margin-bottom: -5px; border-radius: 5px" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </Section>
            </main>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Swiper from "swiper";
import { onMounted, onBeforeUnmount } from "vue";
</script>
