<template>
    <AppLayout title="Shop">
        <template #content>
            <main>
                <section>
                    <div class="container">
                        <nav aria-label="breadcrumb" style="margin-top: 80px;">
                            <ol class="breadcrumb breadcrumb-dots pb-0 mb-0">
                                <li class="breadcrumb-item">
                                    <Link :href="route('home')">Home</Link>
                                </li>
                                <li class="breadcrumb-item">
                                    <Link :href="route('products.index')">Shop</Link>
                                </li>
                                <li class="breadcrumb-item">
                                    <Link :href="route('cart.index')">Cart </Link>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Checkout
                                </li>
                            </ol>
                        </nav>

                        <div class="row mt-7">
                            <div class="col-md-5 mb-5 mb-md-0">
                                <div class="swiper" ref="swiper" :data-swiper-options="swiperOptions">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" v-if="primaryImage">
                                            <a class="w-100 h-100" data-glightbox data-gallery="gallery"
                                                :href="primaryImage.image_url">
                                                <div class="card card-element-hover overflow-hidden">
                                                    <div class="image-wrapper"
                                                        style="width: auto; height: 450px; overflow: hidden; position: relative;">
                                                        <img :src="primaryImage.image_url" alt="primary image missed"
                                                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 90%; height: 100%; object-fit: cover; border-radius: 10px;" />
                                                    </div>
                                                    <div class="hover-element w-100 h-100">
                                                        <i
                                                            class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="swiper-slide" v-if="primaryImage" v-for="image in secondaryImages"
                                            :key="image.id">
                                            <a class="w-100 h-100" data-glightbox data-gallery="gallery">
                                                <div class="card card-element-hover overflow-hidden">
                                                    <div class="image-wrapper"
                                                        style="width: auto; height: 450px; overflow: hidden; position: relative;">
                                                        <img :src="image.image_url" alt="primary image missed"
                                                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 90%; height: 90%; object-fit: cover; border-radius: 10px;" />
                                                    </div>
                                                    <div class="hover-element w-100 h-100">
                                                        <i
                                                            class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="swiper-slide" v-else >
                                            <a class="w-100 h-100" data-glightbox data-gallery="gallery">
                                                <div class="card card-element-hover overflow-hidden">
                                                    <div class="image-wrapper"
                                                        style="width: auto; height: 400px; overflow: hidden; position: relative;">
                                                        <img :src="invalidImage" alt="primary image missed"
                                                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 90%; height: 100%; object-fit: cover; border-radius: 20px" />
                                                    </div>
                                                    <div class="hover-element w-100 h-100">
                                                        <i
                                                            class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between position-absolute top-50 start-0 w-100">
                                        <button @click="prevSlide"
                                            class="btn btn-dark btn-icon rounded-circle mb-0 swiper-button-prev"
                                            style=" padding: 20px; color: aliceblue; ">
                                            <i class="bi bi-arrow-left"></i>
                                        </button>
                                        <button @click="nextSlide"
                                            class="btn btn-dark btn-icon rounded-circle mb-0 swiper-button-next"
                                            style=" padding: 20px; color: aliceblue; ">
                                            <i class="bi bi-arrow-right"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7 ps-md-6">
                                <div class="badge text-bg-dark mb-3">
                                    {{ product.category?.name }}
                                </div>
                                <p class="badge text-bg-primary m-2 ml-2" v-if="cart_item_id > 0">Already in your cart
                                </p>
                                <h1 class="h2 mb-4">
                                    {{ product.name }}
                                </h1>

                                <!-- Rating list -->
                                <!-- <div class="d-flex align-items-center flex-wrap mb-4">
								<ul class="list-inline mb-0">
									<li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
									<li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
									<li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
									<li class="list-inline-item me-0"><i class="fas fa-star text-warning"></i></li>
									<li class="list-inline-item me-0"><i class="fas fa-star-half-alt text-warning"></i></li>
									<li class="list-inline-item me-0 heading-color fw-normal">(4.5)</li>
								</ul>
								<span class="text-secondary opacity-3 mx-2 mx-sm-3">|</span>
								<a href="#" class="heading-color text-primary-hover mb-0">345 reviews</a>
								<span class="text-secondary opacity-3 mx-2 mx-sm-3">|</span>
								<span>86 sold</span>
								</div> -->

                                <div class="">
                                    <h4 class="fw-bold mb-0" v-if="product.discount_price">
                                        <del>Rs.{{ product.price }}</del>
                                    </h4>
                                    <h4 class="fw-bold text-success mb-0" v-if="product.discount_price">
                                        Rs.{{ product.price - product.discount_price }}
                                    </h4>
                                </div>

                                <!-- Storage choice -->
                                <!-- <div class="d-flex align-items-center gap-1 gap-sm-3 flex-wrap mt-2 mb-4">
								<span class="d-block">Memory storage:</span> -->
                                <!-- First button -->
                                <!-- <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked>
								<label class="btn btn-sm btn-light border btn-primary-soft-check mb-0" for="btnradio1">256 GB</label> -->
                                <!-- Second button -->
                                <!-- <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
								<label class="btn btn-sm btn-light border btn-primary-soft-check mb-0" for="btnradio2">512 GB</label> -->
                                <!-- Third button -->
                                <!-- <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
								<label class="btn btn-sm btn-light border btn-primary-soft-check mb-0" for="btnradio3">1 TB</label> -->
                                <!-- </div> -->
                                <!-- Color choice -->
                                <!-- <div class="color-check-radio d-flex align-items-center gap-3 mt-2 mb-4">
								<span class="d-block">Select color:</span>
								<div>
									<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" style="background-color: #9a0a0a;">
									<label class="form-check-label" for="flexRadioDefault1"></label>
									<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" style="background-color: #32C7F5;">
									<label class="form-check-label" for="flexRadioDefault2"></label>
									<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault3" style="background-color: #F7C32E;">
									<label class="form-check-label" for="flexRadioDefault3"></label>
									<input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault4" checked style="background-color: #333369;">
									<label class="form-check-label" for="flexRadioDefault4"></label>
								</div>
							</div> -->

                                <div v-if="isContentLoaded && cart_item_id > 0"
                                    class="d-flex align-items-center gap-3 mt-2 mb-4">
                                    <span class="d-block">Select quantity:</span>
                                    <div class="wrapper" v-if="cart_item_id">
                                        <span class="minus" @click=" decrement(product.id)">-</span>
                                        <input class="num" type="number" min="1" max="1000"
                                            v-model="newQuantity[product.id].quantity"
                                            @change=" updateQuantity(product.id)" />
                                        <span class="plus" @click="increment(product.id)">+</span>
                                    </div>
                                </div>

                                <p class="mb-4">{{ product.description }}</p>

                                <div class="d-grid">
                                    <button @click.prevent="addToCard(product.id)" hidden
                                        v-if="isContentLoaded && cart_item_id > 0 && user">
                                    </button>
                                    <button @click.prevent="addToCard(product.id)" class="btn btn-primary mb-0 w-100"
                                        v-else-if="user && cart_item_id <= 0">
                                        <i class="bi bi-cart2 me-2"></i>
                                        Add to Cart
                                    </button>
                                    <Link v-else :href="route('customer.login')" class="btn btn-primary mb-0 w-100">
                                    <i class="bi bi-cart2 me-2"></i>
                                    Add to Cart
                                    </Link>
                                    <p class="mb-0 mt-2 text-end small">
                                        <i class="bi bi-question-circle-fill text-primary me-2"></i>Need help?
                                        <a href="contact-v1.html" class="mb-0">Chat Now</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="pt-0">
                    <div class="container">
                        <h2 class="h4 mb-3">Specification</h2>

                        <p class="mb-5">
                            Please note that this is a generic example, and
                            actual specifications may vary depending on the
                            specific mobile phone model and brand. Mobile phone
                            specifications typically include information about
                            the display, performance, camera capabilities,
                            battery, operating system, connectivity options, and
                            additional features. Please note that this is a
                            generic example, and actual specifications may vary
                            depending on the specific mobile phone model and
                            brand.
                        </p>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="d-flex mb-4">
                                    <span class="w-150px w-sm-200px">Model:</span>
                                    <p class="heading-color fw-normal w-auto mb-0">
                                        Mizz-ZX
                                    </p>
                                </div>

                                <div class="d-flex mb-4">
                                    <span class="w-150px w-sm-200px">Operating System:</span>
                                    <p class="heading-color fw-normal w-auto mb-0">
                                        Android 12 with XYZ UI
                                    </p>
                                </div>

                                <div class="d-flex mb-4">
                                    <span class="w-150px w-sm-200px">Dimensions:</span>
                                    <p class="heading-color fw-normal w-auto mb-0">
                                        160 x 75 x 7.5 mm
                                    </p>
                                </div>

                                <div class="d-flex mb-4">
                                    <span class="w-150px w-sm-200px">Weight:</span>
                                    <p class="heading-color fw-normal w-auto mb-0">
                                        165 grams
                                    </p>
                                </div>

                                <div class="d-flex mb-4">
                                    <p class="w-150px w-sm-200px">Display:</p>
                                    <ul class="list-group list-group-borderless">
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            Screen Size: 6.5 inches
                                        </li>
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            Type: Super AMOLED
                                        </li>
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            Resolution: 1080 x 2340 pixels
                                        </li>
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            Refresh Rate: 120Hz
                                        </li>
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            HDR Support: Yes
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="d-flex mb-4">
                                    <span class="w-150px w-sm-200px">Battery:</span>
                                    <ul class="list-group list-group-borderless">
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            4,500mAh
                                        </li>
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            25W Fast Charging
                                        </li>
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            Wireless Charging (15W)
                                        </li>
                                    </ul>
                                </div>

                                <div class="d-flex mb-4">
                                    <span class="w-150px w-sm-200px">Camera:</span>
                                    <ul class="list-group list-group-borderless">
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            Main Camera 48MP
                                        </li>
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            Ultra-Wide 12MP
                                        </li>
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            Telephoto 8MP
                                        </li>
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            Macro 2MP
                                        </li>
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            Front Camera 20MP
                                        </li>
                                        <li class="list-group-item heading-color fw-normal w-auto pb-0">
                                            Video Recording 4K at 30fps
                                        </li>
                                    </ul>
                                </div>

                                <div class="d-flex mb-4">
                                    <span class="w-150px w-sm-200px">Colors:</span>
                                    <p class="heading-color fw-normal w-auto mb-0">
                                        Black, Arctic White, and Ocean Blue
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="pt-0">
                    <div class="container">
                        <h2 class="h4 mb-5">Rating & review</h2>
                        <div class="row">
                            <div class="col-lg-5 pe-lg-5 mb-5 mb-lg-0">
                                <div class="border rounded-2 p-4">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h2 class="mb-0">4.5</h2>
                                            <ul class="list-inline mb-2">
                                                <li class="list-inline-item me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item me-0">
                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                </li>
                                            </ul>
                                            <p class="mb-2">
                                                Based on 56 Reviews
                                            </p>
                                        </div>

                                        <div class="col-md-7">
                                            <div class="d-flex align-items-center">
                                                <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: 95%" aria-valuenow="95" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <span class="heading-color">5</span>
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <span class="heading-color">4</span>
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: 55%" aria-valuenow="55" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <span class="heading-color">3</span>
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <span class="heading-color">2</span>
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <div class="progress progress-sm bg-warning bg-opacity-15 w-100 me-3">
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                                <span class="heading-color">1</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5">
                                    <h5 class="mb-4">Reviews with images</h5>

                                    <div class="row g-4">
                                        <div class="col-4 col-sm-2 col-lg-3" v-for="image in product.product_image">
                                            <a class="w-100 h-100" data-glightbox data-gallery="gallery"
                                                :href="image.image_url">
                                                <div class="card card-element-hover overflow-hidden">
                                                    <div class="image-wrapper"
                                                        style="width: auto; height: 100px; overflow: hidden; position: relative;">
                                                        <img :src="image.image_url" alt="primary image missed"
                                                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 100%; height: 100%; object-fit: cover;" />
                                                    </div>
                                                    <div class="hover-element w-100 h-100">
                                                        <i
                                                            class="bi bi-fullscreen fs-6 text-white position-absolute top-50 start-50 translate-middle bg-dark rounded-1 p-2 lh-1"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Sort by</h5>
                                    <div class="col-xl-3">
                                        <select class="form-select" aria-label="Default select example">
                                            <option value="1">
                                                Most Recent
                                            </option>
                                            <option value="2">
                                                Most Viewed
                                            </option>
                                            <option value="3">Helpful</option>
                                        </select>
                                    </div>
                                </div>

                                <hr class="my-4" />

                                <div class="d-flex">
                                    <img class="avatar avatar-md rounded-circle float-start me-3"
                                        src="/assets/PublicArea/images/avatar/01.jpg" alt="avatar" />
                                    <div>
                                        <div class="d-sm-flex justify-content-between mb-2">
                                            <div>
                                                <h6 class="m-0">Allen Smith</h6>
                                                <span class="me-3 small">June 11, 2022, at 6:01 am
                                                </span>
                                            </div>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item small me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item small me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item small me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item small me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item small me-0">
                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <p>
                                            Warrant private blushes removed an
                                            in equally totally if. Delivered
                                            dejection necessary objection do Mr
                                            prevailed. Mr feeling does chiefly
                                            cordial in do.
                                        </p>
                                        <span>Was it helpful?</span>
                                        <div class="btn-group ms-md-2" role="group"
                                            aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="btnradio1" id="btnradior1" />
                                            <label class="btn btn-outline-secondary btn-sm mb-0" for="btnradior1"><i
                                                    class="far fa-thumbs-up me-1"></i>
                                                Yes</label>
                                            <input type="radio" class="btn-check" name="btnradio1" id="btnradior2" />
                                            <label class="btn btn-outline-secondary btn-sm mb-0" for="btnradior2">
                                                No
                                                <i class="far fa-thumbs-down ms-1"></i></label>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4" />

                                <div class="d-flex">
                                    <img class="avatar avatar-md rounded-circle float-start me-3"
                                        src="/assets/PublicArea/images/avatar/02.jpg" alt="avatar" />
                                    <div>
                                        <div class="d-sm-flex justify-content-between mb-2">
                                            <div>
                                                <h6 class="m-0">
                                                    Louis Ferguson
                                                </h6>
                                                <span class="me-3 small">June 14, 2022, at 6:01 am
                                                </span>
                                            </div>
                                            <ul class="list-inline mb-0">
                                                <li class="list-inline-item small me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item small me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item small me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item small me-0">
                                                    <i class="fas fa-star text-warning"></i>
                                                </li>
                                                <li class="list-inline-item small me-0">
                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <p>
                                            Delivered dejection necessary
                                            objection do Mr prevailed. Mr
                                            feeling does chiefly cordial in do.
                                        </p>
                                        <span>Was it helpful?</span>
                                        <div class="btn-group ms-md-2" role="group"
                                            aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="btnradio" id="btnradior3" />
                                            <label class="btn btn-outline-secondary btn-sm mb-0" for="btnradior3"><i
                                                    class="far fa-thumbs-up me-1"></i>
                                                Yes
                                            </label>
                                            <input type="radio" class="btn-check" name="btnradio" id="btnradior4" />
                                            <label class="btn btn-outline-secondary btn-sm mb-0" for="btnradior4">
                                                No
                                                <i class="far fa-thumbs-down ms-1"></i>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <a class="btn btn-primary-soft mb-0" data-bs-toggle="collapse"
                                        href="#collapseExample" role="button" aria-expanded="false"
                                        aria-controls="collapseExample">
                                        Write a review
                                    </a>
                                </div>

                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        <form>
                                            <select class="form-select mb-3" aria-label="Default select example">
                                                <option value="1">
                                                    ★★★★★ (5/5)
                                                </option>
                                                <option value="2">
                                                    ★★★★☆ (4/5)
                                                </option>
                                                <option value="3">
                                                    ★★★☆☆ (3/5)
                                                </option>
                                                <option value="3">
                                                    ★★☆☆☆ (2/5)
                                                </option>
                                                <option value="3">
                                                    ★☆☆☆☆ (1/5)
                                                </option>
                                            </select>
                                            <textarea class="form-control mb-3" id="exampleFormControlTextarea1"
                                                placeholder="Your review" rows="3"></textarea>
                                            <button type="submit" class="btn btn-primary mb-0">
                                                Post It
                                                <i class="bi fa-fw bi-arrow-right ms-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="pt-0">
                    <div class="container">
                        <div class="d-flex justify-content-between mb-5">
                            <h2 class="h4 mb-0">Similar products</h2>

                            <div class="d-flex gap-1 gap-sm-3 d-xl-none">
                                <button @click="prevSlide"
                                    class="btn btn-dark btn-icon rounded-circle mb-0 swiper-button-prev">
                                    <i class="bi bi-arrow-left"></i>
                                </button>
                                <button @click="nextSlide"
                                    class="btn btn-dark btn-icon rounded-circle mb-0 swiper-button-next">
                                    <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        <div class="swiper2" ref="swiper2" :data-swiper-options="swiperOptions2">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide" style="height: 400px;" v-for="product in similarProduct.filter(
                                    (products) => products.id !== currentProductId)" :key="product.id">
                                    <div class="card border bg-transparent overflow-hidden p-0 h-100">
                                        <Link class="" :href="route('product.single', { id: product.id, })">
                                        <div class="position-absolute top-0 start-0 p-3" v-if="product.featured == 1"
                                            style="z-index: 1;">
                                            <span class="badge text-bg-dark">Featured</span>
                                        </div>

                                        <div class="" v-if="product.product_image.length > 0">
                                            <div class="bg-light rounded"
                                                v-for="product_image in product.product_image.filter((image) => image.status == 1)"
                                                :key="product_image.id">
                                                <div class="image-wrapper"
                                                    style="width: auto; height: 250px; overflow: hidden; position: relative;">
                                                    <img :src="product_image.image_url" alt="primary image missed"
                                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 80%; height: 90%; object-fit: cover;" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="" v-else>
                                            <div class="bg-light rounded">
                                                <div class="image-wrapper"
                                                    style="width: auto; height: 250px; overflow: hidden; position: relative;">
                                                    <img :src="invalidImage" alt="primary image missed"
                                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 80%; height: 80%; object-fit: cover;" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <img :src="invalidImage" alt="primary image missed"
                                            style="position: absolute; overflow: hidden; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 95%; height: 95%; object-fit: cover; z-index: 0;" /> -->

                                        <div class="card-body pb-0">
                                            <h6 class="card-title">
                                                <a href="shop-detail.html" class="stretched-link">{{ product.name }}</a>
                                            </h6>
                                            <!-- Badge and price -->
                                            <!-- <ul class="list-inline">
													<li class="list-inline-item me-0 small"><i
															class="fas fa-star text-warning"></i></li>
													<li class="list-inline-item me-0 small"><i
															class="fas fa-star text-warning"></i></li>
													<li class="list-inline-item me-0 small"><i
															class="fas fa-star text-warning"></i></li>
													<li class="list-inline-item me-0 small"><i
															class="fas fa-star text-warning"></i></li>
													<li class="list-inline-item me-0 small"><i
															class="fas fa-star-half-alt text-warning"></i></li>
												</ul> -->
                                            <div class="" v-if="product.discount_price > 0.00">
                                                Discount: Rs.{{ product.discount_price }}
                                            </div>
                                        </div>
                                        </Link>

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
                                                    Rs.{{ product.price }}
                                                </div>
                                            </div>
                                            <button href="#" class="btn btn-dark mb-0 z-index-2" v-if="user">
                                                <i class="bi bi-cart" @click.prevent=" addToCart(product.id)"></i>
                                            </button>
                                            <Link :href="route('customer.login')" class="btn btn-dark mb-0 z-index-2"
                                                v-else><i class="bi bi-cart"></i></Link>
                                        </div>
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
import Swiper from "swiper";
import { onMounted, onBeforeUnmount, ref, defineProps, computed } from "vue";
import "swiper/swiper-bundle.css";
import { Link, usePage } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import invalidImage from '@/../src/AdminArea/img/product/invalid_image.png';
import { emitter, CART_REFRESH } from "@/event-bus.js";

