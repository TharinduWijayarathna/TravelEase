<template>
    <div id="basic-info">
        <div class="card-header">
            <h5>Bus Stops</h5>
        </div>
        <div class="card-body pt-0 mt-0">
            <div class="col image-header">
                <form enctype="multipart/form-data">
                    <div class="">
                        <div class="row">

                        </div>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Code</th>
                            <th scope="col">Name</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="busStop in busStops" :key="busStop.id">
                            <td>{{ busStop.code }}</td>
                            <td>{{ busStop.name }}</td>
                            <td>
                                <button class="btn btn-sm btn-round btn-outline-primary">
                                    <i class="fa-solid fa-edit"></i> Edit
                                </button>
                                <button class="btn btn-sm btn-round btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script setup>
import { ref, onMounted } from "vue";

const busStops = ref([]);
</script>
