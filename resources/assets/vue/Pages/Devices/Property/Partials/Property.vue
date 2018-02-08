<template>
    <div class="list-group-item">
        <h6 class="list-group-item-heading">
            <router-link :to="linkItem">
                {{ property.name }}
            </router-link>
        </h6>
        <p v-if="hasDescription">{{ property.description }}</p>
    </div>
</template>

<script>
    import DevicePropertyRepository from 'Repositories/DeviceProperty';
    import {DEVICE_PROPERTY_SHOW} from 'router/actions';

    export default {
        name: "device-property",
        props: {
            property: {
                required: true,
                type: Object,
                default() {
                    return DevicePropertyRepository.structure;
                }
            }
        },
        computed: {
            linkItem() {
                return {
                    name: DEVICE_PROPERTY_SHOW,
                    params: {
                        id: this.property.device_id,
                        property: this.property.id
                    }
                }
            },
            hasDescription() {
                return this.property.description;
            }
        }
    }
</script>