<template>
    <nav class="bg__nav navbar navbar-top navbar-expand navbar-red bg- border-bottom Nav_bar" style="
            background: #1d599a;
        ">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Search form -->
                <!-- Navbar links -->
                <ul class="navbar-nav align-items-center ml-md-auto">
                    <li class="nav-item d-xl-none">
                        <!-- Sidenav toggler -->
                        <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                            data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div> 
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-4" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <div class="media align-items-center">
                                <i class="fa fa-user me-sm-1 text-white"></i>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm font-weight-bold text-white">{{ $page.props.auth.user.first_name }}</span>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item border-radius-md" href="#">
                                <font-awesome-icon icon="fa-solid fa-user" />
                                <span>Profile</span>
                            </a>
                            <!-- <Link href="/logout" as="button" method="post" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                            </Link> -->
                            <a href="#" as="button" @click.prevent="logout" class="dropdown-item">
                                <i class="ni ni-user-run"></i>
                                <span>Logout</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';
import { library } from '@fortawesome/fontawesome-svg-core';
import { faUser } from '@fortawesome/free-solid-svg-icons';
import  axios  from 'axios';

const { props } = usePage();

library.add(faUser)

const viewProfile = () => {
    try {
        router.visit(route("user.edit", props.auth.user.id));
    } catch (error) {
        console.log(error);
    }
}

const logout = async () => {
    try{
        await axios.post('/logout').then(response=>{
            window.location.href = '/login';
        })
    }catch(error){
        console.log('Error',error);
    }
}

</script>

<style lang="scss" scoped>
.nav-link:hover .fa-user {
    color: #505050;
}
</style>
