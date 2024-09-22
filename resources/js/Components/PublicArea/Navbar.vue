<template>
    <header class="header-sticky header-absolute">
        <!-- Logo Nav START -->
        <nav class="navbar navbar-expand-xl">
            <div class="container">
                <!-- Logo START -->
                <a class="navbar-brand me-5" href="">
                    <img class="light-mode-item navbar-brand-item" src="/assets/PublicArea/images/logo.svg"
                        alt="logo" />
                    <img class="dark-mode-item navbar-brand-item" src="/assets/PublicArea/images/logo-light.svg"
                        alt="logo" />
                </a>
                <!-- Logo END -->

                <!-- Main navbar START -->
                <div class="navbar-collapse collapse" id="navbarCollapse">
                    <ul class="navbar-nav navbar-nav-scroll dropdown-hover">
                        <!-- Nav item -->

                        <li class="nav-item">
                            <Link class="nav-link" :href="route('home')">Home</Link>
                        </li>

                        <li class="nav-item">
                            <Link class="nav-link" :href="route('products.index')">Shop</Link>
                        </li>

                        <li class="nav-item">
                            <Link class="nav-link" :href="route('categories')">Categories</Link>
                        </li>

                        <li class="nav-item">
                            <Link class="nav-link" :href="route('contact')">Contact</Link>
                        </li>

                        <!-- <li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Portfolio</a>
						<div class="dropdown-menu dropdown-menu-center dropdown-menu-size-lg p-3">
							<div class="row g-xl-3">
								<div class="col-xl-7 d-none d-xl-block">
									<div class="d-flex gap-4">
										<div class="card bg-transparent">
											<img src="/assets/PublicArea/images/portfolio/list/02.jpg" class="card-img" alt="">
											<div class="card-body px-0 text-start pb-0">
												<h6><a href="#">Brushstrokes and Beyond</a></h6>
												<p class="mb-2 small">We help our customers better manage their web presence.</p>
												<a class="icon-link icon-link-hover stretched-link mb-0" href="portfolio-case-studies-v2.html">Learn more<i class="bi bi-arrow-right"></i> </a>
											</div>
										</div>

										<div class="vr ms-2"></div>
									</div>
								</div>
								<div class="col-xl-5">
									<ul class="list-unstyled">
										<li class="dropdown-header h6">Portfolio Pages</li>
										<li> <a class="dropdown-item" href="portfolio-masonry.html">Portfolio Masonry</a> </li>
										<li> <a class="dropdown-item" href="portfolio-showcase.html">Portfolio Showcase</a> </li>
										<li> <a class="dropdown-item" href="portfolio-list.html">Portfolio List</a> </li>
										<li> <a class="dropdown-item" href="portfolio-case-studies-v1.html">Portfolio Case Study v.1</a> </li>
										<li> <a class="dropdown-item" href="portfolio-case-studies-v2.html">Portfolio Case Study v.2</a> </li>
									</ul>
								</div>
							</div>
						</div>
					</li> -->
                    </ul>
                </div>
                <!-- Main navbar END -->

                <!-- Buttons -->
                <ul class="nav align-items-center dropdown-hover ms-sm-2">
                    <!-- Dark mode option START -->
                    <!-- <li class="nav-item dropdown dropdown-animation">
					<button class="btn btn-link mb-0 px-2 lh-1" id="bd-theme"
					type="button"
					aria-expanded="false"
					data-bs-toggle="dropdown"
					data-bs-display="static">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"  class="bi bi-circle-half theme-icon-active fill-mode fa-fw" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
						<use href="#"></use>
					</svg>
					</button>

					<ul class="dropdown-menu min-w-auto dropdown-menu-end" aria-labelledby="bd-theme">
						<li class="mb-1">
							<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light">
								<svg width="16" height="16" fill="currentColor" class="bi bi-brightness-high-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
									<path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
									<use href="#"></use>
								</svg>Light
							</button>
						</li>
						<li class="mb-1">
							<button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-moon-stars-fill fa-fw mode-switch me-1" viewBox="0 0 16 16">
									<path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
									<path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
									<use href="#"></use>
								</svg>Dark
							</button>
						</li>
						<li>
							<button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto">
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-circle-half fa-fw mode-switch me-1" viewBox="0 0 16 16">
									<path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
									<use href="#"></use>
								</svg>Auto
							</button>
						</li>
					</ul>
				</li> -->
                    <!-- Dark mode option END -->

                    <!-- Search -->
                    <li class="nav-item flex-nowrap align-items-center ms-3 d-none d-md-block">
                        <form class="position-relative">
                            <input class="form-control pe-5 bg-light" type="search" placeholder="Search"
                                aria-label="Search" />
                            <button
                                class="bg-transparent p-2 position-absolute top-50 end-0 translate-middle-y border-0 text-primary-hover text-reset"
                                type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </li>

                    <!-- Offcanvas cart menu -->
                    <li class="nav-item position-relative ms-2 ms-sm-3" v-if="user">
                        <Link class="btn btn-light border btn-round mb-0" :href="route('cart.index')" role="button">
                        <i class="bi bi-cart3 fa-fw"></i>
                        </Link>
                        <span
                            class="position-absolute top-0 start-100 translate-middle badge smaller rounded-circle bg-primary mt-xl-2 ms-n1"
                            v-if="cartCount">{{ cartCount }}
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </li>

                    <li class="nav-item position-relative ms-2 ms-sm-3" v-else>
                        <Link class="btn btn-light border btn-round mb-0" :href="route('customer.login')" role="button">
                        <i class="bi bi-cart3 fa-fw"></i>
                        </Link>
                    </li>
                    <!-- Profile -->
                    <li class="nav-item position-relative ms-2 ms-sm-3">
                        <Link class="btn btn-lg icon-link mb-0" :href="route('customer.index')" href="#"
                            v-if="$page.props.auth.user">
                        <div class="btn btn-light btn-round mb-0">
                            <img class="avatar-img rounded-circle border" v-if="user.image_url" :src="user.image_url"
                                alt="" />
                            <img class="avatar-img rounded-circle border" v-else
                                src="assets/PublicArea/images/avatar/user.jpg" alt="" />
                        </div>
                        <span class="profile-button">Hi,
                            <b style="color: black">
                                {{ $page.props.auth.user.first_name }}</b>!</span>
                        </Link>

                        <Link class="btn btn-lg profile-button icon-link mb-0" :href="route('customer.login')" href="#"
                            v-else>
                        <span class="btn-light border btn btn-light mb-0 profile-button"
                            style="color: #fff; background-color: #1d599a">Login</span>
                        </Link>
                    </li>

                    <!-- Responsive navbar toggler -->
                    <li class="nav-item">
                        <button class="navbar-toggler ms-3 p-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-animation">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Logo Nav END -->
    </header>
    <!-- Header END -->
</template>

<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { onMounted, ref, watch } from "vue";
import { emitter, CART_REFRESH } from "@/event-bus.js";

const cartCount = ref(0);

const profile_image = ref(null);

const user = usePage().props.auth.user;

const getCartCount = async () => {
    if (user && user.id) {
        try {
            const response = await axios.get(route('cart.item.count', user.id));
            if(response.data){
                cartCount.value = response.data;
            }else{
                cartCount.value = 0;
            }
        } catch (error) {
            console.log("Error:", error);
        }
    }
};

onMounted(() => {
    getCartCount();
    emitter.on(CART_REFRESH, getCartCount)
});
</script>

<style scoped>
.profile-button:hover {
    color: rgba(11, 59, 148, 0.822);
}

.navbar {
    background-color: white;
}
</style>
