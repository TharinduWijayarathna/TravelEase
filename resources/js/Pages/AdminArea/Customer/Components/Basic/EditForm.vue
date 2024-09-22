<template>
    <div id="basic-info">
        <div class="card-header">
            <h5>Basic Info</h5>
        </div>
        <div class="card-body pt-0 mt-3">
            <form>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">FIST NAME</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="first_name" id="first_name"
                            v-model="customerData.first_name" />
                        <small v-if="validationErrors.first_name" id="first_name"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.first_name }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">LAST NAME</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="last_name" id="last_name"
                            v-model="customerData.last_name" />
                        <small v-if="validationErrors.last_name" id="last_name"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.last_name }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">EMAIL</div>
                    <div class="col-md-10">
                        <input type="email" class="form-control form-control-sm" name="email" id="email"
                            v-model="customerData.email" />
                        <small v-if="validationErrors.email" id="email"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.email }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">CONTACT NUMBER</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="contact_number"
                            id="contact_number" placeholder="Contact Number" v-model="customerData.contact_number" />
                        <small v-if="validationErrors.contact_number" id="contact_number"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.contact_number }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        ADDRESS
                    </div>

                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="address" id="address"
                            placeholder="Address" v-model="customerData.address" />
                        <small v-if="validationErrors.address" id="address"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.address }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">STATUS</div>
                    <div class="col-md-10">
                        <div class="custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                v-model="customerData.status" />
                            <label class="custom-control-label" for="customSwitch1"></label>
                            <small v-if="validationErrors.status" id="status"
                                class="text-danger form-text text-error-msg error">{{
                                    validationErrors.status }}</small>
                        </div>
                    </div>
                </div>

                <div class="text-right">
                    <!-- <button type="button" class="btn btn-sm btn-round btn-outline-dark mb-0"
                        @click.prevent="resetData()">
                        <font-awesome-icon icon="fa-solid fa-trash" />
                        RESET
                    </button> -->
                    <button type="button" class="btn btn-sm btn-round btn-outline-danger mb-0"
                        @click.prevent="deleteCustomer(customerData.id)">
                        <font-awesome-icon icon="fa-solid fa-trash" />
                        DELETE
                    </button>
                    <button type="submit" class="btn btn-round custom-button btn-sm mb-0"
                        @click.prevent="updateBasicData(customerData.id)">
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
    customerId: {
        type: Number,
        required: true,
    },
});

const customerData = ref({});

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
        customerData.value.status ? 1 : 0;
        if (customerData.value.gender?.id) {
            customerData.value.gender = customerData.value.gender.id;
        }
        const response = await axios
            .post(route("admin.customer.update", id), customerData.value)
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
                getCustomerData();
            })
            .catch((error) => {
                convertValidationError(error);
                console.log("Error:", error);
            });
    } catch (error) {
        console.log("Error:", error);
    }
};


const getCustomerData = async () => {
    try {
        const response = await axios.get(
            route("admin.customer.get", props.customerId)
        );
        customerData.value = response.data.customer;
        if (customerData.value.gender == 1) {
            customerData.value.gender = { id: '1', name: 'Male' };
        } else if (customerData.value.gender == 2) {
            customerData.value.gender = { id: '2', name: 'Female' };
        } else if (customerData.value.gender == 3) {
            customerData.value.gender = { id: '3', name: 'Other' };
        }
        if (response.data.customer.status == 1) {
            customerData.value.status = true;
        } else {
            customerData.value.status = false;
        }
    } catch (error) {
        console.log("Error", error);
    }
};


// const resetData = () => {
//     customerData.value = '';
//     getCustomerData();
// };

const deleteCustomer = async (id) => {
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
                            route("admin.customer.delete", id)
                        );
                        router.visit(route('admin.customer.index'));
                    } catch (error) {
                        console.log("Error", error);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    getCustomerData();
                }
            });
    } catch (error) {
        console.log(error);
    }
};

onMounted(() => {
    getCustomerData();
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
</style>
