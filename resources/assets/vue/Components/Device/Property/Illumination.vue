<template>
    <div class="row p-10">
        <div class="col-lg-6">
            <div class="counter text-left">
                <div class="counter-number-group">
                    <span class="counter-number">{{ property.formatted_value }}</span>
                </div>
                <div class="counter-label text-capitalize font-size-16">{{ property.name }}</div>
            </div>
        </div>

        <div class="col-lg-6 text-right">
            <i class="fa-3x far fa-sun text-success"></i>
        </div>
    </div>
</template>

<script>
    import PropertyMixin from '../Mixins/Property';

    export default {
        mixins: [PropertyMixin]
    }
</script>