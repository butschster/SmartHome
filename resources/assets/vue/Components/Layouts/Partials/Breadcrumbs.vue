<template>
    <ol class="breadcrumb" v-if="hasBreadcrumbs">
        <li class="breadcrumb-item" v-for="c in breadcrumbs">
            <router-link :to="c.route" v-if="!c.last">
                {{ c.title }}
            </router-link>
            <span v-else>
                {{ c.title }}
            </span>
        </li>
    </ol>
</template>

<script>
    import Breadcrumbs from 'Breadcrumbs';

    export default {
        props: {
            crumb: {
                required: true,
                type: Object,
                default() {
                    return {
                        name: null,
                        params: null
                    }
                }
            }
        },

        computed: {
            hasBreadcrumbs() {
                return this.breadcrumbs.length > 0;
            },
            breadcrumbs() {
                try {
                    return Breadcrumbs.generate(
                        this.crumb.name,
                        this.crumb.params
                    );
                } catch (e) {
                    console.error(e)
                }

                return [];
            }
        }
    }
</script>