<template>
    <AppLayout>
        <template #content>
            <main>
                <!-- Content START -->
                <section class="pt-sm-7">
                    <div class="container pt-3 pt-xl-5">
                        <div class="row">
                            <!-- Sidebar -->
                            <div class="col-lg-4 col-xl-3">
                                <!-- Responsive offcanvas body START -->
                                <div class="offcanvas-lg offcanvas-start h-100" tabindex="-1" id="offcanvasSidebar">
                                    <!-- Offcanvas header -->
                                    <div class="offcanvas-header bg-light">
                                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                                            My profile
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                            data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
                                    </div>
                                    <!-- Offcanvas body -->
                                    <div class="offcanvas-body p-0">
                                        <div class="card border p-3 w-100">
                                            <!-- Card header -->
                                            <div class="card-header text-center border-bottom">
                                                <!-- Avatar -->
                                                <div class="avatar avatar-xl position-relative mb-2">
                                                    <img class="avatar-img rounded-circle border border-2 border-white"
                                                        v-if="user.image_url" :src="user.image_url" alt="" />
                                                    <img v-else
                                                        class="avatar-img rounded-circle border border-2 border-white"
                                                        src="assets/PublicArea/images/avatar/user.jpg" alt="" />
                                                </div>
                                                <h6 class="mb-0">
                                                    {{ $page.props.auth.user.first_name }}
                                                    {{ $page.props.auth.user.last_name }}
                                                </h6>
                                                <a href="#" class="text-reset text-primary-hover small">
                                                    {{ $page.props.auth.user.email }}
                                                </a>
                                            </div>

                                            <!-- Card body START -->
                                            <div class="card-body p-0 mt-4">
                                                <ul class="nav nav-pills-primary-border-start flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link" :href="route('customer.index')">
                                                            <i class="bi bi-person fa-fw me-2"></i>
                                                            My profile
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <Link class="nav-link" :href="route('payments')">
                                                        <i class="bi bi-wallet fa-fw me-2"></i>Payment details</Link>
                                                    </li>
                                                    <li class="nav-item">
                                                        <Link class="nav-link active" :href="route('history')">
                                                        <i class="bi bi-clock-history fa-fw me-2"></i>Booking History
                                                        </Link>
                                                    </li>
                                                    <li class="nav-item">
                                                        <Link class="nav-link" :href="route('customer.delete.index')">
                                                        <i class="bi bi-trash fa-fw me-2"></i>Delete profile</Link>
                                                    </li>
                                                    <li class="nav-item">
                                                        <Link href="/logout" as="button" method="post"
                                                            class="nav-link text-danger" @click.prevent="signOut()">
                                                        <i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign Out
                                                        </Link>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- Card body END -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Main content -->
                            <div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
                                <!-- Title and offcanvas button -->
                                <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
                                    <!-- Title -->
                                    <h1 class="h3 mb-0">Order history</h1>

                                    <!-- Advanced filter responsive toggler START -->
                                    <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar"
                                        aria-controls="offcanvasSidebar">
                                        <i class="fas fa-sliders-h"></i> Menu
                                    </button>
                                    <!-- Advanced filter responsive toggler END -->
                                </div>

                                <div class="card bg-transparent">
                                    <!-- Card header -->
                                    <div
                                        class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center p-0 pb-3">
                                        <h6 class="card-title mb-0">
                                            Your order
                                        </h6>
                                        <div class="col-md-3 ms-auto">
                                            <!-- Short by filter -->
                                            <form>
                                                <select class="form-select js-choice" aria-label=".form-select-sm">
                                                    <option>Sort by</option>
                                                    <option selected>
                                                        All
                                                    </option>
                                                    <option>Delivered</option>
                                                    <option>Processing</option>
                                                    <option>Cancelled</option>
                                                </select>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Card body -->
                                    <div class="card-body p-0 pt-5">
                                        <!-- Product item START -->
                                        <div class="row align-items-md-center">
                                            <!-- Image -->
                                            <div class="col-5 col-md-2">
                                                <div class="bg-light p-2 rounded-2">
                                                    <img src="assets/PublicArea/images/shop/02.png" alt="" />
                                                </div>
                                            </div>

                                            <div class="col-7 col-md-10">
                                                <div class="row g-2 align-items-center">
                                                    <!-- Content -->
                                                    <div class="col-md-6 mb-3 mb-md-0">
                                                        <p class="heading-color fw-normal small mb-2">
                                                            Order no:
                                                            <span class="text-primary">#458795</span>
                                                        </p>
                                                        <h6 class="mb-2">
                                                            <a href="#">Round neck
                                                                cotton
                                                                t-shirt</a>
                                                        </h6>
                                                        <!-- List -->
                                                        <ul class="nav nav-divider small align-items-center">
                                                            <li class="nav-item">
                                                                Size: <b>L</b>
                                                            </li>
                                                            <li class="nav-item">
                                                                Shipped date:
                                                                <b>10 Nov,
                                                                    2023</b>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <!-- Price and button -->
                                                    <div class="col-md-4 text-md-end ms-auto">
                                                        <p class="text-success fw-semibold mb-1 mb-md-3">
                                                            <i class="bi bi-check-circle-fill me-1"></i>Delivered
                                                        </p>
                                                        <small>Total amount</small>
                                                        <h5 class="mt-1 mb-0">
                                                            $103.00
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Product item END -->

                                        <hr class="my-5" />
                                        <!-- Divider -->


                                        <!-- Product item END -->

                                    </div>

                                    <!-- Card footer -->
                                    <div class="card-footer bg-transparent text-end p-0">
                                        <!-- Pagination -->
                                        <ul
                                            class="pagination pagination-primary-soft list-unstyled d-flex justify-content-sm-end flex-wrap mb-0">
                                            <li class="page-item disabled">
                                                <a class="page-link" href="#">Prev</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">1</a>
                                            </li>
                                            <li class="page-item active">
                                                <a class="page-link" href="#">2</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">3</a>
                                            </li>
                                            <li class="page-item">
                                                <a class="page-link" href="#">Next</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- =======================
Content END -->
            </main>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Swiper from "swiper"; // Make sure to install the swiper package
import { onMounted, onBeforeUnmount } from "vue";
import { Link, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;
</script>
