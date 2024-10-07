<template>
    <AdminLayout>
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body row">
                        <div class="col-lg-8 align-items-center py-4">
                            <h6 class="h2 text-maroon d-inline-block mb-0">Category Managements</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block ">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('admin.dashboard')" class="text-dark">
                                        <i class="fa-solid fa-house"></i>
                                        </Link>
                                    </li>
                                    <li class="breadcrumb-item active breadcrumb-yellow" aria-current="page">
                                        Categories
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-lg-4 text-right py-4">
                            <button type="button" class="btn btn-primary btn btn-sm btn-neutral" data-toggle="modal"
                                @click.prevent="resetData()" data-target="#exampleModal">
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
                                        <Multiselect v-model="select_category_status" :options="statusList"
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
                                    <div class="">Category Name</div>
                                    <div class="inline-block ">
                                        <input type="text" class="form-control form-control-sm" name="name" id="name"
                                            v-model="search_name" @keyup="getSearch" placeholder="Category Name" />
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
                                            <th class="textClassHead text-center">
                                                Status
                                            </th>
                                            <th class="textClassHead">
                                                Code
                                            </th>
                                            <th class="textClassHead">
                                                Category Name
                                            </th>
                                            <th class="textClassHead text-center">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="value in categoryData" :key="value.id">
                                            <td class="textClassBody text-center">
                                                <div class="" v-if="value.status === 1">
                                                    <span class="badge badge-success">Active</span>
                                                </div>
                                                <div class="" v-else>
                                                    <span class="badge badge-warning">Inactive</span>
                                                </div>
                                            </td>
                                            <td class="textClassBody">
                                                {{ value.code }}
                                            </td>
                                            <td class="textClassBody">
                                                {{ value.name }}
                                            </td>
                                            <td class="textClassBody text-center">

                                                <a href="javascript:void(0)" v-if="value.status === 1"
                                                    @click="changeStatus(value.id)" class="p-2 float-end">
                                                    <i class="fas  fa-toggle-on"></i>
                                                </a>
                                                <a href="javascript:void(0)" v-else @click=" changeStatus(value.id)"
                                                    class="p-2 float-end">
                                                    <i class="fas fa-toggle-off "></i>
                                                </a>

                                                <a href="javascript:void(0)" @click.prevent=" editCategory(value.id)"
                                                    data-toggle="modal" data-target="#descriptionModal"
                                                    class="p-2 float-end">
                                                    <i class="text-right fa__2x ml-2 fa-solid fa-eye text-muted"></i>
                                                </a>

                                                <a href="javascript:void(0)" @click.prevent=" editCategory(value.id)"
                                                    data-toggle="modal" data-target="#updateModal"
                                                    class="p-2 float-end">
                                                    <i class="text-right fa__2x ml-2 fas fas fa-pencil text-muted"></i>
                                                </a>
                                                <a href="javascript:void(0)" @click.prevent="deleteCategory(value.id)"
                                                    class="p-2 float-end">
                                                    <i class="fa-solid fa-trash text-danger text-right fa__2x ml-2"></i>
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
            <div class="modal fade" id="exampleModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newVendorModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                                id="add_brandLabel">
                                New Category
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
                                                CATEGORY NAME
                                            </div>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control form-control-sm" name="name"
                                                    id="name" placeholder="Category Name" v-model="Category.name"
                                                    maxlength="13" required />
                                                <small v-if="validationErrors.name" id="name"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.name }}</small>
                                            </div>
                                        </div>

                                        <div class="row mb-1">
                                            <div class="col-md-3 col-form-label">
                                                STATUS
                                            </div>
                                            <div class="col-md-9">
                                                <div class="custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customSwitch1" v-model="Category.status" />
                                                    <label class="custom-control-label" for="customSwitch1"></label>
                                                    <small v-if="validationErrors.status" id="status"
                                                        class="text-danger form-text text-error-msg error">{{
                                                            validationErrors.status }}</small>
                                                </div>
                                            </div>
                                            <small id="msg_status"
                                                class="col-md-12 text-danger form-text text-error-msg error"></small>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-3 col-form-label">
                                                DESCRIPTION
                                            </div>
                                            <div class="col-md-9">
                                                <textarea type="text" class="form-control form-control-sm description"
                                                    name="description" v-model="Category.description" id="description"
                                                    placeholder="Description" col="10" required />
                                                <small v-if="validationErrors.description" id="description"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.description }}</small>
                                            </div>
                                            <small id="msg_code"
                                                class="text-danger form-text text-error-msg error"></small>
                                        </div>

                                        <div class="text-right mt-2">
                                            <button type="button"
                                                class="btn btn-primary btn btn-sm btn-neutral float-end"
                                                @click.prevent=" createCategory()">
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
                                Update Category
                            </h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
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
                                                <input type="text" class="form-control form-control-sm" name="name"
                                                    id="name" placeholder="Category Name"
                                                    v-model="selectedCategory.name" required />
                                                <small v-if="validationErrors.name" id="name"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.name }}</small>
                                            </div>
                                            <small id="msg_code"
                                                class="text-danger form-text text-error-msg error"></small>
                                        </div>

                                        <div class="row mb-1">
                                            <div class="col-md-3 col-form-label">
                                                STATUS
                                            </div>
                                            <div class="col-md-9">
                                                <div class="custom-switch">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="customSwitch2" v-model="selectedCategory.status" />
                                                    <label class="custom-control-label" for="customSwitch2"></label>
                                                    <small v-if="validationErrors.status" id="status"
                                                        class="text-danger form-text text-error-msg error">{{
                                                            validationErrors.status }}</small>
                                                </div>
                                            </div>
                                            <small id="msg_status"
                                                class="col-md-12 text-danger form-text text-error-msg error"></small>
                                        </div>
                                        <div class="row mb-1">
                                            <div for="code" class="col-md-3 col-form-label">
                                                DESCRIPTION
                                            </div>
                                            <div class="col-md-9">
                                                <textarea type="text" class="form-control form-control-sm description"
                                                    name="description" v-model="selectedCategory.description"
                                                    id="description" placeholder="Description" col="10" required />
                                                <small v-if="validationErrors.description" id="description"
                                                    class="text-danger form-text text-error-msg error">{{
                                                        validationErrors.description }}</small>
                                            </div>
                                            <small id="msg_code"
                                                class="text-danger form-text text-error-msg error"></small>
                                        </div>
                                        <div class="text-right mt-2">
                                            <button type="button"
                                                class="btn btn-primary btn btn-sm btn-neutral float-end"
                                                @click.prevent=" updateCategory(selectedCategory.id)">
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

            <div class="modal fade" id="descriptionModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="newVendorModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-mb" role="document">
                    <div class="modal-content p-2">
                        <div class="modal-header">
                            <h5 class="modal-title font-weight-bolder breadcrumb-text text-gradient"
                                id="add_brandLabel">
                                DESCRIPTION
                            </h5>
                            <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
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
                                            <div class="col-md-12">
                                                <textarea type="text" class="form-control description"
                                                    name="description" v-model="selectedCategory.description"
                                                    id="description" placeholder="Category Description" disabled />
                                            </div>
                                            <small id="msg_code"
                                                class="text-danger form-text text-error-msg error"></small>
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
import Swal from "sweetalert2";
import { ref, onMounted, watch } from "vue";
import { Link } from "@inertiajs/vue3";
import categoryImage from '@/../src/AdminArea/img/product/invalid_image.png';
import Multiselect from 'vue-multiselect';

