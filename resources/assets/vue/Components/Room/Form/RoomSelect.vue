<script>
    import Selectize from 'Components/Form/Select';
    import Repository from 'Repositories/Room';

    export default {
        name: "room-select",
        mixins: [Selectize],
        methods: {
            getLabel() {
                return 'name';
            },
            async loadOptions() {
                this.loading = true;

                try {
                    let response = await Repository.list();
                    this.options = response.data.data;
                } catch (e) {
                    this.$message.error(e.message);
                }

                this.loading = false;

                this.init();
            }
        }
    }
</script>