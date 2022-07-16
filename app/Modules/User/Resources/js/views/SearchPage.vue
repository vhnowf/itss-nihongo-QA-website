<template>
    <div class="row search-page">
        <div class="col-12 sm-filter">
            <div class="d-flex justify-content-between">
                <div class="group-item-sort">
                    <select v-model="parameter.sort" class="form-control" v-on:change="search()">
                        <option :value="null">Sắp xếp</option>
                        <option value="min_to_max">Giá: Thấp đến Cao</option>
                        <option value="max_to_min">Giá: Cao đến Thấp</option>
                    </select> 
                </div>
                <button type="button" class="btn btn-show-filter" data-toggle="modal" data-target="#smFilterModal">
                    <i class="feather-filter"></i>
                </button>

                <div class="modal fade" id="smFilterModal" tabindex="-1" role="dialog" aria-labelledby="smFilterModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <img src="https://jptech-life.com/wp-content/themes/jobdb/images/icons/close.png" alt="close">
                                </button>
                                <h5 class="modal-title" id="smFilterModalLabel">Tìm kiếm</h5>
                            </div>
                            <div class="modal-body">
                                <div class="s-item">
                                    <div class="s-head">Từ khóa</div>
                                    <div class="s-data">
                                        <div class="form-group">
                                            <input v-model="parameter.keyword" type="text" class="form-control" placeholder="Từ khóa">
                                        </div>
                                    </div> 
                                </div>

                                <div v-if="!hideItem.categories && categories.length > 0" class="s-item">
                                    <div class="s-head box-collapse">
                                        <span class="s-title">Loại sản phẩm</span>
                                        <span class="arrow" data-toggle="collapse" aria-controls="collapse_category" data-target="#collapse_category">
                                            <i class="feather-chevron-right"></i>
                                        </span>
                                    </div>
                                    <div id="collapse_category" class="s-data collapse show">
                                        <div v-for="(level_1, key) in categories" v-bind:key="key">
                                            <div class="box-collapse">
                                                <label v-bind:key="key" class="custom-checkbox">
                                                    {{ level_1.title }}
                                                    <input type="checkbox" v-model="parameter.categories" :value="level_1.id" v-on:change="changeCategory(level_1.id, level_1.parent_id, 1, false)">
                                                    <span class="checkmark"></span>
                                                </label>
                                                <span 
                                                    v-if="level_1.childs.length > 0"
                                                    class="arrow collapsed"
                                                    data-toggle="collapse"
                                                    :aria-controls="'collapse_category_' + level_1.id"
                                                    :data-target="'#collapse_category_' + level_1.id"
                                                ><i class="feather-chevron-right"></i></span>
                                            </div>

                                            <div v-if="level_1.childs && level_1.childs.length > 0" class="p-l-12 collapse" :id="'collapse_category_' + level_1.id">
                                                <div v-for="level_2 in level_1.childs" :key="level_2.id" >
                                                    <div class="box-collapse">
                                                        <label class="custom-checkbox">
                                                            {{ level_2.title }}
                                                            <input type="checkbox" v-model="parameter.categories" :value="level_2.id" v-on:change="changeCategory(level_2.id, level_2.parent_id, 2, false)">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                        <span 
                                                            v-if="level_2.childs && level_2.childs.length > 0"
                                                            class="arrow collapsed"
                                                            data-toggle="collapse"
                                                            :aria-controls="'collapse_category_' + level_2.id"
                                                            :data-target="'#collapse_category_' + level_2.id"
                                                        ><i class="feather-chevron-right"></i></span>
                                                    </div>

                                                    <div v-if="level_2.childs && level_2.childs.length > 0" class="p-l-12 collapse" :id="'collapse_category_' + level_2.id">
                                                        <div v-for="level_3 in level_2.childs" :key="level_3.id" >
                                                            <label class="custom-checkbox">
                                                                {{ level_3.title }}
                                                                <input type="checkbox" v-model="parameter.categories" :value="level_3.id" v-on:change="changeCategory(level_3.id, level_3.parent_id, 3, false)">
                                                                <span class="checkmark"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div v-if="!hideItem.companies" class="s-item">
                                    <div class="s-head box-collapse">
                                        <span class="s-title">Lựa chọn công ty</span>
                                        <span class="arrow collapsed" data-toggle="collapse" aria-controls="collapse_company" data-target="#collapse_company">
                                            <i class="feather-chevron-right"></i>
                                        </span>
                                    </div>
                                    <div id="collapse_company" class="s-data collapse">
                                        <label v-for="(company, key) in companies" v-bind:key="key" class="custom-checkbox">
                                            {{ company.title }}
                                            <input type="checkbox" v-model="parameter.companies" :value="company.id">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div> 
                                </div>

                                <div class="s-item s-price">
                                    <div class="s-head">Khoảng giá</div>
                                    <div class="form-group">
                                        <div class="s-price-input">
                                            <input type="text" maxlength="13" class="price_min" placeholder="₫ TỪ" v-model="parameter.price_min">
                                            <span>-</span>
                                            <input type="text" maxlength="13" class="price_max" placeholder="₫ ĐẾN" v-model="parameter.price_max">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="f-btn-list">
                                    <button type="button" class="btn-reset" data-dismiss="modal">Thoát</button>
                                    <!-- <button type="button" class="btn-reset" v-on:click="spResetSearch()">Reset</button> -->
                                    <button type="button" class="btn-submit" data-dismiss="modal" v-on:click="search()">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 pc-filter">
            <div v-if="company" class="s-item s-item-company">
                <div class="logo">
                    <a :href="baseUrl('cong-ty/'+company.slug)" target="_blank">
                        <img v-lazy="company.avatar" :alt="company.title">
                    </a>
                </div>
                <div class="s-name"><a :href="baseUrl('cong-ty/'+company.slug)" target="_blank">{{ company.title }}</a></div>
            </div>
            <div class="s-item">
                <div class="s-head">Từ khóa</div>
                <div class="s-data">
                    <div class="form-group">
                        <input v-model="parameter.keyword" v-on:change="search()" type="text" class="form-control" placeholder="Từ khóa">
                    </div>
                </div> 
            </div>

            <div v-if="!hideItem.categories && categories.length > 0" class="s-item">
                <div class="s-head box-collapse">
                    <span class="s-title">Loại sản phẩm</span>
                    <span class="arrow" data-toggle="collapse" aria-controls="collapse_category" data-target="#collapse_category">
                        <i class="feather-chevron-right"></i>
                    </span>
                </div>
                <div id="collapse_category" class="s-data collapse show">
                    <div v-for="(level_1, key) in categories" v-bind:key="key">
                        <div class="box-collapse">
                            <label v-bind:key="key" class="custom-checkbox">
                                {{ level_1.title }}
                                <input type="checkbox" v-model="parameter.categories" :value="level_1.id" v-on:change="changeCategory(level_1.id, level_1.parent_id, 1)">
                                <span class="checkmark"></span>
                            </label>
                            <span 
                                v-if="level_1.childs.length > 0"
                                class="arrow collapsed"
                                data-toggle="collapse"
                                :aria-controls="'collapse_category_' + level_1.id"
                                :data-target="'#collapse_category_' + level_1.id"
                            ><i class="feather-chevron-right"></i></span>
                        </div>

                        <div v-if="level_1.childs && level_1.childs.length > 0" class="p-l-12 collapse" :id="'collapse_category_' + level_1.id">
                            <div v-for="level_2 in level_1.childs" :key="level_2.id" >
                                <div class="box-collapse">
                                    <label class="custom-checkbox">
                                        {{ level_2.title }}
                                        <input type="checkbox" v-model="parameter.categories" :value="level_2.id" v-on:change="changeCategory(level_2.id, level_2.parent_id, 2)">
                                        <span class="checkmark"></span>
                                    </label>
                                    <span 
                                        v-if="level_2.childs && level_2.childs.length > 0"
                                        class="arrow collapsed"
                                        data-toggle="collapse"
                                        :aria-controls="'collapse_category_' + level_2.id"
                                        :data-target="'#collapse_category_' + level_2.id"
                                    ><i class="feather-chevron-right"></i></span>
                                </div>

                                <div v-if="level_2.childs && level_2.childs.length > 0" class="p-l-12 collapse" :id="'collapse_category_' + level_2.id">
                                    <div v-for="level_3 in level_2.childs" :key="level_3.id" >
                                        <label class="custom-checkbox">
                                            {{ level_3.title }}
                                            <input type="checkbox" v-model="parameter.categories" :value="level_3.id" v-on:change="changeCategory(level_3.id, level_3.parent_id, 3)">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div v-if="!hideItem.companies" class="s-item">
                <div class="s-head box-collapse">
                    <span class="s-title">Lựa chọn công ty</span>
                    <span class="arrow collapsed" data-toggle="collapse" aria-controls="collapse_company" data-target="#collapse_company">
                        <i class="feather-chevron-right"></i>
                    </span>
                </div>
                <div id="collapse_company" class="s-data collapse">
                    <label v-for="(company, key) in companies" v-bind:key="key" class="custom-checkbox">
                        {{ company.title }}
                        <input type="checkbox" v-model="parameter.companies" :value="company.id" v-on:change="search()">
                        <span class="checkmark"></span>
                    </label>
                </div> 
            </div>

            <div class="s-item s-price">
                <div class="s-head">Khoảng giá</div>
                <div class="form-group">
                    <div class="s-price-input">
                        <input type="text" maxlength="13" class="price_min" placeholder="₫ TỪ" v-model="parameter.price_min">
                        <span>-</span>
                        <input type="text" maxlength="13" class="price_max" placeholder="₫ ĐẾN" v-model="parameter.price_max">
                    </div>
                </div>
                <div class="text-center">
                    <button class="m-b-12 btn btn-main" v-on:click="search()">Áp dụng</button>
                </div>
            </div>

            <div class="s-item">
                <div class="s-head">Sắp xếp</div>
                <div class="s-data">
                    <div class="form-group">
                        <select v-model="parameter.sort" class="form-control" v-on:change="search()">
                            <option value=""></option>
                            <option value="min_to_max">Giá: Thấp đến Cao</option>
                            <option value="max_to_min">Giá: Cao đến Thấp</option>
                        </select> 
                    </div>
                </div>
            </div>

            <!-- <div class="s-item">
                <div class="text-center form-group">
                    <button class="m-t-24 m-b-24 btn btn-main" v-on:click="search()">Tìm kiếm</button>
                </div>
            </div> -->
        </div>
        <div class="col-md-9">
            <!-- <div class="m-t-12 m-b-12">
                <div class="btn-group">
                    <button class="btn btn-light btn-active" id="products-grid"><i class="feather-grid"></i></button>
                    <button class="btn btn-light" id="products-list" onclick="showListProduct()"><i class="feather-list"></i></button>
                </div>
                <div class="float-right">
                    <select v-model="parameter.sort" class="form-control form-custom sort_product" v-on:change="search()">
                        <option value="all" hidden>Giá</option>
                        <option value="min_to_max">Giá: Thấp đến Cao</option>
                        <option value="max_to_min">Giá: Cao đến Thấp</option>
                    </select> 
                </div>
            </div> -->
            <div id="products" class="row">
                <div v-show="products.data.length == 0 && !isLoading" class="text-center empty-data">
                    <img src="/images/search-empty.png">
                    <p><b>Không tìm thấy sản phẩm nào</b></p>
                </div>
                <div v-for="(product, key) in products.data" v-bind:key="key" class="item col-6 col-sm-4 col-md-3">
                    <product-item :product="product"></product-item>
                </div>

                <div class="col-12 m-t-24 m-b-24">
                    <pagination :datas="products" @change="onChangePage" /> 
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Pagination from '@user/components/products/Pagination.vue';
    import ProductItem from '@user/components/products/ProductItem.vue';
    import httpStore from '@core/config/httpStore';

    export default {
        name: "search-page",
        components: {
            Pagination,
            ProductItem
        },
        data() {
            return { 
                isLoading: false,
                parameter: {
                    keyword: null,
                    categories: [],
                    companies: [],
                    price_min: null,
                    price_max: null,
                    sort: null,
                    attribute: null,
                    page: 1,
                },
                products: {
                    current_page: 1,
                    data: [],
                    first_page_url: null,
                    from: null,
                    last_page: 1,
                    last_page_url: null,
                    next_page_url: null,
                    path: null,
                    per_page: 20,
                    prev_page_url: null,
                    to: null,
                    total: 0
                }
            };
        },
        props: {
            categories: {
                type: Array,
                required: true,
            },
            companies: {
                type: Array,
                required: true,
            },
            filterData: {
                type: Object,
                required: true,
            },
            hideItem: {
                type: [Object, Array],
                default: function () {
                    return {}
                }
            },
            company: {
                type: [Object, String],
                default: null,
            },
        },
        created: function () {
            this.parameter = this.filterData;
            this.search(this.filterData.page);
        },
        methods: {
            changeCategory: function(id, parent_id, level, runSearch = true) {
                let scop = this;
                let childs = scop.getCategoryChilds(id);
                if(childs.length > 0) {
                    if(scop.parameter.categories.includes(id)) {
                        childs.forEach((item, key) => {
                            if(!scop.parameter.categories.includes(item.id)) {
                                scop.parameter.categories.push(item.id);
                            }
                        });

                        if(level == 1) {
                            childs.forEach((item, key) => {
                                if(item.childs) {
                                    item.childs.forEach((item3, key) => {
                                        if(!scop.parameter.categories.includes(item3.id)) {
                                            scop.parameter.categories.push(item3.id);
                                        }
                                    });
                                }
                               
                            });
                        }
                    } else {
                        childs.forEach((item, key) => {
                            if(scop.parameter.categories.includes(item.id)) {
                                let index = scop.parameter.categories.indexOf(item.id);
                                scop.parameter.categories.splice(index, 1);
                            }
                        });

                        if(level == 1) {
                            childs.forEach((item, key) => {
                                if(item.childs) {
                                    item.childs.forEach((item3, key) => {
                                        if(scop.parameter.categories.includes(item3.id)) {
                                            let index = scop.parameter.categories.indexOf(item3.id);
                                            scop.parameter.categories.splice(index, 1);
                                        }
                                    });
                                }
                            });
                        }
                    }
                } 

                // if(parent_id != 0) {
                //     if(!scop.parameter.categories.includes(parent_id)) {
                //         // Kiểm tra nếu tất cả các category con đều check rồi thì check luôn thằng cha
                //         let childs = scop.getCategoryChilds(parent_id);
                //         let check = true;
                //         childs.forEach((item, key) => {
                //             if(!scop.parameter.categories.includes(item.id)) {
                //                 check = false;

                //                 return;
                //             }
                //         });

                //         if(check) {
                //             scop.parameter.categories.push(parent_id);
                //         }
                //     }
                // }

                if(runSearch) {
                    scop.search();
                }
            },
            getCategoryChilds: function(id) {
                let childs = [];
                this.categories.forEach((item, key) => {
                    if(id == item.id) {
                        childs = item.childs;
                    }
                });

                return childs;
            },
            spResetSearch: function() {
                this.parameter = {
                    keyword: null,
                    categories: [],
                    companies: [],
                    price_min: null,
                    price_max: null,
                    sort: null,
                    attribute: null,
                    page: 1,
                }
            },
            onChangePage: function(page) {
                this.parameter.page = page;
                this.search(page);
                window.scrollTo(0, 0); 
            },
            setParam: function() {
                // if (history.pushState) {
                //     var params = new URLSearchParams(window.location.search);
                //     params.set(key, value);
                //     var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + params.toString();
                //     window.history.pushState({path:newUrl},'',newUrl);
                // }

                let obj = {};

                if(this.parameter.keyword) {
                    obj.keyword = this.parameter.keyword;
                }
                if(!this.hideItem.companies && this.parameter.companies.length > 0) {
                    obj.companies = this.parameter.companies;
                }
                if(!this.hideItem.categories && this.parameter.categories.length > 0) {
                    obj.categories = this.parameter.categories;
                }
                if(this.parameter.price_min) {
                    obj.price_min = this.parameter.price_min;
                }
                if(this.parameter.price_max) {
                    obj.price_max = this.parameter.price_max;
                }
                if(this.parameter.sort) {
                    obj.sort = this.parameter.sort;
                }
                if(this.parameter.attribute) {
                    obj.attribute = this.parameter.attribute;
                }
                if(this.parameter.page && this.parameter.page > 1) {
                    obj.page = this.parameter.page;
                }

                this.setParamSearch(obj);
            },
            removeParam: function(key) {
                if (history.pushState) {
                    var params = new URLSearchParams(window.location.search);
                    params.delete(key);
                    var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?' + params.toString();
                    window.history.pushState({path:newUrl},'',newUrl);
                }
            },
            search: function(page = 1) {
                let scop = this;
                scop.parameter.page = page;
                scop.setParam();
                
                scop.$loading(true);
                httpStore.dispatch('get', {
                    url: scop.baseUrl('/products/search'),
                    data: {
                        params: scop.parameter
                    }
                }).then(function (response) {
                    scop.products = response.products;
                    scop.$loading(false);
                }).catch(function (error) {
                    console.log(error);
                    scop.$loading(false);
                });
            },
            openLink: function (slug, id) {
                if(slug) {
                    location.href = BASE_URL + '/' + slug;
                } else {
                    location.href = BASE_URL + '/' + id;
                }
            }
        }
    };
