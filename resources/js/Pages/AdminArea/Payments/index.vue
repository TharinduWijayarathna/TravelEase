<template>
    <AdminLayout>
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body row">
                        <div class="col-lg-8 align-items-center py-4">
                            <h6 class="h2 text-maroon d-inline-block mb-0">Payment Management</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block ">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('admin.dashboard')" class="text-dark">
                                        <i class="fa-solid fa-house"></i>
                                        </Link>
                                    </li>
                                    <li class="breadcrumb-item active breadcrumb-yellow" aria-current="page">
                                        Payment Management
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-4 text-right py-4">

                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #content>
            <div class="row">
                <div class="col-lg-12 mt-0">
                    <div class="card shadow">
                        <div class="py-3 filters-margin mx-3 text-sm card-body">
                            <div class="flex">
                                <div class="items-center text-muted mx-1">
                                    <div class="">Payment Method</div>
                                    <div class="inline-block" style="width: 200px;">
                                        <input type="text" class="form-control form-control-sm" v-model="payment_method"
                                            placeholder="Payment Method" @keyup.enter="getSearch" />
                                    </div>
                                </div>
                                <div class="items-center text-muted mx-1">
                                    <div class="">Payment Date</div>
                                    <div class="inline-block" style="width: 200px;">
                                        <input type="date" class="form-control form-control-sm" v-model="payment_date"
                                            placeholder="Payment Date" @keyup.enter="getSearch" />
                                    </div>
                                </div>
                                <div class="text-muted mx-1">
                                    <div class="mt-2">
                                        <button @click.prevent="clearFilter()"
                                            class="btn btn-ash float-end mt-2 pt-2">
                                            <i class="fa fa-refresh" aria-hidden="true" />
                                        </button>
                                    </div>
                                </div>
                                <div class="flex text-muted ml-auto mt-4">
                                    <div class="inline-block">
                                        <select class="form-control form-control-sm per-page-entry" :value="25"
                                            v-model="pageCount" @change="perPageChange">
                                            <option v-for="perPageCount in perPage" :key="perPageCount"
                                                :value="perPageCount" v-text="perPageCount" />
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mx-4">
                            <div class="table-responsive">
                                <div class="d-flex flex-row mb-3 rounded">
                                    <div class="left d-flex"></div>
                                </div>
                                <table class="table">
                                    <thead>

                                        <tr>
                                            <th class="textClassHead text-center" style="width: 14%;">
                                                Booking ID
                                            </th>
                                            <th class="textClassHead text-left" style="width: 14%;">
                                               Customer
                                            </th>
                                            <th class="textClassHead text-left" style="width: 14%;">
                                                Price
                                            </th>
                                            <th class="textClassHead text-left" style="width: 14%;">
                                                Payment Method
                                            </th>
                                            <th class="textClassHead" style="width: 14%;">
                                                Payment Status
                                            </th>

                                            <th class="textClassHead text-right" style="width: 14%;">
                                                Payment Reference
                                            </th>
                                            <th class="textClassHead text-right" style="width: 14%;">
                                                Payment Date
                                            </th>
                                            <!-- <th class="textClassHead">Rating</th> -->

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="value in paymentData" :key="value.id"
                                            @click.prevent="edit(value.id)">

                                            <td class="textClassBody text-left">
                                                {{ value.booking_id }}
                                            </td>
                                            <td class="textClassBody text-left">
                                                {{ value.customer_name }}
                                            </td>
                                            <td class="textClassBody text-left">
                                                {{ value.price }}
                                            </td>
                                            <td class="textClassBody text-left">
                                                {{ value.payment_method }}
                                            </td>

                                            <td class="textClassBody text-left">
                                                {{ value.payment_status }}
                                            </td>
                                            <td class="textClassBody text-left">
                                                {{ value.payment_reference }}
                                            </td>
                                            <td class="textClassBody text-left">
                                                {{ value.payment_date }}
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex mt-1 px-3 mx-1 card-footer table-footer align-items-center">
                            <div class="col-sm-12 col-md-6 p-0">
                                <div class="dataTables_info column__left___padding" id="DataTables_Table_0_info"
                                    role="status" aria-live="polite">
                                    Showing {{ pagination.from }} to
                                    {{ pagination.to }} of
                                    {{ pagination.total }} entries
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 p-0">
                                <div class="dataTables_paginate paging_simple_numbers column__right___padding"
                                    id="DataTables_Table_0_paginate">
                                    <nav aria-label="Page navigation" style="float: right">
                                        <ul class="pagination">
                                            <li class="page-item "
                                                :class="pagination.current_page == 1 ? 'disabled' : ''">
                                                <a class="page-link" href="javascript:void(0)"
                                                    @click="setPage(pagination.current_page - 1)">
                                                    <i class="fa-solid fa-angles-left"></i>
                                                </a>
                                            </li>
                                            <template v-for="(page, index) in pagination.last_page">
                                                <template
                                                    v-if="page == 1 || page == pagination.last_page || Math.abs(page - pagination.current_page) < 5">
                                                    <li class="page-item cursor-pointer" :key="index"
                                                        :class="pagination.current_page == page ? 'active' : ''">
                                                        <a class="page-link" @click="setPage(page)">{{ page }}</a>
                                                    </li>
                                                </template>
                                            </template>
                                            <li class="page-item"
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
        </template>

    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import axios from "axios";
import Multiselect from "vue-multiselect";
import { ref, onMounted, watch } from "vue";
import { router, Link } from "@inertiajs/vue3";
import productImage from '@/../src/AdminArea/img/product/invalid_image.png';
import Swal from "sweetalert2";

const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});

const payment_method = ref(null);
const payment_date = ref(null);
const paymentData = ref([]);


const reload = async () => {
    try {
        const response = (
            await axios.get(route("admin.payment.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    payment_method: payment_method.value,
                    payment_date: payment_date.value,
                },
            })
        ).data;
        paymentData.value = response.data;
        pagination.value = response;
    } catch (error) {
        console.log("Error", error);
    }
};

const clearFilter = () => {
    try {
        payment_method.value = null;
        payment_date.value = null;
        reload();
    } catch (error) {
        console.log('Error', error);
    }
}

onMounted(() => {
    reload();
});

watch([page, pageCount], () => {
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

<style scoped>
.badge-dark {
    color: white;
}

.textClassBody {
    vertical-align: middle;
}

.cursor-pointer{
    cursor: pointer;
}
</style>
