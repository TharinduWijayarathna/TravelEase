<template>
    <AdminLayout>
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body row">
                        <div class="col-lg-8 align-items-center py-4">
                            <h6 class="h2 text-maroon d-inline-block mb-0">Order Managements</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block ">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('admin.dashboard')" class="text-dark">
                                        <i class="fa-solid fa-house"></i>
                                        </Link>
                                    </li>
                                    <li class="breadcrumb-item active breadcrumb-yellow" aria-current="page">
                                        Orders
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-4 text-right py-4">
                            <button type="button" class="btn btn-primary btn btn-sm btn-neutral" data-toggle="modal"
                                @click.prevent="showNewOrderModal()" data-target="#exampleModal">
                                <i class="fa-solid fa-circle-plus"></i> ADD NEW
                            </button>
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
                                    <div class="">Code</div>
                                    <div class="inline-block ">
                                        <input type="text" class="form-control form-control-sm" name="code" id="code"
                                            v-model="search_code" @keyup="getSearch" placeholder="Code" />
                                    </div>
                                </div>
                                <div class="items-center text-muted mx-1">
                                    <div class="">DATE FROM</div>
                                    <div class="inline-block ">
                                        <input type="date" class="form-control form-control-sm" name="date_from"
                                            id="date_from" v-model="search_date_from" @keyup="getSearch"
                                            placeholder="date" />
                                    </div>
                                </div>
                                <div class="items-center text-muted mx-1">
                                    <div class="">DATE TO</div>
                                    <div class="inline-block ">
                                        <input type="date" class="form-control form-control-sm" name="date_to"
                                            id="date_to" v-model="search_date_to" @keyup="getSearch"
                                            placeholder="date" />
                                    </div>
                                </div>
                                <div class="items-center text-muted mx-1">
                                    <div class="">Customer Name</div>
                                    <div class="inline-block ">
                                        <input type="text" class="form-control form-control-sm" name="customer_name"
                                            id="customer_name" v-model="search_customer_name" @keyup="getSearch"
                                            placeholder="Customer Name" />
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
                                        <Multiselect v-model="select_is_shipped" :options="isShipped"
                                            :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                            :searchable="true" placeholder="Select Status" label="name" track-by="id" />
                                    </div>
                                </div>
                                <div class="text-muted mx-1">
                                    <div class="mt-2">
                                        <button @click.prevent="clearFilter()" class="btn btn-ash float-end mt-2 pt-2">
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
                                            <th class="textClassHead text-left">
                                                CODE
                                            </th>
                                            <th class="textClassHead text-left">
                                                DATE
                                            </th>
                                            <th class="textClassHead text-left">
                                                CUSTOMER CODE
                                            </th>
                                            <th class="textClassHead text-left">
                                                CUSTOMER NAME
                                            </th>
                                            <th class="textClassHead text-left">
                                                CUSTOMER EMAIL
                                            </th>
                                            <th class="textClassHead text-right">
                                                TOTAL
                                            </th>
                                            <th class="textClassHead text-center">
                                                IS PAID
                                            </th>
                                            <th class="textClassHead text-center">
                                                IS SHIPPED
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="value in orderData" :key="value.id" @click.prevent="edit(value.id)">
                                            <td class="textClassBody text-left">
                                                {{ value.code }}
                                            </td>
                                            <td class="textClassBody">
                                                {{ removeTFromTimestamp(value.updated_at) }}
                                            </td>
                                            <td class="textClassBody">
                                                {{ value.customer_code }}
                                            </td>
                                            <td class="textClassBody">
                                                {{ value.customer_name }}
                                            </td>
                                            <td class="textClassBody">
                                                {{ value.customer_email }}
                                            </td>
                                            <td class="textClassBody text-right">
                                                Rs.{{ numberFormatter(value.total) }}
                                            </td>
                                            <td class="textClassBody text-center">
                                                <div class="" v-if="value.is_paid == 1">
                                                    <span class="badge badge-success">PAID</span>
                                                </div>
                                                <div class="" v-else>
                                                    <span class="badge bg-light">NOT PAID</span>
                                                </div>
                                            </td>
                                            <td class="textClassBody text-center">
                                                <div class="" v-if="value.is_shipped == 1">
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
                                            <li class="page-item"
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

        <template #modals>
            <div class="modal fade" id="newOrderModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newVendorModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                                id="add_brandLabel">
                                New Order
                            </h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close"
                                @click.prevent="resetData()">
                                <span aria-hidden="true">
                                    <i class="fa fa-times"></i>
                                </span>
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="card-plain">
                                <div class="card-body">
                                    <form role="form text-left" enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-3 col-form-label">
                                                SELECT
                                            </div>
                                            <div class="col-md-9" v-if="select_customer">
                                                <Multiselect v-model="select_customer" :options="customerData.map(customer => ({
                                                    ...customer,
                                                    name: truncateText(customer.first_name),
                                                    searchableText: `${customer.code} : ${truncateText(customer.first_name)}`
                                                }))" :showLabels="false" :close-on-select="true" :searchable="true"
                                                    placeholder="Select Customer" label="searchableText" track-by="id"
                                                    class="z__index" max-height="200" @change="onSearchCustomer" />
                                                <small id="first_name"
                                                    class="text-danger form-text text-error-msg error"> </small>
                                            </div>
                                        </div>

                                        <div class="row mb-1 mt-4">
                                            <div for="code" class="col-md-3 col-form-label">
                                                FIRST NAME
                                            </div>
                                            <div class="col-md-9" v-if="select_customer_data">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="first_name" id="name" placeholder="First name"
                                                    v-model="select_customer_data.first_name" required />
                                                <small id="first_name"
                                                    class="text-danger form-text text-error-msg error"> </small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="price" class="col-md-3 col-form-label">
                                                LAST NAME
                                            </div>
                                            <div class="col-md-9" v-if="select_customer_data">
                                                <input type="text" class="form-control form-control-sm" name="last_name"
                                                    id="last_name" placeholder="last name"
                                                    v-model="select_customer_data.last_name" required />
                                            </div>
                                            <small id="msg_code"
                                                class="text-danger form-text text-error-msg error"></small>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="email" class="col-md-3 col-form-label">
                                                EMAIL
                                            </div>
                                            <div class="col-md-9" v-if="select_customer_data">
                                                <input type="email" class="form-control form-control-sm" name="email"
                                                    id="email" placeholder="email" v-model="select_customer_data.email"
                                                    required />
                                                <small id="email" class="text-danger form-text text-error-msg error">
                                                </small>
                                            </div>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="button"
                                                class="btn btn-primary btn btn-sm btn-neutral float-end"
                                                @click.prevent="createOrder()">
                                                <i class="fas fa-save"></i>
                                                CREATE
                                            </button>
                                        </div>
                                    </form>
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
import { ref, onMounted, watch } from "vue";
import { router, Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import Multiselect from "vue-multiselect";

const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});
const search_code = ref(null);
const search_date_from = ref();
const search_date_to = ref();
const search_customer_name = ref();
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
const customerData = ref([]);
const select_customer = ref([]);
const select_customer_data = ref([]);

