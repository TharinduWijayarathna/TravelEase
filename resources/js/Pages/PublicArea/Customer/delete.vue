<template>
    <AppLayout>
        <template #content>
            <main>
                <!-- Content START -->
                <section class="pt-sm-7">
                    <div class="container pt-3 pt-xl-5">
                        <div class="row">

                            <!-- Main content -->
                            <div class="col-lg-12 col-xl-12 ps-lg-12 ps-xl-12">
                                <div class="d-flex justify-content-between align-items-center mb-5 mb-sm-6">
                                    <!-- Title -->
                                    <h1 class="h3 mb-0">Delete profile</h1>
                                    <button class="btn btn-primary d-lg-none flex-shrink-0 ms-2" type="button"
                                        data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar"
                                        aria-controls="offcanvasSidebar">
                                        <i class="fas fa-sliders-h"></i> Menu
                                    </button>
                                </div>

                                <div class="card bg-transparent rounded-3 mb-0">
                                    <div class="card-header bg-transparent border-bottom p-0 pb-3">
                                        <h6 class="card-header-title mb-0">Deactivate Account</h6>
                                    </div>
                                    <div class="card-body px-0">
                                        <span class="heading-color fw-bold">Before you go...</span>
                                        <ul class="mt-2">
                                            <!-- <li>Take a backup of your data <a href="#">Here</a> </li> -->
                                            <li>If you delete your account, you will lose your all data.</li>
                                        </ul>
                                        <div class="form-check form-check-md my-4">
                                            <input class="form-check-input" type="checkbox" v-model="confirmAgreement"
                                                id="deleteaccountCheck">

                                            <label class="form-check-label" for="deleteaccountCheck">Yes, I'd like to
                                                delete my account</label>
                                        </div>
                                        <button href="#" class="btn btn-success-soft mb-2 mb-sm-0 m-2"
                                            @click="keepUserAccount">Keep my account</button>
                                        <DangerButton class="btn btn-danger mb-0 m-2" @click="confirmUserDeletion">
                                            Delete my Account</DangerButton>
                                    </div>
                                </div>

                                <Modal :show="confirmingUserDeletion" @close="closeModal">
                                    <div class="p-6">
                                        <h2 class="text-lg font-medium text-gray-900">
                                            Are you sure you want to delete your account?
                                        </h2>

                                        <p class="mt-1 text-sm text-gray-600">
                                            Once your account is deleted, all of its resources and data will be
                                            permanently deleted. Please
                                            enter your password to confirm you would like to permanently delete your
                                            account.
                                        </p>

                                        <div class="mt-6">
                                            <InputLabel for="password" value="Password" class="sr-only" />

                                            <TextInput id="password" ref="passwordInput" v-model="form.password"
                                                type="password" class="form-control" placeholder="Password"
                                                @keyup.enter="deleteUser" />

                                            <InputError :message="form.errors.password" class="mt-2" />
                                        </div>

                                        <div class="mt-6 flex justify-end">
                                            <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                                            <DangerButton class="ms-3 btn btn-danger"
                                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                                                @click="deleteUser">
                                                Delete Account
                                            </DangerButton>
                                        </div>
                                    </div>
                                </Modal>

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
import { onMounted } from "vue";
import { usePage, Link, router } from "@inertiajs/vue3";
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';
import Swal from "sweetalert2";

const user = usePage().props.auth.user;

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);
const confirmAgreement = ref(false);
const form = useForm({
    password: '',
});

const keepUserAccount = () => {
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
        title: "Your Account is safe"
    });
    router.visit(route('customer.index'));
}

const confirmUserDeletion = () => {
    if (confirmAgreement.value === true) {
        confirmingUserDeletion.value = true;
        nextTick(() => passwordInput.value.focus());
    }
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => {
            closeModal();
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
                title: "Your Account has been deleted"
            });
        },

        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;
    form.reset();
};

</script>
