<template>
    <div class="product-detail">
        <div v-if="product.status != 'public'" class="alert alert-danger" role="alert">Sản phẩm ngừng kinh doanh</div>
        <div class="row h-page-border-b">
            <div class="col-md-9 col-sm-8 col-12">
                <div class="row">
                    <div class="col-md-5 col-12">
                        <image-magnifier
                            :src="slider.activeImg"
                            :zoom-src="slider.activeImg"
                            zoom-width="400"
                            zoom-height="400">
                        </image-magnifier>
                        <div class="slider">
                            <div class="slider-control">
                                <ul class="list-thumbnail" id="list-thumbnail">
                                    <li v-for="(img, key) in slider.items" v-bind:key="key" v-on:click="selectImg(img)" :class="img == slider.activeImg ? 'active' : ''">
                                        <img v-lazy="img" :alt="product.title" />
                                    </li>
                                </ul>

                                <!-- <div v-on:click="scrollSlider('previous')" class="btn-prev"><i class="feather-chevron-left"></i></div>
                                <div v-on:click="scrollSlider('next')" class="btn-next"><i class="feather-chevron-right"></i></div> -->
                            </div>
                        </div>
                    </div>
                    <div class="content col-md-7 col-12 m-b-24">
                        <h1 class="product-name">{{ product.title }}</h1>
                        <div class="m-b-24">Mã SP: {{ product.id }}</div>
                        <p class="m-b-12">
                            <strong class="price-vnd-last">{{ numberToCurrency(price.sale_price_vi) }} ₫</strong>&nbsp;&nbsp;
                            <s v-show="price.input_price_vi > price.sale_price_vi">{{ numberToCurrency(price.input_price_vi) }} ₫</s>
                            <span v-if="price.percent_sale > 0" class="percent-sale">{{ price.percent_sale }}% Giảm</span>
                        </p>

                        <div v-if="product.status == 'public'">
                            <div class="delivery">
                                <div class="icon-delivery">
                                    <img :src="baseUrl('/images/giaohang.png')">
                                </div>
                                <div class="time-delivery">
                                    Thời gian dự kiến quý khách nhận được hàng vào khoảng ngày <span class="txt-price-color">{{ datetimeFirst() }}</span> đến <span class="txt-price-color">{{ datetimeSecond() }}</span> nếu quý khách thanh toán hôm nay.
                                </div>
                            </div>
                            <div class="delivery">
                                <div class="icon-delivery">
                                    <img :src="baseUrl('/images/icon-tax.png')">
                                </div>
                                <div v-if="!price.freight || price.freight == 0" class="time-delivery txt-price-color">
                                    Giá chưa bao gồm thuế và cước vận chuyển. Xem các thông tin tại đơn hàng.
                                </div>
                            </div>
                            <div class="quantity-cart">
                                <input-quantity v-model="quantity" class="q-c-item"></input-quantity>
                                <div class="q-c-item">
                                    <button v-on:click="addCart()" class="p-buy-cart"><img src="/images/cart.png"/><span>Nhặt hàng</span></button>
                                </div>
                                <div class="q-c-item">
                                    <button v-on:click="addCart(true)" class="p-buy-now">Mua ngay</button>
                                </div>
                            </div>
                        </div> 
                    </div>  
                </div>
            </div>
            <div class="col-md-3 col-sm-4 col-12">
                <div class="more-information">
                    <div v-if="product.company" class="s-item-company h-page-border-b">
                        <div class="text-center">Một sản phẩm của</div>
                        <div class="logo">
                            <a :href="baseUrl('cong-ty/'+product.company.slug)" target="_blank">
                                <img v-lazy="product.company.avatar" :alt="product.company.title">
                            </a>
                        </div>
                    </div>

                    <support-box></support-box>
                    <!-- <div class="request-translation" v-if="product.original && product.original.status == 'new'">
                        <button type="button" class="btn btn-primary bg-orange border-coler-orange" v-on:click="requestTranslation()">Dịch</button>
                    </div> -->
                </div>
            </div>
        </div>
        
        <div class="m-t-24 h-page-border-b description">
            <div class="row">
                <div class="col-md-9 col-sm-8 col-12">
                    <div class="p-d-note">
                        * Nội dung bên dưới được dịch tự động. Để dễ dàng hiểu hơn, bạn có thể yêu cầu đội ngũ vận hành của chúng tôi dịch lại: <a href="javascript:void(0)" data-toggle="modal" data-target="#modalRequestTranslation">Ở ĐÂY!</a>
                    </div>
                    <div class="modal fade" id="modalRequestTranslation" tabindex="-1" role="dialog" aria-labelledby="modalRequestTranslation" aria-hidden="true">
                        <div class="modal-dialog modal-md" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Yêu cầu dịch</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="feather-x"></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="m-b-12">
                                        <label class="custom-checkbox">
                                            Nhân thông báo khi dịch xong
                                            <input 
                                                type="checkbox"
                                                value="1"
                                                v-model="translation_notice"
                                            />
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div v-show="translation_notice" class="m-b-12">
                                        <label>Email nhận thông báo sau khi dịch</label>
                                        <input type="email" v-model="email_notification" class="form-control" placeholder="Email nhận thông báo sau khi dịch">
                                        <span v-if="email_notification_error" class="help-block">
                                            <small class="text-danger">{{ email_notification_error }}</small>
                                        </span>
                                    </div>
                                    <div class="text-center">
                                        <button v-on:click="requestTranslation()" class="btn btn-primary bg-orange border-coler-orange" type="button">Yều cầu dịch</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-content-detail" v-html="product.content"></div> 
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import InputQuantity from '@user/components/products/InputQuantity.vue'
    import SupportBox from '@user/components/SupportBox.vue'
    import ImageMagnifier from 'vue-image-magnifier';
    export default {
        name: "product-detail",
        components:{
            InputQuantity,
            SupportBox
        },
        data() {
            return {
                slider: {
                    items: [],
                    frame: 2,
                    activeImg: null,
                },
                quantity: 1,
                email_notification: null,
                email_notification_error: null

            };
        },
        props: {
            product: {
                type: Object,
                required: true,
            }
        },
        computed: {
            price: function () {
                return {};
            },
        },
        created: function () {
            this.initSliderItems();
        },
        methods: {
            initSliderItems: function () {
                let scop = this;
                // scop.slider.activeImg = scop.product.avatar;
                // scop.slider.items = [scop.product.avatar];

                scop.slider.items = [];
                $.each(scop.product.images, function(i, img) {
                    if(img.url) {
                        scop.slider.items.push(img.url);
                    }
                });

                // if(scop.product.attributes.length > 0) {
                //     $.each(scop.product.attributes[0].values, function(i, item) {
                //         if(item.img) {
                //             scop.slider.items.push(item.img);
                //         }
                //     });
                // }
                scop.slider.activeImg = scop.slider.items[0];
            },
            scrollSlider(position) {
                let el = document.getElementById("list-thumbnail");
                let width = 90;
                let maxScrollLeft = el.scrollWidth - el.clientWidth;
                if(position == 'next'){
                    if(el.scrollLeft == maxScrollLeft) {
                        el.scrollLeft = 0;
                    } else {
                        el.scrollLeft += width
                    }
                } else {
                    if(el.scrollLeft == maxScrollLeft) {
                        el.scrollLeft -= width;
                    } else {
                        el.scrollLeft = maxScrollLeft
                    }
                }
            },
            selectImg: function(img) {
                this.slider.activeImg = img;
            },
            datetimeFirst(){
                var todayDate = new Date()

                var newDate = todayDate.setTime( todayDate.getTime() + 10 * 86400000 );// adding 3 days

                var dt=new Date (newDate);
                var datetime = dt.toLocaleDateString("hi-IN");
                return datetime;
            },
            datetimeSecond(){
                var todayDate = new Date()

                var newDate = todayDate.setTime( todayDate.getTime() + 21 * 86400000 );// adding 6 days

                var dt=new Date (newDate);
                var datetime = dt.toLocaleDateString("hi-IN");
                return datetime;
            },
        }
    };
