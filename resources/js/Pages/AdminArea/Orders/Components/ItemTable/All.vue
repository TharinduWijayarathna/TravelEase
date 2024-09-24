<template>
    <div class="row">
        <div class="col-lg-12 mt-1 ">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Order item</h5>
                </div>
                <!-- <div class="py-3 filters-margin mx-3 text-sm card-body">
                    <div class="flex">
                        <div class="items-center text-muted mx-1">
                            <div class="">Item Name</div>
                            <div class="inline-block ">
                                <input type="text" class="form-control form-control-sm" name="name" id="name"
                                    v-model="search_item_name" @keyup="getSearch" placeholder="Item Name" />
                            </div>
                        </div>
                        <div class="items-center text-muted mx-1">
                            <div class="">Item Code</div>
                            <div class="inline-block ">
                                <input type="text" class="form-control form-control-sm" name="code" id="code"
                                    v-model="search_item_code" @keyup="getSearch" placeholder="Item Code" />
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
                </div> -->
                <div class="py-3 filters-margin mx-3 text-sm card-body">
                    <div class="col-md-12">
                        <div class=" my-2">
                            <form class="card-body tab-content" role="form text-left" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-3 column__right___padding">
                                        <div for="plant_id" class="col-form-label">PRODUCT</div>
                                        <Multiselect v-model="select_product" :options="productData.map(product => ({
                                            ...product,
                                            name: truncateText(product.name),
                                            searchableText: `${product.code} : ${truncateText(product.name)}`
                                        }))" :showLabels="false" :close-on-select="true" :searchable="true"
                                            placeholder="Select Product" label="searchableText" track-by="id"
                                            class="z__index" max-height="200" @change="onSearchProduct" />
                                        <small id="msg_PRODUCT_id"
                                            class="text-danger form-text text-error-msg error"></small>
                                    </div>
                                    <div class="col-md-2 column__right___padding column__left___padding">
                                        <div for="quantity" class="col-form-label">QUANTITY</div>
                                        <input v-if="select_product_data" type="number" step="any"
                                            class="form-control form-control-sm" v-model="quantity" name="quantity"
                                            id="quantity" min="1" placeholder="Quantity" />
                                        <input v-else type="number" step="any" class="form-control form-control-sm"
                                            name="quantity" id="quantity" min="1" placeholder="Quantity" />
                                        <small id="msg_quantity"
                                            class="text-danger form-text text-error-msg error"></small>
                                    </div>
                                    <div class="col-md-3 column__left___padding column__right___padding">
                                        <div for="selling_price" class="col-form-label">SELLING PRICE </div>
                                        <input type="number" step="any" class="form-control form-control-sm"
                                            min="0.000001" name="selling_price" id="remarks" v-if="select_product_data"
                                            v-model="select_product_data.price" placeholder="Selling Price" />
                                        <input type="number" step="any" class="form-control form-control-sm"
                                            min="0.000001" name="selling_price" id="remarks" v-else
                                            placeholder="Selling Price" />
                                        <small id="msg_selling_price"
                                            class="text-danger form-text text-error-msg error"></small>
                                    </div>
                                    <div class="col-md-1 pt-3 mt-3">
                                        <button type="button"
                                            class="btn btn-sm btn-round btn-outline-success btn-md mb-0 mt-1"
                                            @click.prevent="createOrderItem">
                                            <i class="fa-solid fa-circle-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-12 mt-2" v-if="select_product_data">
                                        <div class="card mt-0 mb-3">
                                            <div class="card-body row">
                                                <div class="col-2">
                                                    <img v-if="select_product_data.product_image"
                                                        :src="select_product_data.product_image"
                                                        class="product-img text-center product-image-setup">
                                                    <img v-else src="@/../src/AdminArea/img/product/invalid_image.png"
                                                        alt="" class="product-img product-image-setup">
                                                </div>
                                                <div class="col-9">
                                                    <p class="card-text">NAME: {{ select_product_data.name }}</p>
                                                    <p class="card-text">DISCOUNT: {{ select_product_data.discount_price
                                                        }}</p>
                                                    <p class="card-text">LKR: {{ select_product_data.price }}</p>
                                                    <p class="card-text">Stock Qty : {{ select_product_data.quantity }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="row mx-4 m-2">
                    <div class="table-responsive">
                        <div class="d-flex flex-row mb-3 rounded">
                            <div class="left d-flex"></div>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="textClassHead text-left">
                                        ITEM NAME
                                    </th>
                                    <th class="textClassHead text-left">
                                        ITEM CODE
                                    </th>
                                    <th class="textClassHead text-right">
                                        DISCOUNT PRICE
                                    </th>
                                    <th class="textClassHead text-right">
                                        UNIT PRICE
                                    </th>
                                    <th class="textClassHead text-right">
                                        QUANTITY
                                    </th>
                                    <th class="textClassHead text-right">
                                        TOTAL
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="value in itemData" :key="value.id">
                                    <td class="textClassBody text-left">
                                        {{ value.product?.name }}
                                    </td>
                                    <td class="textClassBody">
                                        {{ value.product?.code }}
                                    </td>
                                    <td class="textClassBody text-right">
                                        Rs.{{ numberFormatter(value.product?.discount_price) }}
                                    </td>
                                    <td class="textClassBody text-right">
                                        Rs.{{ numberFormatter(value.unit_price) }}
                                    </td>
                                    <td class="textClassBody text-right">
                                        {{ value.quantity }}
                                    </td>
                                    <td class="textClassBody text-right">
                                        Rs.{{ numberFormatter(value.total) }}
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
import AdminLayout from "@/Layouts/AdminLayout.vue";
import axios from "axios";
import Multiselect from "vue-multiselect";
import { ref, onMounted, watch } from "vue";
import { router, Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { emitter, ORDER_TOTAL_UPDATE } from "@/event-bus.js";
import { errorMessages } from "vue/compiler-sfc";

const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});
const search_item_code = ref(null);
const search_item_name = ref(null);
const itemData = ref([]);
const orderData = ref([]);
const productData = ref([]);
const select_product = ref(null);
const select_product_data = ref(null);
const quantity = ref(1);
const cartId = ref(0);

