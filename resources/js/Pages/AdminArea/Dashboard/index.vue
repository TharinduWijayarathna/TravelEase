<template>
    <AdminLayout title="Dashboard">
        <template #header> </template>
        <template #content> </template>
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

const { props } = usePage();

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

<style>
.cls-1 {
    fill: #699f4c;
    fill-rule: evenodd;
}
</style>
