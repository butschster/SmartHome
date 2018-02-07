<template>
    <div>
        <header>
            <navbar>
                <slot name="navbar"></slot>
            </navbar>
            <slot name="header"></slot>
        </header>

        <div class="container-fluid">
            <div class="row">

                <nav class="bg-white sidebar">
                    <sidebar-menu></sidebar-menu>
                </nav>

                <div class="content-wrapper">
                    <page-header v-if="header">{{ header }}</page-header>

                    <slot></slot>
                </div>

                <footer class="footer">
                    <slot name="footer"></slot>
                </footer>
            </div>
        </div>
    </div>
</template>

<script>

    import PageHeader from './Partials/Header';
    import Navbar from './Partials/Navigation';
    import SidebarMenu from 'SidebarMenu';

    export default {
        name: 'main-layout',

        components: {
            Navbar, SidebarMenu, PageHeader
        },

        props: {
            header: {
                required: false,
                type: String
            }
        }
    }
</script>