<template>
<div class="form-group">
    <!-- <media :media-type="5" :avatar="value.image" @change="(data) => value.image = data"></media> 
    <div class="">
        <label>Tên chứng nhận</label>
        <input
            v-model="value.title"
            type="text"
            class="form-control"
            placeholder="Tên chứng nhận"
        > -->
        <!-- <span v-if="errors[key]">
            <small class="text-danger">{{ errors[key] }}</small>
        </span> -->
    <!-- </div>
    <div v-if="value.detail">
        <label>Chi tiết</label>
        <textarea v-model="item.detail" rows="3" class="form-control"></textarea>
    </div> -->
    <!-- <div v-show="value.length > 1" v-on:click="removeItem(key)" class="remove">
        <i class="feather-x"></i>
    </div> -->
</div>
</template>
<script>

export default ({
    name: "add-company-item",
    data() {
        return {
            errors: null
        }
    },
    props: ['value'],
    methods: {
        created() {
            console.log(this.value);
        },
        removeItem() {

        }
    }
})
</script>
