<template>
    <div>

        <Head :title="title ? title : 'TravelEase'">
            <link rel="icon" type="image/svg+xml" href="/img/logo/logo_white.png" />
            <slot name="meta_head" />
        </Head>
        <div>

            <slot name="content" />

        </div>
        <slot name="modal" />
        <slot name="loader" />
    </div>
</template>
<script setup>
import { Head, Link } from '@inertiajs/vue3';



import '../../css/app.css';

import '../../src/PublicArea/vendor/bootstrap/dist/js/bootstrap.bundle.min.js';
import '../../src/PublicArea/vendor/purecounterjs/dist/purecounter_vanilla.js';
import '../../src/PublicArea/vendor/swiper/swiper-bundle.min.js';
import '../../src/PublicArea/vendor/jarallax/jarallax.min.js';
import '../../src/PublicArea/vendor/jarallax/jarallax-video.min.js';
// import '../../src/PublicArea/vendor/sticky-js/sticky.min.js';
// import '../../src/PublicArea/js/functions.js';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../../vendor/tightenco/ziggy/dist/vue.m';


const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    // resolve: (name) => resolvePageComponent(`../Pages/${name}.vue`, import.meta.glob('../Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
import '.././bootstrap';
</script>
../bootstrap
