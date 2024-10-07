<template>
    <AppLayout>
        <template #content>
            <main>
                <section class="pt-sm-7">
                    <div class="container pt-3 pt-xl-5">
                        <div class="row">
                            <div class="col-lg-4 col-xl-3">
                                <div class="offcanvas-lg offcanvas-start h-100" tabindex="-1" id="offcanvasSidebar">
                                    <div class="offcanvas-header bg-light">
                                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
                                            My profile
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                            data-bs-target="#offcanvasSidebar" aria-label="Close"></button>
                                    </div>

                                    <div class="offcanvas-body p-0">
                                        <div class="card border p-3 w-100">
                                            <div class="card-header text-center border-bottom">
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
                                                <ul class="nav nav-pills-primary-border-start flex-column">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" :href="route('customer.index')">
                                                            <i class="bi bi-person fa-fw me-2"></i>
                                                            My profile
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <Link class="nav-link" :href="route('history')">
                                                        <i class="bi bi-clock-history fa-fw me-2"></i>Booking History</Link>
                                                    </li>
                                                    <li class="nav-item">
                                                        <Link class="nav-link" :href="route('customer.delete.index')">
                                                        <i class="bi bi-trash fa-fw me-2"></i>Delete profile</Link>
                                                    </li>
                                                    <li class="nav-item">
                                                        <Link href="/logout" as="button" method="post"
                                                            class="nav-link text-danger" @click.prevent="signOut()">
                                                        <i class="fas fa-sign-out-alt fa-fw me-2"></i>Sign Out
                                                        </Link>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Main content -->
                            <div class="col-lg-8 col-xl-9 ps-lg-4 ps-xl-6">
                                <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
                                    <h1 class="h3 mb-0">My profile</h1>
                                    <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar"
                                        aria-controls="offcanvasSidebar">
                                        <i class="fas fa-sliders-h"></i> Menu
                                    </button>
                                </div>
                                <!-- <form> -->
                                <form @submit.prevent="submitForm()" class="mt-6 space-y-6">
                                    <div class="card bg-transparent p-0">
                                        <div class="card-header bg-transparent border-bottom p-0 pb-3">
                                            <h6 class="mb-0">
                                                Personal Information
                                            </h6>
                                        </div>
                                        <div class="card-body px-0">
                                            <div class="row g-4">
                                                <div class="col-12">
                                                    <label class="form-label">
                                                        Profile picture
                                                    </label>
                                                    <div class="d-flex align-items-center">
                                                        <label class="position-relative me-2" title="Replace this pic">
                                                            <span class="avatar avatar-xl">
                                                                <img class="avatar-img rounded-circle border border-white border-3 shadow"
                                                                    v-if="user.image_url" :src="user.image_url"
                                                                    alt="" />
                                                                <img v-else
                                                                    class="avatar-img rounded-circle border border-2 border-white"
                                                                    src="assets/PublicArea/images/avatar/user.jpg"
                                                                    alt="" />
                                                            </span>
                                                        </label>
                                                        <div class="input-group">
                                                            <input id="fileInput" class="form-control d-none"
                                                                type="file" ref="fileInput"
                                                                @input="handleImageUpload" />
                                                            <label class="btn btn-sm btn-dark mb-0"
                                                                for="fileInput">Change</label>
                                                        </div>

                                                        <!-- <label class="btn btn-sm btn-dark mb-0"
															for="fileInput">Change</label>
														<input id="fileInput" class="form-control d-none" type="file"
															ref="fileInput"
															@input="(e) => (user_image = e.target.files[0])" /> -->
                                                    </div>
                                                </div>
                                                <!-- Full name -->
                                                <div class="col-12">
                                                    <label class="form-label">Full name</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="First name"
                                                            v-model="form.first_name" autofocus />
                                                        <input type="text" class="form-control" placeholder="Last name"
                                                            v-model="form.last_name" />
                                                    </div>
                                                </div>

                                                <!-- Email -->
                                                <!-- <div class="col-md-6">
													<label class="form-label">Email address</label>
													<input type="email" class="form-control"
														placeholder="Enter your email id" v-model="form.email">
												</div> -->

                                                <!-- Mobile -->
                                                <div class="col-md-6">
                                                    <label class="form-label">Mobile number</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter your mobile number"
                                                        v-model="form.contact_number" />
                                                </div>

                                                <!-- Gender -->
                                                <div class="col-md-6">
                                                    <label class="form-label">Select Gender</label>
                                                    <div class="input-group">
                                                        <div class="form-control">
                                                            <div class="form-check radio-bg-light">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault" id="flexRadioDefault1"
                                                                    value="1" :checked="form.gender === 1"
                                                                    @change=" setGender(1)" />
                                                                <label class="form-check-label"
                                                                    for="flexRadioDefault1">Male</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-control">
                                                            <div class="form-check radio-bg-light">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault" id="flexRadioDefault2"
                                                                    value="2" :checked="form.gender === 2"
                                                                    @change="setGender(2)" />
                                                                <label class="form-check-label"
                                                                    for="flexRadioDefault2">Female</label>
                                                            </div>
                                                        </div>

                                                        <div class="form-control">
                                                            <div class="form-check radio-bg-light">
                                                                <input class="form-check-input" type="radio"
                                                                    name="flexRadioDefault" id="flexRadioDefault3"
                                                                    value="0" :checked="form.gender === 0"
                                                                    @change="setGender(0)" />
                                                                <label class="form-check-label"
                                                                    for="flexRadioDefault3">Others</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Address -->
                                                <div class="col-12">
                                                    <label class="form-label">Address</label>
                                                    <textarea class="form-control" rows="3" spellcheck="false"
                                                        v-model="form.address">
                                                    </textarea>
                                                </div>

                                                <!-- Button -->
                                                <div class="col-12 text-end">
                                                    <PrimaryButton class="btn btn-primary mb-0"
                                                        :disabled="form.processing">Save Changes</PrimaryButton>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <!-- </form> -->

                                <!-- <div class="text-center my-5">
                                    <i class="bi bi-three-dots"></i>
                                </div> -->
                                <!-- Divider -->

                                <!-- Update email -->
                                <!-- <form>
                                    <div class="card bg-transparent p-0">
                                        <div class="card-header bg-transparent border-bottom px-0">
                                            <h6 class="mb-0">Update email</h6>
                                        </div>
                                        <div class="card-body px-0">
                                            <div class="mb-4">
                                                <p class="mb-4">
                                                    Your current email address is
                                                    <span class="text-primary">example@gmail.com</span>
                                                </p>
                                                <label class="form-label">Email address</label>
                                                <input type="email" class="form-control"
                                                    placeholder="Enter your email id" />
                                            </div>
                                            <div class="text-end">
                                                <a href="#" class="btn btn-primary mb-0">Save Changes</a>
                                            </div>
                                        </div>
                                    </div>
                                </form> -->

                                <!-- <div class="text-center my-5">
                                    <i class="bi bi-three-dots"></i>
                                </div> -->
                                <!-- Divider -->

                                <!-- Update password -->
                                <form @submit.prevent="updatePassword">
                                    <div class="card bg-transparent p-0">
                                        <div class="card-header bg-transparent border-bottom px-0">
                                            <h6 class="mb-0">
                                                Update password
                                            </h6>
                                        </div>

                                        <div class="card-body px-0">
                                            <div class="mb-3">
                                                <label class="form-label">Current password</label>
                                                <TextInput id="current_password" ref="currentPasswordInput"
                                                    v-model="PasswordForm.current_password" type="password"
                                                    class="form-control" autocomplete="current-password"
                                                    placeholder="Enter current password" />
                                                <InputError :message="PasswordForm.errors.current_password"
                                                    class="mt-2 text-danger" />
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Enter new password</label>
                                                <div class="position-relative">
                                                    <TextInput id="password" ref="passwordInput"
                                                        v-model="PasswordForm.password" type="password"
                                                        class="form-control" autocomplete="new-password"
                                                        placeholder="Enter new password" />

                                                    <InputError :message="PasswordForm.errors.password"
                                                        class="mt-2 text-danger" />
                                                </div>
                                            </div>

                                            <div>
                                                <label class="form-label">Confirm new password</label>
                                                <TextInput id="password_confirmation"
                                                    v-model="PasswordForm.password_confirmation" type="password"
                                                    class="form-control" autocomplete="new-password"
                                                    placeholder="Confirm new password" />
                                                <InputError :message="PasswordForm.errors.password_confirmation"
                                                    class="mt-2 text-danger" />
                                            </div>

                                            <div class="d-flex justify-content-end mt-4">
                                                <PrimaryButton class="btn btn-primary mb-0"
                                                    :disabled="PasswordForm.processing">Change password</PrimaryButton>
                                            </div>

                                            <Transition enter-active-class="transition ease-in-out"
                                                enter-from-class="opacity-0" leave-active-class="transition ease-in-out"
                                                leave-to-class="opacity-0">
                                                <p v-if="PasswordForm.recentlySuccessful" class="text-sm text-success">
                                                    Password Changed</p>
                                            </Transition>

                                        </div>
                                    </div>
                                </form>
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
import { ref, onMounted, defineProps } from "vue";
import Swal from "sweetalert2";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { Link, useForm, usePage } from "@inertiajs/vue3";
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';

const user = usePage().props.auth.user;
const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const PasswordForm = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const form = useForm({
    first_name: user.first_name,
    last_name: user.last_name,
    contact_number: user.contact_number,
    gender: user.gender,
    address: user.address,
    email: user.email,
    image: null,
});

console.log(form);

const user_image = ref(null);
const profile_image = ref("");
const gender = ref(0);

const setGender = (value) => {
    form.gender = value;
};

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    user_image.value = file;
    form.image = file;
};

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


const submitForm = async () => {
    try {
        const response = await axios
            .post(route("profile.update"), form, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Profile update successfully",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 4000,
                    timerProgressBar: true,
                });

                window.location.reload();
            })
            .catch((error) => {
                console.log("Error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Failed to update profile",
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

const updatePassword = () => {
    PasswordForm.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => {
            PasswordForm.reset();
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
                title: "Password has been updated",
            });
        },

        onError: () => {
            if (PasswordForm.errors.password) {
                PasswordForm.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (PasswordForm.errors.current_password) {
                PasswordForm.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },

    });
};

onMounted(() => {
    console.log(user);
});
</script>

<style scoped></style>
