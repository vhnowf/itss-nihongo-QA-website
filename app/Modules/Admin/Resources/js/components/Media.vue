<script>
export default {
  name: "media",
  data() {
    return {
      tab: "list",
      search: {
        keyword: null,
        date: "all",
        page: 1,
      },
      medias: [],
      randomIndex: [],
      mediaPageCheck: true,
      showLoadMore: true,
      loadingMedia: false,
      checkedFiles: [],
      months: [],
      attributeImgIndex: 0,
      loaded: false,
      contentEditor: null,
      contentEditorValue: this.editorValue,
      isUpload: false,
    };
  },
  props: {
    mediaType: {
      type: Number,
      default: 1, // 2: image flow attribute; 3: list image; 4: editor; 5: avatar
    },
    attributeImgs: {
      type: Array,
      default: () => [],
    },
    listImages: {
      type: Array,
      default: () => [],
    },
    editorValue: {
      type: String,
      default: null,
    },
    avatar: {
      type: String,
      // default: null
    },
  },
  created: function () {
    let scop = this;
    scop.randomIndex = Math.floor(Math.random() * 10000);

    axios
      .get(BASE_API_URL + "/medias/get-list-month", {})
      .then(function (response) {
        if (response.status === 200) {
          let data = response.data;

          scop.months = data.months;
        } else {
          console.log("Error getting month list");
        }
      })
      .catch(function (error) {
        console.log("Error getting month list");
      });

    if(this.mediaType == 4) {
      scop.initEditor();
    }
  },
  methods: {
    onFileChange(e) {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;

      this.uploadImage(files[0]);
    },
    uploadImage(file) {
      let scop = this;
      const config = {
        headers: { 'content-type': 'multipart/form-data' }
      }
      let formData = new FormData();
      formData.append('file', file);

      scop.isUpload = true;
      axios
        .post(BASE_API_URL + "/medias/upload", formData, config)
        .then((response) => {
          let data = response.data;
          if (data.status == 200) {
            scop.medias.unshift(data.data);
            scop.tab = 'list';
            if (scop.mediaType == 2 || scop.mediaType == 5) {
              scop.checkedFiles = [data.data];
            } else {
              scop.checkedFiles.push(data.data);
            }
          } else {
            Swal.fire({
              title: "",
              text: data.message,
              type: "error"
            });
          }
          scop.isUpload = false;
        }).catch(function (error) {
          scop.isUpload = false;
          console.log(error);
          Swal.fire({
            title: "",
            text: error,
            type: "error"
          });
        });
    },
    CheckImg: function (media, event) {
      if (
        event.target.checked &&
        (this.mediaType == 2 || this.mediaType == 5)
      ) {
        this.checkedFiles = [media];
      }
    },
    loadMedia: function (attribute_index = null) {
      this.search.page++;
      this.getMedias();
    },
    initMedia: function (attribute_index = null) {
      $("#media_" + this.randomIndex).modal("show");

      if (this.mediaType == 2) {
        this.attributeImgIndex = attribute_index;
      }

      if (!this.loaded) {
        this.getMedias((attribute_index = null));
        this.loaded = true;
      }
    },
    searchMedia: function () {
      this.search.page = 1;
      this.medias = [];
      this.getMedias();
    },
    getMedias: function () {
      let scop = this;

      scop.loadingMedia = true;
      scop.showLoadMore = false;
      axios
        .get(BASE_API_URL + "/medias", {
          params: {
            key: scop.search.keyword,
            media_filter_date: scop.search.date,
            type: "vue",
            page: scop.search.page,
          },
        })
        .then(function (response) {
          let data = response.data;
          if (data.status == 404) {
            scop.mediaPageCheck = false;
          } else if (data.status == 204) {
            scop.mediaPageCheck = false;
          } else if (data.status == 200) {
            scop.medias = scop.medias.concat(data.data);

            if (data.page_last) {
              scop.mediaPageCheck = false;
              scop.showLoadMore = false;
            } else {
              scop.showLoadMore = true;
            }
          }
          scop.loadingMedia = false;
        })
        .catch(function (error) {
          scop.loadingMedia = false;
        });
    },
    insert: function () {
      let scop = this;
      if (scop.mediaType == 2) {
        scop.attributeImgs[scop.attributeImgIndex]["img"] =
          scop.checkedFiles[0]["url"];
      } else if (scop.mediaType == 3) {
        for (let i = 0; i < scop.checkedFiles.length; i++) {
          scop.listImages.push({
            id: null,
            url: scop.checkedFiles[i]["url"],
          });
        }
      } else if (scop.mediaType == 4) {
        for (let i = 0; i < scop.checkedFiles.length; i++) {
          let data =
            '<img src="' +
            scop.checkedFiles[i]["url"] +
            '"class="img-thumbnail img-check">';
          scop.contentEditor.insertContent(data);
        }

        scop.contentEditorValue = scop.contentEditor.getContent();
        scop.$emit("change", scop.contentEditorValue);
      } else if (scop.mediaType == 5) {
        scop.avatarValue = scop.checkedFiles[0]["url"];
        scop.$emit("change", this.avatarValue);
      }

      $("#media_" + scop.randomIndex).modal("hide");
      scop.checkedFiles = [];
    },
    deleteFile: function () {
      let scop = this;
      Swal.fire({
        title: "Bạn có chắc chắn muốn xóa?",
        text: "Bạn sẽ không thể khôi phục được dữ liệu sau khi xóa!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Xóa",
        cancelButtonText: "Hủy",
      }).then((result) => {
        if (result.value) {
          var array_id = [];
          for (let i = 0; i < scop.checkedFiles.length; i++) {
            array_id.push(scop.checkedFiles[i]["id"]);

            let index = scop.medias.indexOf(scop.checkedFiles[i]);
            scop.medias.splice(index, 1);
          }

          axios
            .post(BASE_API_URL + "/medias/delete", {
              array_id: array_id,
            })
            .then(function (response) {
              // let data = response.data;
              // for (let i = 0; i < scop.checkedFiles.length; i++) {
              //   let index = scop.medias.indexOf(scop.checkedFiles[i]);
              //   scop.medias.splice(index, 1)
              // }
              scop.checkedFiles = [];
            })
            .catch(function (error) {
              console.log(error);
            });
        }
      });
    },
    removeImg: function (attribute_index) {
      if (this.mediaType == 2) {
        this.attributeImgs[attribute_index]["img"] = null;
      } else if (this.mediaType == 3) {
        this.listImages.splice(attribute_index, 1);
      }
    },
    removeAvatar: function () {
      this.$emit("change", null);
    },
    initEditor: function () {
      let scop = this;
      tinymce.init({
        selector: "#editor_content_" + scop.randomIndex,
        content_css: ["/css/style-editor.css?v=1.0.2"],
        height: 500,
        plugins: [
          "advlist autolink lists link image charmap print preview hr anchor pagebreak",
          "searchreplace wordcount visualblocks visualchars code fullscreen",
          "insertdatetime media nonbreaking save table contextmenu directionality",
          "emoticons template paste textcolor colorpicker textpattern codesample toc",
          "paste",
        ],
        toolbar:
          "cut copy wordcount" +
          "| undo redo" +
          "| bold italic underline strikethrough" +
          "| forecolor backcolor" +
          "| fontsizeselect formatselect" +
          "| bullist numlist " +
          "| blockquote hr pagebreak" +
          "| alignleft aligncenter alignright alignjustify" +
          "| outdent indent" +
          "| ltr rtl" +
          "| link unlink image media" +
          "| table removeformat charmap" +
          "| code fullscreen preview print ",
        menubar: false,
        setup: function (editor) {
          scop.contentEditor = editor;

          editor.on("keyup", function (e) {
            scop.contentEditorValue = editor.getContent();
            scop.$emit("change", scop.contentEditorValue);
          });
        },
        fontsize_formats: "8px 10px 12px 14px 16px 18px 24px 36px 38px 40px",
        paste_auto_cleanup_on_paste: true,
        paste_remove_styles: true,
        paste_remove_styles_if_webkit: true,
        paste_strip_class_attributes: true,
        convert_urls: false,
        branding: false,
      });
    },
  },
};
</script>

