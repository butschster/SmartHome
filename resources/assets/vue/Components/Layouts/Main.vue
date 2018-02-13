<template>
    <div data-plugin="nprogress">
        <navbar></navbar>
        <sidebar></sidebar>

        <div class="page" :class="pageClasses">
            <page-header v-if="title" :title="title" :icon="icon" :crumb="crumb"></page-header>

            <slot></slot>
        </div>

        <footer class="site-footer">
            <slot name="footer"></slot>
        </footer>
    </div>
</template>

<script>

    import PageHeader from './Partials/Header';
    import Navbar from './Partials/Navigation';
    import Sidebar from './Partials/Sidebar';

    export default {
        name: 'layout-main',

        components: {
            Navbar, Sidebar, PageHeader
        },

        props: {
            title: {
                required: false,
                type: String
            },
            icon: {
                required: false,
                type: String
            },
            classes: {
                type: Object,
                default() {
                    return {}
                }
            },
            crumb: Object
        },

        computed: {
            pageClasses() {
                return _.get(this.classes, 'page', {})
            }
        }
    }
</script>