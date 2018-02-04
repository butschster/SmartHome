<template>
    <component v-bind:is="propertyComponent(property)" :property="property"></component>
</template>

<script>
    import PowerProperty from './Property/Power';

    export default {
        components: {
            PowerProperty
        },
        props: {
            property: {
                required: true,
                type: Object
            }
        },
        mounted() {
            Echo.channel(`device.${this.property.id}`)
                .listen('.property.changed', e => {
                    this.$emit('changed', e.property);
                });
        },
        methods: {
            propertyComponent(property) {
                let type = property.key.toLowerCase();
                type = type.charAt(0).toUpperCase() + type.slice(1);

                return `${type}Property`;
            }
        }
    }
</script>

<style scoped>

</style>