</script>

<style scoped lang="scss">
    .search-page {
        .s-item {
            border-bottom: 1px dotted #e9ebee;
            margin-bottom: 12px;

            .s-head {
                margin-bottom: 12px; 
            }
        }

        .s-item-company {
            padding-bottom: 12px;
            text-align: center;

            .logo {
                padding: 5px;
                height: 120px;
                border: 1px solid #e9e9e9;
                display: flex;
                align-items: center;
                justify-content: center;

                img {
                    max-width: 100%;
                    min-height: 50px;
                    max-height: 100px;
                    object-fit: contain;
                }
            }
            .s-name {
                margin-top: 5px
            }
        }

        .s-price {
           .s-price-input input {
                width: 42%;
                border: 1px solid #e9ebee;
                display: inline-block;
                padding: 5px;
            }

            .s-price-input span {
                width: 10%;
                display: inline-block;
                text-align: center;
            }
        }

        .sort_product {
            max-width: 185px;
        }

        .loading {
            align-items: unset;
            padding-top: 200px;
        }

        .sm-filter {
            display: none;
            margin-bottom: 24px;

            .group-item-sort {
                select {
                    height: 40px;
                }
            }

            .btn-show-filter {
                height: 40px;
                width: 40px;
                border-radius: 3px;
                border: 1px solid #f57224;
                background: #FFFFFF;
                color: #f57224;
                font-size: 20px;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            #smFilterModal {
                .modal-dialog {
                    width: 100%;
                    margin: 0;
                    max-width: 100%;
                    height: 100%;
                }
                
                .modal-content {
                    border: none;
                    height: 100%;
                }

                .modal-header {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    background: white;
                    z-index: 999;

                    .close {
                        margin: 0;
                        padding: 0;
                    }
                }

                .modal-title {
                    text-align: center;
                    width: 100%;
                    font-size: 18px;
                }

                .modal-body {
                    padding-top: 75px;
                    padding-bottom: 100px;
                    background-color: white;
                }

                .modal-footer {
                    position: fixed;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    background: white;
                    z-index: 999;
                    box-shadow: 0px 0px 18px 0px rgb(0 0 0 / 13%);

                    .f-btn-list {
                        display: flex;
                        flex-wrap: wrap;
                        justify-content: space-between;
                        width: 100%;
                        button {
                            flex: 0 0 48%;
                            height: 40px;
                            outline: 0;
                            text-transform: uppercase;
                            border: 1px solid #f57224;
                            border-radius: 3px;
                            background-color: white;
                        }
                        .btn-reset {
                            color: #f57224;
                        }
                        .btn-submit {
                            color: white;
                            background-color: #f57224;
                        }
                    }
                }
            }
        }
    }

    @media screen and (max-width: 767px) {
        .search-page {
            .pc-filter {
                display: none
            }

            .sm-filter {
                display: block
            }
        }
    }
</style>
