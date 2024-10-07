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
                                    My Bookings
                                </li>
                            </ol>
                        </nav>
                        <h1 class="h3 mb-0 mt-3">
                            My Bookings
                        </h1>
                    </div>
                </section>

                <section class="pt-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 ps-xl-12">
                                <!-- Card View for each Bus -->
                                <div class="row">
                                    <div class="col-12">
                                        <div v-for="bus in buses" :key="bus.id" class="card mb-4 shadow-sm">
                                            <div class="row g-0">
                                                <div class="col-md-4">
                                                    <!-- Bus Image (Optional) -->
                                                    <img :src="bus.bus_image" alt="Bus Image"
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
                                                                    <Link :href="route('booking.index')"
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

const wishList = ref({});
const checkWishList = ref([]);
const wishListStatus = ref([]);
const buses = ref([]);
const categories = ref({});
const sortBy = ref("");
const busName = ref("");
const user = usePage().props.auth.user;
const busData = ref({
    unit_price: '',
    unit_discount: '',

});
const filterForm = ref({
    selected_category: [],
});

const isInWishlist = async () => {
    try {
        var customer_id = user.id;
        const response = await axios.get(route('wishList.check', { customer_id }));
        checkWishList.value = response.data;
        const busIds = buses.value.map(bus => bus.id);
        const wishListbusIds = checkWishList.value.map(item => item.bus_id);
        busIds.forEach((busId, index) => {
            if (wishListbusIds.includes(busId)) {
                const statusIndex = wishListbusIds.indexOf(busId);
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
        reload();
    } catch (error) {
        console.error('Error:', error);
    }
};

const getCategories = async () => {
    try {
        const response = (
            await axios.get(route("category.all"))
        ).data;
        categories.value = response.data;
    } catch (error) {
        console.log("Error", error);
    }
};

const reload = async () => {
    try {
        const response = (
            await axios.get(route("buses.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                },
            })
        ).data;

        buses.value = response.data;
        pagination.value = response;
    } catch (error) {
        console.log("Error", error);
    }
};

const getSelectedbusData = async (bus_id) => {
    try {
        const response = await axios.get(route('bus.get', bus_id));
        busData.value.unit_price = response.data.price;
        busData.value.unit_discount = response.data.discount_price;
    } catch (error) {
        console.log('Error', error);
    }
}

const addToCard = async (bus_id) => {
    try {
        await getSelectedbusData(bus_id);
        const customer_id = user.id;
        busData.value.created_by = user.first_name;
        const response = await axios
            .post(route("cart.item.store", { customer_id, bus_id }), busData.value)
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "bus added to cart!",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                });
                emitter.emit(CART_REFRESH);
                reload();
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

const updateAvailability = (value) => {
    filterForm.value.availability = value;
};

const filterBuses = async () => {
    try {
        const response = (
            await axios.post(route("bus.filter"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    filterForm: filterForm.value,
                },
            })
        ).data;
        console.log('im filter', response.data.length);
        buses.value = response.data;
        if (response.data && response.data.length > 0) {

            Swal.fire({
                icon: "success",
                title: "Success",
                text: "bus filter successfully!",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
        } else {
            Swal.fire({
                icon: "warning",
                title: "Oops!",
                text: "No matching buses found.",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        }
    } catch (error) {
        console.log("Error:", error);
        Swal.fire({
            icon: "warning",
            title: "Oops!",
            text: "An error occurred. Please try again later.",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    }

};

const clearFilter = () => {
    // filterForm.value = [];
    // filterForm.value.availability = "all";
    router.visit(route('buses.index'));
};

const sortbuses = () => {
    console.log(sortBy.value);
    try {
        if (sortBy.value == 1) {
            buses.value = buses.value.sort((a, b) =>
                a.name.localeCompare(b.name)
            );
        } else if (sortBy.value == 2) {
            buses.value = buses.value.sort((a, b) => a.price - b.price);
        } else if (sortBy.value == 3) {
            buses.value = buses.value.sort((a, b) => b.price - a.price);
        }
    } catch (error) {
        console.log("Error", error);
    }
};

const searchByName = async () => {
    try {
        const response = await axios.post(route("bus.search"), {
            name: busName.value,
        });
        console.log("pr by name", response.data.searched_bus);
        buses.value = response.data.searched_bus;
    } catch (error) {
        console.log("Error", error);
    }
};

const addToWishList = async (bus_id) => {
    try {
        const customer_id = user.id;
        const response = await axios.post(route('wishList.add', { customer_id, bus_id }));
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
            title: "bus successfully added to your wishlist."
        });
        reload();
        isInWishlist();
        console.log('white list', response);
    } catch (error) {
        console.log('Error', error);
    }
}

const removeFromWishList = async (bus_id) => {
    try {
        const customer_id = user.id;
        const response = await axios.post(route('wishList.remove', { customer_id, bus_id }));
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
            title: "bus successfully removed from your wishlist",
        });

        reload();
        isInWishlist();
    } catch (error) {
        console.log('Error', error);
    }
}


onMounted(() => {
    getCategories();
    reload();
    isInWishlist();
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
