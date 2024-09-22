<template>
    <AdminLayout>
        <template #header>
            <div class="pb-6 header">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="py-4 col align-items-center">
                            <h6 class="mb-0 h2 d-inline-block">Customers</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                       <Link :href="route('admin.dashboard')" class="text-dark">
                                            <i class="fa-solid fa-house"></i>
                                        </Link>
                                    </li>
                                    
                                    <li class="breadcrumb-item active text-dark" aria-current="page">
                                        <Link :href="route('admin.customer.index')" class="text-dark">
                                            Customers
                                        </Link>
                                        <input type="image" src="" alt="" />
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">
                                        {{ customer.code }}<input type="image" src="" alt="" />
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <template #content>
            <div class="mt-4 row">
                <div class="col-lg-2 col-md-2">
                    <div class="nav-wrapper-loc">
                        <ul class="nav nav-pills nav-fill flex-column" id="tabs-icons-text" role="tablist">
                            <li class="mb-2 nav-item">
                                <a class="nav-link active" id="basic-data-tab" data-toggle="tab" href="#basic-data"
                                    role="tab" aria-controls="basic-data" aria-selected="true">
                                    Basic Data</a>
                            </li>
                            <li class="mb-2 nav-item">
                                <a class="nav-link" id="customer-orders-tab" data-toggle="tab" href="#customer-orders"
                                    role="tab" aria-controls="customer-orders" aria-selected="true">
                                    Customer's Orders</a>
                            </li>
                            <li hidden></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-10 col-md-10">
                    <div class="shadow card">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="basic-data" role="tabpanel">
                                    <BasicEditForm :customerId="customer.id" />
                                </div>
                                <div class="tab-pane fade show" id="customer-orders" role="tabpanel">
                                    <CustomerOrders :customerId="customer.id" />
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
import { defineProps, onMounted } from "vue";
import BasicEditForm from "@/Pages/AdminArea/Customer/Components/Basic/EditForm.vue";
import CustomerOrders from "@/Pages/AdminArea/Customer/Components/Orders/All.vue";

const props = defineProps({
    customer: {
        type: Object,
        required: true,
    },
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
</style>
