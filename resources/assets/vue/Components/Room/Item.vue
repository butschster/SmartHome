<template>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                {{ room.name }}
            </h4>
        </div>

        <div class="panel-footer">
            <property :property="property"
                      v-for="property in room.properties"
                      :key="property.id"
                      v-on:changed="updateProperty"
            >
            </property>
        </div>
    </div>
</template>

<script>
    import Property from '../Device/Property';
    export default {
        components: {
            Property
        },
        props: {
            room: {
                required: true,
                type: Object
            }
        },
        methods: {
            updateProperty(p) {
                this.room.properties = _.map(this.room.properties, property => {
                    if (property.id == p.id) {
                        return p;
                    }
                    return property;
                })
            },
        }
    }
</script>