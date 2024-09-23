<template>
    <AppLayout>
        <template #content>
            <main>
                <div class="pt-xl-6">
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
                                                        <span class="d-inline-block text-bg-dark small rounded-pill px-3 py-2 mb-4">New Route Available</span>
                                                        <h1 class="text-white display-6 mb-4">Explore Your Next Destination</h1>
                                                        <p class="text-white mb-4">Book your tickets now and enjoy comfortable and affordable bus journeys to exciting destinations.</p>
                                                        <a class="btn btn-lg btn-outline-white icon-link icon-link-hover mb-0" href="#">Book Now<i class="bi bi-arrow-right"></i></a>
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
                                                            <h1 class="text-white display-6 mb-4">{{ banner.main_heading }}</h1>
                                                            <p class="text-white mb-4">{{ banner.sub_heading }}</p>
                                                            <a class="btn btn-lg btn-outline-white icon-link icon-link-hover mb-0" href="#">View Details<i class="bi bi-arrow-right"></i></a>
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

                <!-- Services section, updated for bus booking -->
                <section class="pt-0">
                    <div class="container">
                        <div class="row g-4 g-sm-6">
                            <!-- Item 1: Comfortable Journeys -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-body bg-transparent p-0">
                                    <div class="icon-lg rounded-circle bg-info bg-opacity-10 text-info mb-4">
                                        <i class="bi bi-bus-front-fill fa-lg"></i>
                                    </div>
                                    <h6 class="mb-3">Comfortable Journeys</h6>
                                    <p class="mb-0">
                                        Travel in modern buses with comfortable seating and excellent amenities.
                                    </p>
                                </div>
                            </div>

                            <!-- Item 2: Easy Booking -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-body bg-transparent p-0">
                                    <div class="icon-lg rounded-circle bg-warning bg-opacity-15 text-warning mb-4">
                                        <i class="bi bi-ticket-fill fa-lg"></i>
                                    </div>
                                    <h6 class="mb-3">Easy Online Booking</h6>
                                    <p class="mb-0">
                                        Book your bus tickets online in just a few clicks.
                                    </p>
                                </div>
                            </div>

                            <!-- Item 3: Real-Time Tracking -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-body bg-transparent p-0">
                                    <div class="icon-lg rounded-circle bg-danger bg-opacity-10 text-danger mb-4">
                                        <i class="bi bi-geo-alt-fill fa-lg"></i>
                                    </div>
                                    <h6 class="mb-3">Real-Time Tracking</h6>
                                    <p class="mb-0">
                                        Track your bus location in real-time and plan your journey better.
                                    </p>
                                </div>
                            </div>

                            <!-- Item 4: Customer Support -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-body bg-transparent p-0">
                                    <div class="icon-lg rounded-circle bg-primary bg-opacity-10 text-primary mb-4">
                                        <i class="bi bi-headset fa-lg"></i>
                                    </div>
                                    <h6 class="mb-3">24/7 Customer Support</h6>
                                    <p class="mb-0">
                                        Get assistance with bookings, cancellations, and other queries anytime.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

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
