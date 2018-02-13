<template>
    <i :class="name" class="icon" aria-hidden="true"></i>
</template>

<script>
    export default {
        name: "icon",
        props: ['name']
    }
</script>