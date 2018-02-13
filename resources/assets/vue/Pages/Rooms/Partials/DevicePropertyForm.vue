<template>
    <div class="card border border-primary" v-loading="loading">
        <div class="card-header">
            Привязка датчиков
        </div>
        <div class="card-body">
            <property-select :exclude="attachedPropertyIds" v-model="selected"></property-select>

            <button type="button" v-if="selected" @click="attach" class="btn btn-success">
                <icon name="fas fa-plug"></icon> Подключить
            </button>
        </div>
        <div v-if="hasProperties" class="list-group bg-blue-grey-100 bg-inherit mb-0">
            <div class="list-group-item" v-for="property in properties">
                <icon name="fas fa-microchip"></icon>

                <router-link :to="linkProperty(property)">
                    {{ property.name }}
                </router-link>

                <button class="btn btn-xs float-right btn-outline btn-danger" @click="detach(property)">
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    import PropertySelect from 'Components/Device/Form/PropertySelect';
    import RoomRepository from 'Repositories/Room';
    import {DEVICE_PROPERTY_SHOW} from 'router/actions';

    export default {
        name: "device-property-form",
        components: {PropertySelect},
        props: {
            room: {
                type: Object,
                required: true,
                default() {
                    return RoomRepository.structure;
                }
            }
        },
        data() {
            return {
                loading: false,
                selected: null,
                properties: []
            }
        },
        mounted() {
            this.loadAttachedProperties();
        },
        methods: {
            linkProperty(property) {
                return {
                    name: DEVICE_PROPERTY_SHOW,
                    params: {
                        id: property.device_id,
                        property: property.id
                    }
                }
            },
            async loadAttachedProperties() {
                this.loading = true;

                try {
                    this.properties = await RoomRepository.properties(this.room.id);
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            },

            async attach() {
                this.loading = true;

                try {
                    await RoomRepository.attachProperty(this.room.id, this.selected);
                    this.loadAttachedProperties();
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            },

            async detach(property) {
                this.loading = true;

                try {
                    await RoomRepository.detachProperty(this.room.id, property.id);
                    this.loadAttachedProperties();
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }
        },
        computed: {
            attachedPropertyIds() {
                return this.properties.map(p => p.id);
            },
            hasProperties() {
                return this.properties.length > 0;
            }
        }
    }
</script>