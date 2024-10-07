<template>
    <AppLayout>
        <template #content>
            <main>
                <section class="pb-5 pb-sm-7">
                    <div class="container">
                        <nav aria-label="breadcrumb" style="margin-top: 80px;">
                            <ol class="breadcrumb breadcrumb-dots pb-0 mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Booking
                                </li>
                            </ol>
                        </nav>
                        <h1 class="h3 mb-0 mt-3">
                            {{ props.bus.name }} - Book Now
                        </h1>
                    </div>
                </section>
                <section class="pt-0">
                    <div class="container">
                        <!-- Bus booking form with additional details -->
                        <form @submit.prevent="handleSubmit">
                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" id="name" class="form-control" v-model="form.name" required />
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" v-model="form.email" required />
                            </div>
                            <div class="mb-3">
                                <label for="busRoute" class="form-label">Bus Route</label>
                                <input type="text" disabled :value="bus_route" class="form-control" />
                            </div>
                            <div class="mb-3">
                                <label for="pickup" class="form-label">Pickup Location</label>
                                <select id="pickup" class="form-control" v-model="form.pickup" required>
                                    <option disabled value="">Select a pickup location</option>
                                    <option v-for="stop in bus_stops" :key="stop.id" :value="stop.id">
                                        {{ stop.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dropoff" class="form-label">Drop-off Location</label>
                                <select id="dropoff" class="form-control" v-model="form.dropoff" required>
                                    <option disabled value="">Select a drop-off location</option>
                                    <option v-for="stop in bus_stops" :key="stop.id" :value="stop.id">
                                        {{ stop.name }}
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" id="date" class="form-control" v-model="form.date" required />
                            </div>
                            <div class="mb-3">
                                <label for="seats" class="form-label">Number of Seats</label>
                                <input type="number" id="seats" class="form-control" v-model="form.seats" min="1"
                                    required />
                            </div>
                            <div class="mb-3">
                                <label for="requests" class="form-label">Special Requests</label>
                                <textarea id="requests" class="form-control" v-model="form.requests"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">Book Now</button>
                        </form>
                    </div>
                </section>
            </main>
        </template>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, usePage, router } from "@inertiajs/vue3";
import axios from "axios";
import Swal from "sweetalert2";
import invalidImage from '@/../src/AdminArea/img/product/invalid_image.png';
import { emitter, CART_REFRESH } from "@/event-bus.js";
import { onMounted, ref } from "vue";

const user = usePage().props.auth.user;
const props = defineProps({
    bus: Object,
    bus_stops: Array
});

const bus_stops = props.bus_stops;

const bus_route = props.bus.from + " - " + props.bus.to;

// Form data setup
const form = ref({
    name: '',
    email: '',
    pickup: '',
    dropoff: '',
    date: '',
    seats: 1,
    requests: '',
    bus_id: props.bus.id,
    user_id: user.id
});

// Handle form submission
const handleSubmit = () => {
    axios.post(route('booking.store'), form.value)
        .then(response => {
            Swal.fire({
                title: 'Success',
                text: 'Booking successful',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then(() => {
                router.push(route('booking.success', response.data.id));
            });
        })
        .catch(error => {
            console.log('Error', error);
        });
};

onMounted(() => {
    console.log(user.id)
    getBusStops();
});
</script>
