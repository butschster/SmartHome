<template>
    <div class="page-header">
        <h1 class="page-title">
            <icon :name="icon" v-if="hasIcon"></icon> {{ title }}
        </h1>

        <breadcrumbs :crumb="crumb" v-if="hasCrumbs"></breadcrumbs>

        <slot></slot>
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
            },
            hasIcon() {
                return !_.isEmpty(this.icon);
            }
        }
    }
</script>