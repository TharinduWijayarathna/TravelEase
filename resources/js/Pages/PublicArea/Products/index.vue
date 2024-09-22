<template>
    <AppLayout title="Shop">
        <template #content>
            <main>
                <section class="pb-5 pb-sm-7">
                    <div class="container">
                        <nav aria-label="breadcrumb" style="margin-top: 80px;">
                            <ol class="breadcrumb breadcrumb-dots pb-0 mb-0">
                                <li class="breadcrumb-item">
                                    <Link :href="route('home')">Home</Link>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Shop
                                </li>
                            </ol>
                        </nav>
                        <h1 class="h3 mb-0 mt-3">
                            Explore our diverse range of products.
                        </h1>
                    </div>
                </section>

                <section class="pt-0">
                    <div class="container">
                        <div class="row">
                            <aside class="col-xl-3">
                                <form>
                                    <div class="offcanvas-xl offcanvas-end" tabindex="-1" id="offcanvasSidebar"
                                        aria-labelledby="offcanvasSidebarLabel">
                                        <div class="offcanvas-header bg-light">
                                            <h6 class="offcanvas-title" id="offcanvasSidebarLabel">
                                                Advance Filter
                                            </h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                                data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body flex-column p-3 p-xl-0">
                                            <div class="accordion accordion-alt" id="accordionExample">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button fs-6 fw-semibold collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseOne" aria-expanded="false"
                                                            aria-controls="collapseOne">
                                                            Availability
                                                        </button>
                                                    </h2>
                                                    <div id="collapseOne" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionExample">
                                                        <form class="accordion-body" id="availabilityForm">
                                                            <div class="form-check">
                                                                <input class="form-check-input focus-shadow-none"
                                                                    type="radio" name="flexRadioDefault"
                                                                    id="flexRadioDefault1" checked value="all"
                                                                    v-model="filterForm.availability"
                                                                    @change=" updateAvailability('all')" />
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    All
                                                                </label>
                                                            </div>
                                                            <!-- <div class="form-check mt-2">
															<input class="form-check-input focus-shadow-none" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
															<label class="form-check-label" for="flexRadioDefault2">
																New Arrival
															</label>
															</div> -->
                                                            <div class="form-check mt-2">
                                                                <input class="form-check-input focus-shadow-none"
                                                                    type="radio" name="flexRadioDefault"
                                                                    id="flexRadioDefault3" value="on_stock"
                                                                    v-model="filterForm.availability"
                                                                    @change=" updateAvailability('on_stock')" />
                                                                <label class="form-check-label" for="flexRadioDefault3">
                                                                    On Stock Only
                                                                </label>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button fs-6 fw-semibold collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseTwo" aria-expanded="true"
                                                            aria-controls="collapseTwo">
                                                            Categories
                                                        </button>
                                                    </h2>
                                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                                        data-bs-parent="#accordionExample">
                                                        <form class="accordion-body">
                                                            <div class="form-check" v-for="category in categories"
                                                                :key="category.id">
                                                                <input class="form-check-input" type="checkbox"
                                                                    v-model="filterForm.selected_category"
                                                                    :value="category.id" />
                                                                <label class="form-check-label heading-color">
                                                                    {{ category.name }}</label>
                                                                <span class="small float-end">
                                                                    ({{ category.product.length }})
                                                                </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="accordion-item">
                                                    <h2 class="accordion-header">
                                                        <button class="accordion-button fs-6 fw-semibold collapsed"
                                                            type="button" data-bs-toggle="collapse"
                                                            data-bs-target="#collapseThree" aria-expanded="true"
                                                            aria-controls="collapseThree">
                                                            Price
                                                        </button>
                                                    </h2>
                                                    <div id="collapseThree" class="accordion-collapse collapse"
                                                        data-bs-parent="#accordionExample">
                                                        <div class="row mt-2">
                                                            <div class="col-6">
                                                                <label for="minPrice">Min
                                                                    Price</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">Rs</span>
                                                                    <input type="text"
                                                                        class="form-control with-currency" min="0"
                                                                        id="minPrice" v-model="filterForm.min_price
                                                                            " />
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="maxPrice">Max
                                                                    Price</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text">Rs</span>
                                                                    <input type="text"
                                                                        class="form-control with-currency" min="0"
                                                                        id="maxPrice" v-model="filterForm.max_price
                                                                            " />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Color -->
                                                <!-- <div class="accordion-item">
											<h2 class="accordion-header">
												<button class="accordion-button fs-6 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
													Color
												</button>
											</h2>
											<div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
												<form class="accordion-body">
										
														<div class="color-check-radio">
															<input class="form-check-input" type="radio" name="flexRadiocolor" id="flexRadiocolor1" style="background-color: #9a0a0a;">
															<label class="form-check-label" for="flexRadiocolor1"></label>
										
															<input class="form-check-input" type="radio" name="flexRadiocolor" id="flexRadiocolor2" style="background-color: #32C7F5;">
															<label class="form-check-label" for="flexRadiocolor2"></label>
										
															<input class="form-check-input" type="radio" name="flexRadiocolor" id="flexRadiocolor3" style="background-color: #F7C32E;">
															<label class="form-check-label" for="flexRadiocolor3"></label>
										
															<input class="form-check-input" type="radio" name="flexRadiocolor" id="flexRadiocolor4" style="background-color: #333369;">
															<label class="form-check-label" for="flexRadiocolor4"></label>
														</div>
													</form>
												</div>
											</div> -->

                                                <!-- Rating star -->
                                                <!-- <div class="accordion-item">
												<h2 class="accordion-header">
													<button class="accordion-button fs-6 fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
														Rating star
													</button>
												</h2>
												<div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
													<form class="accordion-body">
														<ul class="list-inline mb-0 g-3">
															
															<li class="list-inline-item mb-0">
																<input type="checkbox" class="btn-check" id="btn-check-6">
																<label class="btn btn-sm btn-light btn-primary-soft-check" for="btn-check-6">1<i class="bi bi-star-fill"></i></label>
															</li>
															
															<li class="list-inline-item mb-0">
																<input type="checkbox" class="btn-check" id="btn-check-7">
																<label class="btn btn-sm btn-light btn-primary-soft-check" for="btn-check-7">2<i class="bi bi-star-fill"></i></label>
															</li>
															
															<li class="list-inline-item mb-0">
																<input type="checkbox" class="btn-check" id="btn-check-8">
																<label class="btn btn-sm btn-light btn-primary-soft-check" for="btn-check-8">3<i class="bi bi-star-fill"></i></label>
															</li>
															
															<li class="list-inline-item mb-0">
																<input type="checkbox" class="btn-check" id="btn-check-15">
																<label class="btn btn-sm btn-light btn-primary-soft-check" for="btn-check-15">4<i class="bi bi-star-fill"></i></label>
															</li>
															
															<li class="list-inline-item mb-0">
																<input type="checkbox" class="btn-check" id="btn-check-16">
																<label class="btn btn-sm btn-light btn-primary-soft-check" for="btn-check-16">5<i class="bi bi-star-fill"></i></label>
															</li>
														</ul>
													</form>
												</div>
											</div> -->
                                            </div>
                                            <div class="d-flex justify-content-between p-2 p-xl-0 mt-xl-3">
                                                <button class="btn btn-link text-primary-hover p-0 mb-0"
                                                    @click.prevent=" clearFilter()"> Clear all
                                                </button>
                                                <button class="btn btn-primary mb-0" @click.prevent=" filterProducts()">
                                                    Filter Result
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </aside>

                            <div class="col-xl-9 ps-xl-6">
                                <form class="row g-2 g-xl-4 mb-4">
                                    <!-- <div class="col-md-6">
                                        <div class="rounded position-relative">
                                            <input class="form-control bg-light pe-5" type="search"
                                                placeholder="Search products by name or keyword..." aria-label="Search"
                                                v-model="productName" />
                                            <button
                                                class="btn bg-transparent border-0 px-2 py-0 position-absolute top-50 end-0 translate-middle-y"
                                                @click.prevent="searchByName">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div> -->

                                    <div class="col-sm-6 col-md-3 ms-auto">
                                        <select class="form-select" aria-label="Default select example" v-model="sortBy"
                                            @change="sortProducts">
                                            <option disabled selected value="">
                                                Sort by
                                            </option>
                                            <option value="1">Name</option>
                                            <option value="2">
                                                Low to High Price
                                            </option>
                                            <option value="3">
                                                High to Low Price
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-sm-6 col-md-3 d-grid d-xl-none">
                                        <button class="btn btn-dark mb-0" type="button" data-bs-toggle="offcanvas"
                                            data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
                                            <i class="fas fa-sliders-h me-1"></i>
                                            Show filter
                                        </button>
                                    </div>
                                </form>

                                <div class="row g-4 g-lg-5" v-if="products.length > 0">
                                    <div class="col-sm-6 col-lg-4" v-for="(product, index) in products"
                                        :key="product.id">
                                        <div class="card border bg-transparent overflow-hidden p-0 h-100">
                                            <Link class="" :href="route('product.single', { id: product.id, })">
                                            <div
                                                class="position-absolute start-0 top-0 d-flex align-items-start w-100 z-index-2 p-3">
                                                <div class="position-absolute top-0 start-0 p-3"
                                                    v-if="product.featured == 1">
                                                    <span class="badge text-bg-dark">Featured</span>
                                                </div>
                                                <div class="ms-auto" v-if="user">
                                                    <div class="ms-auto">
                                                        <div class="ms-auto" v-if="checkWishList">
                                                            <div class="ms-auto" v-if="wishListStatus[index] == 1">
                                                                <div class="ms-auto">
                                                                    <button
                                                                        class="btn btn-light btn-round border mb-0 ms-auto"
                                                                        @click.prevent="removeFromWishList(product.id)">
                                                                        <i class="bi bi-heart-fill text-danger"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                            <div v-else>
                                                                <div class="ms-auto">
                                                                    <button
                                                                        class="btn btn-light btn-round border mb-0 ms-auto"
                                                                        @click.prevent="addToWishList(product.id)">
                                                                        <i class="bi bi-heart"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="" v-if="product.product_image.length > 0">
                                                <div class="bg-light rounded"
                                                    v-for="product_image in product.product_image.filter((image) => image.status == 1)"
                                                    :key="product_image.id">
                                                    <div class="image-wrapper"
                                                        style="width: auto; height: 250px; overflow: hidden; position: relative;">
                                                        <img :src="product_image.image_url" alt="primary image missed"
                                                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 90%; height: 95%; object-fit: cover; border-radius: 10px;" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="" v-else>
                                                <div class="bg-light rounded">
                                                    <div class="image-wrapper"
                                                        style="width: auto; height: 250px; overflow: hidden; position: relative; border-radius: 10px;">
                                                        <img :src="invalidImage" alt="primary image missed"
                                                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 90%; height: 95%; object-fit: cover;" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-body pb-0">
                                                <h6 class="card-title">
                                                    <a href="shop-single.html" class="stretched-link">
                                                        {{ product.name }}
                                                    </a>
                                                </h6>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item me-0 small">
                                                        <i class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item me-0 small">
                                                        <i class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item me-0 small">
                                                        <i class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item me-0 small">
                                                        <i class="fas fa-star text-warning"></i>
                                                    </li>
                                                    <li class="list-inline-item me-0 small">
                                                        <i class="fas fa-star-half-alt text-warning"></i>
                                                    </li>
                                                </ul>
                                                <div class="" v-if="product.discount_price > 0.00">
                                                    Discount: Rs.{{ product.discount_price }}
                                                </div>
                                                <div class="" v-else>
                                                    <br>
                                                </div>
                                            </div>
                                            </Link>
                                            <div
                                                class="card-footer bg-transparent d-flex justify-content-between align-items-center pt-0">
                                                <div class="" v-if="product.discount_price > 0.00">
                                                    <div class="fw-bold mb-0" v-if="product.discount_price">
                                                        <del>Rs.{{ product.price }}</del>
                                                    </div>
                                                    <div class="fw-bold text-success mb-0"
                                                        v-if="product.discount_price">
                                                        Rs.{{ product.price - product.discount_price }}
                                                    </div>
                                                </div>
                                                <div class="" v-else>
                                                    <div class="fw-bold text-success mb-0">
                                                        <br>
                                                        Rs.{{ product.price }}
                                                    </div>
                                                </div>

                                                <a v-if="user" href="#" class="btn btn-dark mb-0 z-index-2"
                                                    @click.prevent=" addToCard(product.id)">
                                                    <i class="bi bi-cart"></i>
                                                </a>

                                                <Link v-else :href="route('customer.login')"
                                                    class="btn btn-dark mb-0 z-index-2">
                                                <i class="bi bi-cart"></i>
                                                </Link>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-4 g-lg-5 mt-5 text-center product-match" v-else>
                                    <div class="">
                                        <h2>We're sorry, </h2>
                                        <h4>unable to find the products!</h4>
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
                                                    <li class="page-item page-link-attributes"
                                                        :class="pagination.current_page == 1 ? 'disabled' : ''">
                                                        <a class="page-link" href="javascript:void(0)"
                                                            @click="setPage(pagination.current_page - 1)">
                                                            <i class="fa-solid fa-angles-left"></i>
                                                        </a>
                                                    </li>
                                                    <template v-for="(page, index) in pagination.last_page">
                                                        <template
                                                            v-if="page == 1 || page == pagination.last_page || Math.abs(page - pagination.current_page) < 5">
                                                            <li class="page-item page-link-attributes" :key="index"
                                                                :class="pagination.current_page == page ? 'active' : ''">
                                                                <a class="page-link" @click="setPage(page)">{{ page
                                                                    }}</a>
                                                            </li>
                                                        </template>
                                                    </template>
                                                    <li class="page-item page-link-attributes"
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
                </section>
            </main>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted, onBeforeUnmount, ref } from "vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import axios from "axios";
