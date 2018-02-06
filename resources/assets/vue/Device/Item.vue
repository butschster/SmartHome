<template>
    <div class="panel" :class="panelClasses" v-loading="loading">
        <div class="panel-heading">
            <div class="panel-title">
                {{ device.name }}
                <div class="btn-group pull-right" role="group">
                    <button class="btn btn-danger btn-sm" v-if="isOutOfDate" @click="destroy">
                        <i class="far fa-trash-alt"></i>
                    </button>

                    <el-button type="primary" size="mini" round @click="edit = !edit">
                        <i class="far fa-edit"></i>
                    </el-button>
                </div>
            </div>
        </div>

        <div class="panel-body" v-if="hasDescription">{{ device.description }}</div>

        <device-form :data="device"
                     v-if="edit"
                     v-on:update="update"
                     v-on:close="edit = false">
        </device-form>

        <property :property="property"
                  v-for="property in device.properties"
                  :key="property.id"
                  v-on:changed="updateProperty"
                  class="panel-body"
        >
        </property>
        <div class="panel-footer">
            <template v-if="isOutOfDate">
                <span class="label label-danger">Нет связи</span>
            </template>
            <template v-else>
                Последняя активность <span class="label label-info">{{ device.last_activity }}</span>
            </template>
        </div>
    </div>
</template>

<script>
    import Property from './Property';
    import DeviceForm from './Form';
    import DeviceRepository from '../Repositories/Device';

    export default {
        components: {
            Property, DeviceForm
        },
        props: {
            device: {
                required: true,
                type: Object
            }
        },
        data() {
            return {
                edit: false,
                loading: false
            }
        },
        mounted() {
            Echo.channel(`device.${this.device.id}`)
                .listen('.last_activity.updated', e => {
                    this.$emit('updated', e.device);
                });
        },
        methods: {
            updateProperty(p) {
                this.device.properties = _.map(this.device.properties, property => {
                    if (property.id == p.id) {
                        return p;
                    }

                    return property;
                })
            },
            async update(data) {
                this.loading = true;

                try {
                    await DeviceRepository.update(this.device.id, data).then(device => {
                        this.$emit('updated', device);
                        this.edit = false;
                    });

                    this.$message.success('Данные успешно обновлены.');
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            },
            async destroy() {
                this.loading = true;

                try {
                    DeviceRepository.destroy(this.device.id).then(r => {
                        this.$emit('destroyed', this.device);
                    });

                    this.$message.success('Устройство удалено.');
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;
            }
        },
        computed: {
            hasDescription() {
                return !_.isEmpty(this.device.description);
            },
            isOutOfDate() {
                if (this.device.last_activity) {
                    return !moment(this.device.last_activity).isAfter(moment().subtract(1, 'hours'));
                }

                return true;
            },
            hasProperties() {
                return !_.isEmpty(this.device.properties);
            },
            panelClasses() {
                return {
                    'panel-primary': !this.isOutOfDate,
                    'panel-warning': this.isOutOfDate
                };
            }
        }
    }
</script>