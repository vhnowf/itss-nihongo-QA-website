<template>
    <div class="support-box">
        <h5 class="text-center font-size-18 font-weight-normal">Hỗ trợ khách hàng</h5>
        <ul>
            <li v-if="$store.state.globalData.setting.phone_number"><img :src="baseUrl('images/sp-phone.png')"><a :href="'tel:+84' + $store.state.globalData.setting.phone_number">{{ $store.state.globalData.setting.phone_number }}</a></li>
            <li v-if="$store.state.globalData.setting.email_address"><img :src="baseUrl('images/sp-email.png')"><a :href="'mailto:' + $store.state.globalData.setting.email_address">{{ $store.state.globalData.setting.email_address }}</a></li>
            <li><img :src="baseUrl('images/sp-guide.png')"><a :href="baseUrl('huong-dan-mua-hang')">Hướng dẫn mua hàng</a></li>
            <li><img :src="baseUrl('images/sp-change.png')"><a :href="baseUrl('chinh-sach-doi-tra-hang')">Chính sách đổi trả</a></li>
            <li><img :src="baseUrl('images/sp-delivery.png')"><a :href="baseUrl('chinh-sach-van-chuyen-va-giao-hang')">Quy trình giao hàng</a></li>
        </ul>

        <div class="d-flex justify-content-center m-b-12">
            <price-estimate class="m-r-12 m-l-12"></price-estimate>
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#showPricingMethod">Tính giá</button>
            <div class="modal fade" id="showPricingMethod" tabindex="-1" role="dialog" aria-labelledby="showPricingMethod" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cách tính phí mua hộ</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="feather-x"></i></button>
                        </div>
                        <div class="modal-body" v-html="$store.state.globalData.setting.calculate_money"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import PriceEstimate from '@user/components/products/PriceEstimate.vue'
    export default {
        components:{
            PriceEstimate,
        },
    };
</script>

<style scoped lang="scss">
    .support-box {
        padding: 24px 12px 0 12px;
        ul {
            list-style: none;
            padding-left: 0;
            line-height: 35px;
            li {
                img {
                    margin-right: 10px;
                }
            }
        }
    }
</style>
