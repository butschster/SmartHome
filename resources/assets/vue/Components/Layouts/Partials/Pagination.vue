<template>
    <nav>
        <ul class="pagination pagination-sm" v-if="hasPages">
            <li class="page-item" v-if="data.current_page > 1">
                <a class="page-link" href="#" @click.prevent="pageChanged(1)" aria-label="Previous">
                    <span aria-hidden="true">First</span>
                </a>
            </li>
            <li class="page-item" v-for="n in paginationRange" :class="activePage(n)">
                <a class="page-link" href="#" @click.prevent="pageChanged(n)">{{ n }}</a>
            </li>

            <li class="page-item" v-if="data.current_page < lastPage">
                <a class="page-link" href="#" @click.prevent="pageChanged(lastPage)" aria-label="Next">
                    <span aria-hidden="true">Last</span>
                </a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        props: {
            data: {
                type: Object,
                default: function () {
                    return {
                        current_page: 1,
                        per_page: 10,
                        total: 0,
                        last_page: 1
                    }
                }
            },
            limit: {
                type: Number,
                default: 6
            }
        },

        methods: {
            activePage (pageNum) {
                return this.data.current_page === pageNum ? 'active' : '';
            },

            pageChanged (pageNum) {
                this.$emit('page-changed', pageNum);
            }
        },

        computed: {
            hasPages () {
                return _.get(this.data, 'last_page', 0) > 1;
            },

            lastPage() {
                if (this.data.last_page) {
                    return this.data.last_page;
                } else {
                    return this.data.total % this.data.per_page === 0
                        ? this.data.total / this.data.per_page
                        : Math.floor(this.data.total / this.data.per_page) + 1;
                }
            },

            paginationRange() {
                let lowerBound = (num, limit) => num >= limit ? num : limit;

                let start =
                    this.data.current_page - this.limit / 2 <= 0
                        ? 1 : this.data.current_page + this.limit / 2 > this.lastPage
                        ? lowerBound(this.lastPage - this.limit + 1, 1)
                        : Math.ceil(this.data.current_page - this.limit / 2);

                let range = [];

                for (let i = 0; i < this.limit && i < this.lastPage; i++) {
                    range.push(start + i)
                }

                return range;
            }
        }
    }
</script>