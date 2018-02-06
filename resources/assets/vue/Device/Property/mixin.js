import DevicePropertyRepository from '../../Repositories/DeviceProperty';

export default {
    props: {
        property: {
            required: true,
            type: Object,
            default: DevicePropertyRepository.structure
        }
    },
    computed: {
        hasDescription() {
            return !_.isEmpty(this.property.description);
        }
    }
}