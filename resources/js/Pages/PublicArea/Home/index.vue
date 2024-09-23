<template>
    <AppLayout>
        <template #content>
            <main>
                <div class="pt-xl-6">
                    <div v-if="banners.length === 0">
                        <Carousel :autoplay="4000" :wrap-around="true" class="w-100px">
                            <Slide v-for="slide in 5" :key="slide">
                                <div class="carousel__item" style="width:100%">
                                    <div class="">
                                        <div class="card overflow-hidden h-500px h-xl-750px rounded-0"
                                            :style="{ backgroundImage: `url(/assets/PublicArea/images/shop/bg/0${slide}.jpg)`, backgroundPosition: 'center left', backgroundSize: 'cover' }">

                                            <div class="bg-overlay bg-dark opacity-5 d-lg-none"></div>
                                            <div class="card-img-overlay d-flex align-items-center">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-11 col-lg-8 col-xl-5">
                                                            <span
                                                                class="d-inline-block text-bg-dark small rounded-pill px-3 py-2 mb-4">New
                                                                release
                                                                mizz-VR</span>
                                                            <h1 class="text-white display-6 mb-4">Dive into Virtual
                                                                Reality
                                                                Adventure</h1>
                                                            <p class="text-white mb-4">Whether you're a gaming
                                                                enthusiast or
                                                                simply seeking an
                                                                extraordinary escape from reality, our Virtual VR
                                                                product is
                                                                your portal to endless
                                                                excitement.</p>
                                                            <a class="btn btn-lg btn-outline-white icon-link icon-link-hover mb-0"
                                                                href="#">Show
                                                                details<i class="bi bi-arrow-right"></i></a>
                                                        </div>
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

                    <!-- if any active banners available -->
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
                                                            <h1 class="text-white display-6 mb-4">
                                                                {{ banner.main_heading }}
                                                            </h1>

                                                            <p class="text-white mb-4">
                                                                {{ banner.sub_heading }}
                                                            </p>
                                                            <a class="btn btn-lg btn-outline-white icon-link icon-link-hover mb-0"
                                                                href="#">Show
                                                                details<i class="bi bi-arrow-right"></i>
                                                            </a>
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

                <section class="pt-0">
                    <div class="container">
                        <div class="row g-4 g-sm-6">
                            <!-- Item -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-body bg-transparent p-0">
                                    <div class="icon-lg rounded-circle bg-info bg-opacity-10 text-info mb-4">
                                        <i class="bi bi-lightning-charge-fill fa-lg"></i>
                                    </div>
                                    <h6 class="mb-3">
                                        Fast and reliable delivery
                                    </h6>
                                    <p class="mb-0">
                                        Ensure timely and dependable delivery
                                        services to meet customer expectations.
                                    </p>
                                </div>
                            </div>

                            <!-- Item -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-body bg-transparent p-0">
                                    <div class="icon-lg rounded-circle bg-warning bg-opacity-15 text-warning mb-4">
                                        <i class="bi bi-radar fa-lg"></i>
                                    </div>
                                    <h6 class="mb-3">Package tracking</h6>
                                    <p class="mb-0">
                                        Offer real-time tracking information, so
                                        customers can monitor the status of
                                        their shipments.
                                    </p>
                                </div>
                            </div>

                            <!-- Item -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-body bg-transparent p-0">
                                    <div class="icon-lg rounded-circle bg-danger bg-opacity-10 text-danger mb-4">
                                        <i class="bi bi-fire fa-lg"></i>
                                    </div>
                                    <h6 class="mb-3">Returns and exchanges</h6>
                                    <p class="mb-0">
                                        Clearly outline your return and exchange
                                        policy, making it easy for customers to
                                        initiate returns.
                                    </p>
                                </div>
                            </div>

                            <!-- Item -->
                            <div class="col-sm-6 col-lg-3">
                                <div class="card card-body bg-transparent p-0">
                                    <div class="icon-lg rounded-circle bg-primary bg-opacity-10 text-primary mb-4">
                                        <i class="bi bi-headset fa-lg"></i>
                                    </div>
                                    <h6 class="mb-3">Customer support</h6>
                                    <p class="mb-0">
                                        Provide responsive customer support to
                                        address shipping-related queries and
                                        issues.
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