<template>
  <div class="media">
    <button v-if="mediaType == 1" v-on:click="initMedia()" type="button" class="btn btn-light">
      <i class="fa fa-music" aria-hidden="true"></i>Media
    </button>

    <div v-if="mediaType == 2" class="img-by-attribute">
      <div
        v-for="(item, i) in attributeImgs"
        v-bind:key="item.value"
        class="d-inline-block m-b-12 img-attribute"
      >
        <div v-show="!item.img" v-on:click="initMedia(i)" class="l-icon">
          <i class="fe-plus"></i>
        </div>
        <div v-show="item.img" class="l-img">
          <img v-lazy="item.img" />
        </div>
        <div class="attribute-value">{{ item.value }}</div>
        <span v-show="item.img" v-on:click="removeImg(i)" class="remove-img">
          <i class="fe-x-circle"></i>
          <span></span>
        </span>
      </div>
    </div>

    <div v-if="mediaType == 3" class="list-images">
      <div v-for="(item, i) in listImages" v-bind:key="item.i" class="item item-border">
        <img v-lazy="item.url" />
        <span v-on:click="removeImg(i)" class="remove-img">
          <i class="fe-x-circle"></i>
        </span>
      </div>
      <div class="item item-add" v-on:click="initMedia()">
        <i class="fe-plus"></i>
      </div>
    </div>

    <div v-if="mediaType == 4" class="media-editor">
      <div class="m-b-5">
        <button type="button" class="btn btn-light" v-on:click="initMedia()">
          <i class="fa fa-music" aria-hidden="true"></i> Media
        </button>
      </div>

      <textarea
        v-model="contentEditorValue"
        class="form-control"
        :id="'editor_content_'+randomIndex"
        rows="5"
      ></textarea>
    </div>

    <div v-if="mediaType == 5" class="media-avatar">
      <div v-show="avatar" class="text-center img-preview" v-on:click="initMedia()">
        <img v-lazy="avatar" class="img-thumbnail" />
      </div>

      <div v-show="!avatar" class="text-center">
        <a href="javascript:void(0)" v-on:click="initMedia()">Chọn ảnh</a>
      </div>

      <div v-show="avatar" class="remove-avatar text-center m-t-12">
        <a href="javascript:void(0)" v-on:click="removeAvatar()">Xóa ảnh</a>
      </div>
    </div>

    <!-- Modal media -->
    <div
      class="modal animated bounceIn"
      :id="'media_'+randomIndex"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header border-0">
            <h4 class="modal-title">Media</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <ul class="nav nav-tabs">
              <li v-on:click="tab = 'upload'" class="nav-item upload-media">
                <a
                  :class="tab == 'upload' ? 'nav-link active' : 'nav-link'"
                  data-toggle="tab"
                >Tải lên tập tin</a>
              </li>
              <li v-on:click="tab = 'list'" class="nav-item media-list">
                <a
                  :class="tab == 'list' ? 'nav-link active' : 'nav-link'"
                  data-toggle="tab"
                >Thư viện</a>
              </li>
            </ul>
            <div class="tab-content">
              <div :class="tab == 'upload' ? 'tab-pane active' : 'tab-pane'">
                <div class="upload-files">
                  <div v-show="!isUpload">
                    <input v-on:change="onFileChange" type="file" class="form-control" />
                  </div>
                  <div v-show="isUpload">
                    <img src="/images/loading-1.gif" width="100px" />
                  </div>
                </div>
              </div>

              <div :class="tab == 'list' ? 'tab-pane active' : 'tab-pane'">
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <select v-model="search.date" class="form-control media_filter_date">
                        <option value="all" selected="selected">Tất cả</option>
                        <option
                          v-for="month in months"
                          v-bind:key="month.value"
                          :value="month.value"
                        >{{ month.title }}</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <div class="form-group">
                      <input
                        v-model="search.keyword"
                        type="text"
                        class="form-control"
                        placeholder="Từ khóa cần tìm"
                      />
                    </div>
                  </div>

                  <div class="col-sm-4">
                    <button
                      class="btn btn-primary"
                      v-on:click="searchMedia()"
                      type="button"
                    >Tìm kiếm</button>
                  </div>
                </div>

                <div id="list-media" class="list-media">
                  <ul class="data">
                    <li v-for="media in medias" v-bind:key="media.id">
                      <input
                        type="checkbox"
                        :id="randomIndex+'cb'+media.id"
                        :value="media"
                        v-model="checkedFiles"
                        v-on:click="CheckImg(media, $event)"
                      />
                      <label :for="randomIndex+'cb'+media.id">
                        <img :src="media.thumbnail" />
                      </label>
                    </li>
                  </ul>
                  <div v-show="loadingMedia" class="loading-media">
                    <img src="/images/loading-1.gif" /> Loading
                  </div>
                  <div class="text-center">
                    <button
                      v-show="showLoadMore"
                      v-on:click="loadMedia()"
                      type="button"
                      class="btn btn-light"
                    >Tải thêm ...</button>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="modal-footer">
            <button
              :disabled="checkedFiles.length == 0"
              v-on:click="deleteFile()"
              type="button"
              class="btn btn-danger"
            >Xóa</button>
            <button
              :disabled="checkedFiles.length == 0"
              v-on:click="insert()"
              type="button"
              class="btn btn-primary"
            >Áp dụng</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped lang="scss">
