<template>
    <div>
        <ul class="pagination">
            <li v-if="pagination.current_page > 1" class="page-item">
                <span aria-label="Previous" v-on:click="changePage(pagination.current_page - 1)" class="page-link">«</span>
            </li>
            <li v-for="page in pagesNumber" :key="page" v-bind:class="[ page == isActived ? 'page-item active' : 'page-item']">
                <a href="#" v-on:click="changePage(page)" class="page-link">{{ page }}</a>
            </li>
            <li v-if="pagination.current_page < pagination.last_page" class="page-item">
                <span  aria-label="Next" v-on:click="changePage(pagination.current_page + 1)"  class="page-link">»</span>
            </li>
        </ul>
        <div v-show="pagination.total > 0">{{ pagination.from }}-{{ pagination.to }} / {{ pagination.total }}</div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                offset: 5,
            }
        },
        props: {
            pagination: {
               type: Object,
               require: true
            }
        },
        computed: {
            isActived: function () {
                return this.pagination.current_page;
            },
            pagesNumber: function () {
                if (!this.pagination.to) {
                    return [];
                }
                let from = this.pagination.current_page - this.offset;
                if (from < 1) {
                    from = 1;
                }
                let to = from + (this.offset * 2);
                if (to >= this.pagination.last_page) {
                    to = this.pagination.last_page;
                }
                let pagesArray = [];
                while (from <= to) {
                    pagesArray.push(from);
                    from++;
                }

                return pagesArray;
            },
        },
        created: function () {
        },
        methods: {
            changePage: function (page) {
                if(page != this.pagination.current_page) {
                    this.$emit('change', page);
                }
            },
        }
    }
</script>

<style scoped lang="scss">

</style>
