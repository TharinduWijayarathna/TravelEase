<template>
    <AppLayout>
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
                                    My cart
                                </li>
                            </ol>
                        </nav>
                        <h1 class="h3 mb-0 mt-3">My cart</h1>
                    </div>
                </section>

                <section class="pt-0">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8 mb-6 mb-lg-0">
                                <form class="card bg-transparent">
                                    <div
                                        class="card-header bg-transparent d-flex justify-content-between align-items-center border-bottom px-0 pt-0">
                                        <!-- <h5 class="mb-0" v-if="cartItemData?.length > 0">
                                            {{ cartItemData.length }} products
                                        </h5>
                                        <h5 class="mb-0" v-else>
                                            Cart is empty
                                        </h5> -->

                                        <h5 class="mb-0" v-if="cartCount > 0">
                                            {{ cartCount }} Products
                                        </h5>
                                        <h5 class="mb-0" v-else>
                                            Cart is empty
                                        </h5>

                                        <button class="btn btn-sm btn-danger-soft mb-0" v-if="cartItemData?.length > 0"
                                            @click.prevent="deleteCart(cartData.id)">
                                            <i class="bi bi-x-lg me-1"></i>Clear cart
                                        </button>
                                        <!-- <button class="btn btn-sm btn-danger-soft mb-0" v-else
                                            @click.prevent="emptyCartMessage()">
                                            <i class="bi bi-x-lg me-1"></i>
                                            Clear cart
                                        </button> -->
                                    </div>

                                    <!-- a {{ cartItemData }} -->

                                    <div class="card-body px-0">
                                        <div class="row align-items-xl-center" v-for="value in cartItemData">
                                            <div class="col-5 col-md-2">
                                                <div class="bg-light p-2 rounded-2">
                                                    <Link class=""
                                                        :href="route('product.single', { id: value.product_id, })">
                                                    <!-- <img :src="value.product?.product_image[0]?.image.name" alt="" /> -->

                                                    <div class="" v-if="value.product.product_image.length > 0">
                                                        <div class="bg-light rounded"
                                                            v-for="product_image in value.product.product_image.filter((image) => image.status == 1)"
                                                            :key="product_image.id">
                                                            <div class="image-wrapper"
                                                                style="width: auto; height: 100px; overflow: hidden; position: relative;">
                                                                <img :src="product_image.image_url"
                                                                    alt="primary image missed"
                                                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 100%; height: 100%; object-fit: cover; border-radius: 10px " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="" v-else>
                                                        <div class="bg-light rounded">
                                                            <div class="image-wrapper"
                                                                style="width: auto; height: 100px; overflow: hidden; position: relative;">
                                                                <img :src="invalidImage" alt="primary image missed"
                                                                    style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); max-width: none; max-height: none; width: 80%; height: 80%; object-fit: cover; border-radius: 10px " />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </Link>
                                                </div>
                                            </div>

                                            <div class="col-7 col-md-10 mb-2">
                                                <div class="row g-3 g-sm-4">
                                                    <div class="col-xl-5">
                                                        <Link class=""
                                                            :href="route('product.single', { id: value.product_id, })">
                                                        <h6 class="mb-1">
                                                            <a href="#">{{ value.product?.name }}</a>
                                                        </h6>
                                                        </Link>
                                                        <ul class="nav nav-divider small align-items-center mt-1">
                                                            <li class="nav-item">
                                                                Item Discount: Rs.{{
                                                                    numberFormatter(value?.unit_discount) }}
                                                            </li>
                                                            <!-- <li class="nav-item">Color: Midblue</li> -->
                                                            <!-- <li class="nav-item">Size: XL, L, M, S</li> -->
                                                        </ul>
                                                        <ul class="nav nav-divider small align-items-center mt-1">
                                                            <li class="nav-item">
                                                                Total Discount: Rs.{{
                                                                    numberFormatter(value?.total_discount) }}
                                                            </li>
                                                            <!-- <li class="nav-item">Color: Midblue</li> -->
                                                            <!-- <li class="nav-item">Size: XL, L, M, S</li> -->
                                                        </ul>
                                                        <ul class="nav nav-divider small align-items-center mt-1">
                                                            <li class="nav-item">
                                                                Unit Price: Rs. {{ numberFormatter(value?.unit_price) }}
                                                            </li>
                                                        </ul>
                                                        <ul class="nav nav-divider small align-items-center mt-1">
                                                            <li class="nav-item">
                                                                <div class=""
                                                                    v-if="value.product?.quantity >= newQuantity[value.id]?.quantity">
                                                                    Availability:
                                                                    <span class="badge bg-success">in stock</span>
                                                                </div>
                                                                <div class="" v-else>
                                                                    Availability:
                                                                    <span
                                                                        class="badge bg-warning text-dark">unavailable</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>

                                                    <div class="col-sm-6 col-md-4 col-xl-2">
                                                        <div class="wrap">
                                                            <div class="wrapper">
                                                                <span class="minus"
                                                                    @click=" decrement(value.id)">-</span>
                                                                <input class="num" type="number" min="1" max="1000"
                                                                    v-model="newQuantity[value.id].quantity"
                                                                    @change=" updateQuantity(value.id)" />
                                                                <span class="plus" @click="increment(value.id)">+</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 col-md-4 col-xl-3 text-md-right">
                                                        <span class="heading-color fw-semibold mb-0 items-total">
                                                            Rs.{{ numberFormatter(value.total) }}
                                                        </span>
                                                    </div>

                                                    <div class="col-xl-2 text-md-center">
                                                        <a href="#" class="text-danger small"
                                                            @click.prevent="removeCartItem(value.id)">
                                                            <i class="bi bi-x-lg"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                        </div>
                                        <!-- Button -->
                                        <!-- <div class="text-end">
                                            <button class="btn btn-light border mb-0"
                                                @click.prevent="updateCart()">Update cart</button>
                                        </div> -->
                                    </div>
                                </form>
                            </div>

                            <div class="col-lg-4 ps-xl-6">
                                <div class="card border p-4">
                                    <h5 class="card-title mb-0">
                                        Payment
                                    </h5>
                                    <div class="card-header p-0 pb-3">
                                        <!-- <h5 class="card-title mb-0">
                                            Promo code
                                          </h5> -->
                                        <!-- Input -->
                                        <!-- <form class="input-group mt-4">
                                                <input class="form-control rounded me-1" type="email" placeholder="Type here..">
                                                <button type="button" class="btn btn-dark rounded-2 mb-0">Apply</button>
                                            </form> -->
                                    </div>

                                    <div class="card-body p-0 pb-3 mt-2">
                                        <ul class="list-group list-group-borderless">
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>Subtotal</span>
                                                <span class="heading-color fw-semibold mb-0">
                                                    Rs.{{ numberFormatter(cartData?.sub_total) }}
                                                </span>
                                            </li>
                                            <!-- <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Service Charge</span>
                                            <span class="heading-color fw-semibold mb-0">-$50</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>Tax</span>
                                            <span class="heading-color fw-semibold mb-0">$10</span>
                                        </li> -->
                                        </ul>
                                    </div>

                                    <div class="card-footer bg-transparent border-top p-0 pt-3">
                                        <div class="d-flex justify-content-between align-items-center mb-4">
                                            <span class="heading-color fw-normal">Payable Now</span>
                                            <span class="h6 mb-0">
                                                Rs. {{ numberFormatter(cartData?.total) }}
                                            </span>
                                        </div>

                                        <div class="d-grid">
                                            <button href="#" class="btn btn-lg btn-primary mb-0"
                                                @click.prevent="checkOut()">
                                                Continue to Checkout
                                            </button>
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
import { onMounted, onBeforeUnmount, ref, computed, watch } from "vue";
import axios from "axios";
import Swal from "sweetalert2";
import { usePage, Link, router } from "@inertiajs/vue3";
import invalidImage from '@/../src/AdminArea/img/product/invalid_image.png';
import { Inertia } from "@inertiajs/inertia";
import { emitter, CART_REFRESH } from "@/event-bus.js";

