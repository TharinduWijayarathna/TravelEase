<template>
    <AuthLayout title="Shop">
        <template #content>
            <main>
                <div class="row g-0">
                    <!-- left -->
                    <div class="col-lg-7 vh-100 d-none d-lg-block">
                        <!-- Slider START -->
                        <div class="swiper h-100"
                            data-swiper-options='{"pagination":{ "el":".swiper-pagination", "clickable":"true" }}'>
                            <!-- Slider items START -->
                            <div class="swiper-wrapper">
                                <!-- Item -->
                                <div class="swiper-slide">
                                    <div class="card rounded-0 h-100" data-bs-theme="dark" style="
                                            background-image: url(/assets/PublicArea/images/auth/01.jpg);
                                            background-position: center left;
                                            background-size: cover;
                                        ">
                                        <!-- Bg overlay -->
                                        <div class="bg-overlay bg-dark opacity-5"></div>

                                        <!-- Card info -->
                                        <div class="card-img-overlay z-index-2 p-7">
                                            <div class="d-flex flex-column justify-content-end h-100">
                                                <!-- Quote -->

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item -->
                                <div class="swiper-slide">
                                    <div class="card rounded-0 h-100" data-bs-theme="dark" style="
                                            background-image: url(/assets/PublicArea/images/auth/02.jpg);
                                            background-position: center left;
                                            background-size: cover;
                                        ">
                                        <!-- Bg overlay -->
                                        <div class="bg-overlay bg-dark opacity-5"></div>

                                        <!-- Card info -->
                                        <div class="card-img-overlay z-index-2 p-7">
                                            <div class="d-flex flex-column justify-content-end h-100">
                                                <!-- Quote -->
                                                <h4 class="fw-light">
                                                    "An exceptional agency CEO
                                                    is a visionary, constantly
                                                    pushing the boundaries of
                                                    creativity and pushing their
                                                    team to new heights. They
                                                    inspire with their passion
                                                    and cultivate a culture of
                                                    trust and respect."
                                                </h4>
                                                <!-- Info -->
                                                <div class="d-flex justify-content-between mt-5">
                                                    <div>
                                                        <h5 class="mb-0">
                                                            Carolyn Ortiz
                                                        </h5>
                                                        <span>CEO, mizzle</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Item -->
                                <div class="swiper-slide">
                                    <div class="card rounded-0 h-100" data-bs-theme="dark" style="
                                            background-image: url(/assets/PublicArea/images/auth/03.jpg);
                                            background-position: center left;
                                            background-size: cover;
                                        ">
                                        <!-- Bg overlay -->
                                        <div class="bg-overlay bg-dark opacity-5"></div>

                                        <!-- Card info -->
                                        <div class="card-img-overlay z-index-2 p-7">
                                            <div class="d-flex flex-column justify-content-end h-100">
                                                <!-- Quote -->
                                                <h4 class="fw-light">
                                                    " Through collaboration and
                                                    strategic direction, they
                                                    steer the agency towards its
                                                    goals, navigating the
                                                    ever-evolving landscape with
                                                    agility and grace."
                                                </h4>
                                                <!-- Info -->
                                                <div class="d-flex justify-content-between mt-5">
                                                    <div>
                                                        <h5 class="mb-0">
                                                            Dennis Barrett
                                                        </h5>
                                                        <span>Founder,
                                                            catalog</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Slider Pagination -->
                            <div class="swiper-pagination swiper-pagination-line mb-3"></div>
                        </div>
                    </div>

                    <!-- Right -->
                    <div class="col-sm-10 col-lg-5 d-flex m-auto vh-100">
                        <div class="row w-100 m-auto">
                            <div class="col-sm-10 my-5 m-auto">

                                <h2 class="mb-4">Welcome back</h2>
                                <p class="mb-4">
                                    Welcome back, please enter your detail
                                </p>

                                <!-- Form START -->
                                <form @submit.prevent="submit">
                                    <div class="mb-4 font-weight-medium text-sm text-success" v-if="status">
                                        {{ status }}
                                    </div>

                                    <div class="input-floating-label form-floating mb-4">
                                        <input id="email" type="email" class="form-control" v-model="form.email"
                                            required autofocus autocomplete="username" placeholder="john@gmail.com" />
                                        <label for="floatingInput">Email</label>
                                        <div class="mt-2 text-danger">
                                            {{ form.errors.email }}
                                        </div>
                                    </div>

                                    <div class="input-floating-label form-floating mb-4">
                                        <input id="password" type="password" class="form-control"
                                            v-model="form.password" required autocomplete="current-password"
                                            placeholder="password" />
                                        <label for="floatingInput">Password</label>

                                        <div class="mt-2 text-danger">
                                            {{ form.errors.password }}
                                        </div>
                                    </div>

                                    <div class="mb-3 form-check">
                                        <input type="checkbox" id="remember" class="form-check-input"
                                            v-model="form.remember" />
                                        <label for="remember" class="form-check-label ms-2 text-sm text-secondary">
                                            Remember me
                                        </label>
                                    </div>
                                    <div class="mb-4 d-flex justify-content-between"></div>

                                    <div class="d-flex justify-content-end mt-4">
                                        <a v-if="canResetPassword" :href="route('password.request')"
                                            class="text-decoration-underline text-sm text-secondary me-4">
                                            Forgot your password?
                                        </a>
                                    </div>

                                    <div class="align-items-center mt-0">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-dark"
                                                :class="{ disabled: form.processing, }" :disabled="form.processing">
                                                Log in
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <!-- Form END -->

                                <!-- Sign up link -->
                                <div class="mt-4 text-center">
                                    <span>Not registered yet?
                                        <Link :href="route('customer.register')" class="login-text">
                                        Create an account
                                        </Link>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </template>
    </AuthLayout>
</template>

<script setup>
import AuthLayout from "@/Layouts/AuthLayout.vue";
import { Link, router, useForm, Head } from "@inertiajs/vue3";
import Swal from "sweetalert2";

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    // form.post(route("login"), {
    //     onFinish: () => form.reset("password"),
    // });
    form.post(route("login"), {
        onFinish: () =>{
            form.reset("password");
            window.location.reload();
        },
    });
};
</script>

<style scoped>
.login-text {
    color: rgb(0, 58, 134);
}
</style>
