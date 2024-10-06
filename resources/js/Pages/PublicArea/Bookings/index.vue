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
                            E123123 - Book Now
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
                                <select id="busRoute" class="form-control" v-model="form.busRoute" required>
                                    <option disabled value="">Select a route</option>
                                    <option v-for="route in busRoutes" :key="route" :value="route">
                                        {{ route }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="pickup" class="form-label">Pickup Location</label>
                                <select id="pickup" class="form-control" v-model="form.pickup" required>
                                    <option disabled value="">Select a pickup location</option>
                                    <option v-for="location in pickupLocations" :key="location" :value="location">
                                        {{ location }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="dropoff" class="form-label">Drop-off Location</label>
                                <select id="dropoff" class="form-control" v-model="form.dropoff" required>
                                    <option disabled value="">Select a drop-off location</option>
                                    <option v-for="location in dropoffLocations" :key="location" :value="location">
                                        {{ location }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="busType" class="form-label">Bus Type</label>
                                <select id="busType" class="form-control" v-model="form.busType" required>
                                    <option disabled value="">Select a bus type</option>
                                    <option v-for="type in busTypes" :key="type" :value="type">
                                        {{ type }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" id="date" class="form-control" v-model="form.date" required />
                            </div>
                            <div class="mb-3">
                                <label for="seats" class="form-label">Number of Seats</label>
                                <input type="number" id="seats" class="form-control" v-model="form.seats" min="1" required />
                            </div>
                            <div class="mb-3">
                                <label for="requests" class="form-label">Special Requests</label>
                                <textarea id="requests" class="form-control" v-model="form.requests"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="payment" class="form-label">Payment Option</label>
                                <select id="payment" class="form-control" v-model="form.payment" required>
                                    <option disabled value="">Select payment method</option>
                                    <option value="credit-card">Credit Card</option>
                                    <option value="paypal">PayPal</option>
                                    <option value="bank-transfer">Bank Transfer</option>
                                </select>
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
import { ref } from "vue";

// Bus routes, locations, and types
const busRoutes = ["Route 1: City A - City B", "Route 2: City C - City D"];
const pickupLocations = ["Station A", "Station B", "Station C"];
const dropoffLocations = ["Station X", "Station Y", "Station Z"];
const busTypes = ["AC", "Non-AC", "Luxury"];

// Form data setup
const form = ref({
    name: '',
    email: '',
    busRoute: '',
    pickup: '',
    dropoff: '',
    busType: '',
    date: '',
    seats: 1,
    requests: '',
    payment: ''
});

// Handle form submission
const handleSubmit = () => {
    console.log("Booking details:", form.value);
    // Add form submission logic here (e.g., API call)
};
</script>
