<template>
    <div class="container-scroller">
        <div class="container-fluid">
            <div class="row">
                <div class="content-wrapper full-page-wrapper d-flex align-items-center text-center error-page">
                    <div class="col-lg-6 mx-auto">
                        <h1 class="display-1 mb-0">404</h1>
                        <h2 class="mb-4">Страница не найдена!</h2>

                        <router-link class="btn btn-primary mt-5 btn-rounded btn-lg" :to="backLink">
                            Back to Dashboard
                        </router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {
        DASHBOARD
    } from 'router/actions';

    export default {
        name: "404",

        data() {
            return {
                backLink: {
                    name: DASHBOARD
                }
            }
        }
    }
</script>

<style scoped>

</style>