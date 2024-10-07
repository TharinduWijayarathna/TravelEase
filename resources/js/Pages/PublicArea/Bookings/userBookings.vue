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
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th class="textClassHead text-center" style="width: 14%;">
                                                        Status
                                                    </th>
                                                    <th class="textClassHead text-left" style="width: 14%;">
                                                        Customer
                                                    </th>
                                                    <th class="textClassHead text-left" style="width: 14%;">
                                                        Email
                                                    </th>
                                                    <th class="textClassHead text-left" style="width: 14%;">
                                                        Pick Up
                                                    </th>
                                                    <th class="textClassHead" style="width: 14%;">
                                                        Drop Off
                                                    </th>
                                                    <th class="textClassHead" style="width: 14%;">
                                                        Date
                                                    </th>
                                                    <th class="textClassHead" style="width: 14%;">
                                                        Seats
                                                    </th>
                                                    <th class="textClassHead" style="width: 14%;">
                                                        Requests
                                                    </th>
                                                    <th class="textClassHead text-center">
                                                        Actions
                                                    </th>
                                                    <!-- <th class="textClassHead text-center">
                                                Profile Image
                                            </th> -->

                                                    <!-- <th class="textClassHead">Rating</th> -->

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="value in bookings" :key="value.id"
                                                    @click.prevent="edit(value.id)">
                                                    <td class="textClassBody text-center">
                                                        <div class="" v-if="value.status === 'PENDING'">
                                                            <span class="badge badge-warning">Pending</span>
                                                        </div>
                                                        <div class="" v-else-if="value.status === 'APPROVED'">
                                                            <span class="badge badge-success">Approved</span>
                                                        </div>
                                                        <div class="" v-else-if="value.status === 'REJECTED'">
                                                            <span class="badge badge-danger">Rejected</span>
                                                        </div>
                                                        <div class="" v-else-if="value.status === 'PAYMENT_PENDING'">
                                                            <span class="badge badge-info">Payment Pending</span>
                                                        </div>
                                                    </td>

                                                    <td class="textClassBody text-left">
                                                        {{ value.name }}
                                                    </td>
                                                    <td class="textClassBody text-left">
                                                        {{ value.email }}
                                                    </td>
                                                    <td class="textClassBody">
                                                        {{ value.pickup_name }}
                                                    </td>
                                                    <td class="textClassBody">
                                                        {{ value.dropoff_name }}
                                                    </td>
                                                    <td class="textClassBody">
                                                        {{ value.date }}
                                                    </td>
                                                    <td class="textClassBody">
                                                        {{ value.seats }}
                                                    </td>
                                                    <td class="textClassBody">
                                                        {{ value.requests }}
                                                    </td>

                                                    <td class="textClassBody text-center">
                                                        <button class="btn btn-sm btn-primary" @click.prevent="pay(value.id)" :disabled="value.status !== 'PAYMENT_PENDING'">
                                                            Pay
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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
import { onMounted, ref } from "vue";
import { Link } from "@inertiajs/vue3";
import axios from "axios";
import Swal from "sweetalert2";


const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});

const bookings = ref([]);

const reload = async () => {
    try {
        const response = (
            await axios.get(route("booking.user.data"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                },
            })
        ).data;

        bookings.value = response.data;
        pagination.value = response;
    } catch (error) {
        console.log("Error", error);
    }
};

const pay = async (id) => {
    try {
       Swal.fire({
            title: 'Are you sure?',
            text: "You want to pay for this booking?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Pay!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = route('booking.pay', id);
            }
        });
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

.badge {
    font-size: 0.8rem;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
}

.badge-warning {
    background-color: #ffc107;
    color: #000;
}

.badge-success {
    background-color: #28a745;
    color: #fff;
}

.badge-danger {
    background-color: #dc3545;
    color: #fff;
}

.badge-info {
    background-color: #17a2b8;
    color: #fff;
}
</style>
