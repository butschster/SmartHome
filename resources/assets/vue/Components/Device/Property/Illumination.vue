<template>
    <div>
        <div class="float-right text-right">
            <small class="text-muted">Освещенность</small>
            <br/>
            <span class="badge badge-primary">{{ property.formatted_value }}</span>
        </div>
        <h4>
            <i class="fas fa-hockey-puck"></i>
            {{ property.name }}
        </h4>
        <small v-if="hasDescription" class="text-muted">{{ property.description }}</small>
    </div>
</template>

<script>
    import PropertyMixin from '../Mixins/Property';

    export default {
        mixins: [PropertyMixin]
    }
</script>