const props = defineProps({
    orderId: {
        type: Number,
        required: true,
    },
});

const createOrderItem = async () => {
    try {
        select_product_data.value.order_id = props.orderId;
        select_product_data.value.cart_id = cartId.value;
        select_product_data.value.quantity = quantity.value;
        select_product_data.value.unit_price = select_product_data.value.price;
        const response = await axios.post(route('admin.cart.item.store'), select_product_data.value);
        select_product_data.value = '';
        select_product.value = '';
        reload();
        successMessage();
        emitter.emit(ORDER_TOTAL_UPDATE);
    } catch (error) {
        errorMessage(error.response.data.message);
    }
}

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

const reload = async () => {
    try {
        console.log('id', props.orderId);
        const response = (
            await axios.get(route("admin.order.cartItem.get", props.orderId), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    item_code: search_item_code.value,
                    item_name: search_item_name.value,
                },
            })
        ).data;

        itemData.value = response.data;
        if (itemData.value.length > 0) {
            cartId.value = itemData.value[0].cart_id;
            pagination.value = response;

        }
        getOrderData();
    } catch (error) {
        console.log("Error", error);
    }
};

const getOrderData = async () => {
    try {
        const response = await axios.get(route("admin.order.get", props.orderId));
        orderData.value = response.data;
        cartId.value = orderData.value.cart_id;
    } catch (error) {
        console.log("Error", error);
    }
};

const getProduct = async () => {
    try {
        const response = await axios.get(route("admin.product.all"));
        productData.value = response.data.data;
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

watch(select_product, (newProduct) => {
    select_product_data.value = null;
    onSearchProduct(newProduct.id)
});

// Function to handle product selection
const onSearchProduct = async (productId) => {
    try {
        const response = await axios.get(route("admin.product.get", productId));
        select_product_data.value = response.data;
        const images = select_product_data.value.product_image;
        if (images.length > 0) {
            if (images && Array.isArray(images)) {
                images.forEach(image => {
                    if (image.status == 1) {
                        select_product_data.value.product_image = image.image_url;
                    } else {
                        select_product_data.value.product_image = null;
                    }
                });
            } else {
                select_product_data.value.product_image = null;
            }
        } else {
            select_product_data.value.product_image = null;
        }
    } catch (error) {
        console.log("Error", error);
    }
};

onMounted(() => {
    reload();
    getProduct();
});

watch([page, pageCount], () => {
    reload();
});

const perPageChange = async () => {
    reload();
}

const setPage = async (nextPage) => {
    page.value = nextPage;
    reload();
}

const errorMessage = (message) => {
    Swal.fire({
        icon: 'error',
        text: message,
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
};

// const resetValidationErrors = () => {
//     // Clear previous validation errors from the state
//     validationMessage.value = '';
//     validationErrors.value = {};
// };

const successMessage = () => {
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Data saved successfully',
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
};
</script>

<style lang="scss" scoped>
.breadcrumb-text {
    color: #6343e9 !important;
}

.nav-link.active {
    background-color: #2a73e0 !important;
    color: #ffffff !important;
}

.nav-link {
    color: black;
}

.main-text {
    font-size: 40px;
}

.for-text {
    font-size: 40px;

}

.breadcrumb-dark .breadcrumb-item+.breadcrumb-item::before {
    color: #030405;
}

.product-image-setup {
    width: 160px;
    height: 160px;
    object-fit: cover;
    object-position: center;
    border-radius: 10px;
    align-items: center;
    justify-content: center;
}
</style>
