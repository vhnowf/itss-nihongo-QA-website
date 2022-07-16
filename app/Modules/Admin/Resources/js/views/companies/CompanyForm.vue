<template>
<form action="" @submit.prevent="" method="Post">    
    <div class="row form-loading">
        <!-- <input type="hidden" id="company" value="{{ json_encode($company ?? null) }}">
        <input type="hidden" id="datas" value="{{ json_encode($datas ?? []) }}"> -->

        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12 m-b-12">
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">
                            <button type="button" v-on:click="tab = 'vi'" :class="tab == 'vi' ? 'btn btn-primary width-md' : 'btn btn-light width-md'">Tiếng việt</button>
                            <button type="button" v-on:click="tab = 'jp'" :class="tab == 'jp' ? 'btn btn-primary width-md' : 'btn btn-light width-md'">Tiếng nhật</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div v-if="Object.keys(errors).length > 0" class="col-md-12">
                    <div class="alert alert-danger">
                        <strong>Rất tiếc!</strong>Có một số vấn đề với đầu vào của bạn.<br><br>
                        <ul>
                            <li v-for="(error,key) in Object.entries(errors)" :key="key">
                                <span v-if="error[0] == 'vi'">Tiếng việt</span>
                                <span v-else-if="error[0] == 'jp'">Tiếng nhật</span>
                                <span v-else>{{ error[1] }}</span>
                            
                                <ul v-if="error[0] == 'vi'">
                                    <li v-for="(errorVi,key) in Object.entries(error[1])" :key="key">{{ errorVi[1] }}</li>
                                </ul>
                                <ul v-if="error[0] == 'jp'">
                                    <li v-for="(errorJp,key) in Object.entries(error[1])" :key="key">{{ errorJp[1] }}</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- tab vietnamese -->
            <div v-show="tab == 'vi'" class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Tên công ty
                            <small>Tổng số ký tự : <span>{{ company.vi.title ? company.vi.title.length : 0 }}</span>)</small> *
                        </label>
                        <input v-on:keyup="titleToSlug('vi')" type="text" v-model="company.vi.title" placeholder="Tên công ty" class="form-control" maxlength=255/>
                        <span v-if="errors.vi" class="help-block">
                            <small class="text-danger">{{ errors.vi.title }}</small>
                        </span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Slug
                            <small>(Tổng số ký tự: <span>{{ company.vi.slug ? company.vi.slug.length : 0 }}</span>)</small> *
                        </label>
                        <input type="text" v-model="company.vi.slug" placeholder="Slug" class="form-control" maxlength=255/>
                        <span v-if="errors.vi" class="help-block">
                            <small class="text-danger">{{ errors['vi']['slug'] }}</small>
                        </span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Địa chỉ
                        </label>
                        <input type="text" v-model="company.coordinates" placeholder="Địa chỉ" class="form-control" maxlength=255/>
                        <span v-if="errors.coordinates" class="help-block">
                            <small class="text-danger">{{ errors.coordinates }}</small>
                        </span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Mô tả ngắn
                        </label>
                        <media :media-type="4" :editor-valute="company.vi.short_description" @change="(value) => company.vi.short_description = value"></media>
                        <span v-if="errors['vi']" class="help-block">
                            <small class="text-danger">{{ errors['vi']['short_description'] }}</small>
                        </span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Bảng thông tin
                        </label>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm tbl-list-data form-group">
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Tên công ty
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.vi.detail_table.name" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Giám đốc điều hành
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.vi.detail_table.ceo" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Thành lập
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.vi.detail_table.date_created" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Vốn điều lệ
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.vi.detail_table.capital" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Nội dung kinh doanh
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.vi.detail_table.content" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Số lượng nhân viên
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.vi.detail_table.staff" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Trụ sở chính
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.vi.detail_table.headquarter" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Nhà máy
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.vi.detail_table.factory" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Website
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.vi.detail_table.website" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Iframe
                            <small>Tổng số ký tự : <span>{{ company.vi.iframe ? company.vi.iframe.length : 0 }}</span>)</small> *
                        </label>
                        <input type="text" v-model="company.vi.iframe" placeholder="Iframe" class="form-control" maxlength=255/>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Quy trình sản xuất
                        </label>
                        <media :media-type="5" :avatar="company.vi.process.image" @change="(value) => company.vi.process.image = value"></media>
                        <media :media-type="4" :editor-value="company.vi.process.detail" @change="(value) => company.vi.process.detail = value"></media>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">   
                        <label>
                            Chứng chỉ chứng nhận
                        </label>
                        <div class="row">
                            <div v-for="(item,key) in company.vi.certificate" :key="key" class="col-md-4">
                                <div form-group>
                                    <media :media-type="5" :avatar="item.image" @change="(data) => item.image = data"></media> 
                                    <div class="">
                                        <label>Tên chứng nhận</label>
                                        <input v-model="item.title" type="text" class="form-control" placeholder="Tên chứng nhận" maxlength=255/>
                                        <!-- <span v-if="errors[key]">
                                            <small class="text-danger">{{ errors[key] }}</small>
                                        </span> -->
                                    </div>
                                    <div>
                                        <label>Chi tiết</label>
                                        <textarea v-model="item.detail" rows="3" class="form-control"></textarea>
                                    </div>
                                    <!-- <div v-show="value.length > 1" v-on:click="removeItem(key)" class="remove">
                                        <i class="feather-x"></i>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-4 item-add" v-on:click="addItem()">
                                <i class="fe-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Môi trường sản xuất
                        </label>
                        <div class="row">
                            <div v-for="(item,key) in company.vi.certificate" :key="key" class="col-md-4">
                                <div form-group>
                                    <media :media-type="5" :avatar="item.image" @change="(data) => item.image = data"></media> 
                                    <div class="">
                                        <label>Tên chứng nhận</label>
                                        <input v-model="item.title" type="text" class="form-control" placeholder="Tên chứng nhận"
                                        >
                                        <!-- <span v-if="errors[key]">
                                            <small class="text-danger">{{ errors[key] }}</small>
                                        </span> -->
                                    </div>
                                    <div>
                                        <label>Chi tiết</label>
                                        <textarea v-model="item.detail" rows="3" class="form-control"></textarea>
                                    </div>
                                    <!-- <div v-show="value.length > 1" v-on:click="removeItem(key)" class="remove">
                                        <i class="feather-x"></i>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-4 item-add" v-on:click="addItem()">
                                <i class="fe-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Điểm mạnh
                        </label>
                        <div class="row">
                            <div v-for="(item,key) in company.vi.certificate" :key="key" class="col-md-4">
                                <div form-group>
                                    <media :media-type="5" :avatar="item.image" @change="(data) => item.image = data"></media> 
                                    <div class="">
                                        <label>Tiêu đề</label>
                                        <input v-model="item.title" type="text" class="form-control" placeholder="Tiêu đề">
                                        <!-- <span v-if="errors[key]">
                                            <small class="text-danger">{{ errors[key] }}</small>
                                        </span> -->
                                    </div>
                                    <div>
                                        <label>Chi tiết</label>
                                        <textarea v-model="item.detail" rows="3" class="form-control"></textarea>
                                    </div>
                                    <!-- <div v-show="value.length > 1" v-on:click="removeItem(key)" class="remove">
                                        <i class="feather-x"></i>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-4 item-add" v-on:click="addItem()">
                                <i class="fe-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end tab vietnamese -->

            <!-- tab japanese -->
            <div v-show="tab == 'jp'" class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Tên công ty
                            <small>Tổng số ký tự : <span>{{ company.jp.title ? company.jp.title.length : 0 }}</span>)</small> *
                        </label>
                        <input v-on:keyup="titleToSlug('jp')" type="text" v-model="company.jp.title" placeholder="Tên công ty" class="form-control" maxlength=255/>
                        <span v-if="errors['jp']" class="help-block">
                            <small class="text-danger">{{ errors['jp']['title'] }}</small>
                        </span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Slug
                            <small>(Tổng số ký tự: <span>{{ company.jp.slug ? company.jp.slug.length : 0 }}</span>)</small> *
                        </label>
                        <input type="text" v-model="company.jp.slug" placeholder="Slug" class="form-control" maxlength=255/>
                        <span v-if="errors['jp']" class="help-block">
                            <small class="text-danger">{{ errors['jp']['slug'] }}</small>
                        </span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Địa chỉ
                        </label>
                        <input type="text" v-model="company.coordinates" placeholder="Địa chỉ" class="form-control" maxlength=255/>
                        <span v-if="errors.coordinates" class="help-block">
                            <small class="text-danger">{{ errors.coordinates }}</small>
                        </span>
                    </div>
                </div>
                
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Mô tả ngắn
                        </label>
                        <media :media-type="4" :editor-valute="company.jp.short_description" @change="(value) => company.jp.short_description = value"></media>
                        <span v-if="errors['jp']" class="help-block">
                            <small class="text-danger">{{ errors['jp']['short_description'] }}</small>
                        </span>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Bảng thông tin
                        </label>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-sm tbl-list-data form-group">
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Tên công ty
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.jp.detail_table.name" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Giám đốc điều hành
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.jp.detail_table.ceo" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Thành lập
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.jp.detail_table.date" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Vốn điều lệ
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.jp.detail_table.capital" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Nội dung kinh doanh
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.jp.detail_table.content" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Số lượng nhân viên
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.jp.detail_table.staff" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Trụ sở chính
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.jp.detail_table.headquarter" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Nhà máy
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.jp.detail_table.factory" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                            <tr>
                                <td class="attribute-name" colspan="7">
                                    Website
                                </td>
                                <td class="attribute-detail" colspan="7">
                                    <input type="text" v-model="company.jp.detail_table.website" class="form-control" maxlength=255/>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Iframe
                            <small>(Tổng số ký tự : <span>{{ company.vi.title ? company.vi.title.length : 0 }}</span>)</small> *
                        </label>
                        <input type="text" v-model="company.jp.iframe" placeholder="Iframe" class="form-control" maxlength=255                        
                        />
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Quy trình sản xuất
                        </label>
                        <media :media-type="5" :avatar="company.jp.process.image" @change="(value) => company.jp.process.image = value"></media>
                        <media :media-type="4" :editor-value="company.jp.process.detail" @change="(value) => company.jp.process.detail = value"></media>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">   
                        <label>
                            Chứng chỉ chứng nhận
                        </label>
                        <div class="row">
                            <div v-for="(item,key) in company.jp.certificate" :key="key" class="col-md-4">
                                <div form-group>
                                    <media :media-type="5" :avatar="item.image" @change="(data) => item.image = data"></media> 
                                    <div class="">
                                        <label>Tiêu đề</label>
                                        <input v-model="item.title" type="text" class="form-control" placeholder="Tiêu đề">
                                        <!-- <span v-if="errors[key]">
                                            <small class="text-danger">{{ errors[key] }}</small>
                                        </span> -->
                                    </div>
                                    <div>
                                        <label>Chi tiết</label>
                                        <textarea v-model="item.detail" rows="3" class="form-control"></textarea>
                                    </div>
                                    <!-- <div v-show="value.length > 1" v-on:click="removeItem(key)" class="remove">
                                        <i class="feather-x"></i>
                                    </div> -->
                                </div>
                            </div>
                            <div v-if="company.jp.certificate.length > 0" class="col-md-4 item-add" v-on:click="addItem()">
                                <i class="fe-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Môi trường sản xuất
                        </label>
                        <div class="row">
                            <div v-for="(item,key) in company.vi.enviroment" :key="key" class="col-md-4">
                                <div form-group>
                                    <media :media-type="5" :avatar="item.image" @change="(data) => item.image = data"></media> 
                                    <div class="">
                                        <label>Tiêu đề</label>
                                        <input v-model="item.title" type="text" class="form-control" placeholder="Tiêu đề">
                                        <!-- <span v-if="errors[key]">
                                            <small class="text-danger">{{ errors[key] }}</small>
                                        </span> -->
                                    </div>
                                    <div>
                                        <label>Chi tiết</label>
                                        <textarea v-model="item.detail" rows="3" class="form-control"></textarea>
                                    </div>
                                    <!-- <div v-show="value.length > 1" v-on:click="removeItem(key)" class="remove">
                                        <i class="feather-x"></i>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-4 item-add" v-on:click="addItem()">
                                <i class="fe-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label>
                            Điểm mạnh
                        </label>
                        <div class="row">
                            <div v-for="(item,key) in company.vi.strength" :key="key" class="col-md-4">
                                <div form-group>
                                    <media :media-type="5" :avatar="item.image" @change="(data) => item.image = data"></media> 
                                    <div class="">
                                        <label>Tiêu đề</label>
                                        <input v-model="item.title" type="text" class="form-control" placeholder="Tiêu đề">
                                        <!-- <span v-if="errors[key]">
                                            <small class="text-danger">{{ errors[key] }}</small>
                                        </span> -->
                                    </div>
                                    <div>
                                        <label>Chi tiết</label>
                                        <textarea v-model="item.detail" rows="3" class="form-control"></textarea>
                                    </div>
                                    <!-- <div v-show="value.length > 1" v-on:click="removeItem(key)" class="remove">
                                        <i class="feather-x"></i>
                                    </div> -->
                                </div>
                            </div>
                            <div class="col-md-4 item-add" v-on:click="addItem()">
                                <i class="fe-plus"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end tab japanese -->
        </div>
        <div class="col-md-3">
            <div class="box box-info">
                <div class="box-body text-center">
                    <button v-show="routeType == 'edit'" type="button" class="btn btn-danger btn-sm m-b-5" v-on:click="cancel()">Hủy bỏ</button>
                        <!-- <a  class="btn btn-pink btn-sm" href="" target="_blank">Xem trước</a> -->
                    <button v-show="routeType == 'edit'" type="submit" class="btn btn-primary btn-sm m-b-5" v-on:click="handleSubmit()">Cập nhật</button>
                    <button v-show="routeType == 'create'" type="submit" class="btn btn-primary btn-sm m-b-5" v-on:click="handleSubmit()">Tạo mới</button>
                </div>
            </div>

            <div :class="errors.status ? 'box box-info box-error' : 'box box-info'">
                <div class="box-header with-border">
                    <h3 class="box-title">Trạng thái</h3>
                </div>

                <div class="box-body">     
                    <div class="custom-radio">
                        <input v-model="company.status" value="active" type="radio" id="active">
                        <label for="active">active</label>
                    </div>   
                     <div class="custom-radio">
                        <input v-model="company.status" value="inactive" type="radio" id="inactive">
                        <label for="inactive">inactive</label>
                    </div>   

                    <span v-if="errors.status" class="help-block">
                        <small class="text-danger">{{ errors.status }}</small>
                    </span>
                </div>
            </div>

            <div :class="errors.is_show_home ? 'box box-info box-error' : 'box box-info'">
                <div class="box-body">
                    <div class="form-group">
                        <label class="custom-checkbox">
                            Hiển thị ở trang chủ
                            <input type="checkbox" value="1">
                            <span class="checkmark"></span>
                        </label>
                
                        <span v-if="errors.is_show_home" class="help-block">
                            <small class="text-danger">{{ errors.is_show_home }}</small>
                        </span>
                    </div>

                    <!-- <div class="form-group">
                        <label for="url">Vị trí hiển thị</label>
                        <input type="number"
                            name="show_home_location"
                            id="show_home_location"
                            class="form-control count_char"
                            placeholder="Vị trí hiển thị"
                            value=""
                            maxlength=255
                        />
                    </div> -->
                </div>
            </div>

            <div :class="errors.avatar ? 'box box-info box-error' : 'box box-info'">
                <div class="box-header with-border">
                    <h3 class="box-title">Ảnh đại diện</h3>
                </div>
                <div class="box-body">
                    <media :media-type="5" :avatar="company.avatar" @change="(value) => company.avatar = value"></media>

                    <span v-if="errors.avatar" class="help-block">
                        <small class="text-danger">{{ errors.avatar }}</small>
                    </span>
                </div>
            </div>
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Ảnh QR</h3>
                </div>
                <div class="box-body">
                    <media :media-type="5" :avatar="company.vi.qr_avatar" @change="(value) => company.vi.qr_avatar = value"></media>

                    <span v-if="errors.avatar" class="help-block">
                        <small class="text-danger">{{ errors.qr_avatar }}</small>
                    </span>
                </div>
            </div>
        </div>
    </div>