import Swal from "sweetalert2";
import invalidImage from '@/../src/AdminArea/img/product/invalid_image.png';
import { emitter, CART_REFRESH } from "@/event-bus.js";

const page = ref(1);
const pageCount = ref(25);
const perPage = ref([25, 50, 100]);
const pagination = ref({});

const wishList = ref({});
const checkWishList = ref([]);
const wishListStatus = ref([]);
const products = ref([]);
const categories = ref({});
const sortBy = ref("");
const productName = ref("");
const user = usePage().props.auth.user;
const productData = ref({
    unit_price: '',
    unit_discount: '',

});
const filterForm = ref({
    selected_category: [],
});

const isInWishlist = async () => {
    try {
        var customer_id = user.id;
        const response = await axios.get(route('wishList.check', { customer_id }));
        checkWishList.value = response.data;
        const productIds = products.value.map(product => product.id);
        const wishListProductIds = checkWishList.value.map(item => item.product_id);
        productIds.forEach((productId, index) => {
            if (wishListProductIds.includes(productId)) {
                const statusIndex = wishListProductIds.indexOf(productId);
                const status = checkWishList.value[statusIndex].status;
                if (status === 0) {
                    wishListStatus.value[index] = 0;
                } else {
                    wishListStatus.value[index] = 1;
                }
            } else {
                wishListStatus.value[index] = 0;
            }
        });
        reload();
    } catch (error) {
        console.error('Error:', error);
    }
};

