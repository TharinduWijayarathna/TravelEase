<template>
    <div id="basic-info">
        <div class="card-header">
            <h5>Basic Info</h5>
        </div>
        <div class="card-body pt-0 mt-3">
            <form>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">NAME</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="name" id="name"
                            v-model="productData.name" disabled />
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        CATEGORY
                    </div>
                    <div class="col-md-10">
                        <select class="form-control form-control-sm" aria-label="Default select example" disabled>
                            <option :value="productData.category_id" class="text-dark" hidden>
                                {{ productData.category ? productData.category.name : "" }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">PRICE</div>
                    <div class="col-md-10">
                        <input type="number" class="form-control form-control-sm" name="price" id="price" min="0"
                            placeholder="Price" v-model="productData.price" />
                        <small v-if="validationErrors.price" id="price"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.price }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        DISCOUNT PRICE
                    </div>
                    <div class="col-md-10">
                        <input type="number" class="form-control form-control-sm" name="discount_price" min="0"
                            id="discount_price" placeholder="Discount Price" v-model="productData.discount_price" />
                        <small v-if="validationErrors.discount_price" id="discount_price"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.discount_price }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label" productData>STATUS</div>
                    <div class="col-md-10">
                        <div class="custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                v-model="productData.status" />
                            <label class="custom-control-label" for="customSwitch1"></label>
                            <small v-if="validationErrors.status" id="status"
                                class="text-danger form-text text-error-msg error">{{
                                    validationErrors.status }}</small>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        FEATURED
                    </div>
                    <div class="col-md-10">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                                v-model="productData.featured" />
                            <label class="form-check-label" for="flexCheckDefault">
                            </label>
                            <small v-if="validationErrors.featured" id="featured"
                                class="text-danger form-text text-error-msg error">{{
                                    validationErrors.featured }}</small>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        QUANTITY
                    </div>
                    <div class="col-md-10">
                        <input type="number" class="form-control form-control-sm" name="quantity" id="quantity"
                            placeholder="Discount Price" v-model="productData.quantity" />
                        <small v-if="validationErrors.quantity" id="quantity"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.quantity }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        DESCRIPTION
                    </div>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control form-control-sm description" name="description"
                            id="description" placeholder="Description" v-model="productData.description" rows="5" />
                        <small v-if="validationErrors.description" id="description"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.description }}</small>
                    </div>
                </div>
                <div class="text-right">
                    <!-- <button type="button" class="btn btn-sm btn-round btn-outline-dark mb-0"
                        @click.prevent="resetData()">
                        <font-awesome-icon icon="fa-solid fa-trash" />
                        RESET
                    </button> -->
                    <button type="button" class="btn btn-sm btn-round btn-outline-danger mb-0"
                        @click.prevent="deleteProduct(productData.id)">
                        <font-awesome-icon icon="fa-solid fa-trash" />
                        DELETE
                    </button>
                    <button type="submit" class="btn btn-round custom-button btn-sm mb-0"
                        @click.prevent="updateBasicData(productData.id)">
                        <font-awesome-icon icon="fa-solid fa-floppy-disk" />
                        SAVE
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted, defineProps } from "vue";
import Swal from "sweetalert2";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    productId: {
        type: Number,
        required: true,
    },
});

const categoryData = ref([]);
const productData = ref({});
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

const updateBasicData = async (id) => {
    try {
        productData.value.featured ? 1 : 0;
        productData.value.status ? 1 : 0;
        const response = await axios
            .post(route("admin.product.update", id), productData.value)
            .then((response) => {
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
                resetValidationErrors();
                getProductData();
            })
            .catch((error) => {
                convertValidationError(error);
                console.log("Error:", error);
            });
    } catch (error) {
        console.log("Error:", error);
    }
};

const getProductData = async () => {
    try {
        const response = await axios.get(
            route("admin.product.get", props.productId)
        );
        productData.value = response.data;
        if (response.data.status == 1) {
            productData.value.status = true;
        } else {
            productData.value.status = false;
        }
        if (response.data.featured == 1) {
            productData.value.featured = true;
        } else {
            productData.value.featured = false;
        }
    } catch (error) {
        console.log("Error", error);
    }
};

const getCategories = async () => {
    try {
        const response = await axios.get(route("admin.category.all"));
        categoryData.value = response.data.category;
    } catch (error) {
        console.log("Error", error);
    }
}

// const resetData = () => {
//     productData.value.price = "";
//     productData.value.discount_price = "";
//     productData.value.featured = "";
//     productData.value.status = "";
// };

const resetDisabled = () => {
    productData.value = "";
};

const deleteProduct = async (id) => {
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
                    try {
                        const response = await axios.delete(
                            route("admin.product.delete", id)
                        );
                        // resetData();
                        resetDisabled();
                        router.visit(route('admin.product.index'));
                    } catch (error) {
                        console.log("Error", error);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    getProductData();
                    getCategories();
                }
            });
    } catch (error) {
        console.log(error);
    }
};

onMounted(() => {
    getProductData();
    getCategories();
});
</script>

<style lang="scss" scoped>
.custom-button {
    background-color: #ffffff;
    border-color: #6343e9;
    color: #6343e9 !important;
}

.custom-button:hover {
    background-color: #6343e9;
    color: #ffffff !important;
}

.description {
    min-height: 150px;
    max-height: 150px;
    position: relative;
    line-height: 25px;
}
</style>
