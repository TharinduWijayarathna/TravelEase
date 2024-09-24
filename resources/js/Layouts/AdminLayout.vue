<template>
    <div>

        <Head :title="title ? title : 'TravelEase'">

            <!-- Favicon and Touch Icons-->
            <link rel="apple-touch-icon" sizes="180x180" href="/img/logo/favicon.png" />
            <link rel="icon" type="image/png" sizes="32x32" href="/img/logo/favicon.png" />
            <link rel="icon" type="image/png" sizes="16x16" href="/img/logo/favicon.png" />
            <link rel="manifest" href="assets/img/site.webmanifest" />
            <link rel="mask-icon" href="/img/logo/favicon.png" />

            <slot name="meta_head" />
        </Head>
        <SideBar />
        <div class="main-content" id="panel">
            <div class="ml--6 fixed-content">
                <NavBar />
            </div>
            <div class="fixed-content">
                <slot name="header" />
            </div>
            <div class="container-fluid mt--6 fixed-content">
                <slot name="content" />
            </div>
        </div>
        <Footer />
        <slot name="modals" />
        <slot name="loader" />
    </div>
</template>


<script setup>
import { Head, Link } from '@inertiajs/vue3'
import SideBar from '@/Components/AdminArea/Main/SideBar.vue';
import NavBar from '@/Components/AdminArea/Main/NavBar.vue';


import '.././bootstrap';
import '../../css/admin.css';
import '../../src/AdminArea/js/plugins/jquery/dist/jquery.min.js';
import 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js';
import '../../src/AdminArea/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js';
import '../../src/AdminArea/vendor/js-cookie/js.cookie.js';
import '../../src/AdminArea/js/argon.js';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../../vendor/tightenco/ziggy/dist/vue.m';

import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'
import VueApexCharts from "vue3-apexcharts";
import VueNumberFormat from '@coders-tm/vue-number-format'
/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'SLO';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    // resolve: (name) => resolvePageComponent(`../Pages/${name}.vue`, import.meta.glob('../Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(LaravelPermissionToVueJS)
            .use(VueApexCharts)
            .use(VueNumberFormat, { precision: 2, decimal: '.' })
            .component('font-awesome-icon', FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});


</script>

<style lang="scss">
body {
    background-image: url('../../src/AdminArea/img/banner/bg.png');
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    height: 100vh;
}

.bg-header {
    background-color: #55699f;
}

.table-responsive {
    overflow: auto;
}

@media screen and (max-width: 1199px) {
    .fixed-content {
        margin-left: 15rem !important;
        width: auto;
    }
}

@media screen and (min-width: 1200px) {
    .fixed-content {
        margin-left: 2rem !important;
        width: auto;
    }
}

@media screen and (max-width: 768px) {
    .fixed-content {
        margin-left: 0rem !important;
        width: auto;
    }
}
</style>
