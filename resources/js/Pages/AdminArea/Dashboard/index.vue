<template>
    <AdminLayout title="Dashboard">
        <template #header>
            <div class="header pb-6">
                <div class="container-fluid">
                    <div class="header-body row">
                        <div class="col-lg-8 align-items-center py-4">
                            <h6 class="h2 text-maroon d-inline-block mb-0">Dashboard</h6>
                            <nav aria-label="breadcrumb" class="d-none d-md-block ">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('admin.dashboard')" class="text-dark">
                                        <i class="fa-solid fa-house"></i>
                                        </Link>
                                    </li>
                                    <li class="breadcrumb-item active breadcrumb-yellow" aria-current="page">
                                        Dashboard
                                    </li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </template>
        <template #content>
            <div class="mt-0 row">
                <div class="col-md-12 mt-1">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-4 card">
                                <div class="p-3 card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="mb-0 text-sm text-uppercase font-weight-bold"> SYSTEM USERS
                                                     </p>
                                                <h5 class="font-weight-bolder">{{ props.user_count }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-right">
                                            <div
                                                class="text-center icon icon-shape bg-gradient-secondary shadow-danger rounded-circle">
                                                <i class="fa fa-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-4 card">
                                <div class="p-3 card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="mb-0 text-sm text-uppercase font-weight-bold"> TOTAL BUSES
                                                     </p>
                                                <h5 class="font-weight-bolder">{{ props.bus_count }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-right">
                                            <div
                                                class="text-center icon icon-shape bg-gradient-secondary shadow-danger rounded-circle">
                                                <i class="fa fa-clock"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="mb-4 card">
                                <div class="p-3 card-body">
                                    <div class="row">
                                        <div class="col-8">
                                            <div class="numbers">
                                                <p class="mb-0 text-sm text-uppercase font-weight-bold"> TOTAL BOOKINGS
                                                     </p>
                                                <h5 class="font-weight-bolder">{{ props.booking_count }}</h5>
                                            </div>
                                        </div>
                                        <div class="col-4 text-right">
                                            <div
                                                class="text-center icon icon-shape bg-gradient-secondary shadow-danger rounded-circle">
                                                <i class="fa fa-clock"></i>
                                            </div>
                                        </div>
                                    </div>
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
import { ref, reactive, watch, onMounted, onBeforeMount } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { usePage } from "@inertiajs/vue3";
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faHandsHoldingCircle,
    faLocationDot,
    faDollarSign,
    faClock,
    faHandHoldingDollar,
    faChartSimple,
    faClockRotateLeft,
    faFolderOpen,
    faArrowUpRightFromSquare,
    faFileInvoice,
    faHouse,
    faListCheck,
    faPenToSquare,
    faUsersViewfinder,
    faPeopleCarryBox,
    faArrowRightArrowLeft,
    faReceipt,
    faAnglesRight,
} from "@fortawesome/free-solid-svg-icons";

import VueApexCharts from "vue3-apexcharts";

import { ValidationMixin } from "@/plugins/mixins";

const props = defineProps({
    user_count: Number,
    bus_count: Number,
    booking_count: Number,
});

library.add(faHouse);
library.add(faFileInvoice);
library.add(faChartSimple);
library.add(faFolderOpen);
library.add(faClockRotateLeft);
library.add(faArrowUpRightFromSquare);
library.add(faPenToSquare);
library.add(faListCheck);
library.add(faUsersViewfinder);
library.add(faPeopleCarryBox);
library.add(faArrowRightArrowLeft);
library.add(faReceipt);
library.add(faAnglesRight);
library.add(faClock);
library.add(faDollarSign);
library.add(faHandHoldingDollar);
library.add(faHandsHoldingCircle);
library.add(faLocationDot);

const textClassHead = ref("text-start text-uppercase");
const textClassHeadName = ref("text-center text-uppercase");
const textClassBody = ref("text-start");
const textClassBodyName = ref("text-center");
const iconClassHead = ref("text-center");
const iconClassBody = ref("text-center");
const valueClassHead = ref("text-right");
const valueClassBody = ref("text-right");

const item = ref({});

const loadDashboard = async () => {
    try {
        const dashboardData = (await axios.get(route("dashboard.load"))).data;
        item.value = dashboardData.data;
    } catch (error) {
        ValidationMixin.methods.convertValidationNotification(error);
    }
};

onMounted(() => {
    loadDashboard();
});

// onMounted(() => {

// });

// onBeforeMount(() => {
//     if (!window.Laravel) {
//         window.location.reload();
//     }
// });

// const taskView = () => {
//     try {
//         window.location.href = route("task.index");
//     } catch (error) {
//         console.log(error);
//     }
// }
</script>
