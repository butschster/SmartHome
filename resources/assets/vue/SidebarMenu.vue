<template>
    <ul class="nav">
        <li class="nav-item active">
            <router-link class="nav-link" :to="item.route" v-for="item in links" :key="item.title">
                <i class="fa-lg" :class="item.icon"></i>
                <span class="menu-title">{{ item.title }}</span>
            </router-link>
        </li>
    </ul>
</template>

<script>
    import {
        DASHBOARD
    } from '../js/router/actions';

    export default {
        name: "sidebar-menu",
        data() {
            return {
                links: [
                    {
                        title: 'Dashboard',
                        icon: 'fas fa-tachometer-alt',
                        route: {name: DASHBOARD}
                    }
                ]
            }
        }
    }
</script>