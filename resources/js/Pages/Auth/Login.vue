<script setup>
import Checkbox from "@/Components/Checkbox.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

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
<template>
    <GuestLayout>
        <div class="container mt-5">
            <div class="mb-4 font-weight-medium text-sm text-success" v-if="status">
                {{ status }}
            </div>

            <form @submit.prevent="submit">

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>

                    <input id="email" type="email" class="form-control" v-model="form.email" required autofocus
                        autocomplete="username" />

                    <div class="mt-2 text-danger">{{ form.errors.email }}</div>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>

                    <input id="password" type="password" class="form-control" v-model="form.password" required
                        autocomplete="current-password" />

                    <div class="mt-2 text-danger">
                        {{ form.errors.password }}
                    </div>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" id="remember" class="form-check-input" v-model="form.remember" />
                    <label for="remember" class="form-check-label ms-2 text-sm text-secondary">
                        Remember me
                    </label>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a v-if="canResetPassword" :href="route('password.request')"
                        class="text-decoration-underline text-sm text-secondary me-4">
                        Forgot your password?
                    </a>
                    
                    <button type="submit" class="btn btn-primary" :class="{ disabled: form.processing }"
                        :disabled="form.processing">
                        Log in
                    </button>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>
