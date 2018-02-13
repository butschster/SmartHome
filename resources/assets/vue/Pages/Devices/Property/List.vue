<template>
    <div class="card border" v-if="hasProperties">
        <div class="card-header">
            Датчики
        </div>

        <div class="list-group mb-0">
            <property v-for="property in properties" :property="property" :key="property.id"></property>
        </div>
    </div>
</template>

<script>
    import Property from './Partials/Property';

    export default {
        name: "device-properties",
        components: {
            Property
        },
        props: {
            properties: {
                type: Array,
                required: true,
                default() {
                    return [];
                }
            }
        },
        computed: {
            hasProperties() {
                return this.properties.length > 0;
            }
        }
    }
</script>