const cartCount = ref({});
const cartItemData = ref({});
const cartData = ref({});
const newQuantity = ref({});
const cartId = ref(0);
const user = usePage().props.auth.user;

const checkOut = async () => {
    try {
        const response = await axios.post(route('cart.checkOut', cartId.value))
            .then((response) => {
                emitter.emit(CART_REFRESH);
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Order placed successfully",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                emitter.emit(CART_REFRESH);
                
                updateCart();
                getCart();
                getCartCount();
                getCartItems();
                
            })
            .catch((error) => {
                console.log("Error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to place order",
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

const getCartItems = async () => {
    try {
        const response = await axios.get(route("cart.item.get", user.id));
        cartItemData.value = response.data.cart_item;
        if (cartItemData.value) {
            cartItemData.value.forEach((item) => {
                newQuantity.value[item.id] = {
                    quantity: item.quantity,
                    cartId: item.id,
                };
            });
            cartId.value = cartItemData.value[0].cart_id;
            updateCart();
            getCart();
        }
        emitter.emit(CART_REFRESH);
    } catch (error) {
        console.log("Error", error);
    }
};

const updateCart = async () => {
    try {
        const response = await axios.post(route("cart.update", cartId.value));
        emitter.emit(CART_REFRESH);
    } catch (error) {
        console.log("Error", error);
    }
};

const getCart = async () => {
    try {
        const response = await axios.get(route("cart.get", user.id));
        cartData.value = response.data.cart[0];
        emitter.emit(CART_REFRESH);
    } catch (error) {
        console.log("Error", error);
    }
};

const emptyCartMessage = () => {
    Swal.fire({
        title: "Nothing to clear",
        text: "Cart is empty",
        icon: "info",
    });
};

const removeCartItem = async (cart_item_id) => {
    try {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-outline-danger m-2",
                cancelButton: "btn btn-outline-success m-2",
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
                        const response = await axios.delete(
                            route("cart.item.delete", cart_item_id)
                        );
                        console.log("response", response);
                        getCartItems();
                        updateCart();
                        getCart();
                        emitter.emit(CART_REFRESH);
                    } catch (error) {
                        console.log("Error", error);
                    }
                }
            });
    } catch (error) {
        console.log(error);
    }
};

const deleteCart = async (cart_id) => {
    try {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-outline-danger m-2",
                cancelButton: "btn btn-outline-success m-2",
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
                        const response = await axios.delete(
                            route("cart.item.delete.all", cart_id)
                        );
                        getCartItems();
                        updateCart();
                        getCart();
                        emitter.emit(CART_REFRESH);
                    } catch (error) {
                        console.log("Error", error);
                    }
                }
            });
    } catch (error) {
        console.log(error);
    }
};

