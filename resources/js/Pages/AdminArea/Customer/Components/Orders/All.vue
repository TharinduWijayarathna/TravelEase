<template>
    <div class="row">
        <div class="col-lg-12 mt-0">
            <div class="card shadow">
                <div class="py-3 filters-margin mx-3 text-sm card-body">
                    <div class="flex">

                        <div class="items-center text-muted mx-1">
                            <div class="">Order Code</div>
                            <div class="inline-block ">
                                <input type="text" class="form-control form-control-sm" name="order_code" id="order_code"
                                    v-model="search_code" @keyup="getSearch" placeholder="Order Code" />
                            </div>
                        </div>
                        <!-- <div class="items-center text-muted mx-1">
                            <div class="">Cart Code</div>
                            <div class="inline-block ">
                                <input type="text" class="form-control form-control-sm" name="search_cart_code" id="search_cart_code"
                                    v-model="search_cart_code" @keyup="getSearch" placeholder="Cart Code" />
                            </div>
                        </div> -->
                        <div class="items-center text-muted mx-1">
                                    <div class="">DATE FROM</div>
                                    <div class="inline-block ">
                                        <input type="date" class="form-control form-control-sm" name="date_from" id="date_from"
                                            v-model="search_date_from" @keyup="getSearch" placeholder="date" />
                                    </div>
                                </div>
                                <div class="items-center text-muted mx-1">
                                    <div class="">DATE TO</div>
                                    <div class="inline-block ">
                                        <input type="date" class="form-control form-control-sm" name="date_to" id="date_to"
                                            v-model="search_date_to" @keyup="getSearch" placeholder="date" />
                                    </div>
                                </div>

                        <div class="items-center text-muted mx-1">
                            <div class="">Is Paid</div>
                            <div class="inline-block" style="width: 200px;">
                                <Multiselect v-model="select_is_paid" :options="isPaid" :showLabels="false"
                                    :close-on-select="true" :clear-on-select="false" :searchable="true"
                                    placeholder="Select Status" label="name" track-by="id" />
                            </div>
                        </div>
                        <div class="items-center text-muted mx-1">
                            <div class="">Is Shipped</div>
                            <div class="inline-block" style="width: 200px;">
                                <Multiselect v-model="select_is_shipped" :options="isShipped" :showLabels="false"
                                    :close-on-select="true" :clear-on-select="false" :searchable="true"
                                    placeholder="Select Status" label="name" track-by="id" />
                            </div>
                        </div>
                        <div class="text-muted mx-1">
                            <div class="mt-2">
                                <button @click.prevent="clearFilter()" class="btn btn-sm btn-ash float-end mt-2 pt-2">
                                    CLEAR
                                </button>
                            </div>
                        </div>
                        <div class="flex text-muted ml-auto mt-4">
                            <div class="inline-block">
                                <select class="form-control form-control-sm per-page-entry" :value="25"
                                    v-model="pageCount" @change="perPageChange">
                                    <option v-for="perPageCount in perPage" :key="perPageCount" :value="perPageCount"
                                        v-text="perPageCount" />
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
                                    <th class="textClassHead text-left" style="width: 2%;">
                                        ORDER CODE
                                    </th>
                                    <!-- <th class="textClassHead text-left">
                                        CART CODE
                                    </th> -->
                                    <th class="textClassHead text-left" style="width: 2%;">
                                        DATE
                                    </th>
                                    <th class="textClassHead text-right" style="width: 0%;">
                                        TOTAL
                                    </th>
                                    <th class="textClassHead text-center" style="width: 2%;">
                                        IS PAID
                                    </th>
                                    <th class="textClassHead text-center" style="width: 2%;">
                                        IS SHIPPED
                                    </th>
                                </tr>
                            </thead>
                           
                            <tbody>
                                <tr v-for="value in orderData" :key="value.id">
                                    <td class="textClassBody text-left">
                                        {{ value?.code }}
                                    </td>
                                    <!-- <td class="textClassBody text-left">
                                        {{ value?.cart_code }}
                                    </td> -->
                                    <td class="textClassBody">
                                        {{ removeTFromTimestamp(value.updated_at) }}
                                    </td>
                                    <td class="textClassBody text-right">
                                        Rs.{{ numberFormatter(value?.total) }}
                                    </td>
                                    <td class="textClassBody text-center">
                                        <div class="" v-if="value?.is_paid == 1">
                                            <span class="badge badge-success">PAID</span>
                                        </div>
                                        <div class="" v-else>
                                            <span class="badge bg-light">NOT PAID</span>
                                        </div>
                                    </td>
                                    <td class="textClassBody text-center">
                                        <div class="" v-if="value?.is_shipped == 1">
                                            <span class="badge badge-success">SHIPPED</span>
                                        </div>
                                        <div class="" v-else>
                                            <span class="badge bg-light">NOT SHIPPED</span>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex mt-1 px-3 mx-1 card-footer table-footer align-items-center">
                    <div class="col-sm-12 col-md-6 p-0">
                        <div class="dataTables_info column__left___padding" id="DataTables_Table_0_info" role="status"
                            aria-live="polite">
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
                                    <li class="page-item" :class="pagination.current_page == 1 ? 'disabled' : ''">
                                        <a class="page-link" href="javascript:void(0)"
                                            @click="setPage(pagination.current_page - 1)">
                                            <i class="fa-solid fa-angles-left"></i>
                                        </a>
                                    </li>
                                    <template v-for="(page, index) in pagination.last_page">
                                        <template
                                            v-if="page == 1 || page == pagination.last_page || Math.abs(page - pagination.current_page) < 5">
                                            <li class="page-item" :key="index"
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

<script setup>
import axios from "axios";
import { ref, onMounted, watch } from "vue";
import { router, Link } from "@inertiajs/vue3";
import Multiselect from "vue-multiselect";

const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});
const search_code = ref(null);
const search_date_from = ref();
const search_date_to = ref();
const select_is_paid = ref([]);
const select_is_shipped = ref([]);
const isPaid = ref([
    { id: 1, name: 'Paid' },
    { id: 2, name: 'Not Paid' },
]);
const isShipped = ref([
    { id: 1, name: 'Shipped' },
    { id: 2, name: 'Not Shipped' },
]);

const orderData = ref([]);

const props = defineProps({
    customerId: {
        type: Number,
        required: true,
    },
});

const removeTFromTimestamp = (timestamp) => {
    return timestamp.replace(/T\d{2}:\d{2}:\d{2}\.\d+Z/, '');
};

const reload = async () => {
    try {
        const response = (
            await axios.get(route("admin.order.find", props.customerId), { 
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    code: search_code.value,
                    date_from: search_date_from.value,
                    date_to: search_date_to.value,
                    is_paid: select_is_paid.value.id,
                    is_shipped: select_is_shipped.value.id,

                },
            })
        ).data;
        orderData.value = response.data;
        pagination.value = response;
    } catch (error) {
        console.log("Error", error);
    }
};

const numberFormatter = (number) => {
    if (number == undefined || number == null || number == Infinity) {
        return "0.00"; // or some default value
    }
    const parsedNumber = Number(number);
    if (isNaN(parsedNumber)) {
        return "0.00"; // or some default value
    }
    if (typeof parsedNumber !== "number") {
        return "0.00"; // or some default value
    }
    return parsedNumber.toLocaleString("en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
        useGrouping: true,
    });
};

const clearFilter = () => {
    try {
        search_code.value = null;
        search_date.value = null;
        select_is_paid.value = [];
        select_is_shipped.value = [];
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

watch(() => {
    if (select_is_paid.value) {
        reload();
    } else {
        reload();
    }
})

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
</style>
