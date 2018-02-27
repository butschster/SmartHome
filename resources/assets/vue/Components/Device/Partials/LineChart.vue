<template>
    <div style="margin-top: 50px;">
        <div :id="`chart${id}`" style="width:100%; height:200px;"></div>
    </div>
</template>

<script>
    export default {
        props: {
            id: String,
            data: Array,
            units: String,
            name: String
        },
        data() {
            return {
                chart: null
            }
        },
        watch: {
            data() {
                this.initChart();
            }
        },
        mounted() {
            this.initChart();
        },
        methods: {
            initChart() {
                if (this.chart) {
                    this.chart.update({
                        series: [{
                            data: this.data
                        }]
                    });
                    return;
                }

                this.chart = Highcharts.chart(`chart${this.id}`, {
                    title: {
                        text: null
                    },
                    chart: {
                        type: 'areaspline',
                        zoomType: 'x'
                    },
                    xAxis: {
                        type: 'datetime'
                    },
                    yAxis: {
                        title: {
                            text: this.units
                        }
                    },
                    plotOptions: {
                        line: {
                            dataLabels: {
                                enabled: true
                            },
                            enableMouseTracking: false
                        }
                    },
                    series: [{
                        name: this.name,
                        data: this.data
                    }]
                });
            }
        }
    }
</script>