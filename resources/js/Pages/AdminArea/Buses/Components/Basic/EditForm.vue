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
                            v-model="busData.name" disabled />
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        CATEGORY
                    </div>
                    <div class="col-md-10">
                        <select class="form-control form-control-sm" aria-label="Default select example" disabled>
                            <option :value="busData.category_id" class="text-dark" hidden>
                                {{ busData.category ? busData.category.name : "" }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">DRIVER NAME</div>
                    <div class="col-md-10">
                        <input type="text" class="form-control form-control-sm" name="price" id="price" min="0"
                            placeholder="Driver Name" v-model="busData.driver_name" />
                        <small v-if="validationErrors.driver_name" id="price"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.driver_name }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        ROUTE
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm" name="from" min="0" id="from"
                            placeholder="Route From" v-model="busData.from" />
                        <small v-if="validationErrors.from" id="from"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.from }}</small>
                    </div>
                    <div class="">
                        <i class="fas fa-arrow-right mt-2"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control form-control-sm" name="to" min="0" id="to"
                            placeholder="Route To" v-model="busData.to" />
                        <small v-if="validationErrors.to" id="to" class="text-danger form-text text-error-msg error">{{
                            validationErrors.to }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        DEPARTURE TIME
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control form-control-sm" name="departure_time" min="0"
                            id="departure_time" placeholder="Departure Time" v-model="busData.departure_time" />
                        <small v-if="validationErrors.departure_time" id="departure_time"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.departure_time }}</small>
                    </div>
                    <div class="">
                        <i class="fas fa-arrow-right mt-2"></i>
                    </div>
                    <div class="col-md-4">
                        <input type="time" class="form-control form-control-sm" name="arrival_time" min="0"
                            id="arrival_time" placeholder="Arrival Time" v-model="busData.arrival_time" />
                        <small v-if="validationErrors.arrival_time" id="arrival_time"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.arrival_time }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        SEATS
                    </div>
                    <div class="col-md-4">
                        <input type="number" class="form-control form-control-sm" name="seats" min="0" id="seats"
                            placeholder="Seats" v-model="busData.seats" />
                        <small v-if="validationErrors.seats" id="seats"
                            class="text-danger form-text text-error-msg error">{{
                                validationErrors.seats }}</small>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label" busData>STATUS</div>
                    <div class="col-md-10">
                        <div class="custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1"
                                v-model="busData.status" />
                            <label class="custom-control-label" for="customSwitch1"></label>
                            <small v-if="validationErrors.status" id="status"
                                class="text-danger form-text text-error-msg error">{{
                                    validationErrors.status }}</small>
                        </div>
                    </div>
                </div>
                <div class="row mb-1">
                    <div for="name" class="col-md-2 col-form-label">
                        DESCRIPTION
                    </div>
                    <div class="col-md-10">
                        <textarea type="text" class="form-control form-control-sm description" name="description"
                            id="description" placeholder="Description" v-model="busData.description" rows="5" />
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
                        @click.prevent="deleteProduct(busData.id)">
                        <font-awesome-icon icon="fa-solid fa-trash" />
                        DELETE
                    </button>
                    <button type="submit" class="btn btn-round custom-button btn-sm mb-0"
                        @click.prevent="updateBasicData(busData.id)">
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
    busId: {
        type: Number,
        required: true,
    },
});

const categoryData = ref([]);
const busData = ref({});
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
        busData.value.featured ? 1 : 0;
        busData.value.status ? 1 : 0;
        const response = await axios
            .post(route("admin.bus.update", id), busData.value)
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
                getbusData();
            })
            .catch((error) => {
                convertValidationError(error);
                console.log("Error:", error);
            });
    } catch (error) {
        console.log("Error:", error);
    }
};

const getbusData = async () => {
    try {
        const response = await axios.get(
            route("admin.bus.get", props.busId)
        );
        busData.value = response.data;
        if (response.data.status == 1) {
            busData.value.status = true;
        } else {
            busData.value.status = false;
        }
        if (response.data.featured == 1) {
            busData.value.featured = true;
        } else {
            busData.value.featured = false;
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
//     busData.value.price = "";
//     busData.value.discount_price = "";
//     busData.value.featured = "";
//     busData.value.status = "";
// };

const resetDisabled = () => {
    busData.value = "";
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
                            route("admin.bus.delete", id)
                        );
                        // resetData();
                        resetDisabled();
                        router.visit(route('admin.bus.index'));
                    } catch (error) {
                        console.log("Error", error);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    getbusData();
                    getCategories();
                }
            });
    } catch (error) {
        console.log(error);
    }
};

onMounted(() => {
    getbusData();
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
