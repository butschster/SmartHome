<template>
    <div class="panel mb-0">
        <div class="panel-body bg-blue-800">
            <div class="input-search input-search-dark">
                <i class="input-search-icon wb-search" aria-hidden="true"></i>
                <input type="text" class="form-control" name="search" :placeholder="placeholder" v-model="searchText">
                <button type="button" class="input-search-close icon wb-close" aria-label="Close" @click="clear"></button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            placeholder: {
                type: String,
                default: "",
            }
        },
        data() {
            return {
                searchText: ''
            }
        },
        methods: {
            clear() {
                this.searchText = '';
            }
        },
        watch: {
            searchText(value) {
                this.$emit('input', value)
            }
        }
    }
</script>