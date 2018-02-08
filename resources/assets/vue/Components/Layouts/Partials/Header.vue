<template>
    <div class="page-header">
        <h1 class="page-title">
            <icon :name="icon" v-if="icon"></icon> {{ title }}
        </h1>

        <slot></slot>

        <breadcrumbs :crumb="crumb" v-if="hasCrumbs"></breadcrumbs>
    </div>
</template>

<script>
    import Breadcrumbs from './Breadcrumbs';

    export default {
        name: "layout-header",
        components: {
            Breadcrumbs
        },
        props: {
            title: String,
            icon: String,
            crumb: Object
        },
        computed: {
            hasCrumbs() {
                return !_.isEmpty(this.crumb);
            }
        }
    }
</script>