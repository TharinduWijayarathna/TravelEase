<template>
    <AppLayout>
        <template #content>
            <main>
                <section class=" pt-xl-6">
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
                </section>

                <section class="pt-0">
                    <div class="container">
                        <!-- Title -->
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3>Dive into our vibrant categories!</h3>
                            <a class="icon-link icon-link-hover text-body-secondary text-primary-hover"
                                :href="route('categories')">
                                View all
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>

                        <!-- Slider START -->
                        <div class="swiper">
                            <div class="swiper-wrapper justify-content-center">
                                <!-- Item -->
                                <div class="swiper-slide ss-2" v-for="category in categories" :key="category.name">
                                    <div class="card card-body border-primary-hover border bg-transparent text-center">
                                        <!-- Svg -->

                                        <figure class="" v-if="category.image_url">
                                            <div class="image-wrapper justify-content-center"
                                                style="width: auto; height: 100px; overflow: hidden; position: relative; align-items: center; justify-content: center;">
                                                <img :src="category.image_url" alt="primary image missed"
                                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 80%; height: 100%; object-fit: cover; align-items: center; justify-content: center; border-radius: 10px ;" />
                                            </div>
                                        </figure>

                                        <figure class="text-center" v-else>
                                            <div class="image-wrapper justify-content-center"
                                                style="width: auto; height: 100px; overflow: hidden; position: relative; align-items: center; justify-content: center;">
                                                <img :src="invalidImage" alt="primary image missed"
                                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 80%; height: 100%; object-fit: cover; align-items: center; justify-content: center; border-radius: 10px " />
                                            </div>
                                        </figure>

                                        <!-- Title -->
                                        <h6 class="mb-0">
                                            <a href="#" class="stretched-link">{{ truncateName(category.name) }}</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>

                            <!-- Slider Pagination -->
                            <div class="swiper-pagination swiper-pagination-primary position-relative mt-4"></div>
                        </div>
                    </div>
                </section>

                <section class="pt-0">
                    <div class="container">
                        <!-- Title -->
                        <div class="d-sm-flex justify-content-between align-items-center mb-4">
                            <h3>Discover what's trending today!</h3>
                            <Link class="icon-link icon-link-hover text-body-secondary text-primary-hover"
                                :href="route('products.index')">See all products<i class="bi bi-arrow-right"></i>
                            </Link>
                        </div>

                        <div class="row g-4 g-sm-5">
                            <!-- Adv -->
                            <div class="col-lg-8 col-xl-6">
                                <div class="card p-0 h-100" style="
                                        background-image: url(/assets/PublicArea/images/shop/bg/03.jpg);
                                        background-position: center left;
                                        background-size: cover; ">
                                    <div class="card-body p-5 mb-8">
                                        <span class="bg-dark text-white rounded fw-semibold small px-3 py-2">
                                            New Arrival</span>
                                        <h4 class="text-white my-4"> Powerful performance. Versatile design.
                                        </h4>
                                        <a class="btn btn-lg btn-outline-white icon-link icon-link-hover mb-0"
                                            href="#">Shop now<i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Product item -->
                            <div class="col-sm-6 col-lg-4 col-xl-3" v-for="(product, index) in products" :key="index">
                                <div class="card border bg-transparent overflow-hidden p-0 h-100">
                                    <Link class="" :href="route('product.single', { id: product.id, })">
                                    <!-- Overlay -->
                                    <div
                                        class="position-absolute start-0 top-0 d-flex align-items-start w-100 z-index-2 p-3">
                                        <div class="position-absolute top-0 start-0 p-3" v-if="product.featured == 1">
                                            <span class="badge text-bg-dark">Featured</span>
                                        </div>

                                        <div class="ms-auto" v-if="user">
                                            <div class="ms-auto">
                                                <div class="ms-auto" v-if="checkWishList">
                                                    <div class="ms-auto" v-if="wishListStatus[index] == 1">
                                                        <div class="ms-auto">
                                                            <!-- Check if product is in wishlist -->
                                                            <button class="btn btn-light btn-round border mb-0 ms-auto"
                                                                @click.prevent="removeFromWishList(product.id)">
                                                                <i class="bi bi-heart-fill text-danger"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div v-else>
                                                        <div class="ms-auto">
                                                            <!-- Product not in wishlist -->
                                                            <button class="btn btn-light btn-round border mb-0 ms-auto"
                                                                @click.prevent="addToWishList(product.id)">
                                                                <i class="bi bi-heart"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Image -->
                                    <div class="p-2" v-if="product.product_image.length > 0">
                                        <div class="bg-light rounded"
                                            v-for="product_image in product.product_image.filter((image) => image.status == 1)"
                                            :key="product_image.id">
                                            <div class="image-wrapper"
                                                style="width: auto; height: 250px; overflow: hidden; position: relative;">
                                                <img :src="product_image.image_url" alt="primary image missed"
                                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 90%; height: 95%; object-fit: cover; border-radius: 10px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-2" v-else>
                                        <div class="bg-light rounded">
                                            <div class="image-wrapper"
                                                style="width: auto; height: 250px; overflow: hidden; position: relative; border-radius: 10px;">
                                                <img :src="invalidImage" alt="primary image missed"
                                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 90%; height: 95%; object-fit: cover;" />
                                            </div>
                                        </div>
                                    </div>
 

                                    <!-- {{ product?.wish_list?.customer_id === user?.id }}
                                    {{ user?.id }} -->
                                    <!-- Card body -->
                                    <div class="card-body pb-0">
                                        <!-- Title -->
                                        <h6 class="card-title">
                                            <a href="#" class="stretched-link">{{ product.name }}</a>
                                        </h6>
                                        <!-- Badge and price -->
                                        <ul class="list-inline">
                                            <li class="list-inline-item me-0 small">
                                                <i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item me-0 small">
                                                <i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item me-0 small">
                                                <i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item me-0 small">
                                                <i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item me-0 small">
                                                <i class="fas fa-star-half-alt text-warning"></i>
                                            </li>
                                        </ul>
                                        <div class="" v-if="product.discount_price > 0.00">
                                            Discount: Rs.{{ product.discount_price }}
                                        </div>
                                        <div class="" v-else>
                                            <br>
                                        </div>
                                    </div>
                                    </Link>
                                    <!-- Card footer -->
                                    <div
                                        class="card-footer bg-transparent d-flex justify-content-between align-items-center pt-0">
                                        <div class="" v-if="product.discount_price > 0.00">
                                            <div class="fw-bold mb-0" v-if="product.discount_price">
                                                <del>Rs.{{ product.price }}</del>
                                            </div>
                                            <div class="fw-bold text-success mb-0" v-if="product.discount_price">
                                                Rs.{{ product.price - product.discount_price }}
                                            </div>
                                        </div>
                                        <div class="" v-else>
                                            <div class="fw-bold text-success mb-0">
                                                <br>
                                                Rs.{{ product.price }}
                                            </div>
                                        </div>

                                        <a v-if="user" href="#" class="btn btn-dark mb-0 z-index-2"
                                            @click.prevent=" addToCard(product.id)">
                                            <i class="bi bi-cart"></i>
                                        </a>

                                        <Link v-else :href="route('customer.login')"
                                            class="btn btn-dark mb-0 z-index-2">
                                        <i class="bi bi-cart"></i>
                                        </Link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

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

                <section class="bg-parallax position-relative" style="
                        background: url(/assets/PublicArea/images/shop/bg/04.jpg)  no-repeat;
                        background-size: cover;
                        background-position: center; ">
                    <!-- Bg overlay -->
                    <div class="bg-overlay bg-dark opacity-6"></div>
                    <div class="container position-relative z-index-2">
                        <div class="row">
                            <div class="col-lg-8 col-xl-5 mb-5 mb-xl-0">
                                <span class="text-primary display-4">20% off</span>
                                <h3 class="text-white my-4">
                                    Enhance your style with our latest
                                    collections
                                </h3>
                                <p class="text-white">
                                    Discover the perfect fusion of modern trends
                                    and timeless classics, meticulously curated
                                    to complement your unique taste.
                                </p>

                                <!-- Slider arrow -->
                                <div class="d-flex gap-3 position-relative mt-5 mt-md-6">
                                    <a class="btn btn-outline-white btn-icon rounded-circle mb-0 swiper-button-prev"
                                        @click="prevSlide"><i class="bi bi-arrow-left"></i></a>
                                    <a class="btn btn-outline-white btn-icon rounded-circle mb-0 swiper-button-next"
                                        @click="nextSlide"><i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>

                            <div class="col-xl-7 col-xxl-6 ms-auto">
                                <!-- Slider START -->
                                <div class="swiper" ref="swiper" :data-swiper-options="swiperOptions">
                                    <div class="swiper-wrapper">
                                        <!-- Slider items -->
                                        <div class="swiper-slide">
                                            <div class="card border overflow-hidden p-0 h-100">
                                                <!-- Wishlist -->
                                                <div
                                                    class="position-absolute start-0 top-0 d-flex align-items-start w-100 z-index-2 p-3">
                                                    <div class="badge text-bg-dark">
                                                        <i class="fas fa-star text-warning me-1"></i>4.5
                                                    </div>
                                                    <a href="#" class="btn btn-light btn-round border mb-0 ms-auto">
                                                        <i class="bi bi-heart"></i>
                                                    </a>
                                                </div>

                                                <!-- Image -->
                                                <div class="card-header bg-transparent pb-0">
                                                    <img src="assets/PublicArea/images/shop/08.png" alt="" />
                                                </div>

                                                <!-- Card body -->
                                                <div class="card-body pt-0">
                                                    <h6 class="card-title">
                                                        <a href="shop-detail.html" class="stretched-link">Mizz dunk
                                                            low</a>
                                                    </h6>
                                                    <p class="mb-0">
                                                        Man's training shoes
                                                    </p>
                                                </div>

                                                <!-- Card footer -->
                                                <div
                                                    class="card-footer bg-transparent d-flex justify-content-between align-items-center pt-0">
                                                    <div class="d-flex align-items-center gap-2 justify-content-center">
                                                        <p class="fw-bold text-success mb-0">
                                                            $180.00
                                                        </p>
                                                        <small class="text-decoration-line-through">$130.00</small>
                                                    </div>
                                                    <a href="#" class="btn btn-dark mb-0 z-index-2">Buy now</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Slider items -->
                                        <div class="swiper-slide">
                                            <div class="card border overflow-hidden p-0 h-100">
                                                <!-- Wishlist -->
                                                <div
                                                    class="position-absolute start-0 top-0 d-flex align-items-start w-100 z-index-2 p-3">
                                                    <div class="badge text-bg-dark">
                                                        <i class="fas fa-star text-warning me-1"></i>4.5
                                                    </div>
                                                    <a href="#" class="btn btn-light btn-round border mb-0 ms-auto"><i
                                                            class="bi bi-heart-fill text-danger"></i></a>
                                                </div>

                                                <!-- Image -->
                                                <div class="card-header bg-transparent pb-0">
                                                    <img src="assets/PublicArea/images/shop/09.png" alt="" />
                                                </div>

                                                <!-- Card body -->
                                                <div class="card-body pt-0">
                                                    <h6 class="card-title">
                                                        <a href="shop-detail.html" class="stretched-link">Mizz metcon
                                                            russell</a>
                                                    </h6>
                                                    <p class="mb-0">
                                                        Woman's training shoes
                                                    </p>
                                                </div>

                                                <!-- Card footer -->
                                                <div
                                                    class="card-footer bg-transparent d-flex justify-content-between align-items-center pt-0">
                                                    <div class="d-flex align-items-center gap-2 justify-content-center">
                                                        <p class="fw-bold text-success mb-0">
                                                            $135.00
                                                        </p>
                                                        <small class="text-decoration-line-through">$160.00</small>
                                                    </div>
                                                    <a href="#" class="btn btn-dark mb-0 z-index-2">Buy now</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Slider items -->
                                        <div class="swiper-slide">
                                            <div class="card border overflow-hidden p-0 h-100">
                                                <!-- Wishlist -->
                                                <div
                                                    class="position-absolute start-0 top-0 d-flex align-items-start w-100 z-index-2 p-3">
                                                    <div class="badge text-bg-dark">
                                                        <i class="fas fa-star text-warning me-1"></i>4.5
                                                    </div>
                                                    <a href="#" class="btn btn-light btn-round border mb-0 ms-auto"><i
                                                            class="bi bi-heart"></i></a>
                                                </div>

                                                <!-- Image -->
                                                <div class="card-header bg-transparent pb-0">
                                                    <img src="assets/PublicArea/images/shop/07.png" alt="" />
                                                </div>

                                                <!-- Card body -->
                                                <div class="card-body pt-0">
                                                    <h6 class="card-title">
                                                        <a href="shop-detail.html" class="stretched-link">Air Max Pulse
                                                            Roam</a>
                                                    </h6>
                                                    <p class="mb-0">
                                                        Man's sports and casual
                                                        were
                                                    </p>
                                                </div>

                                                <!-- Card footer -->
                                                <div
                                                    class="card-footer bg-transparent d-flex justify-content-between align-items-center pt-0">
                                                    <p class="fw-bold text-success mb-0">
                                                        $245
                                                    </p>
                                                    <a href="#" class="btn btn-dark mb-0 z-index-2">Buy now</a>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Slider items -->
                                        <div class="swiper-slide">
                                            <div class="card border overflow-hidden p-0 h-100">
                                                <!-- Wishlist -->
                                                <div
                                                    class="position-absolute start-0 top-0 d-flex align-items-start w-100 z-index-2 p-3">
                                                    <div class="badge text-bg-dark">
                                                        <i class="fas fa-star text-warning me-1"></i>4.5
                                                    </div>
                                                    <a href="#" class="btn btn-light btn-round border mb-0 ms-auto"><i
                                                            class="bi bi-heart"></i></a>
                                                </div>

                                                <!-- Image -->
                                                <div class="card-header bg-transparent pb-0">
                                                    <img src="assets/PublicArea/images/shop/10.png" alt="" />
                                                </div>

                                                <!-- Card body -->
                                                <div class="card-body pt-0">
                                                    <h6 class="card-title">
                                                        <a href="shop-detail.html" class="stretched-link">Jordan victori
                                                            once</a>
                                                    </h6>
                                                    <p class="mb-0">
                                                        Man's printed slides
                                                    </p>
                                                </div>

                                                <!-- Card footer -->
                                                <div
                                                    class="card-footer bg-transparent d-flex justify-content-between align-items-center pt-0">
                                                    <div class="d-flex align-items-center gap-2 justify-content-center">
                                                        <p class="fw-bold text-success mb-0">
                                                            $45.00
                                                        </p>
                                                        <small class="text-decoration-line-through">$86.00</small>
                                                    </div>
                                                    <a href="#" class="btn btn-dark mb-0 z-index-2">Buy now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-5 col-xl-4 mb-5 mb-lg-0">
                                <h2 class="mb-4">
                                    Their Impressive Product Collections
                                </h2>
                                <a class="icon-link icon-link-hover heading-color text-primary-hover" href="#">Explore
                                    all brands<i class="bi bi-arrow-right"></i>
                                </a>
                            </div>

                            <div class="col-lg-7 text-center ms-auto">
                                <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 g-4 g-md-6">
                                    <!-- Image -->
                                    <div class="col">
                                        <a href="#"><img src="/assets/PublicArea/images/client/01.svg" class="grayscale"
                                                alt="client-img" /></a>
                                    </div>
                                    <!-- Image -->
                                    <div class="col">
                                        <a href="#"><img src="/assets/PublicArea/images/client/02.svg" class="grayscale"
                                                alt="client-img" /></a>
                                    </div>
                                    <!-- Image -->
                                    <div class="col">
                                        <a href="#"><img src="/assets/PublicArea/images/client/03.svg" class="grayscale"
                                                alt="client-img" /></a>
                                    </div>
                                    <!-- Image -->
                                    <div class="col">
                                        <a href="#"><img src="/assets/PublicArea/images/client/04.svg" class="grayscale"
                                                alt="client-img" /></a>
                                    </div>
                                    <!-- Image -->
                                    <div class="col">
                                        <a href="#"><img src="/assets/PublicArea/images/client/05.svg" class="grayscale"
                                                alt="client-img" /></a>
                                    </div>
                                    <!-- Image -->
                                    <div class="col">
                                        <a href="#"><img src="/assets/PublicArea/images/client/06.svg" class="grayscale"
                                                alt="client-img" /></a>
                                    </div>
                                    <!-- Image -->
                                    <div class="col">
                                        <a href="#"><img src="/assets/PublicArea/images/client/07.svg" class="grayscale"
                                                alt="client-img" /></a>
                                    </div>
                                    <!-- Image -->
                                    <div class="col">
                                        <a href="#"><img src="/assets/PublicArea/images/client/08.svg" class="grayscale"
                                                alt="client-img" /></a>
                                    </div>
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
import Swiper from "swiper";
import { onMounted, onBeforeUnmount, ref, defineProps, computed } from "vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { Carousel, Pagination, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import invalidImage from '@/../src/AdminArea/img/product/invalid_image.png';
import { emitter, CART_REFRESH } from "@/event-bus.js";