</form>
</template>
<script>
import Media from '@admin/components/Media.vue';
import httpStore from '@core/config/httpStore';
import AddCompanyItem from '@admin/components/AddCompanyItem.vue';

export default ({
    name:"company-form",
    components: {
        Media,
        AddCompanyItem
    },
    data() {
        return {
        isLoading: false,
        tab: 'vi',
        submitUrl: null,
        routeType: null,
        object: {
            image: null,
            title: null,
            detail: null
        },
        company: {
            id: null,
            avatar: null,
            coordinates: null,
            created_at: null,
            deleted_at: null,
            is_show_home: 0,
            show_home_location: null,
            status: null,
            telephone: null,
            vi: {
                company_id: null,
                title: null,
                slug: null,
                url: null,
                iframe: null,
                short_description: null,
                qr_avatar: null,
                detail_table: {
                    name: null,
                    content: null,
                    staff: null,
                    headquarter: null,
                    factory: null,
                    website: null
                },
                process:[
                    this.object
                ],
                certificate: [
                    {
                        image: null,
                        title: null,
                        detail: null
                    }
                ],  
                enviroment: [
                    {
                        image: null,
                        title: null,
                    }
                ],
                strength: [
                    {
                        image: null,
                        title: null,
                        detail: null
                    }
                ],
                updated_at: null,
                deleted_at: null,
                language: 'vi'
            },
            jp: {
                company_id: null,
                title: null,
                slug: null,
                url: null,
                short_description: null,
                qr_avatar: null,
                detail_table: {
                    name: null,
                    content: null,
                    staff: null,
                    headquarter: null,
                    factory: null,
                    website: null
                },
                iframe: null,
                process:[],
                certificate:[
                    {
                        image: null,
                        title: null,
                        detail: null
                    }  
        
                ],  
                enviroment: [
                    {
                        image: null,
                        title: null,
                    }
                ],
                strength: [
                    {
                        image: null,
                        title: null,
                        detail: null
                    }
                ],
                updated_at: null,
                deleted_at: null,
                language: 'jp'
            }
        },
            // productImages: [],
            errors: {},
        }
    },
    created: function () {
        this.submitUrl = $('#submitUrl').val();
        this.routeType = $('#routeType').val();

        let company = JSON.parse($('#company').val());
        if (company) {
            this.company = company;
            console.log(JSON.parse(company));
        }


        // if (datas.productImages) {
        //     this.productImages = datas.productImages;
        // }

        // if (datas.routeType) {
        //     this.routeType = datas.routeType;
        // }
    },
    // computed: {
    //     company: function() {
    //         let data = {};
    //         let scop = this;

    //         scop.companies.forEach(item => {
    //             if(scop.product.company_id == item.id) {
    //                 data = item;

    //                 return
    //             }
    //         })

    //         return data;
    //     }
    // }
    methods: {
        cancel: function () {
            Swal.fire({
                title: 'Bạn có chắc không?',
                text: "Bạn sẽ không thể khôi phục lại được dữ liêu!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Có',
                cancelButtonText: 'Hủy',
            }).then((result) => {
                if (result.value) {
                    location.reload();
                }
            })
        },
        titleToSlug: function (tab) {
            if(tab =='vi') {
                this.company.vi.slug = stringToSlug(this.company.vi.title);
            } else if(tab =='jp') {
                this.company.jp.slug = stringToSlug(this.company.jp.title);
            } 
        },
        checkValid: function () {
            let scop = this;
            scop.errors = [];
            if (!scop.company.status) {
                scop.errors['status'] = 'Vui lòng chọn trạng thái';
            }
            if (!scop.company.coordinates) {
                scop.errors['coordinates'] = 'Vui lòng nhập địa chỉ';
            }

            if (!scop.company.avatar) {
                scop.errors['avatar'] = 'Vui lòng chọn ảnh đại diện';
            }

            scop.errors['vi'] = [];
            if (!scop.company.vi.title) {
                scop.errors['vi']['title'] = 'Vui lòng nhập tên công ty';
            }
            if (!scop.company.vi.slug) {
                scop.errors['vi']['slug'] = 'Vui lòng nhập đường dẫn';
            }
            // if (!scop.company.vi.short_description) {
            //     scop.errors['vi']['short_description'] = 'Vui lòng nhập mô tả';
            // }
            if(Object.keys(scop.errors['vi']) == 0) {
                delete scop.errors['vi'];
            }

            scop.errors['jp'] = [];
            if (!scop.company.jp.title) {
                scop.errors['jp']['title'] = 'Vui lòng nhập tên công ty';
            }
            if (!scop.company.jp.slug) {
                scop.errors['jp']['slug'] = 'Vui lòng nhập đường dẫn';
            }
            // if (!scop.company.jp.short_description) {
            //     scop.errors['jp']['short_description'] = 'Vui lòng nhập mô tả';
            // }
            if(Object.keys(scop.errors['jp']) == 0) {
                delete scop.errors['jp'];
            }
        },
        handleSubmit: function () {
            let scop = this;
            scop.checkValid();

            if (Object.keys(scop.errors).length == 0) {
                scop.$loading(true);
                let method = 'put';
                if (scop.routeType == 'create' || scop.routeType == 'log') {
                    method = 'post';
                }
                httpStore.dispatch(method, {
                    url: scop.submitUrl,
                    data: {
                        company: scop.company,
                    },
                }).then(response => {
                    if (response.status === 200) {
                        Swal.fire({
                            icon: 'success',
                            title: '',
                            text: response.message,
                            timer: 1500
                        }).then((result) => {
                            if (scop.routeType == 'create' || scop.routeType == 'log') {
                                window.location.href = response.redirect_url;
                            }
                        })
                    } else if (response.status === 400) {
                        scop.errors = [];
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.datas,
                            footer: ''
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                            footer: ''
                        });
                    }

                    scop.$loading(false);
                }).catch((error) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: error,
                        footer: ''
                    });

                    scop.$loading(false);
                });
            }
        },
        addItem: function () {},
        removeItem: function () {}
    }
})
</script>
<style scoped lang="scss">
.form-loading {
    table {
        border: 1px solid #dee2e6;
    }
    .item-add {
        border: 1px dashed #71b6f9;
        color: #71b6f9;
        font-size: 20px;
        padding-top: 25%;
        text-align: center;
        display: inline-block;
        &:hover {
            background: #71b6f914;
            cursor: pointer;
        }
    }
}
</style>