const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});
const search_code = ref(null);
const search_name = ref();
const select_category_status = ref([]);
const statusList = ref([
    { id: 1, name: 'Active' },
    { id: 2, name: 'Inactive' },
]);

const categoryData = ref([]);
const categoryId = ref({});
const selectedCategory = ref({});
const category_image = ref(null);
const Category = ref({});
const update_category_image = ref({});

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

const changeStatus = async (category_id) => {
    try {
        const response = await axios.get(route('admin.category.status.update', category_id));
        // categoryData.value = response.data.category;
        reload();
    } catch (error) {
        console.log('Error', error);
    }
}

const createCategory = async () => {
    try {
        Category.value.image = category_image;
        const response = await axios
            .post(route("admin.category.store"), Category.value, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "New category has been created",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                $('#exampleModal').modal('hide');
                reload();
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

const updateCategory = async (category_id) => {
    try {
        selectedCategory.value.status = selectedCategory.value.status ? 1 : 0;
        selectedCategory.value.image = update_category_image.value;
        const response = await axios
            .post(
                route("admin.category.update", category_id),
                selectedCategory.value,
                {
                    headers: {
                        "Content-Type": "multipart/form-data",
                    },
                }
            )
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
                $('#updateModal').modal('hide');
                reload();
                resetData();
            })
            .catch((error) => {
                convertValidationError(error);
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

const deleteCategory = async (id) => {
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
                        const response = await axios.post(
                            route("admin.category.delete", id)
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

const editCategory = async (id) => {
    try {
        document.getElementById("image").value = "";
        document.getElementById("update_image").value = "";
        const response = await axios.get(route("admin.category.get", id));
        selectedCategory.value = response.data.category;
        if (response.data.category.status == 1) {
            selectedCategory.value.status = true;
        } else {
            selectedCategory.value.status = false;
        }
    } catch (error) {
        console.log("Error:", error);
    }
};

const resetData = () => {
    validationErrors.value = "";
    validationMessage.value = "";
    Category.value.name = "";
    Category.value.status = "";
    Category.value.image = "";
    Category.value.description = "";
    document.getElementById("image").value = "";
    document.getElementById("update_image").value = "";
    categoryId.value = "";
};

const reload = async () => {
    try {
        const response = (
            await axios.get(route("admin.category.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    code: search_code.value,
                    name: search_name.value,
                    status: select_category_status.value.id,
                },
            })
        ).data;

        pagination.value = response;
        categoryData.value = response.data;
    } catch (error) {
        console.log("Error", error);
    }
};

const clearFilter = () => {
    try {
        search_code.value = null;
        search_name.value = null;
        select_category_status.value = [];
        page.value = 1;
        reload();
    } catch (error) {
        console.log('Error', error);
    }
}

onMounted(() => {
    reload();
});

watch([page, pageCount], () => {
    reload();
});

watch(() => {
    if (select_category_status.value) {
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
    vertical-align: middle;
}

.description {
    min-height: 150px;
    max-height: 150px;
    position: relative;
    line-height: 25px;
}

.category-image-setup{
    width: 100px;
    height: 100px;
    object-fit: cover;
    object-position: center;
    border-radius: 10px;
}
</style>