const createOrder = async () => {
    try {
        console.log('select_customer_data', select_customer_data);
        const response = await axios.post(
            route("admin.order.store", select_customer_data.value.id),
            select_customer_data.value);
        $("#newOrderModal").modal("hide");
        router.visit(route("admin.order.edit", response.data.id));
    } catch (error) {
        console.log("Error:", error);
    }
};

const getCustomers = async () => {
    console.log('respose');
    try {
        const response = await axios.get(route("admin.customer.all"));
        customerData.value = response.data.data;
    } catch (error) {
        console.log("Error", error);
    }
};

const truncateText = (text) => {
    if (text && typeof text === 'string') {
        return text.length > 30 ? text.substring(0, 30) + '...' : text;
    }
    return '';
};

const edit = (order_id) => {
    try {
        router.visit(route("admin.order.edit", order_id));
    } catch (error) {
        console.lod("Error", error);
    }
}

const removeTFromTimestamp = (timestamp) => {
    return timestamp.replace(/T\d{2}:\d{2}:\d{2}\.\d+Z/, '');
};

const reload = async () => {
    try {
        const response = (
            await axios.get(route("admin.order.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    code: search_code.value,
                    date_from: search_date_from.value,
                    date_to: search_date_to.value,
                    customer_name: search_customer_name.value,
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
        search_customer_name.value = null;
        select_is_paid.value = [];
        select_is_shipped.value = [];
        reload();
    } catch (error) {
        console.log('Error', error);
    }
}

watch(select_customer, (newCustomer) => {
    onSearchCustomer(newCustomer.id)
});

const onSearchCustomer = async (customer_id) => {
    try {
        const response = await axios.get(route("admin.customer.get", customer_id));
        select_customer_data.value = response.data.customer;
    } catch (error) {
        console.log("Error", error);
    }
};

onMounted(() => {
    getCustomers();
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

const showNewOrderModal = () => {
    $("#newOrderModal").modal("show");
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

.cursor-pointer {
    cursor: pointer;
}
</style>