const updateQuantity = async (itemId) => {
    try {
        const { quantity } = newQuantity.value[itemId];
        const response = await axios.post(
            route("cart.item.quantity.update", itemId),
            {
                quantity: quantity,
            }
        );
        getCartItems();
        getCart();
        emitter.emit(CART_REFRESH);
    } catch (error) {
        console.log("Error", error);
    }
};

const increment = (itemId) => {
    if (newQuantity.value[itemId].quantity < 500) {
        newQuantity.value[itemId].quantity++;
        updateQuantity(itemId);
        getCartCount();
        emitter.emit(CART_REFRESH);
    }
};

const decrement = (itemId) => {
    if (newQuantity.value[itemId].quantity > 1) {
        newQuantity.value[itemId].quantity--;
        updateQuantity(itemId);
        getCartCount();
        emitter.emit(CART_REFRESH);
    }
};

const formatNumber = computed(() => {
    return newQuantity.value < 100
        ? "0" + newQuantity.value
        : newQuantity.value;
});

const numberFormatter = (number) => {
    if (number == undefined || number == null || number == Infinity) {
        return "0.00"; // or some default value
    }
    const parsedNumber = Number(number);
    if (isNaN(parsedNumber)) {
        return "0.00"; // or some default value
    }
    if (typeof parsedNumber !== "number") {
        return "0.00"; // or some default value
    }
    return parsedNumber.toLocaleString("en-US", {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2,
        useGrouping: true,
    });
};

const getCartCount = async () => {
    if (user.id) {
        try {
            const response = await axios.get(route("cart.item.count", user.id));
            cartCount.value = response.data;
            emitter.emit(CART_REFRESH);
        } catch (error) {
            console.log("Error", error);
        }
    }
};

watch(() => {
    getCart();
    getCartCount();
})


onMounted(() => {
    getCartItems();
    updateCart();
    getCart();
    getCartCount();
});

watch
</script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

.wrapper {
    height: 25px;
    min-width: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 5px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.151);
    widows: 50px;
    padding: 20px;
}

.wrapper span {
    width: 100%;
    text-align: center;
    font-size: 55px;
    font-weight: large;
    cursor: pointer;
    user-select: none;
}

.wrapper span.num {
    font-size: large;
    border-right: 2px solid rgba(0, 0, 0, 0.2);
    border-left: 2px solid rgba(0, 0, 0, 0.2);
    pointer-events: none;
    width: 50px;
}

.num {
    font-size: large;
    border-right: 2px solid rgba(0, 0, 0, 0.2);
    border-left: 2px solid rgba(0, 0, 0, 0.2);
    width: 50px;
    border: none;
    text-align: center;
}

.wrapper .plus {
    font-size: x-large;
}

.wrapper .minus {
    font-size: x-large;
}

.wrap {
    width: 10vh;
}

.right-align {
    text-align: right !important;
}

.items-total {
    display: block;
    text-align: right;
}
</style>
