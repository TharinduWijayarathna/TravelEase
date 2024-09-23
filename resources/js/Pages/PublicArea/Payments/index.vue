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
                                                        <Link class="nav-link active" :href="route('payments')">
                                                        <i class="bi bi-wallet fa-fw me-2"></i>Payment details</Link>
                                                    </li>
                                                    <li class="nav-item">
                                                        <Link class="nav-link" :href="route('history')">
                                                        <i class="bi bi-clock-history fa-fw me-2"></i>Booking History</Link>
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
                                    <h1 class="h3 mb-0">Payment details</h1>

                                    <!-- Advanced filter responsive toggler START -->
                                    <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar"
                                        aria-controls="offcanvasSidebar">
                                        <i class="fas fa-sliders-h"></i> Menu
                                    </button>
                                    <!-- Advanced filter responsive toggler END -->
                                </div>

                                <!-- Payment method -->
                                <div class="card bg-transparent rounded-3">
                                    <!-- Card header -->
                                    <div
                                        class="card-header bg-transparent border-bottom d-sm-flex justify-content-between px-0 pt-0">
                                        <h5 class="card-header-title mb-2 mb-sm-0">
                                            Saved payment methods
                                        </h5>
                                        <a href="#" class="btn btn-primary mb-0" data-bs-toggle="modal"
                                            data-bs-target="#addcard"><i class="bi bi-plus-lg me-2"></i>Add new card</a>
                                    </div>
                                    <!-- Card body START -->
                                    <div class="card-body px-0 mt-3">
                                        <!-- Master card -->
                                        <div class="border rounded p-4 mb-4">
                                            <div class="d-sm-flex align-items-center">
                                                <div class="flex-shrink-0 mb-2 mb-sm-0">
                                                    <img class="avatar"
                                                        src="assets/PublicArea/images/elements/mastercard.svg"
                                                        alt="Image Description" />
                                                </div>

                                                <div class="flex-grow-1 ms-sm-3">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm mb-3 mb-sm-0">
                                                            <p class="heading-color fw-normal mb-0">
                                                                MasterCard ••••
                                                                1569
                                                                <span class="badge text-bg-primary">primary</span>
                                                            </p>
                                                            <small class="text-muted">Checking -
                                                                Expires
                                                                12/26</small>
                                                        </div>
                                                        <!-- End Col -->

                                                        <div class="col-sm-auto">
                                                            <div class="d-flex gap-3">
                                                                <a class="btn btn-sm btn-white border mb-0">
                                                                    <i class="bi-pencil-fill me-1"></i>
                                                                    Edit
                                                                </a>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-white border mb-0">
                                                                    <i class="bi-trash me-1"></i>
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <!-- End Col -->
                                                    </div>
                                                    <!-- End Row -->
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Visa card -->
                                        <div class="border rounded p-4">
                                            <div class="d-sm-flex align-items-center">
                                                <div class="flex-shrink-0 mb-2 mb-sm-0">
                                                    <img class="avatar" src="assets/PublicArea/images/elements/visa.svg"
                                                        alt="Image Description" />
                                                </div>

                                                <div class="flex-grow-1 ms-sm-3">
                                                    <div class="row align-items-center">
                                                        <div class="col-sm mb-3 mb-sm-0">
                                                            <p class="heading-color fw-normal mb-0">
                                                                VisaCard ••••
                                                                5620
                                                            </p>
                                                            <small class="text-muted">Checking -
                                                                Expires
                                                                02/35</small>
                                                        </div>
                                                        <!-- End Col -->

                                                        <div class="col-sm-auto">
                                                            <div class="d-flex gap-3">
                                                                <a class="btn btn-sm btn-white border mb-0">
                                                                    <i class="bi-pencil-fill me-1"></i>
                                                                    Edit
                                                                </a>
                                                                <button type="button"
                                                                    class="btn btn-sm btn-white border mb-0">
                                                                    <i class="bi-trash me-1"></i>
                                                                    Delete
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <!-- End Col -->
                                                    </div>
                                                    <!-- End Row -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card body END -->
                                </div>

                                <div class="text-center my-5">
                                    <i class="bi bi-three-dots"></i>
                                </div>
                                <!-- Divider -->

                                <!-- Transition history -->
                                <div class="card bg-transparent rounded-3">
                                    <!-- Card header -->
                                    <div class="card-header bg-transparent border-bottom px-0 pt-0">
                                        <h5 class="card-header-title mb-0">
                                            Transition history
                                        </h5>
                                    </div>
                                    <!-- Card body -->
                                    <div class="card-body px-0 mt-3">
                                        <!-- Search and select -->
                                        <div class="row g-3 align-items-center justify-content-between mb-4">
                                            <!-- Content -->
                                            <div class="col-md-8">
                                                <form class="rounded position-relative">
                                                    <input class="form-control pe-5 bg-transparent" type="search"
                                                        placeholder="Search" aria-label="Search" />
                                                    <button
                                                        class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                                                        type="submit">
                                                        <i class="fas fa-search fs-6"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Select option -->
                                            <div class="col-md-3">
                                                <!-- Short by filter -->
                                                <form>
                                                    <select class="form-select z-index-9 bg-transparent">
                                                        <option value="">
                                                            Sort by
                                                        </option>
                                                        <option>Newest</option>
                                                        <option>Oldest</option>
                                                    </select>
                                                </form>
                                            </div>
                                        </div>

                                        <!-- Table -->
                                        <div class="table-responsive border-0">
                                            <table class="table align-middle p-4 mb-0 table-hover">
                                                <!-- Table head -->
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col" class="border-0 text-white rounded-start">
                                                            Reference
                                                        </th>
                                                        <th scope="col" class="border-0 text-white">
                                                            Payment method
                                                        </th>
                                                        <th scope="col" class="border-0 text-white">
                                                            Status
                                                        </th>
                                                        <th scope="col" class="border-0 text-white">
                                                            Amount
                                                        </th>
                                                        <th scope="col" class="border-0 text-white">
                                                            Date
                                                        </th>
                                                        <th scope="col" class="border-0 text-white rounded-end">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>

                                                <!-- Table body START -->
                                                <tbody>
                                                    <!-- Table row -->
                                                    <tr>
                                                        <!-- Table data -->
                                                        <td>
                                                            <a href="#">#23458</a>
                                                        </td>

                                                        <!-- Table data -->
                                                        <td>
                                                            <img src="assets/PublicArea/images/elements/mastercard.svg"
                                                                class="h-20px" alt="" /><span
                                                                class="ms-2">****4568</span>
                                                        </td>

                                                        <!-- Table data -->
                                                        <td>
                                                            <div class="badge bg-warning bg-opacity-15 text-warning">
                                                                Pending
                                                            </div>
                                                        </td>

                                                        <!-- Table data -->
                                                        <td>$215</td>

                                                        <!-- Table data -->
                                                        <td>16/8/2023</td>

                                                        <!-- Table data -->
                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-light border btn-round me-1 mb-1 mb-md-0"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Download"><i class="bi bi-download"></i></a>
                                                        </td>
                                                    </tr>

                                                    <!-- Table row -->
                                                    <tr>
                                                        <!-- Table data -->
                                                        <td>
                                                            <a href="#">#23458</a>
                                                        </td>

                                                        <!-- Table data -->
                                                        <td>
                                                            <img src="assets/PublicArea/images/elements/mastercard.svg"
                                                                class="h-20px" alt="" /><span
                                                                class="ms-2">****4568</span>
                                                        </td>

                                                        <!-- Table data -->
                                                        <td>
                                                            <div class="badge bg-danger bg-opacity-15 text-danger">
                                                                Cancel
                                                            </div>
                                                        </td>

                                                        <!-- Table data -->
                                                        <td>$199</td>

                                                        <!-- Table data -->
                                                        <td>21/7/2023</td>

                                                        <!-- Table data -->
                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-light border btn-round me-1 mb-1 mb-md-0"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Download"><i class="bi bi-download"></i></a>
                                                        </td>
                                                    </tr>

                                                    <!-- Table row -->
                                                    <tr>
                                                        <!-- Table data -->
                                                        <td>
                                                            <a href="#">#3158</a>
                                                        </td>

                                                        <!-- Table data -->
                                                        <td>
                                                            <img src="assets/PublicArea/images/elements/visa.svg"
                                                                class="h-20px" alt="" /><span
                                                                class="ms-2">****5620</span>
                                                        </td>

                                                        <!-- Table data -->
                                                        <td>
                                                            <div class="badge bg-success bg-opacity-15 text-success">
                                                                paid
                                                            </div>
                                                        </td>

                                                        <!-- Table data -->
                                                        <td>$380</td>

                                                        <!-- Table data -->
                                                        <td>5/7/2023</td>

                                                        <!-- Table data -->
                                                        <td>
                                                            <a href="#"
                                                                class="btn btn-light border btn-round me-1 mb-1 mb-md-0"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Download"><i class="bi bi-download"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <!-- Table body END -->
                                            </table>
                                        </div>
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
import { ref } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;
</script>
