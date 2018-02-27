<template>
    <div class="counter counter-inverse">
        <div class="counter-number-group">
            <span class="counter-number">{{ property.formatted_value }}{{ property.meta.units }}</span>
            <span class="counter-icon ml-10">
                <i class="fas fa-fw" :class="batteryClass"></i>
            </span>
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
                this.$emit('updateClasses', 'bg-blue-600');
            }
        },
        computed: {
            batteryClass() {
                let percentage = this.property.formatted_value;
                return {
                    'fa-battery-empty': percentage < 5,
                    'fa-battery-quarter': percentage >= 25 && percentage < 50,
                    'fa-battery-half': percentage >= 50 && percentage < 70,
                    'fa-battery-three-quarters': percentage >= 70 && percentage < 90,
                    'fa-battery-full': percentage >= 90,
                }
            }
        }
    }
</script>