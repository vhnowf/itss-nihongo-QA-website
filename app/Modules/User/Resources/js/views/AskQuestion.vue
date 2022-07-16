<template>
	<div class="col-md-12">
        <div class="pageTitle mt-3" style="margin-bottom: 10px">Ask a public question</div>
        <form :action="baseUrl('questions/store')" @submit.prevent="saveQuestion()">
            <div class="form-group">
                <label class="control-label" for="content">Title</label>
                <br/>
                <small>Be specific and imagine you're asking a question to another person.</small>
                <input 
                    v-model="question.title" 
                    :class=" errors.title ? 'form-control is-invalid' : 'form-control'" 
                    type="text" 
                    name="title" 
                    id="title" 
                    placeholder="e.g. Is there an R function for finding the index of an element in a vector?"
                />
                <span v-if="errors.title" class="help-block">
                    <small class="text-danger">{{ errors.title }}</small>
                </span>
            </div>
            <div class="form-group">
                <label class="control-label" for="content">Body</label>
                <br/>
                <small>Include all the information someone would need to answer your question.</small>
               <editor
                v-model="question.content"
                api-key="5pgi2zw8z050ruf11ym52sk14p9wk8e4iybt2jzk0xin6psn"
                :init="{
                    height: 500,
                    menubar: true,
                    images_upload_handler: example_image_upload_handler,
                    plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount'
                    ],
                    toolbar:
                    'undo redo | formatselect | bold italic backcolor | \
                    alignleft aligncenter alignright alignjustify | \
                    bullist numlist outdent indent | removeformat | help'
                }"
                />
                <span v-if="errors.content" class="help-block">
                    <small class="text-danger">{{ errors.content }}</small>
                </span>
            </div>
            <div class="form-group">
                <label class="control-label" for="tags">Tags (You can only add 5 tags)</label>
                <div v-for="(tag, index) in question.tag" :key="index">
                    <div class="input-tag" style="display:flex;">
                        <input 
                            v-model="tag.value" 
                            v-on:keyup="getTag(index)" 
                            :class=" errors.title ? 'form-control tag-input is-invalid' : 'form-control tag-input'"
                            type="text" 
                            name="tags" 
                            @click="showSuggestion(index)" 
                            :id="'tag-input-' + index" 
                            placeholder="e.g. (ios android string)" 
                            style="margin-bottom: 10px;"
                        />
                        <button class="js-delete-tag s-tag--dismiss" title="Remove tag" @click="removeTag(index)"><svg class="svg-icon iconClearSm pe-none" width="14" height="14" viewBox="0 0 14 14"><path d="M12 3.41L10.59 2 7 5.59 3.41 2 2 3.41 5.59 7 2 10.59 3.41 12 7 8.41 10.59 12 12 10.59 8.41 7z"></path></svg></button>
                    </div>
                    <span v-if="errors.tag" class="help-block">
                        <small class="text-danger">{{ errors.tag[index] }}</small>
                    </span>
                    <div class="col-md-12 tag-suggestions js-tag-suggestions box-border hidden" :id="'tag-suggestions-' + index" style="position: absolute;left: 0px;">
                        <div v-for="(tag, key) in tags" :key="key" class="col-md-4 outline-none js-tag-suggestion" @click="tag_suggestion(tag.name, index)">
                            <div class="d-flex ai-center">
                                <div class="flex--item mr6">
                                    <span class="s-tag">
                                        {{ tag.name }}
                                    </span>
                                </div>  
                                <div class="flex--item fs-fine truncate mr6">{{ tag.questions.length }}</div>
                                <a class="ml-auto flex--item s-btn s-btn__muted p2 js-tag-info-btn" target="_blank" href="/tags/n/info">
                                    <svg aria-hidden="true" class="svg-icon iconHelpSm" width="14" height="14" viewBox="0 0 14 14">
                                        <path d="M7 1C3.74 1 1 3.77 1 7c0 3.26 2.77 6 6 6 3.27 0 6-2.73 6-6s-2.73-6-6-6Zm1.06 9.06c-.02.63-.48 1.02-1.1 1-.57-.02-1.03-.43-1.01-1.06.02-.63.5-1.04 1.08-1.02.6.02 1.05.45 1.03 1.08Zm.73-3.07-.47.3c-.2.15-.36.36-.44.6a3.6 3.6 0 00-.08.65c0 .04-.03.14-.16.14h-1.4c-.14 0-.16-.09-.16-.13-.01-.5.11-.99.36-1.42A4.6 4.6 0 017.7 6.07c.15-.1.21-.21.3-.33.18-.2.28-.47.28-.74.01-.67-.53-1.14-1.18-1.14-.9 0-1.18.7-1.18 1.46H4.2c0-1.17.31-1.92.98-2.36a3.5 3.5 0 011.83-.44c.88 0 1.58.16 2.2.62.58.42.88 1.02.88 1.82 0 .5-.17.9-.43 1.24-.15.2-.44.47-.86.79h-.01Z"></path>
                                    </svg>
                                </a>
                            </div>
                            <p class="mt6 mb0 v-truncate4 lh-md">n is a CLI for managing multiple Node.js versions.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div id="comments-link-54093766" data-rep="50" data-reg="true">
                <a class="js-add-link comments-link disabled-link" title="Use comments to ask for more information or suggest improvements. Avoid comments like “+1” or “thanks”." type="button" @click="addNewTag()">Add a new tag</a>
            </div>
            <input v-if="question_detail" class="button" type="submit" value="Edit your question" style="display: block; float: none; margin-top: 15px">
            <input v-else class="button" type="submit" value="Post your question" style="display: block; float: none; margin-top: 15px">
        </form>
    </div>