const page = ref(1);
const pageCount = ref(1000);
const perPage = ref([25, 50, 100]);
const pagination = ref({});

const navbarComponent = ref(null);
const { props } = usePage();
const user = usePage().props.auth.user;
const maxCharacters = 10;
const wishList = ref({});
const checkWishList = ref([]);
const wishListStatus = ref([]);
const banners = ref([]);
const categories = ref([]);
const products = ref([]);
const productData = ref({
    unit_price: '',
    unit_discount: '',
});

const callGetCartCount = () => {
    navbarComponent.value.getCartCount();
};

const truncateName = (name) => {
    if (name.length > maxCharacters) {
        return name.substring(0, maxCharacters) + "...";
    }
    return name;
};

const isInWishlist = async () => {
    try {
        var customer_id = user.id;
        const response = await axios.get(route('wishList.check', { customer_id }));
        checkWishList.value = response.data;
        const productIds = products.value.map(product => product.id);
        const wishListProductIds = checkWishList.value.map(item => item.product_id);
        productIds.forEach((productId, index) => {

            if (wishListProductIds.includes(productId)) {
                const statusIndex = wishListProductIds.indexOf(productId);
                const status = checkWishList.value[statusIndex].status;
                if (status === 0) {
                    wishListStatus.value[index] = 0;
                } else {
                    wishListStatus.value[index] = 1;
                }
            } else {
                wishListStatus.value[index] = 0;
            }
        });
        getProducts();
    } catch (error) {
        console.error('Error:', error);
    }
};

