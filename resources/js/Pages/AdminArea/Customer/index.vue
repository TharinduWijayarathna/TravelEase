<template>
    <AdminLayout>
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body row">
                        <div class="col-lg-8 align-items-center py-4">
                            <h6 class="h2 text-maroon d-inline-block mb-0">Customer Managements</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block ">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('admin.dashboard')" class="text-dark">
                                        <i class="fa-solid fa-house"></i>
                                        </Link>
                                    </li>
                                    <li class="breadcrumb-item active breadcrumb-yellow" aria-current="page">
                                        Customers
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-4 text-right py-4">
                            <button type="button" class="btn btn-primary btn btn-sm btn-neutral" data-toggle="modal"
                                @click.prevent="resetData()" data-target="#newCustomerModal">
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
                                    <div class="">Status</div>
                                    <div class="inline-block" style="width: 200px;">
                                        <Multiselect v-model="select_customer_status" :options="statusList"
                                            :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                            :searchable="true" placeholder="Select Status" label="name" track-by="id" />
                                    </div>
                                </div>

                                <div class="items-center text-muted mx-1">
                                    <div class="">Customer Code</div>
                                    <div class="inline-block ">
                                        <input type="text" class="form-control form-control-sm" name="customer_code"
                                            id="customer_code" v-model="customer_code" @keyup="getSearch"
                                            placeholder="Customer Code" />
                                    </div>
                                </div>

                                <div class="items-center text-muted mx-1">
                                    <div class="">First Name</div>
                                    <div class="inline-block ">
                                        <input type="text" class="form-control form-control-sm" name="first_name"
                                            id="first_name" v-model="first_name" @keyup="getSearch"
                                            placeholder="First Name" />
                                    </div>
                                </div>

                                <div class="items-center text-muted mx-1">
                                    <div class="">Last Name</div>
                                    <div class="inline-block ">
                                        <input type="text" class="form-control form-control-sm" name="last_name"
                                            id="last_name" v-model="last_name" @keyup="getSearch"
                                            placeholder="Last Name" />
                                    </div>
                                </div>

                                <div class="items-center text-muted mx-1">
                                    <div class="">Email</div>
                                    <div class="inline-block ">
                                        <input type="text" class="form-control form-control-sm" name="category_name"
                                            id="category_name" v-model="email" @keyup="getSearch" placeholder="Email" />
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
                                                Status
                                            </th>
                                            <th class="textClassHead text-left" style="width: 14%;">
                                                Customer Code
                                            </th>
                                            <th class="textClassHead text-left" style="width: 14%;">
                                                First Name
                                            </th>
                                            <th class="textClassHead text-left" style="width: 14%;">
                                                Last Name
                                            </th>
                                            <th class="textClassHead" style="width: 14%;">
                                                email
                                            </th>
                                            <!-- <th class="textClassHead text-center">
                                                Profile Image
                                            </th> -->
                                            <th class="textClassHead text-right" style="width: 14%;">
                                                Contact Number
                                            </th>
                                            <!-- <th class="textClassHead">Rating</th> -->
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="value in CustomerData" :key="value.id"
                                            @click.prevent="edit(value.id)">
                                            <td class="textClassBody text-center">
                                                <div class="" v-if="value.status === 1">
                                                    <span class="badge badge-success">Active</span>
                                                </div>
                                                <div class="" v-else>
                                                    <span class="badge badge-warning">Inactive</span>
                                                </div>
                                            </td>
                                            <td class="textClassBody text-left">
                                                {{ value.code }}
                                            </td>
                                            <td class="textClassBody text-left">
                                                {{ value.first_name }}
                                            </td>
                                            <td class="textClassBody text-left">
                                                {{ value.last_name }}
                                            </td>
                                            <td class="textClassBody">
                                                {{ value.email }}
                                            </td>
                                            <!-- <td class="textClassBody text-center">
                                                <img width="160px" v-if="value.image_url" :src="value.image_url"
                                                    alt="" />
                                                <img v-else width="80px" src="/assets/PublicArea/images/avatar/user.jpg"
                                                    alt="" />
                                            </td> -->
                                            <td class="textClassBody text-right">
                                                {{ value.contact_number }}
                                            </td>
                                            <!-- <td class="textClassBody text-center">
                                                <div v-if="value.gender == 1">
                                                    <span>Male</span>
                                                </div>
                                                <div v-else-if="value.gender == 2">
                                                    <span>Female</span>
                                                </div>
                                                <div v-else-if="value.gender == 3">
                                                    <span>Other</span>
                                                </div>
                                            </td> -->
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
            <div class="modal fade" id="newCustomerModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newVendorModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                                id="add_brandLabel">
                                New Customer
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
                                                    v-model="Customer.first_name" required />
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
                                                    id="last_name" placeholder="last name" v-model="Customer.last_name"
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
                                                    id="email" placeholder="email" v-model="Customer.email" required />
                                                <small v-if="validationErrors.email" id="email"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.email }}</small>
                                            </div>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="button"
                                                class="btn btn-primary btn btn-sm btn-neutral float-end"
                                                @click.prevent="createCustomer()">
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
    { id: 1, name: 'Active' },
    { id: 2, name: 'Inactive' },
]);

const CustomerData = ref([]);
const Customer = ref({});
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

const edit = (customer_id) => {
    try {
        router.visit(route("admin.customer.edit", customer_id));
    } catch (error) {
        console.lod("Error", error);
    }
}

const createCustomer = async (id) => {
    try {
        const response = await axios.post(
            route("admin.customer.store"),
            Customer.value)
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "New Customer has been created",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                const customerId = response.data.id;
                resetData();
                router.visit(route("admin.customer.edit", customerId));
                $("#newCustomerModal").modal("hide");
            })
            .catch((error) => {
                convertValidationError(error);
                console.log("Error:", error);
            });
    } catch (error) {
        console.log("Error:", error);
    }
};

const reload = async () => {
    try {
        const response = (
            await axios.get(route("admin.customer.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    status: select_customer_status.value?.id,
                    code: customer_code.value,
                    first_name: first_name.value,
                    last_name: last_name.value,
                    email: email.value,
                },
            })
        ).data;
        CustomerData.value = response.data;
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
    Customer.value.first_name = '';
    Customer.value.last_name = '';
    Customer.value.email = '';
}

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

.cursor-pointer{
    cursor: pointer;
}
</style>
