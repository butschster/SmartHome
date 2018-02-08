<template>
    <nav class="site-navbar navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggler hamburger hamburger-close navbar-toggler-left hided"
                    data-toggle="menubar">
                <span class="sr-only">Toggle navigation</span>
                <span class="hamburger-bar"></span>
            </button>

            <button type="button" class="navbar-toggler collapsed" data-target="#site-navbar-collapse"
                    data-toggle="collapse">
                <icon name="more-horizontal"></icon>
            </button>

            <router-link class="navbar-brand navbar-brand-center" :to="dashboardLink">
                <img class="navbar-brand-logo" src="svg/logo.svg">
            </router-link>
        </div>

        <div class="navbar-container container-fluid">
            <!-- Navbar Collapse -->
            <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
                <navbar-tools></navbar-tools>
                <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                    <notifications></notifications>
                    <profile></profile>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    import Search from './Navbar/Search';
    import NavbarTools from './Navbar/Tools';
    import Profile from './Navbar/Profile';
    import Notifications from './Navbar/Notifications';
    import {DASHBOARD} from 'router/actions';

    export default {
        name: "layout-navigation",
        components: {
            Search, NavbarTools, Profile, Notifications
        },
        data() {
            return {
                dashboardLink: {name: DASHBOARD}
            }
        },
        methods: {
            minimize() {
                $('body').toggleClass('sidebar-icon-only');
            }
        }
    }
</script>