<template>
	<AppLayout>
		<template #content>
			<main>
				<!--Content START -->
				<section class="pt-sm-7">
					<div class="container pt-3 pt-xl-5">
						<div class="row">
							<!-- Sidebar -->
							<div class="col-lg-4 col-xl-3">
								<!-- Responsive offcanvas body START -->
								<div class="offcanvas-lg offcanvas-start h-100" tabindex="-1" id="offcanvasSidebar">
									<!-- Offcanvas header -->
									<div class="offcanvas-header bg-light">
										<h5 class="offcanvas-title" id="offcanvasNavbarLabel">My profile</h5>
										<button type="button" class="btn-close" data-bs-dismiss="offcanvas"
											data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
									</div>
									<!-- Offcanvas body -->
									<div class="offcanvas-body p-0">
										<div class="card border p-3 w-100">
											<!-- Card header -->
											<div class="card-header text-center border-bottom">
												<!-- Avatar -->
												<div class="avatar avatar-xl position-relative mb-2">
													<img class="avatar-img rounded-circle border border-2 border-white"
														v-if="user.image_url" :src="user.image_url" alt="" />
													<img v-else
														class="avatar-img rounded-circle border border-2 border-white"
														src="assets/PublicArea/images/avatar/user.jpg" alt="" />
												</div>

												<h6 class="mb-0">
													{{ $page.props.auth.user.first_name }}
													{{ $page.props.auth.user.last_name }}
												</h6>
												<a href="#" class="text-reset text-primary-hover small">
													{{ $page.props.auth.user.email }}
												</a>
											</div>

											<!-- Card body START -->
											<div class="card-body p-0 mt-4">
												<!-- Sidebar menu item START -->
												<ul class="nav nav-pills-primary-border-start flex-column">
													<li class="nav-item">
														<Link class="nav-link" :href="route('customer.index')"><i
															class="bi bi-person fa-fw me-2"></i>My profile</Link>
													</li>
													<li class="nav-item">
														<Link class="nav-link" :href="route('payments')"><i
															class="bi bi-wallet fa-fw me-2"></i>Payment details</Link>
													</li>
													<li class="nav-item">
														<Link class="nav-link" :href="route('history')"><i
															class="bi bi-basket fa-fw me-2"></i>Order history</Link>
													</li>
													<li class="nav-item">
														<Link class="nav-link active" :href="route('wishList.index')"><i
															class="bi bi-heart fa-fw me-2"></i>Wishlist</Link>
													</li>
													<li class="nav-item">
														<Link class="nav-link" :href="route('customer.delete.index')"><i
															class="bi bi-trash fa-fw me-2"></i>Delete profile</Link>
													</li>
													<li class="nav-item">
														<Link href="/logout" as="button" method="post"
															class="nav-link text-danger" @click.prevent="signOut()">
														<i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign Out
														</Link>
													</li>
												</ul>
												<!-- Sidebar menu item END -->
											</div>
											<!-- Card body END -->
										</div>
									</div>
								</div>
							</div>

							<!-- Main content -->
							<div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">

								<!-- Title and offcanvas button -->
								<div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
									<!-- Title -->
									<h1 class="h3 mb-0">Wishlist</h1>

									<!-- Advanced filter responsive toggler START -->
									<button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button"
										data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar"
										aria-controls="offcanvasSidebar">
										<i class="fas fa-sliders-h"></i> Menu
									</button>
									<!-- Advanced filter responsive toggler END -->
								</div>

								<div class="card bg-transparent">
									<!-- Card header -->
									<div
										class="card-header bg-transparent border-bottom d-flex justify-content-between align-items-center p-0 pb-3">
										<h6 class="card-title mb-0">Recently added</h6>

										<span v-if="filteredWishLists.length > 0">{{ filteredWishLists.length }}
											Items</span>
										<span v-else>No wishlist items</span>
									</div>
									<div v-if="wishLists.length > 0">
										<div v-if="filteredWishLists.length <= 0">
											<h3 class="mt-5" v-if="filteredWishLists.length <= wishLists.length"> Your'r all wishlist items now in the cart</h3>
										</div>
									</div>
									<div v-else>
										<h3 class="mt-5" v-if="filteredWishLists.length <= wishLists.length"> Nothing in your wishlist. ! </h3>
									</div>
									
									

									<!-- Card body -->
									<div class="card-body p-0 pt-5">
										<!-- Product item START -->
										<div class="row align-items-xl-center" v-for="wishList in filteredWishLists">
											<!-- Image -->
											<div class="col-5 col-md-2">
												<div class="bg-light p-2 rounded-2">
													<img :src="wishList.product_image[0]?.image_url" alt="">
												</div>
											</div>

											<div class="col-7 col-md-10">
												<div class="row g-4">
													<!-- Content -->
													<div class="col-xl-6">
														<!-- Product detail START -->
														<Link class=""
															:href="route('product.single', { id: wishList.product_id, })">
														<!-- Product detail START -->
														<h6 class="mb-1">
															<a href="#">{{ wishList.product_name }}</a>
														</h6>
														</Link>
														<ul class="nav nav-divider small align-items-center mt-1">
															<li class="nav-item">
																Item Discount: Rs.{{ wishList.product_discount }}
															</li>
														</ul>
														<!-- List -->
														<ul class="nav nav-divider small align-items-center mt-1">
															<li class="nav-item">
																Unit Price: Rs. {{ wishList.product_price }}
															</li>
														</ul>
														<ul class="nav nav-divider small align-items-center mt-1">
															<li class="nav-item">
																<!-- <div class=""
                                                                    v-if="wishList.product_quantity >= newQuantity[value.id].quantity">
                                                                    Availability:
                                                                    <span class="badge bg-success">in stock</span>
                                                                </div>
                                                                <div class="" v-else>
                                                                    Availability:
                                                                    <span
                                                                        class="badge bg-warning text-dark">unavailable</span>
                                                                </div> -->
															</li>
														</ul>
													</div>

													<!-- Select -->
													<div class="col-md-6 col-xl-3">
														<div class="wrap">
															<div class="wrapper">
																<span class="minus"
																	@click=" decrement(wishList.id)">-</span>
																<input class="num" type="number" min="1" max="1000"
																	v-model="newQuantity[wishList.id].quantity"
																	@change=" updateQuantity(wishList.id)" />
																<span class="plus"
																	@click="increment(wishList.id)">+</span>
															</div>
														</div>

														<!-- Buttons -->
														<div
															class="hstack gap-1 flex-wrap text-primary-hover mt-2 justify-content-md-end">
															<button @click.prevent="removeWishList(wishList.id)"
																class="text-reset small" style="border:none; background-color: white;"><i
																class="bi bi-trash3 me-2"></i>Remove</button>
															<!-- <a href="#" class="text-reset small"><i
																	class="bi bi-heart me-2"></i>Save for later</a> -->
														</div>
													</div>

													<!-- Price and button -->
													<div class="col-md-6 col-xl-3 text-md-end">
														<h5 class="mb-2">Rs. {{ totalPrice[wishList.id].totalPrice }}
														</h5>
														<button class="btn btn-sm btn-dark mb-0"
															@click.prevent="addToCart(wishList.product_id, newQuantity[wishList.id].quantity)"><i
																class="bi bi-cart3 me-2"></i>Add to cart</button>
													</div>
												</div>
											</div>
											<hr class="my-5"> <!-- Divider -->
										</div>
										<!-- Product item END -->
									</div>

									<!-- Card footer -->
									<div class="card-footer bg-transparent text-end p-0">
										<Link :href="route('products.index')" class="btn btn-light border mb-0">Continue
										shopping</Link>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<!-- Content END -->
			</main>
		</template>
	</AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { onMounted, computed, ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";
import axios from 'axios';
import Swal from "sweetalert2";

const user = usePage().props.auth.user;
const newQuantity = ref({
	quantity: 0,
});
const cartItems = ref([]);
const wishLists = ref([]);
const quantity = ref(0);
const totalPrice = ref({
	totalPrice: 0.00,
});

const filteredWishLists = computed(() => {
	return wishLists.value.filter(wishList => !cartItems.value.includes(wishList.product_id)  );
});

const getWishList = async () => {
	try {
		const customer_id = user.id;
		const response = await axios.get(route('wishList.all', customer_id));
		wishLists.value = response.data;
		wishLists.value = wishLists.value.filter(wishList => wishList.status === 1);
		// console.log('wish list values', wishLists.value.filter(wishList => wishList.status === 1));
		var i = 0;
		wishLists.value.forEach((item) => {
			newQuantity.value[item.id] = {
				quantity: quantity.value,
				product_id: wishLists.value[i].product_id,
			};
			if (newQuantity.value.quantity == 0) {
				increment(item.id);
			}
			i += 1;
		});
	} catch (error) {
		console.log('Error', error);
	}
}

const updateQuantity = async (itemId) => {
	try {
		wishLists.value.forEach((item) => {
			const totalPrices = (newQuantity.value[item.id].quantity * item.product_price) - (newQuantity.value[item.id].quantity * item.product_discount);
			totalPrice.value[item.id] = {
				totalPrice: totalPrices,
				product_id: wishLists.value.product_id,
			};
		});
	} catch (error) {
		console.log("Error", error);
	}
};

const increment = (itemId) => {
	if (newQuantity.value[itemId].quantity < 500) {
		newQuantity.value[itemId].quantity++;
		updateQuantity(itemId);
	}
};

const decrement = (itemId) => {
	if (newQuantity.value[itemId].quantity > 1) {
		newQuantity.value[itemId].quantity--;
		updateQuantity(itemId);
	}
};

const addToCart = async (product_id, quantity) => {
	try {
		var selectedQuantity = quantity;
		var customer_id = user.id;
		
		const response = await axios.post(route('cart.item.store', { customer_id, product_id }), {
			quantity: selectedQuantity,
			unit_price: selectedQuantity,
			unit_discount: selectedQuantity,
			created_by: user.first_name,
		});

		const remove_response = await axios.post(route('wishList.remove',{ customer_id, product_id }));
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
			title: "Item added to cart"
		});
		getWishList();
		checkCart();
		console.log('add to cart', response);
	} catch (error) {
		console.log('Error', error);
	}
}

