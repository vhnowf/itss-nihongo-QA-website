<template>
</template>

<script>
    export default {
        data() {
            return {};
        },
        props: {
            globalData: {
                type: Object | String,
                required: true,
            },
            authUser: {
                type: Object | String,
                required: true,
            },
            locale: {
                type: String,
                default: 'vi',
            },
        },
        created: function() {
            if(this.globalData) {
                let globalDataNew = this.$store.state.globalData;
            
                if(this.globalData.setting) {
                    globalDataNew.setting = this.globalData.setting;
                }

                this.$store.commit('setGlobalData', globalDataNew);
            }

            if(this.authUser) {
                this.$store.commit('setAuthUser', this.authUser);
            }

            this.$i18n.locale = this.locale;
        }
    };
</script>
