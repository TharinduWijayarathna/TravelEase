<template>
    <div id="basic-info">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h5>Bus Stops</h5>

                </div>
                <div class="col-6 text-right">
                    <button class="btn btn-sm btn-round btn-outline-primary" @click.prevent="createBusStopModal()">
                        <i class="fa-solid fa-plus"></i> Add
                    </button>
                </div>
            </div>

        </div>
        <div class="card-body pt-0 mt-0">
            <div class="col image-header">
                <form enctype="multipart/form-data">
                    <div class="">
                        <div class="row">

                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="busStop in busStops" :key="busStop.id">
                            <td>{{ busStop.name }}</td>
                            <td>
                                <button class="btn btn-sm btn-round btn-outline-primary" @click="editBusStopModal(busStop.id)">
                                    <i class="fa-solid fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-round btn-outline-danger" @click="deleteBusStop(busStop.id)">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newBusStopModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="newVendorModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
            <div class="modal-content p-2">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient" id="add_brandLabel">
                        New Bus Stop
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
                                        NAME
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control form-control-sm" name="name" id="name"
                                            placeholder="Bus stop name" v-model="busStop.name" required />
                                        <small v-if="validationErrors.name" id="bus_name"
                                            class="text-danger form-text text-error-msg error">{{
                                                validationErrors.name }}</small>
                                    </div>


                                </div>
                                <div class="text-right mt-2">
                                    <button type="button" class="btn btn-primary btn btn-sm btn-neutral float-end"
                                        @click.prevent="createBusStop()">
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
    <div class="modal fade" id="editBusStopModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
        aria-labelledby="newVendorModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
            <div class="modal-content p-2">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient" id="add_brandLabel">
                        Edit Bus Stop
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
                                        NAME
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control form-control-sm" name="name" id="name"
                                            placeholder="Bus stop name" v-model="editBusStop.name" required />
                                        <small v-if="validationErrors.name" id="bus_name"
                                            class="text-danger form-text text-error-msg error">{{
                                                validationErrors.name }}</small>
                                    </div>


                                </div>
                                <div class="text-right mt-2">
                                    <button type="button" class="btn btn-primary btn btn-sm btn-neutral float-end"
                                        @click.prevent="updateBusStop()">
                                        <i class="fas fa-save"></i>
                                        UPDATE
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
<script setup>
import axios from 'axios';
import { ref, onMounted, defineProps } from "vue";
import Swal from "sweetalert2";


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

const props = defineProps({
    busId: {
        type: Number,
        required: true,
    },
});
const busStops = ref([]);
const busStop = ref({});
const editBusStop = ref({});
const createBusStopModal = () => {
    $("#newBusStopModal").modal("show");
}
const createBusStop = async () => {
    try {
        busStop.value.bus_id = props.busId;
        const response = await axios.post(
            route("admin.bus.stop.store"),
            busStop.value)
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "New bus stop has been created",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                resetData();
                reload();
                $("#newBusStopModal").modal("hide");
            })
            .catch((error) => {
                convertValidationError(error);
                console.log("Error:", error);

            });
    } catch (error) {
        console.log("Error:", error);
    }
};
const editBusStopModal = async (id) => {
    const response = await axios.get(route("admin.bus.stop.get", id));
            editBusStop.value = response.data
        $("#editBusStopModal").modal("show");
};
const updateBusStop = async () => {
    const response = await axios.post(route("admin.bus.stop.update", editBusStop.value.id), editBusStop.value)
        .then((response) => {
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Bus stop has been updated",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            reload();
            $("#editBusStopModal").modal("hide");
        })
        .catch((error) => {
            convertValidationError(error);
            console.log("Error:", error);
        })
};
const deleteBusStop = async (id) => {
    const response = (await axios.delete(route("admin.bus.stop.delete", id))).data;
    Swal.fire({
        icon: "success",
        title: "Success",
        text: "Bus stop has been deleted",
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
    reload();
};
const reload = async () => {
    try {
        const response = (
            await axios.get(route("admin.bus.stop.all", props.busId))
        ).data;

        busStops.value = response.data;
        resetData();
    } catch (error) {
        console.log("Error", error);
    }
};
const resetData = () => {
    busStop.value = {};
    validationErrors.value = {};
    validationMessage.value = null;
};

onMounted(() => {
    reload();
});
</script>