const getBanners = async () => {
    try {
        const response = await axios.get(route("banner.get"));
        banners.value = response.data.banner;
    } catch (error) {
        console.log("Error", error);
    }
};

const getCategories = async () => {
    try {
        const response = (
            await axios.get(route("category.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                },
            })
        ).data;
        categories.value = response.data;
        pagination.value = response;
    } catch (error) {
        console.log("Error", error);
    }
};

const getProducts = async () => {
    try {
        const response = (
            await axios.get(route("product.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                },
            })
        ).data;

        
        products.value = response.data;
        pagination.value = response;
    } catch (error) {
        console.log("Error", error);
    }
};

const getSelectedProductData = async (product_id) => {
    try {
        const response = await axios.get(route('product.get', product_id));
        productData.value.unit_price = response.data.price;
        productData.value.unit_discount = response.data.discount_price;
    } catch (error) {
        console.log('Error', error);
    }
}

const addToCard = async (product_id) => {
    try {
        await getSelectedProductData(product_id);
        const customer_id = user.id;
        productData.value.created_by = user.first_name;
        const response = await axios
            .post(route("cart.item.store", { customer_id, product_id }), productData.value)
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Product added to cart!",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                });
                getProducts();
                emitter.emit(CART_REFRESH);
            })
            .catch((error) => {
                console.log("Error:", error);
                Swal.fire({
                    icon: "error",
                    title: "error",
                    text: "Failed to add item",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
    } catch (error) {
        console.log("Error:", error);
    }
};

const addToWishList = async (product_id) => {
    try {
        const customer_id = user.id;
        const response = await axios.post(route('wishList.add', { customer_id, product_id }));
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "Product successfully added to your wishlist."
        });
        getProducts();
        isInWishlist();
    } catch (error) {
        console.log('Error', error);
    }
}

const removeFromWishList = async (product_id) => {
    try {
        const customer_id = user.id;
        const response = await axios.post(route('wishList.remove', { customer_id, product_id }));
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "Product successfully removed from your wishlist",
        });

        getProducts();
        isInWishlist();
    } catch (error) {
        console.log('Error', error);
    }
}

onMounted(() => {
    getBanners();
    getCategories();
    getProducts();
    isInWishlist();
});

</script>

<style>
section {
    padding-top: 3vh;
    padding-bottom: 7.5vh;
}
</style>
