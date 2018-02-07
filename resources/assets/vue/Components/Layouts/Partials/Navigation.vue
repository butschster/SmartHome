<template>
    <nav class="navbar navbar-default col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="bg-white text-center navbar-brand-wrapper">
            <router-link class="navbar-brand brand-logo" :to="dashboardLink">
                SmartHome
            </router-link>
            <router-link class="navbar-brand brand-logo-mini" :to="dashboardLink">
                SH
            </router-link>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center">
            <button class="navbar-toggler navbar-toggler d-none d-lg-block navbar-dark align-self-center mr-3"
                    type="button" @click="minimize">
                <span class="navbar-toggler-icon"></span>
            </button>

            <navbar-menu class="navbar-nav ml-lg-auto d-flex align-items-center flex-row"></navbar-menu>
        </div>
    </nav>
</template>

<script>
    import NavbarMenu from 'NavbarMenu';

    export default {
        name: "navigation",
        components: {
            NavbarMenu
        },
        data() {
            return {
                dashboardLink: {}
            }
        },
        methods: {
            minimize() {
                $('body').toggleClass('sidebar-icon-only');
            }
        }
    }
</script>