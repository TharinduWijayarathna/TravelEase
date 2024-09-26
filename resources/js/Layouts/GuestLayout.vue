<script setup>
import '../../css/app.css';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="container min-vh-100 d-flex flex-column justify-content-center align-items-center w-25">
        <div class="mb-3">
            <a href="/">
                <img src="../../../public/assets/PublicArea/images/logo-no-background.svg" alt="Application Logo" width="150px" height="150px" />
            </a>
        </div>

        <div class="w-100 max-w-md mt-4 px-4 py-3 bg-white shadow-sm rounded-lg">
            <slot />
        </div>
    </div>
</template>