const product = ref([]);
const similarProduct = ref([]);
const categoryId = ref(0);
const currentProductId = ref(0);
const newQuantity = ref({});
const user = usePage().props.auth.user;
const cart_item_id = ref(0);
const defaultQuantity = ref(1);

const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const productData = ref({
    unit_price: '',
    unit_discount: '',

});

const isContentLoaded = ref(false);

const primaryImage = computed(() => {
    return product.value.product_image?.find((image) => image.status === 1);
});

const secondaryImages = computed(() => {
    return product.value.product_image?.filter((image) => image.status === 0);
});

const getProduct = () => {
    product.value = props.product;
    categoryId.value = product.value.category_id;
    getSimilarProduct();
    currentProductId.value = product.value.id;
    newQuantity.value[product.value.id] = { quantity: product.value.quantity, cartId: product.value.id, };
};

const getSelectedProductData = async (product_id, current_quantity) => {
    try {
        const response = await axios.get(route('product.get', product_id));
        product.value = response.data;
        categoryId.value = product.value.category_id;
        getSimilarProduct();
        newQuantity.value[product.value.id] = { quantity: current_quantity, cartId: product.value.id, };
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
                checkCart();
                emitter.emit(CART_REFRESH);
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
            })
            .catch((error) => {
                console.log("Error:", error);
                Swal.fire({
                    icon: "warning",
                    title: "Warning",
                    text: "Oops! Already in cart.",
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

const getSimilarProduct = async () => {
    try {
        const response = await axios.get(
            route("category.get", categoryId.value)
        );
        if (response.data?.category) {
            similarProduct.value = response.data.category?.product.filter(product => product.id !== props.product.id);
        }

    } catch (error) {
        console.log("Error", error);
    }
};

const swiperOptions = {
    loop: false,
    grabCursor: true,
    autoplay: false,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
};

const updateQuantity = async (itemId) => {
    try {
        const { quantity } = newQuantity.value[itemId];
        const response = await axios.post(
            route("cart.item.quantity.update", cart_item_id.value),
            {
                quantity: quantity,
            }
        );
        getCartItems();
        getCart();
        emitter.emit(CART_REFRESH);
    } catch (error) {
        console.log("Error", error);
    }
};

const increment = (itemId) => {
    if (newQuantity.value[itemId].quantity < 500) {
        newQuantity.value[itemId].quantity++;
        updateQuantity(itemId);
        emitter.emit(CART_REFRESH);
    }
};

const decrement = (itemId) => {
    if (newQuantity.value[itemId].quantity > 1) {
        newQuantity.value[itemId].quantity--;
        updateQuantity(itemId);
        emitter.emit(CART_REFRESH);
    }
};

const formatNumber = computed(() => {
    return newQuantity.value < 100 ? "0" + newQuantity.value : newQuantity.value;
});

const checkCart = async () => {
    if (user) {
        try {
            const product_id = props.product.id;
            const customer_id = user.id;
            const response = await axios.get(route('cart.item.find', { product_id, customer_id }));
            if (response.data.status == 200) {
                cart_item_id.value = response.data.data[0].id;
                newQuantity.value[cart_item_id.value] = { quantity: response.data.data[0].quantity, cartId: cart_item_id.value };
                const current_quantity = response.data.data[0].quantity;
                getSelectedProductData(product_id, current_quantity);
            } else {
                getProduct();
            }
        } catch (error) {
            console.log('Error', error);
        }
    } else {
        getProduct();
    }
}

const swiper = ref(null);

onMounted(() => {
    checkCart();

    setTimeout(() => {
        isContentLoaded.value = true;
    }, 1);
    swiper2.value = new Swiper(".swiper2", swiperOptions2);
    swiper.value = new Swiper(".swiper", swiperOptions);
});

const nextSlide = () => {
    if (swiper.value && swiper.value.swiper) {
        swiper.value.swiper.slideNext();
    }
};

const prevSlide = () => {
    if (swiper.value && swiper.value.swiper) {
        swiper.value.swiper.slidePrev();
    }
};

const swiper2 = ref(null);

const swiperOptions2 = {
    spaceBetween: 30,
    grabCursor: true,
    speed: 1000,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    autoplay: {
        delay: 1000,
        disableOnInteraction: false,
        pauseOnMouseEnter: true,
    },
    breakpoints: {
        576: { slidesPerView: 1 },
        768: { slidesPerView: 2 },
        992: { slidesPerView: 3 },
        1200: { slidesPerView: 4 },
    },
};

</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

.wrapper {
    height: 25px;
    min-width: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.151);
    widows: 50px;
    padding: 20px;
}

.wrapper span {
    width: 100%;
    text-align: center;
    font-size: 55px;
    font-weight: large;
    cursor: pointer;
    user-select: none;
}

.wrapper span.num {
    font-size: large;
    border-right: 2px solid rgba(0, 0, 0, 0.2);
    border-left: 2px solid rgba(0, 0, 0, 0.2);
    pointer-events: none;
    width: 50px;
}

.num {
    font-size: large;
    border-right: 2px solid rgba(0, 0, 0, 0.2);
    border-left: 2px solid rgba(0, 0, 0, 0.2);
    width: 50px;
    border: none;
    text-align: center;
}

.wrapper .plus {
    font-size: x-large;
}

.wrapper .minus {
    font-size: x-large;
}

.wrap {
    width: 10vh;
}
</style>
