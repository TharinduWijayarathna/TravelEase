<template>
    <div class="card shadow mt-3" id="basic-info">
        <div class="card-header">
            <h5>Basic Info</h5>
        </div>
        <div class="card-body p-4 mt-3">
            <form>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">CODE</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="code" id="code"
                            v-model="orderData.code" disabled />
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">CUSTOMER</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="name" id="name"
                            v-model="orderData.customer_name" disabled />
                        <small id="name" class="text-danger form-text text-error-msg error"></small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">EMAIL</div>
                    <div class="col-md-10">
                        <input type="email" class="form-control form-control-sm" name="email" id="email"
                            v-model="orderData.customer_email" disabled />
                        <small id="email" class="text-danger form-text text-error-msg error"></small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        TOTAL
                    </div>

                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="address" id="address"
                            v-model="orderData.total" placeholder="Address" />
                        <small id="address" class="text-danger form-text text-error-msg error"></small>
                    </div>
                </div>

                <div class="text-right">
                    <button type="button" class="btn btn-sm btn-round btn-outline-danger mb-0"
                        @click.prevent="deleteOrder(props.orderId)">
                        <font-awesome-icon icon="fa-solid fa-trash" />
                        DELETE
                    </button>
                    <button type="submit" class="btn btn-round custom-button btn-sm mb-0"
                        @click.prevent="updateBasicData(props.orderId)">
                        <!-- <font-awesome-icon icon="fa-solid fa-floppy-disk" /> -->
                        SAVE
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted, watch } from "vue";
import { router, Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";
import { emitter, ORDER_TOTAL_UPDATE } from "@/event-bus.js";

const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});
const search_item_code = ref(null);
const search_item_name = ref(null);
const itemData = ref([]);
const orderData = ref([]);
const customerData = ref([]);

const props = defineProps({
    orderId: {
        type: Number,
        required: true,
    },

    customerId: {
        type: Number,
        required: true,
    }
});

const reload = async () => {
    try {
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
        pagination.value = response;
        getOrderData();
    } catch (error) {
        console.log("Error", error);
    }
};

const updateBasicData = async (orderId) => {
    try {
        console.log('order data', orderData.value);
        const response = await axios.post(route("admin.order.update", orderId), orderData.value);
        getOrderData();
        successMessage();
    } catch (error) {
        errorMessage();
        console.log("Error", error);
    }
};

const getOrderData = async () => {
    try {
        const response = await axios.get(route("admin.order.get", props.orderId));
        orderData.value = response.data;
    } catch (error) {
        console.log("Error", error);
    }
};

const getCustomerData = async () => {
    try {
        const response = await axios.get(
            route("admin.customer.get", props.customerId)
        );
        customerData.value = response.data.customer;
    } catch (error) {
        console.log("Error", error);
    }
};

const deleteOrder = async (orderId) => {
    try {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-outline-danger",
                cancelButton: "btn btn-outline-success",
            },
            buttonsStyling: false,
        });
        swalWithBootstrapButtons
            .fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: false,
            })
            .then(async (result) => {
                if (result.isConfirmed) {
                    const response = await axios.delete(
                        route("admin.order.delete", props.orderId)
                    );
                    router.visit(route('admin.order.index'));
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    getCustomerData();
                }
            });
    } catch (error) {
        console.log(error);
    }
};

onMounted(() => {
    reload();
    getCustomerData();
    emitter.on(ORDER_TOTAL_UPDATE, getOrderData);
});

const successMessage = () => {
    Swal.fire({
        icon: "success",
        title: "Success",
        text: "Successfully updated",
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
}

const errorMessage = () => {
    Swal.fire({
        icon: "error",
        title: "error",
        text: "Failed to save data",
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
}

watch([page, pageCount], () => {
    reload();
});

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

.custom-button {
    background-color: #ffffff;
    border-color: #6343e9;
    color: #6343e9 !important;
}

.custom-button:hover {
    background-color: #6343e9;
    color: #ffffff !important;
}
</style>
