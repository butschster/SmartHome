<template>
    <div>
        <h5>
            <i class="fas fa-lg fa-fw fa-lightbulb"></i>
            {{ property.name }} <span class="label label-info">#{{ property.formatted_value.hex }}</span>
        </h5>
    </div>
</template>

<script>
    import PropertyMixin from '../Mixins/Property';

    export default {
        mixins: [PropertyMixin],
        mounted() {
            this.updateStyle();
        },
        watch: {
            property() {
                this.updateStyle();
            }
        },
        methods: {
            updateStyle() {
                this.$emit('updateStyle', {'background-color': this.bgColor, color: this.textColor});
            }
        },
        computed: {
            bgColor() {
                let color = this.property.formatted_value.hex;

                return `#${color}`;
            },
            textColor() {
                let rgb = this.property.formatted_value.rgb;
                let o = Math.round(((parseInt(rgb[0]) * 299) + (parseInt(rgb[1]) * 587) + (parseInt(rgb[2]) * 114)) / 1000);

                return (o > 125) ? 'black' : 'white';
            }
        }
    }
</script>