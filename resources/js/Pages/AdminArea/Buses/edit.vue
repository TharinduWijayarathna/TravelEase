<template>
    <AdminLayout>
        <template #header>
            <div class="pb-6 header">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="py-4 col align-items-center">
                            <h6 class="mb-0 h2 d-inline-block">Bus Management</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('admin.dashboard')" class="text-dark">
                                        <i class="fa-solid fa-house"></i>
                                        </Link>
                                    </li>

                                    <li class="breadcrumb-item active text-dark" aria-current="page">
                                        <Link :href="route('admin.bus.index')" class="text-dark">
                                        Bus Management
                                        </Link>
                                        <input type="image" src="" alt="" />
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">
                                        {{ bus.code }}<input type="image" src="" alt="" />
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
                                    Bus Data</a>
                            </li>
                            <li class="mb-2 nav-item">
                                <a class="nav-link" id="bus-images-tab" data-toggle="tab" href="#bus-images"
                                    role="tab" aria-controls="bus-images" aria-selected="true">
                                    Bus Images</a>
                            </li>
                            <li class="mb-2 nav-item">
                                <a class="nav-link" id="bus-stops-tab" data-toggle="tab" href="#bus-stops"
                                    role="tab" aria-controls="bus-stops" aria-selected="true">
                                    Bus Stops</a>
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
                                    <BasicEditForm :busId="bus.id" />
                                </div>
                                <div class="tab-pane fade show" id="bus-images" role="tabpanel">
                                    <BusImagesAll :busId="bus.id" />
                                </div>
                                <div class="tab-pane fade show" id="bus-stops" role="tabpanel">
                                    <BusStopsALl :busId="bus.id" />
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
import BasicEditForm from "@/Pages/AdminArea/Buses/Components/Basic/EditForm.vue";
import BusImagesAll from "@/Pages/AdminArea/Buses/Components/BusImages/All.vue";
import BusStopsALl from "@/Pages/AdminArea/Buses/Components/BusStops/All.vue";

const props = defineProps({
    bus: {
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