.media {
  .nav-tabs {
    a {
      &:hover {
        cursor: pointer;
      }
    }
  }

  .check {
    opacity: 0.5;
    color: #996;
  }

  .upload-files {
    text-align: center;
    margin: 6% auto;
    input {
      width: 300px;
      margin: 0 auto;
    }
  }

  .list-media {
    overflow: auto;
    height: calc(100vh - 320px);

    ul {
      padding: 0;
      list-style-type: none;
      li {
        display: inline-block;
      }
    }

    .media-file {
      height: 130px;
    }

    img {
      width: 100%;
      height: 100%;
      border-width: 0;
    }

    input[type="checkbox"] {
      display: none;
    }

    label {
      border: 1px solid #fff;
      padding: 10px;
      display: block;
      position: relative;
      margin: 10px;
      cursor: pointer;

      &:before {
        background-color: white;
        color: white;
        content: " ";
        display: block;
        border-radius: 50%;
        border: 1px solid #286090;
        position: absolute;
        top: -5px;
        left: -5px;
        width: 23px;
        height: 23px;
        text-align: center;
        line-height: 28px;
        transition-duration: 0.4s;
        transform: scale(0);
      }

      img {
        height: 100px;
        width: 100px;
        object-fit: contain;
      }
    }

    ul li :checked + label {
      border-color: #ddd;

      &:before {
        background-image: url(/images/uploader-icons.png);
        background-position: -17px 3px;
        background-color: #286090;
        transform: scale(1);
      }

      img {
        transform: scale(0.9);
        box-shadow: 0 0 5px #333;
        z-index: 9999;
      }
    }
  }

  .loading-media,
  .media-null {
    text-align: center;
  }

  .loading-media img {
    width: 35px;
  }

  .media_filter_date {
    margin-bottom: 5px;
  }
  .modal {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    overflow: hidden;
    .modal-dialog {
      position: fixed;
      margin: 0;
      width: 96%;
      height: 96%;
      padding: 0;
      left: 2%;
      top: 2%;
    }

    .modal-content {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      border-radius: 0;
      box-shadow: none;
    }

    .modal-body {
      position: absolute;
      top: 50px;
      overflow: auto;
      width: 100%;
    }

    .modal-footer {
      position: absolute;
      right: 0;
      bottom: 0;
      left: 0;
      height: 60px;
      background: #fff;
    }
  }
  
  .list-images {
    position: relative;
    min-height: 110px;

    .item-border {
      border: 1px solid #dee2e6;
      margin-right: 12px;
    }
    .item {
      position: relative;
      display: inline-block;
      width: 100px;
      margin-bottom: 12px;

      img {
        height: 98px;
        width: 100%;
        object-fit: cover;
      }

      &:hover {
        opacity: 0.8;
      }

      .remove-img {
        position: absolute;
        top: -8px;
        right: -5px;
        font-size: 16px;
        color: #71b6f9;

        i {
          background: #ffffff;
          border-radius: 50%;
        }

        &:hover {
          color: #e0810c;
          cursor: pointer;
        }
      }
    }
    .item-add {
      border: 1px dashed #71b6f9;
      color: #71b6f9;
      font-size: 20px;
      width: 100px;
      height: 100px;
      margin-bottom: 0;
      position: absolute;
      padding-top: 33px;
      text-align: center;
      margin-bottom: 12px;
      display: inline-block;
      width: 100px;
      margin-bottom: 12px;
      &:hover {
        background: #71b6f914;
        cursor: pointer;
      }
    }
  }

  .img-by-attribute {
    .img-attribute {
      text-align: center;
      width: 100px;
      height: 110px;
      margin-right: 12px;
      position: relative;

      .l-icon {
        border: 1px dashed #71b6f9;
        color: #71b6f9;
        font-size: 20px;
        width: 100px;
        height: 100px;
        margin-bottom: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        &:hover {
          background: #71b6f914;
          cursor: pointer;
        }
      }
    }
    .l-img {
      border: 1px solid #e9e9e9;

      img {
        width: 100%;
        height: 100px;
        object-fit: cover;
      }
    }

    .attribute-value {
      color: #6c757d;
      margin-top: 5px;
      font-size: 13px;
    }

    .img-attribute .remove-img {
      position: absolute;
      top: -8px;
      right: -5px;
      font-size: 16px;
      color: #71b6f9;

      i {
        background: #ffffff;
        border-radius: 50%;
      }
    }

    .remove-img:hover {
      color: #e0810c;
      cursor: pointer;
    }
  }

  .media-editor {
    width: 100%;
  }

  .media-avatar {
    width: 100%;

    .img-preview {
      img {
        max-width: 200px;
      }

      &:hover {
        cursor: pointer;
        opacity: 0.7;
      }
    }
  }
}

@media (min-width: 576px) {
  .media .modal-dialog {
    max-width: 100%;
  }
}

@media (max-height: 500px) {
  .media .list-media {
    height: calc(100vh - 265px);
  }
}

@media screen and (max-width: 370px) {
  .media {
    .upload-media a,
    .media-list a,
    .upload-media-get a,
    .media-list-get a {
      font-size: 11px;
      padding: 10px 3px;
    }
  }
}
</style>
