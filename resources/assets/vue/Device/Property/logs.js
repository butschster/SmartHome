import DevicePropertyRepository from '../../Repositories/DeviceProperty';

export default {
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