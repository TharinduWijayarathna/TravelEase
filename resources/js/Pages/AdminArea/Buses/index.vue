<template>
    <AdminLayout>
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body row">
                        <div class="col-lg-8 align-items-center py-4">
                            <h6 class="h2 text-maroon d-inline-block mb-0">Bus Management</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block ">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('admin.dashboard')" class="text-dark">
                                        <i class="fa-solid fa-house"></i>
                                        </Link>
                                    </li>
                                    <li class="breadcrumb-item active breadcrumb-yellow" aria-current="page">
                                        Bus Management
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-4 text-right py-4">
                            <button type="button" class="btn btn-primary btn btn-sm btn-neutral" data-toggle="modal"
                                @click.prevent="resetData()" data-target="#newProductModal">
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
                                        <Multiselect v-model="select_product_status" :options="statusList"
                                            :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                            :searchable="true" placeholder="Select Status" label="name" track-by="id" />
                                    </div>
                                </div>
                                <div class="items-center text-muted mx-1">
                                    <div class="">Code</div>
                                    <div class="inline-block ">
                                        <input type="text" class="form-control form-control-sm" name="code" id="code"
                                            v-model="search_code" @keyup="getSearch" placeholder="Code" />
                                    </div>
                                </div>
                                <div class="items-center text-muted mx-1">
                                    <div class="">Product Name</div>
                                    <div class="inline-block ">
                                        <input type="text" class="form-control form-control-sm" name="product_name"
                                            id="product_name" v-model="search_product_name" @keyup="getSearch"
                                            placeholder="Product Name" />
                                    </div>
                                </div>
                                <div class="items-center text-muted mx-1">
                                    <div class="">Category Name</div>
                                    <div class="inline-block ">
                                        <input type="text" class="form-control form-control-sm" name="category_name"
                                            id="category_name" v-model="search_category_name" @keyup="getSearch"
                                            placeholder="Category Name" />
                                    </div>
                                </div>

                                <div class="text-muted mx-1">
                                    <div class="mt-2">
                                        <button @click.prevent="clearFilter()" class="btn  btn-ash float-end mt-2 pt-2">
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
                                            <th class="textClassHead text-center">
                                                Status
                                            </th>
                                            <th class="textClassHead text-left">
                                                CODE
                                            </th>

                                            <th class="textClassHead">
                                                Product Name
                                            </th>
                                            <th class="textClassHead">
                                                Category Name
                                            </th>
                                            <th class="textClassHead">
                                                Primary Image
                                            </th>
                                            <!-- <th class="textClassHead">Rating</th> -->
                                            <th class="textClassHead text-right">
                                                Price
                                            </th>
                                            <th class="textClassHead text-right">
                                                Discount Price
                                            </th>
                                            <th class="textClassHead text-center">
                                                Featured
                                            </th>
                                            <th class="textClassHead text-right">
                                                quantity
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="value in productData" :key="value.id"
                                            @click.prevent="edit(value.id)">
                                            <td class="textClassBody text-center">
                                                <div class="" v-if="value.status == 1">
                                                    <span class="badge badge-success">Active</span>
                                                </div>
                                                <div class="" v-else>
                                                    <span class="badge badge-warning">Inactive</span>
                                                </div>
                                            </td>
                                            <td class="textClassBody text-left">
                                                {{ value.code }}
                                            </td>
                                            <td class="textClassBody">
                                                {{ value.name }}
                                            </td>
                                            <td class="textClassBody">
                                                {{ value.category?.name }}
                                            </td>
                                            <td class="textClassBody" v-if="value?.product_image.length > 0">
                                                <div class="" v-for="image in value.product_image">
                                                    <div class="" v-if="image.status == 1">
                                                        <img v-if="value?.product_image.length > 0"
                                                            class="img-fluid product-image-setup"
                                                            :src="image.image_url" />
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="textClassBody" v-else>
                                                <div class="">
                                                    <div class="">
                                                        <img :src="productImage" alt="no image"
                                                            class="product-image-setup" height="100px" />
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="textClassBody text-right">
                                                Rs.{{ numberFormatter(value.price) }}
                                            </td>
                                            <td class="textClassBody text-right">
                                                Rs.{{ numberFormatter(value.discount_price) }}
                                            </td>

                                            <td class="textClassBody text-center">
                                                <div class="" v-if="value.featured == 1">
                                                    <span class="badge badge-dark">FEATURED</span>
                                                </div>
                                                <div class="" v-else>
                                                    <span class="badge badge-primary">STANDARD</span>
                                                </div>
                                            </td>
                                            <td class="textClassBody text-right">
                                                {{ value.quantity }}
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
                                                <a class="page-link cursor-pointer" href="javascript:void(0)"
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
                                                <a class="page-link cursor-pointer" href="javascript:void(0)"
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
            <div class="modal fade" id="newProductModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newVendorModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                                id="add_brandLabel">
                                New Product
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
                                                PRODUCT NAME
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="name"
                                                    id="name" placeholder="product name" v-model="Product.name"
                                                    required />
                                                <small v-if="validationErrors.name" id="product_name"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.name }}</small>
                                            </div>


                                        </div>
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-3 col-form-label">
                                                CATEGORY
                                            </div>
                                            <div class="col-md-9">
                                                <Multiselect v-model="Product.category_id" :options="categoryData"
                                                    :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                                    :searchable="true" placeholder="Select category" label="name"
                                                    track-by="id">
                                                </Multiselect>
                                                <small v-if="validationErrors.category_id" id="category"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.category_id }}</small>
                                            </div>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="price" class="col-md-3 col-form-label">
                                                PRICE
                                            </div>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control form-control-sm" name="price"
                                                    id="price" placeholder="price" v-model="Product.price"
                                                    @input="checkMinPrice" required />
                                                <small v-if="validationErrors.price" id="price"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.price }}</small>
                                            </div>
                                            <small id="msg_code"
                                                class="text-danger form-text text-error-msg error"></small>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="button"
                                                class="btn btn-primary btn btn-sm btn-neutral float-end"
                                                @click.prevent="createProduct()">
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
const search_code = ref(null);
const search_product_name = ref();
const search_category_name = ref();
const select_product_status = ref([]);
const statusList = ref([
    { id: 1, name: 'Active' },
    { id: 2, name: 'Inactive' },
]);

