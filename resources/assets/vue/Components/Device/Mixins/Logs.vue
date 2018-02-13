<script>
    import DevicePropertyRepository from '../../../Repositories/DeviceProperty';

    export default {
        props: {
            property: {
                required: true,
                type: Object,
                default: DevicePropertyRepository.structure
            }
        },
        data() {
            return {
                logs: []
            }
        },
        mounted() {
            Echo.channel(`device.property.${this.property.id}`)
                .listen('.property.changed', e => {
                    this.getLogs();
                });

            this.getLogs();
        },
        methods: {
            async getLogs() {
                try {
                    this.logs = await DevicePropertyRepository.logs(this.property.id);
                    this.logs.push({
                        time: moment().valueOf(),
                        value: this.property.value
                    });
                } catch (e) {

                }
            }
        },
        computed: {
            hasLogs() {
                return !_.isEmpty(this.logs);
            },
            convertedLogs() {
                return _.map(this.logs, log => [log.time, parseFloat(log.value)]);
            }
        }
    }
</script>