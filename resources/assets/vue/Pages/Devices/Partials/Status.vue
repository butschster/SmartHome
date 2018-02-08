<template>
    <div class="card-footer">
        <template v-if="isOutOfDate">
            <span class="badge badge-danger">Нет связи</span>
        </template>
        <template v-else>
            <small class="text-muted">Последняя активность</small>
            <span class="badge badge-info">{{ device.last_activity }}</span>
        </template>
    </div>
</template>

<script>
    import DeviceRepository from 'Repositories/Device';

    export default {
        name: "status",
        props: {
            device: {
                required: true,
                type: Object,
                default() {
                    return DeviceRepository.structure;
                }
            }
        },

        computed: {
            isOutOfDate() {
                if (this.device.last_activity) {
                    return !moment(this.device.last_activity).isAfter(moment().subtract(1, 'hours'));
                }

                return true;
            }
        }
    }
</script>

<style scoped>

</style>