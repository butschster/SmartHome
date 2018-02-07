<template>
    <layout header="Dashboard">
        <devices></devices>
    </layout>
</template>

<script>
    import Layout from 'Components/Layouts/Main';
    import Devices from 'Components/Device/List';

    export default {
        components: {
            Layout, Devices
        }
    }
</script>