const checkCart = async () => {
	try {
		const customer_id = user.id;
		const response = await axios.get(route("cart.item.get", user.id));
		console.log('hellomm', response.data == "no items");
		if (response.data == "no items") {
			console.log('heeroo');
		}
		else {
			if (response.data.cart_item.length > 0) {
				cartItems.value = response.data.cart_item.map(item => item.product_id);
				getWishList();
				// const count = response.data.cart_item.length;
				// for (var i = 0; count > i; i++) {

				// 	cartItems.value[i] = response.data.cart_item[i].product_id;
				// }
			}
			console.log('cart items', cartItems.value);
		}
		// getWishList();
	} catch (error) {
		console.log('Error', error);
	}
}

const removeWishList = async (wishList_id) => {
	try {
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: "btn btn-outline-danger m-2",
				cancelButton: "btn btn-outline-success m-2",
			},
			buttonsStyling: false
		});
		swalWithBootstrapButtons.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, delete it!",
			cancelButtonText: "No, cancel!",
			reverseButtons: false
		}).then(async (result) => {
			if (result.isConfirmed) {
				try {
					const response = await axios.delete(route('wishList.delete', wishList_id));
					getWishList();
					checkCart();
				} catch (error) {
					console.log('Error', error);
				}
				getWishList();
				checkCart();
			} else if (
				result.dismiss === Swal.DismissReason.cancel
			) {
				swalWithBootstrapButtons.fire({
					title: "Cancelled",
					text: "Your imaginary file is safe :)",
					icon: "error"
				});
			}
		});
	} catch (error) {

		console.log(error);
	}
}

const signOut = () => {
	try {
		sessionStorage.clear();
	} catch (error) {
		console.log("Error", error);
	}
	const Toast = Swal.mixin({
		toast: true,
		position: "top-end",
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.onmouseenter = Swal.stopTimer;
			toast.onmouseleave = Swal.resumeTimer;
		},
	});
	Toast.fire({
		icon: "success",
		title: "Signed out successfully",
	});
};
onMounted(() => {
	updateQuantity();
	getWishList();
	checkCart();

});
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
</style>