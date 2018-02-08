<template>
    <div>
        <form role="search">
            <div class="form-group">
                <div class="input-search">

                    <i class="input-search-icon wb-search" aria-hidden="true"></i>
                    <input type="text" class="form-control" name="site-search" placeholder="Search..." v-model="searchText">
                    <button type="button" class="input-search-close icon wb-close" data-target="#site-navbar-search" data-toggle="collapse" aria-label="Close"></button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                searchText: ''
            };
        },
        watch: {
            searchText(value) {
                this.$emit('input', value)
            }
        }
    }
</script>