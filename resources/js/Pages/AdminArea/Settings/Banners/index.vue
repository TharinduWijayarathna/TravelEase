<template>
    <AdminLayout>
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body row">
                        <div class="col-lg-8 align-items-center py-4">
                            <h6 class="h2 text-maroon d-inline-block mb-0">Banners Managements</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block ">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('admin.dashboard')" class="text-dark">
                                        <i class="fa-solid fa-house"></i>
                                        </Link>
                                    </li>
                                    <li class="breadcrumb-item active breadcrumb-yellow" aria-current="page">
                                        Banners
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-4 text-right py-4">
                            <button type="button" class="btn btn-primary btn btn-sm btn-neutral" data-toggle="modal"
                                @click.prevent="resetData()" data-target="#newBannerModal">
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
                                    <div class="">Status</div>
                                    <div class="inline-block" style="width: 200px;">
                                        <Multiselect v-model="select_banner_status" :options="statusList"
                                            :showLabels="false" :close-on-select="true" :clear-on-select="false"
                                            :searchable="true" placeholder="Select Status" label="name" track-by="id" />
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
                                            <th class="textClassHead ">
                                                Code
                                            </th>
                                            <th class="textClassHead text-center">
                                                Status
                                            </th>
                                            <th class="textClassHead ">
                                                Image
                                            </th>
                                            <th class="textClassHead">
                                                Heading
                                            </th>
                                            <th class="textClassHead">
                                                Sub Heading
                                            </th>

                                            <th class="textClassHead text-center">
                                                ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="value in bannerData" :key="value.id" class="textClassBodys">
                                            <td class="textClassBody">
                                                {{ value.code }}
                                            </td>
                                            <td class="textClassBody text-center">
                                                <div class="" v-if="value.status === 'true'">
                                                    <span class="badge badge-success">Active</span>
                                                </div>
                                                <div class="" v-else>
                                                    <span class="badge badge-warning">Inactive</span>
                                                </div>
                                            </td>
                                            <td class="textClassBody ">
                                                <img :src="value.image_url" alt="no image" width="160px"
                                                    height="100px" />
                                            </td>
                                            <td class="textClassBody">
                                                {{ value.main_heading }}
                                            </td>
                                            <td class="textClassBody">
                                                {{ value.sub_heading }}
                                            </td>
                                            <td class="textClassBody text-center">
                                                <!-- <a href="javascript:void(0)" v-if="value.status === 'true'"
                                                    @click.prevent="changeStatus(value.id)" class="p-2 float-end">
                                                    <i class="fas  fa-toggle-on"></i>
                                                </a>
                                                <a href="javascript:void(0)" v-else
                                                    @click.prevent="changeStatus(value.id)" class="p-2 float-end">
                                                    <i class="fas fa-toggle-off "></i>
                                                </a> -->
                                                <a href="javascript:void(0)"
                                                    @click.prevent="editBanner(value.id, value.image_id)"
                                                    data-toggle="modal" data-target="#updateModal"
                                                    class="p-2 float-end">
                                                    <i class="text-right fa__2x ml-3 fas fas fa-pencil text-muted"></i>
                                                </a>
                                                <a href="javascript:void(0)" @click.prevent="deleteBanner(value.id)"
                                                    class="p-2 float-end">
                                                    <i class="fa-solid fa-trash text-danger text-right fa__2x ml-3"></i>
                                                </a>
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

        <template #modals>
            <!-- store modal -->
            <div class="modal fade" id="newBannerModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newVendorModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                                id="add_brandLabel">
                                New Banner
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
                                    <form enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <label for="heading" class="col-md-3 col-form-label">MAIN HEADING</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="heading"
                                                    id="heading" placeholder="Main Heading"
                                                    v-model="Banner.main_heading" required />
                                                <small v-if="validationErrors.main_heading" id="main_heading"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.main_heading }}</small>
                                            </div>
                                        </div>

                                        <div class="row mb-1">
                                            <label for="sub-heading" class="col-md-3 col-form-label">SUB HEADING</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="sub-heading" id="sub-heading" placeholder="Sub Heading"
                                                    v-model="Banner.sub_heading" required />
                                                <small v-if="validationErrors.sub_heading" id="sub_heading"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.sub_heading }}</small>
                                            </div>
                                            <small id="msg_sub_heading"
                                                class="col-md-12 text-danger form-text text-error-msg error"></small>
                                        </div>
                                        <div class="row mb-1">
                                            <label for="name" class="col-md-3 col-form-label">IMAGE</label>
                                            <div class="col-md-9">
                                                <input type="file" class="form-control form-control" name="image"
                                                    id="image" @input="(e) => (banner_image = e.target.files[0])"
                                                    required />
                                                <small v-if="validationErrors.image" id="image"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.image }}</small>
                                            </div>
                                            <small id="msg_name"
                                                class="col-md-12 text-danger form-text text-error-msg error"></small>
                                        </div>

                                        <div class="row mb-1">
                                            <div class="col-md-3 col-form-label">
                                                STATUS
                                            </div>
                                            <div class="col-md-9">
                                                <div class="custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customSwitch1" v-model="Banner.status" />
                                                    <label class="custom-control-label" for="customSwitch1"></label>
                                                </div>
                                            </div>
                                            <small id="msg_status"
                                                class="col-md-12 text-danger form-text text-error-msg error"></small>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="button"
                                                class="btn btn-primary btn btn-sm btn-neutral float-end"
                                                @click.prevent="createBanner()">
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

            <!-- update modal -->
            <div class="modal fade" id="updateModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newVendorModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                                id="add_brandLabel">
                                Update exist Banner
                            </h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close"
                                @click.prevent="resetData">
                                <span aria-hidden="true">
                                    <i class="fa fa-times"></i>
                                </span>
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            <div class="card-plain">
                                <div class="card-body">
                                    <form enctype="multipart/form-data">
                                        <div class="row mb-1">
                                            <label for="heading" class="col-md-3 col-form-label">MAIN HEADING</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="heading"
                                                    id="heading" placeholder="Main Heading"
                                                    v-model="selectedBannerData.main_heading" required />
                                                <small v-if="validationErrors.main_heading" id="main_heading"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.main_heading }}</small>
                                            </div>
                                            <small id="msg_heading"
                                                class="col-md-12 text-danger form-text text-error-msg error"></small>
                                        </div>
                                        <div class="row mb-1">
                                            <label for="sub-heading" class="col-md-3 col-form-label">SUB HEADING</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm"
                                                    name="sub-heading" id="sub-heading" placeholder="Sub Heading"
                                                    v-model="selectedBannerData.sub_heading" required />
                                                <small v-if="validationErrors.sub_heading" id="sub_heading"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.sub_heading }}</small>
                                            </div>
                                            <small id="msg_sub_heading"
                                                class="col-md-12 text-danger form-text text-error-msg error"></small>
                                        </div>
                                        <div class="row mb-1">
                                            <label for="name" class="col-md-3 col-form-label">IMAGE</label>
                                            <div class="col-md-9">
                                                <input type="file" class="form-control form-control" name="update_image"
                                                    id="update_image" placeholder="image"
                                                    @input="(e) => (selected_banner_image = e.target.files[0])"
                                                    required />
                                                <small v-if="validationErrors.image" id="image"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.image }}</small>
                                            </div>
                                            <small id="msg_name"
                                                class="col-md-12 text-danger form-text text-error-msg error"></small>
                                        </div>

                                        <div class="row mb-1">
                                            <div class="col-md-3 col-form-label">
                                                STATUS
                                            </div>
                                            <div class="col-md-9">
                                                <div class="custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customSwitch2" v-model="selectedBannerData.status" />
                                                    <label class="custom-control-label" for="customSwitch2"></label>
                                                    <small v-if="validationErrors.status" id="status"
                                                        class="text-danger form-text text-error-msg error">{{
                                                            validationErrors.status }}</small>
                                                </div>
                                            </div>
                                            <small id="msg_status"
                                                class="col-md-12 text-danger form-text text-error-msg error"></small>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="button"
                                                class="btn btn-primary btn btn-sm btn-neutral float-end"
                                                data-toggle="modal" data-target="#updateModal"
                                                @click.prevent=" updateBanner(selectedBannerData.id)">
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
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Link } from "@inertiajs/vue3";
import { ref, onMounted, watch } from "vue";
import Swal from "sweetalert2";
import axios from "axios";
import Multiselect from 'vue-multiselect';

