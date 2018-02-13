<template>
    <main-layout>
        <page-content>
            <weather></weather>
            <devices></devices>
        </page-content>
    </main-layout>
</template>

<script>
    import Devices from 'Components/Device/List';
    import Weather from 'Components/Weather/Widget';

    export default {
        name: "page-dashboard",
        components: {
            Devices, Weather
        }
    }
</script>