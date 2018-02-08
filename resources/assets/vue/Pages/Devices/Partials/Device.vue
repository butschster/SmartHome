<template>
    <div class="card border">
        <div class="card-body">
            <div class="float-right" role="group">
                <button class="btn btn-danger btn-sm" @click="destroy">
                    <i class="far fa-fw fa-trash-alt"></i>
                </button>
            </div>

            <h5 class="card-title">
                <router-link :to="itemLink">
                    {{ device.name }}
                </router-link>
            </h5>

            <p v-if="hasDescription" class="card-text text-muted">{{ device.description }}</p>
        </div>

        <device-status :device="device" class="card-footer"></device-status>
    </div>
</template>

<script>
    import DeviceStatus from './Status';
    import DeviceRepository from 'Repositories/Device';
    import {DEVICE_SHOW} from 'router/actions';

    export default {
        components: {
            DeviceStatus
        },
        props: {
            device: {
                required: true,
                type: Object,
                default() {
                    return DeviceRepository.structure;
                }
            }
        },
        mounted() {
            Echo.channel(`device.${this.device.id}`)
                .listen('.last_activity.updated', e => {
                    this.$emit('updated', e.device);
                });
        },
        methods: {
            destroy() {
                this.$emit('destroy', this.device);
            }
        },
        computed: {
            hasDescription() {
                return !_.isEmpty(this.device.description);
            },
            itemLink() {
                return {
                    name: DEVICE_SHOW,
                    params: {id: this.device.id}
                };
            }
        }
    }
</script>