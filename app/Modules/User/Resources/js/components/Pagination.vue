<template>
    <div :class="'l-pagination ' + position">
        <ul v-if="datas && datas.total > 0 && datas.last_page > 1" class="pagination">
            <!-- <li class="page-item">
                <button 
                    type="button" 
                    @click="onClickFirstPage"
                    :disabled="isInFirstPage"
                    aria-label="Go to first page"
                >
                    <i class="feather-chevrons-left"></i>
                </button>
            </li> -->
            <li class="page-item">
                <button 
                    type="button" 
                    @click="onClickPreviousPage"
                    :disabled="isInFirstPage"
                    aria-label="Go to previous page"
                >
                    <i class="feather-chevron-left"></i>
                </button>
            </li>

            <li v-for="(page, key) in pages" v-bind:key="key" class="page-item page-item-pc">
                <button 
                    type="button" 
                    @click="onClickPage(page.name)"
                    :disabled="page.isDisabled"
                    :class="{ active: isPageActive(page.name) }"
                    :aria-label="`Go to page number ${page.name}`"
                >
                    {{ page.name }}
                </button>
            </li>

            <li class="page-item page-item-sm">{{ this.datas.current_page }}</li>

            <li class="page-item">
                <button 
                    type="button" 
                    @click="onClickNextPage"
                    :disabled="isInLastPage"
                    aria-label="Go to next page"
                >
                    <i class="feather-chevron-right"></i>
                </button>
            </li>

            <!-- <li class="page-item">
                <button 
                    type="button" 
                    @click="onClickLastPage"
                    :disabled="isInLastPage"
                    aria-label="Go to last page"
                >
                    <i class="feather-chevrons-right"></i>
                </button>
            </li> -->
        </ul>
        <div v-show="datas.total > 0" class="pagination_content">{{$t('hiển thị')}} {{ datas.from }}-{{ datas.to }} {{$t('trong số')}} {{ datas.total }} {{$t('Công ty')}}</div>
    </div>
</template>

<script>

    export default {
        name: "pagination",
        props: {
            maxVisibleButtons: {
                type: Number,
                required: false,
                default: 10
            },
            datas: {
                type: Object,
                required: true
            },
            tableName: {
                type: String,
                default: 'sản phẩm'
            },
            position: {
                type: String,
                default: 'center'
            }
        },
        computed: {
            startPage() {
                if (this.datas.current_page === 1 || this.maxVisibleButtons >= this.datas.last_page ) {
                    return 1;
                }

                if (this.datas.current_page === this.datas.last_page) { 
                    return this.datas.last_page - this.maxVisibleButtons + 1;
                }

                return this.datas.current_page - 1;
            },
            endPage() {
                return Math.min(this.startPage + this.maxVisibleButtons - 1, this.datas.last_page);
            },
            pages() {
                const range = [];
                for (let i = this.startPage; i <= this.endPage; i+= 1 ) {
                    range.push({
                        name: i,
                        isDisabled: i === this.datas.current_page 
                    });
                }

                return range;
            },
            isInFirstPage() {
                return this.datas.current_page === 1;
            },
            isInLastPage() {
                return this.datas.current_page === this.datas.last_page;
            },
        },
        methods: {
            onClickFirstPage() {
                this.$emit('change', 1);
            },
            onClickPreviousPage() {
                this.$emit('change', this.datas.current_page - 1);
            },
            onClickPage(page) {
                this.$emit('change', page);
            },
            onClickNextPage() {
                this.$emit('change', this.datas.current_page + 1);
            },
            onClickLastPage() {
                this.$emit('change', this.datas.last_page);    
            },
            isPageActive(page) {
                return this.datas.current_page === page;
            },
        }
    };
</script>

<style scoped lang="scss">
    .l-pagination {
        margin-bottom: 24px;
        .pagination {
            .page-item {
                padding: 0 5px;
                button {
                    background: transparent;
                    border-color: transparent;
                    padding: 2px 10px;
                    border: none;
                    font-size: 16px;
                    font-weight: bold;
                    i{
                        font-size: 22px;
                        color: #24A67F 
                    }
                }
                button:hover,
                .active {
                    z-index: 1;
                    color: #fff;
                    background-color: #24A67F;
                    border-color: #24A67F;
                }
            }
            .page-item-sm {
                display: none;
            }
        }
        .pagination_content{
            font-size: 16px;
            font-weight: bold;
        }

        // &.right {
        //     text-align: center;

        //     .pagination {
        //         justify-content: center;
        //     }
        // }

        &.center {
            text-align: center;

            .pagination {
                justify-content: center;
            }
        }
    }

    @media screen and (max-width: 576px) {
        .l-pagination {
            .pagination {
                align-items: center;
                .page-item{
                    button{
                        font-size: 14px;
                    }
                }
                .pagination_content{
                    font-size: 13px;
                }
                .page-item-sm {
                    width: 50px;
                    text-align: center;
                }
            }

            &.left {
                text-align: center;
                .pagination {
                    justify-content: center;
                }
            }

            &.right {
                text-align: center;
                .pagination {
                    justify-content: center;
                }
            }
            .pagination_content{
            font-size: 13px;
            font-weight: bold;
        }
        }
    }
</style>
