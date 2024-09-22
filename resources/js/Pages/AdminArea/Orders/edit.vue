<template>
    <AdminLayout>
        <template #header>
            <div class="pb-6 header">
                <div class="container-fluid">
                    <div class="header-body">
                        <div class="py-4 col align-items-center">
                            <nav aria-label="breadcrumb" class="d-none d-md-block">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item for-text">
                                        <h6 class="mb-0 h2 d-inline-block main-text">Order Item</h6>
                                    </li>

                                    <li class="breadcrumb-item for-text active text-dark" aria-current="page">
                                        <h6 class="mb-0 h2 d-inline-block main-text"> {{ order.code }} </h6>
                                    </li>

                                </ol>
                            </nav>
                            <nav aria-label="breadcrumb" class="d-none d-md-block">
                                <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                    <li class="breadcrumb-item">
                                        <Link :href="route('admin.dashboard')" class="text-dark">
                                        <i class="fa-solid fa-house"></i>
                                        </Link>
                                    </li>

                                    <li class="breadcrumb-item active text-dark" aria-current="page">
                                        <Link :href="route('admin.order.index')" class="text-dark">
                                        Orders
                                        </Link>
                                        <input type="image" src="" alt="" />
                                    </li>
                                    <li class="breadcrumb-item text-muted" aria-current="page">
                                        {{ order.code }}<input type="image" src="" alt="" />
                                    </li>
                                    <li>

                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="text-right">
                            <button v-if="orderData.is_paid != 1" class="btn btn-sm btn-warning"
                                @click.prevent="markAsPaid()"> <i class="fa-solid fa-check-double"></i> mark as
                                paid</button>
                            <button v-else class="btn btn-sm btn-light" @click.prevent="markAsPaid()"> <i
                                    class="fa-solid fa-rotate"></i> reverse paid</button>

                            <button v-if="orderData.is_shipped != 1" class="btn btn-sm btn-success"
                                @click.prevent="markAsShipped()"> <i class="fa-solid fa-truck-fast"></i> mark as
                                shipped</button>
                            <button v-else class="btn btn-sm btn-light" @click.prevent="markAsShipped()"><i
                                    class="fa-solid fa-rotate"></i> reverse
                                shipped</button>

                        </div>
                    </div>
                </div>
            </div>
        </template> 

        <template #content>

            <BasicDataLayout :orderId="props.order.id" :customerId="props.order.customer_id"/>

            <ItemTableLayout :orderId="props.order.id"/>

        </template> 
    </AdminLayout>
</template>

<script setup>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import BasicDataLayout from "@/Pages/AdminArea/Orders/Components/Basic/EditForm.vue"
import ItemTableLayout from "@/Pages/AdminArea/Orders/Components/ItemTable/All.vue"
import axios from "axios";
import Multiselect from "vue-multiselect";
import { ref, onMounted, watch } from "vue";
import { router, Link } from "@inertiajs/vue3";
import Swal from "sweetalert2";

const page = ref(1);
const pageCount = ref(25);
const pagination = ref({});
const search_item_code = ref(null);
const search_item_name = ref(null);
const itemData = ref([]);
const orderData = ref([]);

const props = defineProps({
    order: {
        type: Object,
        required: true,
    },
});


const reload = async () => {
    try {
        const response = (
            await axios.get(route("admin.order.cartItem.get", props.order.id), {
                params: {
                    page: page.value,
                    per_page: pageCount.value,
                    item_code: search_item_code.value,
                    item_name: search_item_name.value,
                },
            })
        ).data;

        itemData.value = response.data;
        pagination.value = response;
        getOrderData();
    } catch (error) {
        console.log("Error", error);
    }
};

const getOrderData = async () => {
    try {
        const response = await axios.get(route("admin.order.get", props.order.id));
        orderData.value = response.data;
        console.log('order data', orderData.value);
    } catch (error) {
        console.log("Error", error);
    }
};


const markAsPaid = async () => {
    try {
        const response = await axios.get(route('admin.order.paid.update', props.order.id));
        reload();
    } catch (error) {
        console.log('Error', error);
    }
}

const markAsShipped = async () => {
    try {
        const response = await axios.get(route('admin.order.shipped.update', props.order.id));
        reload();
    } catch (error) {
        console.log('Error', error);
    }
}

onMounted(() => {
    reload();
});

watch([page, pageCount], () => {
    reload();
});
</script>

<style lang="scss" scoped>
.breadcrumb-text {
    color: #6343e9 !important;
}

.nav-link.active {
    background-color: #2a73e0 !important;
    color: #ffffff !important;
}

.nav-link {
    color: black;
}

.main-text {
    font-size: 40px;
}

.for-text {
    font-size: 40px;

}

.breadcrumb-dark .breadcrumb-item+.breadcrumb-item::before {
    color: #030405;
}
</style>