const getCategories = async () => {
    try {
        const response = (
            await axios.get(route("category.all"))
        ).data;
        categories.value = response.data;
    } catch (error) {
        console.log("Error", error);
    }
};

const reload = async () => {
    try {
        const response = (
            await axios.get(route("product.all"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                },
            })
        ).data;

        products.value = response.data;
        pagination.value = response;
    } catch (error) {
        console.log("Error", error);
    }
};

const getSelectedProductData = async (product_id) => {
    try {
        const response = await axios.get(route('product.get', product_id));
        productData.value.unit_price = response.data.price;
        productData.value.unit_discount = response.data.discount_price;
    } catch (error) {
        console.log('Error', error);
    }
}

const addToCard = async (product_id) => {
    try {
        await getSelectedProductData(product_id);
        const customer_id = user.id;
        productData.value.created_by = user.first_name;
        const response = await axios
            .post(route("cart.item.store", { customer_id, product_id }), productData.value)
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Product added to cart!",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                });
                emitter.emit(CART_REFRESH);
                reload();
            })
            .catch((error) => {
                console.log("Error:", error);
                Swal.fire({
                    icon: "warning",
                    title: "Warning",
                    text: "Oops! Already in cart.",
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

// const addToCard = async (product_id) => {
//     try {
//         await getSelectedProductData(product_id);
//         const customer_id = user.id;
//         productData.value.created_by = user.first_name,
//             console.log('product data', productData.value);
//         const response = await axios
//             .post(route("cart.item.store", { customer_id, product_id }), productData.value)
//             .then((response) => {
//                 Swal.fire({
//                     icon: "success",
//                     title: "Success",
//                     text: "Product added to cart!",
//                     toast: true,
//                     position: "top-end",
//                     showConfirmButton: false,
//                     timer: 1500,
//                     timerProgressBar: true,
//                 });
//             })
//             .catch((error) => {
//                 console.log("Error:", error);
//                 Swal.fire({
//                     icon: "warning",
//                     title: "Warning",
//                     text: "Oops! Already in cart.",
//                     toast: true,
//                     position: "top-end",
//                     showConfirmButton: false,
//                     timer: 3000,
//                     timerProgressBar: true,
//                 });
//             });
//     } catch (error) {
//         console.log("Error:", error);
//     }
// };

const updateAvailability = (value) => {
    filterForm.value.availability = value;
};

const filterProducts = async () => {
    try {
        const response = (
            await axios.post(route("product.filter"), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    filterForm: filterForm.value,
                },
            })
        ).data;
        console.log('im filter', response.data.length);
        products.value = response.data;
        if (response.data && response.data.length > 0) {

            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Product filter successfully!",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
        } else {
            Swal.fire({
                icon: "warning",
                title: "Oops!",
                text: "No matching products found.",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
        }
    } catch (error) {
        console.log("Error:", error);
        Swal.fire({
            icon: "warning",
            title: "Oops!",
            text: "An error occurred. Please try again later.",
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
        });
    }

};

const clearFilter = () => {
    // filterForm.value = [];
    // filterForm.value.availability = "all";
    router.visit(route('products.index'));
};

const sortProducts = () => {
    console.log(sortBy.value);
    try {
        if (sortBy.value == 1) {
            products.value = products.value.sort((a, b) =>
                a.name.localeCompare(b.name)
            );
        } else if (sortBy.value == 2) {
            products.value = products.value.sort((a, b) => a.price - b.price);
        } else if (sortBy.value == 3) {
            products.value = products.value.sort((a, b) => b.price - a.price);
        }
    } catch (error) {
        console.log("Error", error);
    }
};

const searchByName = async () => {
    try {
        const response = await axios.post(route("product.search"), {
            name: productName.value,
        });
        console.log("pr by name", response.data.searched_product);
        products.value = response.data.searched_product;
    } catch (error) {
        console.log("Error", error);
    }
};

const addToWishList = async (product_id) => {
    try {
        const customer_id = user.id;
        const response = await axios.post(route('wishList.add', { customer_id, product_id }));
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "Product successfully added to your wishlist."
        });
        reload();
        isInWishlist();
        console.log('white list', response);
    } catch (error) {
        console.log('Error', error);
    }
}

const removeFromWishList = async (product_id) => {
    try {
        const customer_id = user.id;
        const response = await axios.post(route('wishList.remove', { customer_id, product_id }));
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "Product successfully removed from your wishlist",
        });

        reload();
        isInWishlist();
    } catch (error) {
        console.log('Error', error);
    }
}


onMounted(() => {
    getCategories();
    reload();
    isInWishlist();
});

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

<style lang="scss">
.with-currency {
    padding-left: 5px;
}

.input-group-text {
    left: 0;
    top: 0;
    bottom: 0;
    display: flex;
    background-color: #fff;
}

.page-link-attributes {
    cursor: pointer;
}
</style>
