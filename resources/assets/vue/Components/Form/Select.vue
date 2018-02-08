<template>
    <div v-loading="loading" style="min-height: 50px">
        <select>
            <slot></slot>
        </select>
    </div>
</template>

<script>
    require('selectize/dist/js/selectize');

    export default {
        props: {
            value: {
                type: [String, Number, Array],
                default: null
            },
            exclude: {
                type: [Array, String, Number]
            },
            multiple: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                $select: null,
                selectize: null,
                options: [],
                prepared_options: [],
                loading: false
            }
        },
        mounted() {
            this.loadOptions();
        },
        methods: {
            getValueField() {
                return 'id';
            },
            getLabel() {
                return 'name';
            },
            getPlaceholder() {
                return "Не выбрано";
            },
            renderElement(item) {
                return `
<div class="media">
    <div class="media-body">
        ${_.get(item, this.getLabel())}
    </div>
</div>
`;
            },
            loadOptions() {
                this.loading = true;
                this.init();
                this.loading = false;
            },
            init() {
                this.$select = $('select', this.$el).selectize({
                    valueField: this.getValueField(),
                    labelField: this.getLabel(),
                    searchField: this.getLabel(),
                    maxItems: this.multiple ? null : 1,
                    render: {
                        option: (item, escape) => this.renderElement(item)
                    },
                    onInitialize: this.onInit,
                    onChange: this.onChange
                });

                this.selectize = this.$select[0].selectize;
                this.selectize.settings.placeholder = this.getPlaceholder();
                this.selectize.updatePlaceholder();

                this.onSelectInit();
            },
            onSelectInit() {
                this._init && this.$select.trigger('change');
            },
            onChange(value) {
                this.$emit('input', value)
            },
            onInit() {

            },
            excludeOptions() {
                const exclude = this.exclude;

                this.prepared_options = this.options.filter(item => {
                    if (_.isArray(exclude)) {
                        return _.indexOf(exclude, item.id) == -1;
                    } else if (_.isString(exclude) || _.isNumber(exclude)) {
                        return item.id != exclude;
                    }

                    return true;
                });
            },

            setValue(value) {
                if (this.selectize)
                    this.selectize.setValue(value, true);
            }
        },
        watch: {
            value(value) {
                this.setValue(value)
            },
            options(options) {
                this.excludeOptions();
            },
            prepared_options(options) {
                if (this.selectize) {
                    this.selectize.clearOptions();
                    this.selectize.addOption(options);
                }

                this.setValue(this.value, true)
            },
            exclude(data) {
                this.excludeOptions();
            }
        },
        destroyed () {
            if (this.selectize)
                this.selectize.destroy();
        }
    }
</script>