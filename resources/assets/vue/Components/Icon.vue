<template>
    <i :class="name" aria-hidden="true"></i>
</template>

<script>
    export default {
        name: "icon",
        props: ['name']
    }
</script>