const category = ref([]);
const categoryData = ref([]);
const productData = ref([]);
const Product = ref({
    price: ref(0)
});

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

const edit = (product_id) => {
    try {
        router.visit(route("admin.product.edit", product_id));
    } catch (error) {
        console.lod("Error", error);
    }
}

const createProduct = async (id) => {
    try {
        if (Product.value.category_id?.id) {
            Product.value.category_id = Product.value.category_id.id;
        }
        const response = await axios.post(
            route("admin.product.store"),
            Product.value)
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "New Product has been created",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                const productId = response.data.id;
                resetData();
                router.visit(route("admin.product.edit", productId));
                $("#newProductModal").modal("hide");
            })
            .catch((error) => {
                convertValidationError(error);
                console.log("Error:", error);
                // Swal.fire({
                //     icon: "error",
                //     title: "Error",
                //     text: "Failed to create product",
                //     toast: true,
                //     position: "top-end",
                //     showConfirmButton: false,
                //     timer: 3000,
                //     timerProgressBar: true,
                // });
            });
    } catch (error) {
        console.log("Error:", error);
    }
};

const getCategories = async () => {
    try {
        const response = await axios.get(route("admin.category.all"));
        categoryData.value = response.data.data.map((category) => ({
            id: category.id,
            name: category.name,
        }));
    } catch (error) {
        console.log("Error", error);
    }
};

const reload = async () => {
    try {
        const response = (
            await axios.get(route("admin.product.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    code: search_code.value,
                    product_name: search_product_name.value,
                    category_name: search_category_name.value,
                    status: select_product_status.value.id,
                },
            })
        ).data;

        productData.value = response.data;
        pagination.value = response;
        getCategories();
        resetData();
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
        search_product_name.value = null;
        search_category_name.value = null;
        select_product_status.value = [];
        getCategories();
        reload();
    } catch (error) {
        console.log('Error', error);
    }
}

const resetData = () => {
    resetValidationErrors();
    Product.value.name = '';
    Product.value.category_id = '';
    Product.value.price = '';
}
onMounted(() => {
    reload();
    getCategories();
});

watch([page, pageCount], () => {
    reload();
});

watch(() => {
    if (select_product_status.value) {
        reload();
    } else {
        reload();
    }
});

const checkMinPrice = (event) => {
    if (event.target.value < 0) {
        event.target.value = '';
    }
}

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

.product-image-setup {
    width: 100px;
    height: 100px;
    object-fit: cover;
    object-position: center;
    border-radius: 10px;
}

.cursor-pointer {
    cursor: pointer;
}
</style>
