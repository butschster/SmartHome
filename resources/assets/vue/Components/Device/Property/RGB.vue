<template>
    <div class="counter p-10" :style="{'background-color': bgColor}" v-on:dblclick="randomColor">
        <div class="counter-number-group">
            <span class="counter-icon mr-20" v-on:click="toggle" style="cursor: pointer;">
                <i class="icon-circle bg-white fas fa-lightbulb"></i>
            </span>
            <span class="counter-number" :style="{color: textColor}">#{{ property.formatted_value.hex }}</span>
        </div>
    </div>
</template>
<script>
    import PropertyMixin from '../Mixins/Property';
    import {Compact as CompactSlider} from 'vue-color'

    export default {
        components: {CompactSlider},
        mixins: [PropertyMixin],
        methods: {
            randomColor() {
                function getRandomColor() {
                    let colors = [
                        'aae9f2', '7c519f', 'b1e204',
                        'ad009e', 'e6fb04', '04dc7a',
                        'df2a10', 'ff0000', 'ff9ad2',
                        '0000ff', 'f2560a', '008000'
                    ];
                    return colors[Math.floor(Math.random() * colors.length)];
                }

                this.sendCommand(getRandomColor())
            },
            toggle() {
                this.property.formatted_value.hex == '000000'
                    ? this.randomColor()
                    : this.sendCommand('000000');
            },
            async sendCommand(color) {
                await this.$api.commands.handleDeviceCommand(
                    this.property.id,
                    'changeColor',
                    {hex: color}
                );

                this.property.formatted_value.hex = color;
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