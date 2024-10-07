<template>
    <AdminLayout>
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body row">
                        <div class="col-lg-8 align-items-center py-4">
                            <h6 class="h2 text-maroon d-inline-block mb-0">Bookings Management</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block ">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('admin.dashboard')" class="text-dark">
                                        <i class="fa-solid fa-house"></i>
                                        </Link>
                                    </li>
                                    <li class="breadcrumb-item active breadcrumb-yellow" aria-current="page">
                                        Bookings Management
                                    </li>
                                </ol>
                            </nav>
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
                                    <div class="">Status</div>
                                    <div class="inline-block" style="width: 200px;">
                                        <Multiselect v-model="select_customer_status" :options="statusList"
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
                                                Payment Amount
                                            </th>
                                            <th class="textClassHead" style="width: 14%;">
                                                Requests
                                            </th>
                                            <th class="textClassHead text-center">
                                                Action
                                            </th>

                                            <!-- <th class="textClassHead">Rating</th> -->

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="value in customerData" :key="value.id"
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
                                                {{ value.payment }}
                                            </td>
                                            <td class="textClassBody">
                                                {{ value.requests }}
                                            </td>
                                            <td class="textClassBody text-center">
                                                <button class="btn btn-sm btn-outline-info"
                                                    @click.prevent="changeStatus(value.id)">
                                                    <i class="fa fa-arrow-alt-circle-right"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger"
                                                    @click.prevent="rejectBooking(value.id)">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-success"
                                                    @click.prevent="restoreBooking(value.id)">
                                                    <i class="fa fa-undo"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-dark"
                                                    @click.prevent="addPayment(value.id)">
                                                    <i class="fa fa-cash-register"></i>
                                                </button>
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

        <template #modals>
            <div class="modal fade" id="newcustomerModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newVendorModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                                id="add_brandLabel">
                                New customer
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
                                                FIRST NAME
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="first_name" id="name" placeholder="First name"
                                                    v-model="customer.first_name" required />
                                                <small v-if="validationErrors.first_name" id="first_name"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.first_name }}</small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="price" class="col-md-3 col-form-label">
                                                LAST NAME
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="last_name"
                                                    id="last_name" placeholder="last name" v-model="customer.last_name"
                                                    required />
                                            </div>
                                            <small id="msg_code"
                                                class="text-danger form-text text-error-msg error"></small>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="email" class="col-md-3 col-form-label">
                                                EMAIL
                                            </div>
                                            <div class="col-md-9">
                                                <input type="email" class="form-control form-control-sm" name="email"
                                                    id="email" placeholder="email" v-model="customer.email" required />
                                                <small v-if="validationErrors.email" id="email"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.email }}</small>
                                            </div>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="button"
                                                class="btn btn-primary btn btn-sm btn-neutral float-end"
                                                @click.prevent="createcustomer()">
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

            <div class="modal fade" id="addPaymentModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="addPaymentModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                                id="add_brandLabel">
                                Add Payment
                            </h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close"
                                @click.prevent="resetData()">
                                <span aria-hidden="true">
                                    <i class="fa fa-times"></i>
                                </span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-plain p-2">
                                <div class="card-body">
                                    <form role="form text-left" enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-3 col-form-label">
                                                AMOUNT
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="payment_amount" id="payment_amount" placeholder="Amount"
                                                    v-model="payment" required />
                                            </div>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="button"
                                                class="btn btn-primary btn btn-sm btn-neutral float-end"
                                                @click.prevent="CreatePayment()">
                                                <i class="fas fa-save"></i>
                                                ADD
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
import Multiselect from "vue-multiselect";
import { ref, onMounted, watch } from "vue";
import { router, Link } from "@inertiajs/vue3";
import productImage from '@/../src/AdminArea/img/product/invalid_image.png';
import Swal from "sweetalert2";

const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});
const customer_code = ref(null);
const first_name = ref(null);
const last_name = ref(null);
const email = ref(null);
const select_customer_status = ref([]);
const statusList = ref([
    { id: 1, name: 'Pending' },
    { id: 2, name: 'Approved' },
    { id: 3, name: 'Rejected' },
    { id: 4, name: 'Payment Pending' }
]);
const payment = ref(null);
const booking_id = ref(null);

const customerData = ref([]);
const customer = ref({});
const validationErrors = ref({});
const validationMessage = ref(null);

const resetValidationErrors = () => {
    validationErrors.value = {};
    validationMessage.value = null;
};

const convertValidationNotification = (error) => {
    resetValidationErrors();
    if (!(error.response && error.response.data)) return;
    const { message } = error.response.data;

    errorMessage(message);
};

const convertValidationError = (err) => {
    resetValidationErrors();
    if (!(err.response && err.response.data)) return;
    const { message, errors } = err.response.data;
    validationMessage.value = message;
    if (errors) {
        for (const error in errors) {
            validationErrors.value[error] = errors[error][0];
        }
    }
};

const reload = async () => {
    try {
        const response = (
            await axios.get(route("admin.booking.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    status: select_customer_status.value?.id,
                    code: customer_code.value,
                },
            })
        ).data;
        customerData.value = response.data;
        pagination.value = response;
    } catch (error) {
        console.log("Error", error);
    }
};

const clearFilter = () => {
    try {
        select_customer_status.value = null;
        customer_code.value = null;
        first_name.value = null;
        last_name.value = null;
        email.value = null;
        reload();
    } catch (error) {
        console.log('Error', error);
    }
}

const resetData = () => {
    validationErrors.value = "";
    validationMessage.value = "";
    customer.value.first_name = '';
    customer.value.last_name = '';
    customer.value.email = '';
}

const changeStatus = async (id) => {
    try {
        const response = await axios.get(route("admin.booking.changeStatus", id));
        reload();
        successMessage();
    } catch (error) {
        errorMessage();
        console.log("Error", error);
    }
};

const rejectBooking = async (id) => {
    try {
        const response = await axios.get(route("admin.booking.reject", id));
        reload();
        successMessage();
    } catch (error) {
        errorMessage();
        console.log("Error", error);
    }
};

const restoreBooking = async (id) => {
    try {
        const response = await axios.get(route("admin.booking.restore", id));
        reload();
        successMessage();
    } catch (error) {
        errorMessage();
        console.log("Error", error);
    }
};

const addPayment = async (id) => {
    payment.value = '';
    booking_id.value = id;
    $('#addPaymentModal').modal('show');
    customer.value = customerData.value.find((customer) => customer.id === id);
}

const CreatePayment = async () => {
    try {
        const response = await axios.post(route("admin.booking.addPayment", booking_id.value), {
            payment: payment.value
        });
        $('#addPaymentModal').modal('hide');
        reload();
        successMessage();
    } catch (error) {
        convertValidationError(error);
        console.log("Error", error);
    }
};

onMounted(() => {
    reload();
});

watch([page, pageCount], () => {
    reload();
});

watch(() => {
    if (select_customer_status.value) {
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

.cursor-pointer {
    cursor: pointer;
}
</style>
