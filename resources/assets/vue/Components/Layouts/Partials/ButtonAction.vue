<template>
    <button @click="goto" class="site-action-toggle btn-raised btn btn-floating animation-slide-bottom" :class="`btn-${type}`">
        <icon :name="icon" v-if="icon"></icon> <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default() {
                    return 'primary';
                }
            },
            icon: {
                type: String,
                required: true
            },
            link: {}
        },
        methods: {
            goto() {
                if (_.isFunction(this.link)) {
                    this.link();
                } else if (_.isObject(this.link)) {
                    this.$router.push(this.link);
                }
            }
        }
    }
</script>