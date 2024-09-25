<template>
    <div id="basic-info">
        <div class="card-header">
            <h5>Product Images</h5>
        </div>
        <div class="card-body pt-0 mt-0">
            <div class="col image-header">
                <form enctype="multipart/form-data">
                    <div class="">
                        <div class="row">
                            <input type="file" class="form-control file m-2 " id="fileInput"
                                @input="(e) => (product_image = e.target.files[0])" style="width: 300px;" />

                            <div class="justify-content-start mt-3">
                                <button @click.prevent="createProductImage()"
                                    class="btn btn-sm btn-round btn-outline-primary">
                                    <i class="fa-solid fa-floppy-disk"></i> Upload
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="image-setup image-top-header border mt-2">
                <div v-for="value in productImages" class="card image-section" style="width: 22rem; height: 18rem">
                    <div class="m-auto">
                        <img :src="value.image_url" class="card-img-top " alt="no image"
                            style="width: 18rem; height: 14rem" />
                    </div>

                    <div class="image-card-body mr-5 mb-3 mt-2">
                        <div class="button-section d-flex">
                            <div class="button-section" v-if="value.status == 1">
                                <div class="justify-content-start button-section">
                                    <i class="fa-solid fa-toggle-on text-primary"></i>
                                </div>
                            </div>
                            <div class="" v-else>
                                <i class="fa-solid fa-toggle-off text-mute mr-3"
                                    @click.prevent=" makePrimaryImage(value.id, value.product_id)"
                                    style="cursor: pointer;"></i>

                                <i class="fa-solid fa-trash" @click.prevent=" deleteProductImage(value.id)"
                                    style="cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted, defineProps } from "vue";
import Swal from "sweetalert2";

const props = defineProps({
    productId: {
        type: Number,
        required: true,
    },
});

const productImages = ref([]);
const product_image = ref([]);
const productImage = ref({});
const product_id = ref(0);

const createProductImage = async () => {
    try {
        productImage.value.image = product_image.value;
        productImage.value.product_id = props.productId;
        const response = await axios
            .post(route("admin.bus.image.store"), productImage.value, {
                headers: {
                    "Content-Type": "multipart/form-data",
                },
            })
            .then((response) => {
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Product image addedd Successfully",
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                });
                getProductImage();
                const fileInput = document.getElementById('fileInput');
                if (fileInput) {
                    fileInput.value = '';
                }
                product_image.value = '';
            })
            .catch((error) => {
                console.log("Error:", error);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Check availability & image type of your image",
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

const getProductImage = async () => {
    try {
        const respones = await axios.get(
            route("admin.bus.image.all", props.productId)
        );
        productImages.value = respones.data.product_image;
    } catch (error) {
        console.log("Error", error);
    }
};

const deleteProductImage = async (id) => {
    try {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-outline-danger",
                cancelButton: "btn btn-outline-success",
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
                        const response = await axios.post(
                            route("admin.bus.image.delete", id)
                        );
                        getProductImage();
                    } catch (error) {
                        console.log("Error", error);
                    }
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                   
                }
            });
    } catch (error) {
        console.log(error);
    }
};

const makePrimaryImage = async (requestId, productId) => {
    Swal.fire({
        title: "Are you sure?",
        text: "Make this image as primary",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const response = await axios.post(
                    route("admin.bus.image.primary", {
                        request_id: requestId,
                        product_id: productId,
                    })
                );
                getProductImage();
            } catch (error) {
                console.log("Error", error);
            }
            Swal.fire({
                title: "Changed!",
                text: "Primary image has been changed",
                icon: "success",
            });
        }
    });
};

onMounted(() => {
    getProductImage();
});
</script>

<style lang="scss" scoped>
.custom-button {
    background-color: #ffffff;
    border-color: #6343e9;
    color: #6343e9 !important;
}

.custom-button:hover {
    background-color: #6343e9;
    color: #ffffff !important;
}

.image-section {
    background-color: white;
}

.image-section {
    float: left;
    overflow: hidden;
    margin: 2vh;
    // align-items: center;
    justify-content: center;
}

.button-section {
    align-items: right;
    justify-content: right;
    flex-direction: flex-end;
}

.upload-button {
    // margin-left: 50vh;
    overflow: hidden;
}
</style>
