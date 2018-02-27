<template>
    <div v-if="this.property.value > 0" class="card-body">
        <h5 class="text-info">
            <i class="far fa-clock fa-lg fa-fw"></i>
            {{ this.property.formatted_value.humanize }}
        </h5>
    </div>
</template>

<script>
    import PropertyMixin from '../Mixins/Property';

    export default {
        mixins: [PropertyMixin]
    }
</script>