</template>

<script>
import axios from 'axios';
import Editor from '@tinymce/tinymce-vue';

export default {
    name: "ask-question",
    components: {
        Editor
    },
    props: {
        question_detail: {
            type: Object,
        }
    },
    data() {
    	return {
    		question: {
	    		title: '',
	    		content: '',
	    		tag: [],
    		},
    		error: {
    			email:'',
    			title: '',
	    		content: '',
	    		file: '',
	    		captcha:'',
    		},
    		tags: null,
            tag: {
                name: '',
            },
            errors: {},
    	}
    },
    created() {
        if (this.question_detail) {
            this.question = this.question_detail;
            if (this.question_detail.tag) {
                let tag_list = [];
                this.question_detail.tag.forEach(data => {
                    tag_list.push({ value: data.name});
                });
                this.question.tag = tag_list;
            }
        }
    },
    methods: {
        checkValid () {
            let scop = this;
            scop.errors = [];
            if (!scop.question.title) {
                scop.errors['title'] = 'Please input title';
            }
            if (!scop.question.content) {
                scop.errors['content'] = 'Please input content';
            }
            if (scop.question.tag.length > 0) {
                scop.errors['tag'] = [];
                scop.question.tag.forEach((data, index) => {
                    if (!data['value']) {
                        scop.errors['tag'][index] = 'Please input tag';
                    }
                });
            } 
        },
        getTag(index) {
            let scop = this;   
            scop.tag.name = scop.question.tag[index].value
            axios.get('/questions/get-tags', {
                params: scop.tag,
            }).then(function (response) {
                scop.tags = response.data.tags;
            }).catch(function (error) {
                console.log(error);
            });	
        },
        saveQuestion() {
            let scop = this;   
            let url = '';
            scop.checkValid();
            if (Object.keys(scop.errors).length == 0) {
                if (this.question_detail) {
                    url = '/questions/' + this.question_detail.id  + '/update';
                } else {
                    url = '/questions/store'
                }
                console.log(url)
                axios.post(url, {
                    question: scop.question,
                }).then(function (response) {
                    window.location.href = response.data.redirect_url;
                }).catch(function (error) {
                    console.log(error);
                });	
            }          
        },
        example_image_upload_handler (blobInfo, success, failure) {
            var xhr, formData;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', '/memberarea/api/upload-image');
            var token = document.head.querySelector("[name=csrf-token]").content;
            xhr.setRequestHeader("X-CSRF-Token", token);

            xhr.onload = function() {
                var json;
                var folder2;
                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }
                success(json.location);

                this.folder = json.folder;
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
        tag_suggestion(tag_name, index) {
            this.question.tag[index].value = tag_name;
        },
        addNewTag() {
            if (this.question.tag.length >= 5) {
                alert("You can only add 5 tags");
                return
            }
            this.question.tag.push({ value: '' });
        },
        showSuggestion(index) {
            let element = document.getElementById("tag-suggestions-" + index);
            element.classList.remove("hidden");
            this.getTag(index);
        },
        removeTag(index) {
            this.question.tag.splice(index, 1);
        }
    }
};
</script>

<style scoped>
    .hidden {
        display: none;
    }
    .js-tag-suggestions {
        cursor: pointer;
    }
    .disabled-link {
        color: hsl(210,8%,55%);
        opacity: .6;
        padding: 0 3px 2px;
    }
    .s-tag--dismiss {
        display: flex;
        align-content: center;
        align-self: center;
        justify-content: center;
        width: 16px;
        height: 16px;
        margin-left: 4px;
        padding: 1px;
        border-radius: 3px;
        cursor: pointer;
    }
</style>