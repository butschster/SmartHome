<template>
    <main-layout title="Dashboard">
        <page-content>
            <devices></devices>
        </page-content>
    </main-layout>
</template>

<script>
    import Devices from 'Components/Device/List';

    export default {
        name: "page-dashboard",
        components: {
            Devices
        }
    }
</script>