const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});
const search_code = ref(null);
const select_banner_status = ref([]);
const statusList = ref([
    { id: 1, name: 'Active' },
    { id: 2, name: 'Inactive' },
]);

const Banner = ref({});
const bannerData = ref([]);
const bannerId = ref({});
const imageId = ref({});
const selectedBannerData = ref({});
const banner_image = ref(null);
const selected_banner_image = ref(null);
const timer = ref(null);

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

const createBanner = async () => {
    try {
        Banner.value.image = banner_image.value;
        const formData = new FormData();
        await axios
            .post(route("admin.banner.store"), Banner.value, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Banner data has been saved",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                reload();
                $('#newBannerModal').modal('hide');
                resetData();
            })
            .catch((error) => {
                convertValidationError(error);
                console.log("Error:", error);
            });
    } catch (error) {
        console.log("Error:", error);
    }
};

const changeStatus = async (banner_id) => {
    try {
        const response = await axios.get(route('admin.banner.status.update', banner_id));
        reload();
    } catch (error) {
        console.log('Error', error);
    }
}

const reload = async () => {
    try {
        const response = (
            await axios.get(route("admin.banner.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    code: search_code.value,
                    status: select_banner_status.value.id,
                },
            })
        ).data;
        pagination.value = response;
        bannerData.value = response.data;

    } catch (error) {
        console.log("Error", error);
    }
}

