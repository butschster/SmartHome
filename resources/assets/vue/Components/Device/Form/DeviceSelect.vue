<script>
    import Selectize from 'Components/Form/Select';
    import Repository from 'Repositories/Device';

    export default {
        name: "device-select",
        mixins: [Selectize],
        methods: {
            getLabel() {
                return 'name';
            },
            async loadOptions() {
                this.loading = true;

                try {
                    this.options = await Repository.list();
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;

                this.init();
            }
        }
    }
</script>