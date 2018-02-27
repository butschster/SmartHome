<template>
    <div class="counter p-10">
        <div class="counter-number-group" :style="{color: textColor}">
            <span class="counter-icon ml-10">
                <i class="fas fa-lightbulb"></i>
            </span>
            <span class="counter-number">#{{ property.formatted_value.hex }}</span>
        </div>
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
                this.$emit('updateStyle', {'background-color': this.bgColor});
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