const clearFilter = () => {
    try {
        search_code.value = null;
        select_banner_status.value = [];
        page.value = 1;
        reload();
    } catch (error) {
        console.log('Error', error);
    }
}

const deleteBanner = async (id) => {
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
                            route("admin.banner.delete", id)
                        );
                        reload();
                    } catch (error) {
                        console.log("Error", error);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    reload();
                }
            });
    } catch (error) {
        console.log(error);
    }
};

const editBanner = async (banner_id, image_id) => {
    try {
        document.getElementById("update_image").value = "";
        bannerId.value = banner_id;
        imageId.value = image_id;
        const response = await axios.get(route("admin.banner.get", banner_id));
        selectedBannerData.value = response.data.banner;
    } catch (error) {
        console.log("Error", error);
    }
};

const updateBanner = async (banner_id) => {
    try {
        selectedBannerData.value.image = selected_banner_image.value;
        const response = await axios
            .post(
                route("admin.banner.update", banner_id),
                selectedBannerData.value,
                {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                }
            )
            .then((response) => {
                reload();
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
                resetData();
            })
            .catch((error) => {
                convertValidationError(error);
                console.log("Error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to save data",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
            });
    } catch (error) {
        console.log("Error:", error);
    }
};

const resetData = () => {
    validationErrors.value = "";
    validationMessage.value = "";
    Banner.value.image = "";
    Banner.value.main_heading = "";
    Banner.value.sub_heading = "";
    Banner.value.status = "";
    Banner.value.exist_id = "";
    bannerId.value = "";
    document.getElementById("image").value = "";
    document.getElementById("update_image").value = "";
};

onMounted(() => {
    reload();
});

watch([page, pageCount], () => {
    reload();
});

watch(() => {
    if (select_banner_status.value) {
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
.textClassBody {
    vertical-align: middle !important;
}
</style>
