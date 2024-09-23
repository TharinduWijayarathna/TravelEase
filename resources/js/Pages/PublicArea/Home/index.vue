<template>
    <AppLayout>
        <template #content>
            <main>
                <div class="">
                    <!-- Banner carousel showing bus journeys or destinations -->
                    <div v-if="banners.length === 0">
                        <Carousel :autoplay="4000" :wrap-around="true" class="w-100px">
                            <Slide v-for="slide in 5" :key="slide">
                                <div class="carousel__item" style="width:100%">
                                    <div class="card overflow-hidden h-500px h-xl-750px rounded-0"
                                        :style="{ backgroundImage: `url(/assets/PublicArea/images/shop/bg/0${slide}.jpg)`, backgroundPosition: 'center left', backgroundSize: 'cover' }">
                                        <div class="bg-overlay bg-dark opacity-5 d-lg-none"></div>
                                        <div class="card-img-overlay d-flex align-items-center">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-sm-11 col-lg-8 col-xl-5">
                                                        <span
                                                            class="d-inline-block text-bg-dark small rounded-pill px-3 py-2 mb-4">New
                                                            Route Available</span>
                                                        <h1 class="text-white display-6 mb-4">Explore Your Next
                                                            Destination</h1>
                                                        <p class="text-white mb-4">Book your tickets now and enjoy
                                                            comfortable and affordable bus journeys to exciting
                                                            destinations.</p>
                                                        <a class="btn btn-lg btn-outline-white icon-link icon-link-hover mb-0"
                                                            href="#">Book Now<i class="bi bi-arrow-right"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </Slide>
                            <template #addons>
                                <Pagination />
                            </template>
                        </Carousel>
                    </div>

                    <!-- Display active banners -->
                    <div v-else>
                        <div class="swiper overflow-hidden pt-5" ref="swiper2" data-swiper-options="swiperOptions2">
                            <Carousel :autoplay="4000" :wrap-around="true">
                                <Slide v-for="banner in banners" :key="banner.id">
                                    <div class="carousel__item" style="width:100%">
                                        <div class="card overflow-hidden h-500px h-xl-750px rounded-0"
                                            :style="'background-image: url(' + banner.image_url + '); background-position: center left; background-size: cover;'">
                                            <div class="bg-overlay bg-dark opacity-5 d-lg-none"></div>
                                            <div class="card-img-overlay d-flex align-items-center">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-11 col-lg-8 col-xl-5">
                                                            <h1 class="text-white display-6 mb-4">{{ banner.main_heading
                                                                }}</h1>
                                                            <p class="text-white mb-4">{{ banner.sub_heading }}</p>
                                                            <a class="btn btn-lg btn-outline-white icon-link icon-link-hover mb-0"
                                                                href="#">View Details<i
                                                                    class="bi bi-arrow-right"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </Slide>
                                <template #addons>
                                    <Pagination />
                                </template>
                            </Carousel>
                            <div class="swiper-pagination swiper-pagination-line position-absolute bottom-0 mb-3"></div>
                        </div>
                    </div>
                </div>

                <div class="container pb-5">
                    <!-- Title -->
                    <div class="inner-container-small text-center mb-4 mb-md-6">
                        <h2>How to Book Your Ticket in <span class="text-primary">4</span> Easy Steps</h2>
                    </div>

                    <div class="row step-process">
                        <!-- Step item -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-body bg-transparent text-center">
                                <!-- Icon -->
                                <div class="icon-lg bg-dark text-white rounded-circle mb-3 mx-auto">
                                    <i class="bi bi-search fa-lg"></i>
                                </div>
                                <h5>Search for Your Trip</h5>
                                <p>Enter your destination and preferred travel date to find available buses.</p>
                            </div>
                        </div>

                        <!-- Step item -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-body bg-transparent text-center">
                                <!-- Icon -->
                                <div class="icon-lg bg-dark text-white rounded-circle mb-3 mx-auto">
                                    <i class="bi bi-ticket fa-lg"></i>
                                </div>
                                <h5>Select Your Seat</h5>
                                <p>Choose your preferred seat from the seating plan displayed for the selected bus.</p>
                            </div>
                        </div>

                        <!-- Step item -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-body bg-transparent text-center">
                                <!-- Icon -->
                                <div class="icon-lg bg-dark text-white rounded-circle mb-3 mx-auto">
                                    <i class="bi bi-credit-card fa-lg"></i>
                                </div>
                                <h5>Make Payment</h5>
                                <p>Securely complete your booking by paying through our various payment options.</p>
                            </div>
                        </div>

                        <!-- Step item -->
                        <div class="col-sm-6 col-lg-3">
                            <div class="card card-body bg-transparent text-center">
                                <!-- Icon -->
                                <div class="icon-lg bg-dark text-white rounded-circle mb-3 mx-auto">
                                    <i class="bi bi-envelope-check fa-lg"></i>
                                </div>
                                <h5>Receive Confirmation</h5>
                                <p>Get an instant confirmation with your ticket details via email or SMS.</p>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="container pb-5 pt-3">
                    <div class="row g-4 align-items-center pb-5">
                        <!-- About images -->
                        <div class="col-lg-6 position-relative order-2">
                            <!-- Decoration -->
                            <div class="bg-dark rounded d-none d-sm-flex align-items-center z-index-2 position-absolute top-0 end-0 me-8 px-3 py-2"
                                style="max-width: 330px;">
                                <!-- Avatar -->
                                <div class="avatar avatar-sm flex-shrink-0 me-2">
                                    <img class="avatar-img rounded-circle" src="assets/PublicArea/images/avatar/05.jpg"
                                        alt="avatar">
                                </div>
                                <p class="text-white small mb-0">Need help booking your trip? Our support team is here
                                    24/7 🚌</p>
                            </div>

                            <!-- Decoration -->
                            <div
                                class="bg-white shadow rounded d-flex align-items-center px-3 py-2 position-absolute bottom-0 end-0 mb-4 me-5">
                                <!-- Avatar -->
                                <div class="avatar avatar-sm flex-shrink-0 me-2">
                                    <img class="avatar-img rounded-circle" src="assets/PublicArea/images/avatar/03.jpg"
                                        alt="avatar">
                                </div>
                                <p class="text-dark small mb-0">Thousands of happy travelers 😄</p>
                            </div>

                            <!-- SVG decoration -->
                            <figure class="position-absolute top-0 end-0 mt-5 me-4">
                                <svg width="161" height="159" viewBox="0 0 161 159" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path class="fill-mode"
                                        d="M25.5386 13.9089C23.5464 16.1653 22.3451 19.3502 22.4932 22.3567C22.8448 29.8923 30.8302 34.1332 37.0233 36.423C50.0784 41.2465 64.0338 43.1912 77.0903 48.1289C89.1527 52.6911 102.006 59.8378 105.507 73.2574C108.672 85.4796 104.643 99.5095 93.3895 105.945C87.0539 109.575 74.3135 112.401 69.0359 105.215C64.8602 99.5268 73.3331 94.6861 77.6354 93.0458C86.4861 89.6306 96.8613 89.7477 105.86 92.689C118.317 96.7733 129.091 106.995 134.006 119.132C136.082 124.261 137.559 130.382 136.88 135.962C136.74 137.067 138.905 138.255 139.079 136.845C141.136 120.047 128.666 103 114.963 94.7923C105.994 89.3955 95.1401 87.3394 84.8209 88.8208C78.5117 89.7293 69.2315 92.195 66.3738 98.7195C63.5529 105.13 70.8035 110.041 76.2035 111.211C85.7632 113.274 96.4128 109.031 102.457 101.538C110.229 91.8668 110.744 76.8274 104.665 66.1051C98.0233 54.4149 84.6323 48.5083 72.4805 44.4604C64.7228 41.8362 56.8009 39.841 48.9354 37.7883C41.7953 35.9222 33.0411 34.3881 27.5736 28.9349C23.8198 25.2049 23.9084 19.5704 27.3475 15.6506C28.137 14.7709 26.3281 13.0292 25.5386 13.9089Z">
                                    </path>
                                    <path class="fill-mode"
                                        d="M131.181 128.512C134.051 131.523 136.392 134.842 138.299 138.524C138.571 139.056 139.801 140.115 140.248 139.199C142.034 135.536 143.801 131.853 145.587 128.189C144.916 127.793 144.207 127.397 143.536 127.001C143.539 127.267 143.542 127.533 143.545 127.8C143.556 128.752 145.665 130.073 145.65 128.779C145.647 128.512 145.644 128.246 145.641 127.979C145.633 127.218 144.093 125.703 143.591 126.791C141.805 130.455 140.039 134.137 138.253 137.801C138.902 138.026 139.552 138.251 140.202 138.476C138.1 134.414 135.47 130.735 132.33 127.421C131.213 126.285 130.121 127.394 131.181 128.512Z">
                                    </path>
                                </svg>
                            </figure>

                            <!-- Images -->
                            <div class="row pe-md-6">
                                <div class="col-6 position-relative">
                                    <!-- SVG decoration -->
                                    <figure class="position-absolute bottom-0 end-0 mb-7 d-none d-xl-block">
                                        <svg class="fill-mode" width="96" height="99" viewBox="0 0 96 99" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M66.5204 64.3653C68.4878 62.2239 69.8711 59.7411 70.3936 56.886C72.4225 45.5894 64.3072 35.5653 52.1035 36.6825C44.603 37.3653 38.9777 44.5653 39.8999 52.0446C40.6684 58.2205 45.9556 62.4101 51.8576 61.448C54.6549 60.9825 56.776 59.4929 58.0363 56.886C59.02 54.8377 58.7126 52.5101 57.2985 51.0205C55.7923 49.4377 51.8576 48.6308 49.798 49.4377C49.4599 49.5618 49.2447 50.2136 49.4599 50.5239C49.7673 50.9273 50.1054 51.2687 50.4743 51.6101C51.1506 52.2308 51.8576 52.8205 52.5031 53.4722C52.9028 53.8756 52.872 54.4032 52.4724 54.8067C51.5195 55.8618 50.3206 56.048 49.0603 55.6756C46.9393 55.0239 45.8019 53.4411 45.4023 51.2998C44.3571 45.7136 49.4292 42.0205 53.1487 41.7722C58.6511 41.3687 63.5694 44.7205 65.1679 49.9963C66.7356 55.086 65.2294 59.7411 60.9873 62.9377C59.7884 63.8377 58.4666 64.5515 57.0219 65.017C53.0872 66.3204 49.1525 66.3515 45.2793 65.017C37.9325 62.5032 34.1823 56.6377 35.1352 48.5998C35.7193 43.6963 37.7788 39.4446 41.0065 35.7825C42.3898 34.1998 43.8653 32.7101 46.0478 32.3067C46.14 32.3067 46.2015 32.2446 46.2937 32.2136C46.5089 32.0894 46.5396 31.5308 46.3245 31.3136C46.0478 30.9722 45.6789 30.7549 45.2793 30.7239C44.4493 30.5998 43.6501 30.7239 42.8201 31.0032C41.2832 31.5618 40.0536 32.4929 38.8855 33.6101C34.336 37.9239 31.6616 43.2308 31.0468 49.4998C30.1861 58.4377 34.2745 65.048 41.8365 68.7101C44.8182 70.1377 47.9844 70.7273 51.2736 70.7584C52.3494 70.6963 53.4253 70.6653 54.5012 70.5101C59.2351 69.8584 63.2928 67.9032 66.5204 64.3653Z">
                                            </path>
                                            <path
                                                d="M0.769309 44.5963C2.36777 45.8998 3.99697 47.2032 5.65692 48.4756C7.99313 50.2446 10.6367 51.0205 13.8337 51.1136C13.7722 51.1136 14.0488 51.1446 14.264 51.0825C14.4792 51.0205 14.7866 50.9274 14.8481 50.7412C14.9096 50.586 14.8173 50.2446 14.6944 50.0894C14.0796 49.5308 13.4955 48.9101 12.7885 48.4756C10.1449 46.8929 7.53204 45.3101 4.70399 44.0998C3.6281 43.6343 2.52147 43.3239 1.41484 42.9515C1.10745 42.8584 0.769309 42.8584 0.431173 42.8584C0.123776 42.8584 -0.152881 43.3549 0.00081747 43.6032C0.246735 43.9446 0.461913 44.3481 0.769309 44.5963Z">
                                            </path>
                                            <path
                                                d="M55.6683 15.2692C55.822 15.2692 56.0064 15.3002 56.1294 15.2071C56.6212 14.8657 56.8364 14.3071 57.0823 13.7795C58.4349 10.614 60.1563 7.66572 62.0007 4.77951C62.6462 3.78641 63.2303 2.79331 63.8451 1.8002C64.0602 1.45882 64.2447 1.05537 64.3676 0.68296C64.3984 0.558822 64.3369 0.372615 64.2447 0.217443C64.091 -0.0308331 63.8143 0.00020143 63.5991 0.0933049C63.384 0.186408 63.1688 0.341581 62.9536 0.465719C58.0967 3.91055 56.1601 8.93813 55.4531 14.6795C55.4839 14.7726 55.4839 14.9278 55.5453 15.114C55.5453 15.1761 55.6376 15.2692 55.6683 15.2692Z">
                                            </path>
                                            <path
                                                d="M24.5905 26.6586C23.3916 23.0896 22.1928 19.5207 20.9325 15.9827C20.3791 14.4 19.6721 12.8793 18.9959 11.3586C18.8729 11.0793 18.627 10.831 18.4425 10.6138C18.2274 10.7069 18.0122 10.7379 17.9507 10.831C17.7048 11.2034 17.797 11.6379 17.8278 12.0414C18.2888 17.9689 20.6251 23.1827 23.8835 28.0551C23.9757 28.1793 24.0986 28.3345 24.2216 28.3965C24.3446 28.4586 24.5597 28.5517 24.6827 28.4896C24.8057 28.4586 24.9286 28.2414 24.8979 28.1172C24.8364 27.6207 24.7442 27.1241 24.5905 26.6586Z">
                                            </path>
                                            <path
                                                d="M56.5302 83.9173C56.4072 83.8862 56.1613 83.9483 56.0998 84.0414C55.7924 84.7241 55.4851 85.4069 55.2699 86.1207C54.6243 88.1379 53.8251 90.0621 52.3189 91.5828C51.9192 91.9862 51.6119 92.5138 51.2737 93.0104C50.3208 94.4069 49.6753 95.9586 49.0912 97.5104C48.9682 97.8207 48.9682 98.1621 48.9375 98.5035C48.9375 98.6586 48.999 98.9379 49.0912 98.9379C49.3064 99 49.6445 99.0311 49.7675 98.9069C51.1815 97.2621 52.5033 95.5241 54.0095 93.9724C55.9461 91.8931 56.8376 89.4724 56.8683 86.6793C56.8683 86.3379 56.9298 85.9966 56.9606 85.469C56.9298 85.1897 56.9298 84.6931 56.8683 84.1966C56.8376 84.0724 56.6532 83.9173 56.5302 83.9173Z">
                                            </path>
                                            <path
                                                d="M80.4469 37.086C81.031 37.1481 81.615 37.1791 82.1683 37.055C83.8897 36.7136 85.6112 36.6205 87.3633 36.7136C89.8533 36.9308 92.3124 36.4033 94.7716 36.124C95.079 36.0929 95.4171 35.9377 95.6938 35.7826C95.8167 35.7205 96.0319 35.4722 96.0012 35.4412C95.8782 35.2239 95.7245 35.0067 95.5401 34.9136C95.3249 34.7895 95.079 34.7584 94.8331 34.7274C92.5276 34.4791 90.2221 34.2619 87.9166 34.0446C85.2423 33.7653 82.8753 34.7895 80.5391 35.8446C80.3854 35.9067 80.2625 36.0308 80.1702 36.155C80.078 36.2791 79.9551 36.4964 80.0165 36.5895C80.078 36.7757 80.2625 37.055 80.4469 37.086Z">
                                            </path>
                                            <path
                                                d="M78.4176 68.4311C78.2332 68.6173 78.1717 68.8656 78.3254 69.1139C78.4484 69.3311 78.5713 69.5484 78.7865 69.7035C80.7231 71.1001 82.0141 72.9932 83.2437 75.0104C84.3196 76.8104 85.7951 78.269 87.3936 79.6346C87.6088 79.8208 87.9469 80.069 88.2543 79.7587C88.3773 79.6035 88.4387 79.2311 88.3773 79.0759C87.0247 76.5001 85.7644 73.8621 84.0737 71.4725C82.8134 69.7346 80.8768 68.9277 78.9709 68.2139C78.6943 68.2759 78.5406 68.338 78.4176 68.4311Z">
                                            </path>
                                            <path
                                                d="M18.9031 80.3173C16.1058 81.0621 13.8311 82.6759 11.8023 84.7242C11.7408 84.7863 11.6793 84.8483 11.6793 84.9104C11.6486 84.9725 11.6486 85.0966 11.6793 85.1587C11.7715 85.2518 11.9252 85.4069 12.0174 85.4069C12.2634 85.3759 12.5093 85.2828 12.7245 85.1587C16.0443 83.1414 19.6409 82.0242 23.4526 81.5276C23.9444 81.4656 24.4363 81.3725 24.8974 80.7207C22.8071 79.7897 20.8397 79.7897 18.9031 80.3173Z">
                                            </path>
                                        </svg>
                                    </figure>
                                    <!-- Image -->
                                    <img src="assets/PublicArea/images/about/10.jpg" class="rounded-pill"
                                        alt="about-img">
                                </div>
                                <div class="col-6 mt-8">
                                    <img src="assets/PublicArea/images/about/11.jpg" class="rounded-pill"
                                        alt="about-img">
                                </div>
                            </div>
                        </div>

                        <!-- About content -->
                        <div class="col-lg-6 order-lg-2">
                            <!-- Title -->
                            <h2 class="mb-4 mb-lg-5">Your Hassle-Free Bus Ticket Booking Solution</h2>
                            <p class="mb-4 mb-lg-5">Experience seamless travel with TravelEase. Our platform allows you to
                                easily find,
                                compare, and book bus tickets for your journeys. Enjoy comfort and convenience on every
                                trip!</p>

                            <!-- Button -->
                            <a href="#" class="btn btn-dark mb-0">Book Your Trip Now</a>
                        </div>
                    </div>
                </div>

                <!-- Services section, updated for bus booking -->

                <div class="container pb-5">
                    <div class="row g-4 pb-5">

                        <!-- Booking Information -->
                        <div class="col-12 pb-2">
                            <!-- Title -->
                            <h2 class="mb-4">Book Your Next Bus Trip Easily</h2>

                            <!-- Features -->
                            <div class="row g-4 g-lg-5">
                                <div class="col-md-6">
                                    <div class="card card-body bg-transparent p-0">
                                        <div class="icon-md bg-primary bg-opacity-10 text-primary rounded mb-3"><i
                                                class="bi bi-calendar-check fa-xl"></i></div>
                                        <h6 class="mb-2">Hassle-Free Booking</h6>
                                        <p class="mb-0">Book your tickets with just a few clicks, anytime and
                                            anywhere.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card card-body bg-transparent p-0">
                                        <div class="icon-md bg-primary bg-opacity-10 text-primary rounded mb-3"><i
                                                class="bi bi-clock-fill fa-xl"></i></div>
                                        <h6 class="mb-2">Real-Time Bus Schedules</h6>
                                        <p class="mb-0">Stay updated with accurate bus schedules and seat
                                            availability.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card card-body bg-transparent p-0">
                                        <div class="icon-md bg-primary bg-opacity-10 text-primary rounded mb-3"><i
                                                class="bi bi-map fa-xl"></i></div>
                                        <h6 class="mb-2">Track Your Trip</h6>
                                        <p class="mb-0">Track your bus in real time to plan your arrival and
                                            departure.</p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card card-body bg-transparent p-0">
                                        <div class="icon-md bg-primary bg-opacity-10 text-primary rounded mb-3"><i
                                                class="bi bi-shield-fill-check fa-xl"></i></div>
                                        <h6 class="mb-2">Safe and Secure Journeys</h6>
                                        <p class="mb-0">Travel with confidence knowing your safety is our top
                                            priority.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- Row END -->
                </div>


            </main>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import axios from "axios";
import { onMounted, ref } from "vue";
import { Carousel, Pagination, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'

const navbarComponent = ref(null);
const maxCharacters = 10;
const banners = ref([]);

const callGetCartCount = () => {
    navbarComponent.value.getCartCount();
};

const truncateName = (name) => {
    if (name.length > maxCharacters) {
        return name.substring(0, maxCharacters) + "...";
    }
    return name;
};

const getBanners = async () => {
    try {
        const response = await axios.get(route("banner.get"));
        banners.value = response.data.banner;
    } catch (error) {
        console.log("Error", error);
    }
};

onMounted(() => {
    getBanners();
});

</script>

<style>
section {
    padding-top: 3vh;
    padding-bottom: 7.5vh;
}
</style>
