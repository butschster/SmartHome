<script>
    import Selectize from 'Components/Form/Select';
    import Repository from 'Repositories/DeviceProperty';

    export default {
        name: "property-select",
        mixins: [Selectize],
        methods: {
            getLabel() {
                return 'name';
            },

            async loadOptions() {
                this.loading = true;

                try {
                    this.options = await Repository.all();
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;

                this.init();
            }
        }
    }
</script>