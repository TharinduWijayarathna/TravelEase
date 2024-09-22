<template>
    <AppLayout>
        <template #content>
            <section class="pb-5 pb-sm-7">
                <div class="container">
                    <nav aria-label="breadcrumb" style="margin-top: 80px;">
                        <ol class="breadcrumb breadcrumb-dots pb-0 mb-0">
                            <li class="breadcrumb-item">
                                <a href="#">Home</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Categories
                            </li>
                        </ol>
                    </nav>
                    <h1 class="h3 mb-0 mt-3">
                        Discover our wide selection of categories.
                    </h1>
                </div>
            </section>

            <section class="pt-0">
                <div class="container">
                    <div class="row g-4 g-lg-5">
                        <div class="col-sm-6 col-lg-4 col-xl-3" v-for="category in Categories" :key="category.id">
                            <div class="card card-hover-shadow border-primary-hover border h-100 p-4">
                                <div class="card-body p-0">
                                    <div class="d-flex gap-3 align-items-center mb-3">
                                        <div class="image-container" v-if="category?.image_url"
                                            style="width: 50px; height: 50px; overflow: hidden; margin-right: 10px;">
                                            <img :src="category.image_url" alt="primary image missed"
                                                style="max-width: none; max-height: none; width: 100%; height: 100%; object-fit: cover; border-radius: 10px;" />
                                        </div>
                                        <div class="image-container" v-else
                                            style="width: 50px; height: 50px; overflow: hidden; margin-right: 10px;">
                                            <img :src="invalidImage" alt="invalid image missed"
                                                style="max-width: none; max-height: none; width: 100%; height: 100%; object-fit: cover; border-radius: 10px;" />
                                        </div>

                                        <h6 class="mb-0">
                                            {{ category.name }}
                                        </h6>
                                    </div>
                                    <p>{{ category.description }}</p>
                                </div>

                                <div class="card-footer bg-transparent p-0 mt-6">
                                    <a href="integration-single.html"
                                        class="icon-link icon-link-hover heading-color text-primary-hover stretched-link mb-0">View
                                        items<i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination pagination-primary-soft d-flex justify-content-end mb-0 mt-5">
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
                                        <li class="page-item" :class="pagination.current_page == 1 ? 'disabled' : ''">
                                            <a class="page-link page-link-attributes" href="javascript:void(0)"
                                                @click="setPage(pagination.current_page - 1)">
                                                <i class="fa-solid fa-angles-left"></i>
                                            </a>
                                        </li>
                                        <template v-for="(page, index) in pagination.last_page">
                                            <template
                                                v-if="page == 1 || page == pagination.last_page || Math.abs(page - pagination.current_page) < 5">
                                                <li class="page-item" :key="index"
                                                    :class="pagination.current_page == page ? 'active' : ''">
                                                    <a class="page-link page-link-attributes" @click="setPage(page)">{{ page
                                                        }}</a>
                                                </li>
                                            </template>
                                        </template>
                                        <li class="page-item"
                                            :class="pagination.current_page == pagination.last_page ? 'disabled' : ''">
                                            <a class="page-link page-link-attributes" href="javascript:void(0)"
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
            </section>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Swiper from "swiper";
import { onMounted, onBeforeUnmount, ref } from "vue";
import axios from "axios";
import invalidImage from '@/../src/AdminArea/img/product/invalid_image.png';

const Categories = ref({});

const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});

const reload = async () => {
    try {
        const response = (
            await axios.get(route("category.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                },
            })
        ).data;
        Categories.value = response.data;
        pagination.value = response;
    } catch (error) {
        console.log("Error", error);
    }
};

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

onMounted(() => {
    reload();
});
</script>

<style lang="scss">

.page-link-attributes{
    cursor: pointer;
}
</style>