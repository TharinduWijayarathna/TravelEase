<template>
    <nav class="bg-white sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="mb-4 text-center sidenav-header">

                <Link class="navbar-brand text-primary" :href="route('admin.dashboard')">
                <img src="/assets/PublicArea/images/logo.svg" alt="" class="home-logo mt-1 ml-1">
                </Link>
            </div>
            <br>
            <div class="mt-3 navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="mb-3 navbar-nav">

                        <li class="nav-item">
                            <Link :class="{ 'active__sidebar': route().current() == 'admin.dashboard' }"
                                class="nav-link active-preloader" :href="route('admin.dashboard')">
                            <i class="fa fa-desktop"></i>
                            <span class="ml-2 nav-link-text font-weight-600">Dashboard</span>
                            </Link>
                        </li>
                        <li class="nav-item">
                            <Link
                                :class="{ 'active__sidebar': route().current() == 'admin.product.index' || route().current() == 'admin.product.edit' }"
                                class="nav-link active-preloader" :href="route('admin.product.index')">
                            <i class="fa-solid fa-boxes-stacked"></i>
                            <span class="ml-2 nav-link-text font-weight-600">Buses</span>
                            </Link>
                        </li>
                        <li class="nav-item">
                            <Link
                                :class="{ 'active__sidebar': route().current() == 'admin.customer.index' || route().current() == 'admin.customer.edit' }"
                                class="nav-link active-preloader" :href="route('admin.customer.index')">
                            <i class="fa-solid fa-hands-holding-circle"></i>
                            <span class="ml-2 nav-link-text font-weight-600">Customers</span>
                            </Link>
                        </li>
                        <li class="nav-item">
                            <Link
                                :class="{ 'active__sidebar': route().current() == 'admin.customer.index' || route().current() == 'admin.customer.edit' }"
                                class="nav-link active-preloader" :href="route('admin.customer.index')">
                            <i class="fa-solid fa-money-check"></i>
                            <span class="ml-2 nav-link-text font-weight-600">Payments</span>
                            </Link>
                        </li>
                        <li class="nav-item">
                            <Link
                                :class="{ 'active__sidebar': route().current() == 'admin.order.index' || route().current() == 'admin.order.edit' }"
                                class="nav-link active-preloader" :href="route('admin.order.index')">
                            <i class="fa-solid fa-scroll"></i>
                            <span class="ml-2 nav-link-text font-weight-600">Bookings</span>
                            </Link>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link active-preloader" data-toggle="collapse"
                                :class="{ 'active': route().current() == 'admin.banner.index' || route().current() == 'admin.category.index' }"
                                data-target="#userManagementCollapse" aria-expanded="false"
                                aria-controls="userManagementCollapse">
                                <i class="fa-solid fa-gear"></i>
                                <span class="ml-2 nav-link-text font-weight-600">Settings</span>
                            </a>
                            <ul class="collapse list-unstyled"
                                :class="{ 'show': $page.url.startsWith('/admin/banner') || $page.url.startsWith('/admin/category') }"
                                id="userManagementCollapse">
                                <li>
                                    <Link class="nav-link ml-4"
                                        :class="{ 'active__sidebar': route().current() == 'admin.category.index' }"
                                        :href="route('admin.category.index')">
                                    <i class="fas fa-list-alt"></i>
                                    <span class="nav-link-text font-weight-400">Categories</span>
                                    </Link>
                                </li>
                                <li>
                                    <Link class="nav-link ml-4"
                                        :class="{ 'active__sidebar': route().current() == 'admin.banner.index' }"
                                        :href="route('admin.banner.index')">
                                    <i class="fa-solid fa-image"></i>
                                    <span class="nav-link-text font-weight-400">Banners</span>
                                    </Link>
                                </li>
                                <li>
                                    <Link class="nav-link ml-4">
                                    <i class="fa-solid fa-user"></i>
                                    <span class="nav-link-text font-weight-400">User</span>
                                    </Link>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>


<script setup>
import { Link } from '@inertiajs/vue3'
import isArray from 'lodash/isArray';

import { library } from '@fortawesome/fontawesome-svg-core'
import { faDesktop, faFolderOpen, faImage, faCubes, faCar, faPen, faCableCar, faBuildingShield, faCarAlt, faNewspaper, faHotel, faCity, faUser, faInfinity, faArrowsRotate, faLocationDot, faLayerGroup, faTasks, faFolder, faPenToSquare, faBook, faBuildingUser, faBoxesStacked, faPeopleCarryBox, faUsers, faHandsHoldingCircle, faFileInvoiceDollar, faRecordVinyl, faBuilding, faWarehouse, faScrewdriverWrench, faGear, faBriefcase, faPersonWalkingDashedLineArrowRight } from '@fortawesome/free-solid-svg-icons'


library.add(faDesktop)
library.add(faHotel)
library.add(faUser)
library.add(faCubes)
library.add(faPen)
library.add(faImage)
library.add(faCity)
library.add(faNewspaper)
library.add(faCableCar)
library.add(faCarAlt)
library.add(faCar)
library.add(faLocationDot)
library.add(faArrowsRotate)
library.add(faLayerGroup)
library.add(faBuildingShield)
library.add(faHandsHoldingCircle)
library.add(faTasks)
library.add(faFileInvoiceDollar)
library.add(faRecordVinyl)
library.add(faBuilding)
library.add(faWarehouse)
library.add(faScrewdriverWrench)
library.add(faGear)
library.add(faBriefcase)
library.add(faFolderOpen)
library.add(faUsers)
library.add(faBoxesStacked)
library.add(faPeopleCarryBox)
library.add(faBook)
library.add(faFolder)
library.add(faInfinity)
library.add(faBuildingUser)
library.add(faPenToSquare)
library.add(faPersonWalkingDashedLineArrowRight)


</script>

<style lang="scss" scoped>
.navbar-vertical .navbar-brand-img,
.navbar-vertical .navbar-brand>img {
    max-width: 100%;
    max-height: none;
    margin-top: -60px;
    margin-left: -10px;
}

.navbar-vertical.navbar-expand-xs .navbar-collapse {
    margin-top: -50px;
}

.bg__color {
    background-color: #1d599a !important;
}

.active__sidebar {
    background-color: #1d599a !important;
    color: #fff !important;
}

.sidenav {
    width: 15rem !important;
}

.navbar-vertical .navbar-nav .nav-link[data-toggle=collapse][aria-expanded=true]:after {
    transform: rotate(90deg);
    color: #000;
}

.expand-menu-margin {
    margin-left: 1rem;
}
</style>