</script>

<style lang="scss">
    .product-detail {
        .image-magnifier{
            background: #fffafa;
            text-align: center;
            cursor: pointer !important;
            .image-magnifier__img{
                width:100%;
                height: auto;
            }
            .image-magnifier__mask{
                background-color: #ccc !important;
            }
            .image-magnifier__zoom{
                z-index:8!important;
                border: solid 1px #f57224;
            }
        }
        .slider {
            .slider-control {
                position: relative;
                ul.list-thumbnail {
                    position: relative;
                    list-style: none;
                    width: 100%;
                    padding: 0;
                    margin-top: 5px;
                    li {
                        display: inline-block;
                        padding: 5px;
                        width: 20%;
                        img {
                            height: auto;
                            width: 100%;
                        }
                        &:hover {
                            opacity: 0.7;
                            cursor: pointer;
                        }
                    }
                    li.active {
                        img {
                            border: 1px solid #f57224;
                        }
                    }
                }

                .btn-prev,
                .btn-next {
                    position: absolute;
                    top: 5px;
                    height: 80px;
                    background: #0000005e;
                    color: #fff;
                    font-size: 18px;
                    width: 18px;
                    text-align: center;
                    padding: 26px 0 0 0;
                    z-index: 8;
                }
                .btn-prev:hover,
                .btn-next:hover {
                    opacity: 0.8;
                    cursor: pointer;
                }
                .btn-prev:active,
                .btn-next:active {
                    opacity: 0.5;
                }
                .btn-prev {
                    left: 0;
                }
                .btn-next {
                    right: 0;
                }
            }
        }
        .content{
            .product-name {
                font-size: 22px;
                margin-top: 0;
                margin-bottom: 24px;
                font-weight: normal;
            }
            .btn-list-item {
                display: flex;
                align-items: center;
                justify-content: space-around;
            }
            .price-vnd-last {
                color: #f57224;
                font-size: 20px;
            }
            s {
                color: #797777;
            }
            .percent-sale {
                background: #f57224;
                color: #ffffff;
                margin-left: 12px;
                padding: 2px;
            }
            .attribute-item {
                .att-value {
                    display: inline-block;
                    margin: 5px;
                    position: relative;
                    img {
                        width: 50px;
                    }
                    span.att-box {
                        padding: 6px 10px;
                        border-radius: 2px;
                        border: 1px solid rgba(0, 0, 0, 0.09);
                        text-align: center;
                        display: inline-block;
                        min-width: 80px;
                        &:hover,
                        .attribute-selected {
                            color: #f57224;
                            border-color: #f57224;
                        }
                    }
                    span.att-line {
                        position: absolute;
                        top: 0;
                        left: 0;
                        height: 100%;
                    }
                    .att-variation-tick {
                        width: 0.9375rem;
                        height: 0.9375rem;
                        position: absolute;
                        overflow: hidden;
                        right: 0;
                        bottom: 0;
                        i {
                            position: absolute;
                            right: 0;
                            bottom: 0;
                            color: #fff;
                            font-size: 8px;
                        }
                        &:before {
                            border: 0.9375rem solid transparent;
                            border-bottom-color: #f57224;
                            content: "";
                            position: absolute;
                            right: -0.9375rem;
                            bottom: 0;
                        }
                    }

                    &.att-value-selected {
                        img, span.att-box {
                            border: 1px solid #f57224;
                            border: 1px solid #f57224;
                        }
                    }

                    &:hover {
                        cursor: pointer;
                    }
                }
            }
            .btn-login-to-get-more{
                background: rgba(66, 66, 66, 0.1);
                height: 40px;
                text-align: center;
                padding-top:10px;
                margin-top: 25px;
                cursor:pointer;
                &:hover{
                    background: #ccc;
                }
            }
            .delivery{
                margin-top: 24px;
                margin-bottom: 24px;
                display: flex;
                .icon-delivery{
                    padding-right: 5px;
                    img{
                        width:25px;
                    }
                }
                .time-delivery{
                    line-height: 22px;
                }
            }
            .quantity-cart{
                margin-top: 24px;
                display: flex;
                flex-wrap: wrap;
                justify-content: space-around;
                .q-c-item {
                    flex: 0 0 31%;
                    .p-buy-cart{
                        border: 1px solid #ececec;
                        width: 100%;
                        height: 100%;
                        font-size: 16px;
                        img{
                            margin-right:3%;
                        }
                        &:hover {
                            background: #ececec;
                        }
                    }
                    .p-buy-now{
                        width: 100%;
                        height: 100%;
                        border: 1px solid #424242;
                        background: #424242;
                        color: #ffffff;
                        font-size: 16px;
                        &:hover{
                            color: #F4533B;
                        }
                    }
                }
            }
        }
        .description{
            padding-bottom: 24px;
            .p-d-note {
                font-style: italic;
                margin-bottom: 24px;
                color: #f57224;
            }
        }
        .more-information {
            border-left: 1px dashed #4242423d;
            border-right: 1px dashed #4242423d;
            padding-right:0;
            padding-left:0;
        }
        .s-item-company {
            padding-bottom: 12px;
            text-align: center;
            .logo {
                padding: 5px;
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

        .p-content-detail {
            h2 {
                font-size: 20px;
                font-weight: normal;
            }
            h3 {
                font-size: 18px;
                font-weight: normal;
            }
            h4 {
                font-size: 16px;
                font-weight: normal;
            }
            // ailand-store
            .item_detail_getpoint dt,
            .item_detail_other_txt dt {
                float: left;
            }
            .item_detail_other_txt {
                dt::after {
                    content: ":";
                    display: inline-block;
                    margin: 0 3px;
                }
                dd {
                    .item_detail_other_ctgItem {
                        background: url(/images/breadcrumb.svg) center right no-repeat;
                        padding-right: 12px;
                        &:last-child {
                            background: 0 0;
                        }
                    }
                }
            }

            .cosmeland-detail {
                dl {
                    dt {
                        display: table-cell;
                        width: 149px;
                        font-weight: bold;
                    }
                    dd {
                        display: table-cell;
                        color: #828282;
                    }
                }
            }

            .crosset-detail {
                .size-head {
                    float: left;
                    min-width: 7em;
                    box-sizing: border-box;
                    -webkit-box-sizing: border-box;
                    th {
                        background: #f3f3f3;
                    }
                }
                .size-data-wrapper {
                    table {
                        width: auto;
                    }
                }
            }
            .saneibd-detail {
                dt {
                    margin-right: 15px;
                    float: left;
                    padding-bottom: 5px;
                    width: 100px;
                }
                dd {
                    padding-bottom: 5px;
                    margin-left: 105px;
                }
                hr.dash {
                    width: 100%;
                    height: 1px;
                    border-top: 1px dotted #ccc;
                    margin: 5px 0;
                    clear: both;
                }
                .fabric-commentcodes hr.dash {
                    display: none;
                }
            }

            .tbl-detail {
                margin-bottom: 15px;
                td,
                th {
                    border: 1px solid #dee2e6;
                    padding: 5px;
                    min-width: 50px;
                }
            }
        }
    }

    @media screen and (max-width: 992px) {
        .product-detail{
            .content{
                padding-left:10px;
                padding-right:10px;
            }
        }
    }
    @media screen and (max-width: 768px) {
        .product-detail{
            .content {
                .product-name {
                    font-size: 18px;
                }
                .p-buy-cart span {
                    display: none;
                }
            }
            .image-magnifier{
                .image-magnifier__mask,.image-magnifier__zoom{
                    display: none;
                }
            }
        }
    }
    @media screen and (max-width: 576px) {
        .product-detail {
            .content {
                border-bottom: 1px dashed #4242423d;
                padding-bottom:30px;
            }
            .description{
                margin-left:0;
                margin-right:0;
            }
            .more-information {
                border-left: none;
                border-right: none;
                margin-top:25px;
            }
        }
    }
</style>