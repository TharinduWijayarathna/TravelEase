<template>
    <AppLayout title="Shop">
        <template #content>
            <main>
                <section class="pb-5 pb-sm-7">
                    <div class="container">
                        <nav aria-label="breadcrumb" style="margin-top: 80px;">
                            <ol class="breadcrumb breadcrumb-dots pb-0 mb-0">
                                <li class="breadcrumb-item">
                                    <Link :href="route('home')">Home</Link>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Buses
                                </li>
                            </ol>
                        </nav>
                        <h1 class="h3 mb-0 mt-3">
                            Explore Our Buses
                        </h1>
                    </div>
                </section>

                <section class="pt-0">
                    <div class="container">
                        <div class="row">
                            <aside class="col-xl-3">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <h5 class="card-title">Filters</h5>

                                        <!-- Route Filter -->
                                        <div class="mb-3">
                                            <label for="routeFilter" class="form-label">Route From</label>
                                            <input type="text" v-model="filterForm.route_from" id="routeFilter" class="form-control">
                                        </div>

                                        <div class="mb-3">
                                            <label for="routeFilter" class="form-label">Route To</label>
                                            <input type="text" v-model="filterForm.route_to" id="routeFilter" class="form-control">
                                        </div>

                                        <!-- Departure Time Filter -->
                                        <div class="mb-3">
                                            <label for="departureTimeFilter" class="form-label">Departure Time</label>
                                            <input type="time" id="departureTimeFilter" class="form-control" v-model="filterForm.departure_time">
                                        </div>

                                        <!-- Arrival Time Filter -->
                                        <div class="mb-3">
                                            <label for="arrivalTimeFilter" class="form-label">Arrival Time</label>
                                            <input type="time" id="arrivalTimeFilter" class="form-control" v-model="filterForm.arrival_time">
                                        </div>

                                        <!-- Filter Button -->
                                        <button @click="applyFilters" class="btn btn-primary w-100">Apply
                                            Filters</button>

                                        <!-- Reset Button -->
                                        <button @click="clearFilters" class="btn btn-secondary w-100 mt-2">Reset
                                            Filters</button>

                                    </div>
                                </div>
                            </aside>
                            <div class="col-xl-9 ps-xl-6">
                                <!-- Card View for each Bus -->
                                <div class="row">
                                    <div class="col-12">
                                        <div v-for="bus in buses" :key="bus.id" class="card mb-4 shadow-sm">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <!-- Bus Image (Optional) -->
                                                    <img src="https://st4.depositphotos.com/14953852/24787/v/450/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg"
                                                        alt="Bus Image" v-if="bus.bus_image === 'Na'"
                                                        class="img-fluid rounded-start" />
                                                    <img :src="bus.bus_image" alt="Bus Image" v-else
                                                        class="img-fluid rounded-start" />
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-8">
                                                                <h5 class="card-title">{{ bus.name }}</h5>
                                                                <p class="card-text" style="font-size: small;">
                                                                    Route: {{ bus.from }} to {{ bus.to }} <br />
                                                                    Departure: {{ bus.departure_time }} <br />
                                                                    Arrival: {{ bus.arrival_time }} <br />
                                                                    Category: {{ bus.category_name }} <br />
                                                                    Seats Available: {{ bus.seats }}
                                                                </p>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="d-flex justify-content-end">
                                                                    <Link :href="route('booking.index', bus.id)"
                                                                        class="btn btn-primary">Book a
                                                                    Ticket</Link>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pagination -->
                                <div class="pagination pagination-primary-soft d-flex justify-content-end mb-0 mt-5">
                                    <div class="col-sm-12 col-md-6 p-0">
                                        <div class="dataTables_info column__left___padding" id="DataTables_Table_0_info"
                                            role="status" aria-live="polite">
                                            Showing {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total
                                            }} entries
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6 p-0">
                                        <div class="dataTables_paginate paging_simple_numbers column__right___padding"
                                            id="DataTables_Table_0_paginate">
                                            <nav aria-label="Page navigation" style="float: right">
                                                <ul class="pagination">
                                                    <li class="page-item page-link-attributes"
                                                        :class="pagination.current_page == 1 ? 'disabled' : ''">
                                                        <a class="page-link" href="javascript:void(0)"
                                                            @click="setPage(pagination.current_page - 1)">
                                                            <i class="fa-solid fa-angles-left"></i>
                                                        </a>
                                                    </li>
                                                    <template v-for="(page, index) in pagination.last_page">
                                                        <template
                                                            v-if="page == 1 || page == pagination.last_page || Math.abs(page - pagination.current_page) < 5">
                                                            <li class="page-item page-link-attributes" :key="index"
                                                                :class="pagination.current_page == page ? 'active' : ''">
                                                                <a class="page-link" @click="setPage(page)">{{ page
                                                                    }}</a>
                                                            </li>
                                                        </template>
                                                    </template>
                                                    <li class="page-item page-link-attributes"
                                                        :class="pagination.current_page == pagination.last_page ? 'disabled' : ''">
                                                        <a class="page-link" href="javascript:void(0)"
                                                            @click="setPage(pagination.current_page + 1)">
                                                            <i class="fa-solid fa-angles-right"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </nav>
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
import { onMounted, onBeforeUnmount, ref } from "vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import axios from "axios";
import Swal from "sweetalert2";
import invalidImage from '@/../src/AdminArea/img/product/invalid_image.png';
import { emitter, CART_REFRESH } from "@/event-bus.js";

const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});

const buses = ref([]);

const filterForm = ref({
    route_from: "",
    route_to: "",
    departure_time: "",
    arrival_time: "",
});

const applyFilters = async () => {
    page.value = 1;
    reload();
};

const clearFilters = async () => {
    filterForm.value.route_from = "";
    filterForm.value.route_to = "";
    filterForm.value.departure_time = "";
    filterForm.value.arrival_time = "";
    page.value = 1;
    reload();
};

const reload = async () => {
    try {
        const response = (
            await axios.get(route("buses.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    route_from: filterForm.value.route_from,
                    route_to: filterForm.value.route_to,
                    departure_time: filterForm.value.departure_time,
                    arrival_time: filterForm.value.arrival_time,
                },
            })
        ).data;

        buses.value = response.data;
        pagination.value = response;
    } catch (error) {
        console.log("Error", error);
    }
};

onMounted(() => {
    reload();
});

const getSearch = () => {
    page.value = 1;
    reload();
}

const perPageChange = async () => {
    reload();
}

const setPage = async (nextPage) => {
    page.value = nextPage;
    reload();
}

</script>

<style lang="scss">
.with-currency {
    padding-left: 5px;
}

.input-group-text {
    left: 0;
    top: 0;
    bottom: 0;
    display: flex;
    background-color: #fff;
}

.page-link-attributes {
    cursor: pointer;
}
</style>
