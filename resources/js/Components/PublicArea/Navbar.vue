<template>
    <header class="header-sticky header-absolute">
        <!-- Logo Nav START -->
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <!-- Logo START -->
                <a class="navbar-brand me-5" href="">
                    <img class="light-mode-item navbar-brand-item" src="/assets/PublicArea/images/logo.svg"
                        alt="logo" />
                    <img class="dark-mode-item navbar-brand-item" src="/assets/PublicArea/images/logo-light.svg"
                        alt="logo" />
                </a>
                <!-- Logo END -->

                <!-- Main navbar START -->
                <div class="navbar-collapse collapse" id="navbarCollapse">
                    <ul class="navbar-nav navbar-nav-scroll dropdown-hover">
                        <!-- Nav item -->

                        <li class="nav-item">
                            <Link class="nav-link" :href="route('home')">Home</Link>
                        </li>

                        <li class="nav-item">
                            <Link class="nav-link" :href="route('buses.index')">Buses</Link>
                        </li>

                        <!-- <li class="nav-item">
                            <Link class="nav-link" :href="route('categories')">Categories</Link>
                        </li> -->

                        <li class="nav-item">
                            <Link class="nav-link" :href="route('contact')">Contact</Link>
                        </li>

                        <!-- Offcanvas cart menu -->
                        <li class="nav-item" v-if="user">
                            <Link class="nav-link" :href="route('booking.user.index')" role="button">
                            My Bookings
                            </Link>
                        </li>

                        <li class="nav-item" v-else>
                            <Link class="nav-link" :href="route('customer.login')" role="button">
                            Bookings
                            </Link>
                        </li>
                    </ul>
                </div>
                <!-- Main navbar END -->

                <!-- Buttons -->
                <ul class="nav align-items-center dropdown-hover ms-sm-2">
                    <!-- Profile -->
                    <li class="nav-item position-relative ms-2 ms-sm-3">
                        <Link class="btn btn-lg icon-link mb-0" :href="route('customer.index')" href="#"
                            v-if="$page.props.auth.user">
                        <div class="btn btn-light btn-round mb-0">
                            <img class="avatar-img rounded-circle border" v-if="user.image_url" :src="user.image_url"
                                alt="" />
                            <img class="avatar-img rounded-circle border" v-else
                                src="assets/PublicArea/images/avatar/user.jpg" alt="" />
                        </div>
                        <span class="profile-button">Hi,
                            <b style="color: black">
                                {{ $page.props.auth.user.first_name }}</b>!</span>
                        </Link>

                        <Link class="btn btn-lg profile-button icon-link mb-0" :href="route('customer.login')" href="#"
                            v-else>
                        <span class="btn-light border btn btn-light mb-0 profile-button"
                            style="color: #fff; background-color: #1d599a">Login</span>
                        </Link>
                    </li>

                    <!-- Responsive navbar toggler -->
                    <li class="nav-item">
                        <button class="navbar-toggler ms-3 p-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-animation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Logo Nav END -->
    </header>
    <!-- Header END -->
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";
import { emitter, CART_REFRESH } from "@/event-bus.js";

const profile_image = ref(null);

const user = usePage().props.auth.user;

</script>

<style scoped>
.profile-button:hover {
    color: rgba(11, 59, 148, 0.822);
}

.navbar {
    background-color: white;
}
</style>
