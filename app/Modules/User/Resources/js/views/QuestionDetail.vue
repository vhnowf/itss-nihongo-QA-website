<template>
<div class="question-detail">
    <div class="top mt-3">
        <div class="row">
            <div class="col-md-9">
                <div class="pageTitle" id="title">{{ detail.title }}</div>
            </div>
            <div class="col-md-3">
                <a type="button" class="button" :href="baseUrl('questions/ask')">Ask question</a>
            </div>
        </div>
    </div>
    <div class="time">Ask <span id="createdDate">{{ detail.created_at }}</span></div>
    <div class="col-md-12">
        <div class="grid-question">
            <div class="left" style="padding-right: 16px;">
                <div class="voteUp" id="question_up" v-on:click="updateVote(detail.id, null, 1)"><button class="s-button"><i class="fas fa-caret-up vote-icon"></i></button></div> 
                <div class="vote" style="font-size: 20px;">{{ detail.votes }}</div>
                <div class="voteDown" id="question_down" v-on:click="updateVote(detail.id, null, -1)"><button class="s-button"><i class="fas fa-caret-down vote-icon"></i></button></div>
                <div v-on:click="bookmark(detail.id)" class="bookmark" id="bookmark"><i class="fas fa-bookmark" style="font-size: 20px; cursor:pointer;"></i></div>
                <div style="font-size: 13px; margin-top: 5px;">{{ isBookmark }}</div>
            </div>
            <div class="right">
                <div class="question-content" v-html="parsedBody(detail.content)">
                </div>
                <div class="tags mt-16 mb-16 col-md-12">
                    <a v-for="(tag, key) in detail.tag" :key="key" :href="baseUrl('questions/tagged/' + tag.name)">{{ tag.name }}</a>
                </div>
                <div class="mt16 d-flex gs8 gsy fw-wrap jc-between pt4 mb16 col-md-12">
                    <div class="flex--item mr16 fl1 w96">
                        <div class="js-post-menu pt2">
                            <div class="d-flex gs8 s-anchors s-anchors__muted" v-if="detail.user.id == current_user">
                                <div class="flex--item">
                                    <a type="button" :href="baseUrl('questions/edit/' + detail.id)" class="s-btn s-btn__link js-error-click js-gps-track">Edit</a>
                                </div>
                                <div class="flex--item">
                                    <button type="button" class="s-btn__link" v-on:click="deleteQuestion(detail.id)">
                                        Delete
                                    </button>
                                </div>
                                <!-- <div class="flex--item">
                                    <a type="button" class="s-btn s-btn__link js-follow-post js-follow-question js-gps-track" data-gps-track="post.click({ item: 14, priv: -1, post_type: 1 })" data-controller="s-tooltip " data-s-tooltip-placement="bottom" data-s-popover-placement="bottom" aria-controls="" aria-describedby="--stacks-s-tooltip-kbutgq1n">
                                        Follow
                                    </a>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <div class="post-signature owner flex--item">
                        <div class="user-action-time">
                            asked <span title="2022-01-08 06:00:19Z" class="relativetime">2 mins ago</span>
                        </div>
                        <div class="user-gravatar32">
                            <a href="/users/1371947/mike"><div class="gravatar-wrapper-32"><img :src="detail.user.avatar" alt="" class="bar-sm"></div></a>
                        </div>
                        <div class="user-details">
                            <a href="/users/1371947/mike">{{ detail.user.fullname }}</a>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    
        <div class="comment">
            <div class="numAnswer">
                <span id="numAnswers">{{ list_answers.length }}</span> answers
            </div>                    
        </div>

        <div class="list-answer">
            <div v-for="(answer, key) in list_answers" :key="key" class="grid-question">
                <div class="left" style="padding-right: 16px;">
                        <div :id="'answer_up_' + answer.id" class="voteUp"  v-on:click="updateVote(detail.id, answer.id, 1)"><i class="fas fa-caret-up vote-icon" style="font-size: 60px;"></i></div>
                        <div class="vote" style="font-size: 20px;">{{ answer.votes }}</div>
                        <div :id="'answer_down_' + answer.id" class="voteDown" v-on:click="updateVote(detail.id, answer.id, -1)"><i class="fas fa-caret-down vote-icon" style="font-size: 60px;"></i></div>
                        <div v-if="detail.user.id == current_user" class="solve" v-on:click="checkBest(answer)" :id="'check' + answer.id"><i id="check-icon" class="fas fa-check" style="font-size: 30px; cursor:pointer;"></i></div>
                </div>
                <div class="right">
                    <div class="question-content" v-html="answer.content"></div>
                    <div class="mt16 d-flex gs8 gsy fw-wrap jc-between pt4 mb16 col-md-12">
                        <div class="flex--item mr16 fl1 w96">
                            <div class="js-post-menu pt2">
                                <div class="d-flex gs8 s-anchors s-anchors__muted" v-if="answer.user.id == current_user">
                                    <div class="flex--item">
                                        <a type="button" :href="baseUrl('questions/edit/' + detail.id)" class="s-btn s-btn__link js-error-click js-gps-track">Edit</a>
                                    </div>
                                    <div class="flex--item">
                                        <button type="button" class="s-btn__link" v-on:click="deleteAnswer(answer.id)">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="post-signature owner flex--item">
                            <div class="user-action-time">
                                answered <span title="2022-01-08 06:00:19Z" class="relativetime">2 mins ago</span>
                            </div>
                            <div class="user-gravatar32">
                                <a href="/users/1371947/mike"><div class="gravatar-wrapper-32"><img :src="answer.user.avatar" alt="" class="bar-sm"></div></a>
                            </div>
                            <div class="user-details">
                                <a href="/users/1371947/mike">{{ answer.user.fullname }}</a>
                            </div>
                        </div>
                    </div>
                    
                </div>            
            </div> 
        </div>
        
        <form id="post-form" style="border: none;" method="POST" @submit.prevent="postAnswer()">
            <h2 class="space">
                Your Answer
            </h2>
            <editor
                v-model="new_answer.content"
                api-key="5pgi2zw8z050ruf11ym52sk14p9wk8e4iybt2jzk0xin6psn"
                :init="{
                    height: 500,
                    menubar: true,
                    images_upload_url: 'postAcceptor.php',
                    images_upload_handler: function (blobInfo, success, failure) {
                        setTimeout(function () {
                        /* no matter what you upload, we will turn it into TinyMCE logo :)*/
                        success('http://moxiecode.cachefly.net/tinymce/v9/images/logo.png');
                        }, 2000);
                    },
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
            <div class="form-submit cbt d-flex gsx gs4">
            <button id="submit-button" class="flex--item s-btn s-btn__primary s-btn__icon" type="submit" tabindex="120" autocomplete="off">
                Post Your Answer                                       
            </button>
            </div>
        </form>
    </div>
</div>
</template>
<script>
import axios from 'axios';
import Editor from '@tinymce/tinymce-vue';

export default {
    name: "question-detail",
    components: {
        Editor
    },
    props: {
        question: {
            type: Object,
            required: true
        },
        answers: {
            type: Array,
        },
    },
    data() {
        return { 
            new_answer: {},
            detail: {},
            list_answers: {},
            tab: 'oldest',
            current_user: {},
            bookmarked: null,
            errors: {}
        }
    },
    created() {
        this.detail = this.question;
        this.list_answers = this.answers;
        this.current_user = this.$store.state.auth.user.id;
        this.bookmarked = this.detail.bookmark.length;
    },
    mounted() {
        this.voted(this.detail, 'question');
        this.list_answers.forEach(data => {
            let element = document.getElementById("check" + data.id);
            if (data.is_best) {
                element.classList.add("is_best");
            }
            this.voted(data, 'answer');
        });
        this.detail.bookmark.forEach(data => {
            let element = document.getElementById("bookmark");
            if (data.user_id == this.current_user) {
                element.classList.add("bookmarked");
            }
        });
    },
    computed: {
        isBookmark: function () {
            return this.bookmarked;
        },
    },
    methods: {
        countVote(votes) {
            let count = 0;
            votes.forEach(value => {
                count += value.vote_type;
            });
            return count;
        },
        voted(item, type) {
            item.vote.forEach(value => {
                if (type == 'question') {
                    let element_up = document.getElementById("question_up");
                    let element_down = document.getElementById("question_down");
                    if (this.current_user == value.user_id) {
                        this.addCSS(value.vote_type, element_up, element_down);
                    }      
                } else {
                    let element_up = document.getElementById("answer_up_" + value.answer_id);
                    let element_down = document.getElementById("answer_down_" + value.answer_id);
                    if (this.current_user == value.user_id) {
                        this.addCSS(value.vote_type, element_up, element_down);
                    }
                }
            });
        },
        postAnswer() {
            let scop = this;
            scop.errors = [];
            if (!scop.new_answer.content) {
                scop.errors['content'] = 'Please input answer content'
            }
            if (Object.keys(scop.errors).length == 0) {
                axios.post('/answers', {
                    content: scop.new_answer.content,
                    question_id: scop.detail.id,
                }).then(function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: '',
                        text: response.data.message,
                    }).then((result) => {
                        window.location.reload();
                    })
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        checkBest(answer) {
            let element = document.getElementById("check" + answer.id);
            $('.solve').removeClass("is_best");
            if (element.classList.contains('is_best')) {
                element.classList.remove("is_best");
            } else {
                element.classList.add("is_best");
            }
            axios.post('/'+ answer.id + '/check-best', {question_id: this.detail.id}).then(function (response) {
                console.log(response);
            }).catch(function (error) {
                console.log(error);
            });        
        },
        sortedItems: function() {
            this.list_answers.sort( ( a, b) => {
                return new Date(a.created_at) - new Date(b.created_at);
            });
            return this.list_answers;
        },
        updateVote: function (question_id, answer_id, vote_type) {
            let scop = this;   
            if (!answer_id) {
                let element_up = document.getElementById("question_up");
                let element_down = document.getElementById("question_down");
                this.addCSS(vote_type, element_up, element_down);
            } else {
                let element_up = document.getElementById("answer_up_" + answer_id);
                let element_down = document.getElementById("answer_down_" + answer_id);
                this.addCSS(vote_type,  element_up, element_down);
            }
            axios.post('/questions/update-vote', {
                question_id: question_id,
                answer_id: answer_id,
                vote_type: vote_type
            }).then(function (response) {
                scop.detail = response.data.question;
                scop.list_answers = response.data.question.answer;
            }).catch(function (error) {
                console.log(error);
            });	
        },
        addCSS(vote_type, element_up, element_down) {
            if (vote_type == 1) {
                if (element_up.classList.contains('voted')) {
                    element_up.classList.remove("voted");
                } else if (element_down.classList.contains('voted')) {
                    element_down.classList.remove("voted");
                    element_up.classList.add("voted");
                } else {
                    element_up.classList.add("voted");
                }
            } else {
                if (element_down.classList.contains('voted')) {
                    element_down.classList.remove("voted");
                } else if (element_up.classList.contains('voted')) {
                    element_up.classList.remove("voted");
                    element_down.classList.add("voted");
                } else {
                    element_down.classList.add("voted");
                }
            }
        },
        deleteQuestion(question_id) {
            let scop = this;            
            Swal.fire({
                title: "Are you sure you want to delete this question?",
                text: "You will not be able to recover data after deletion!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel"
            }).then(function (result) {
                if (result.value) {
                    axios.delete('/questions/' + question_id + '/delete')
                    .then(function (response) {
                        if (response.data.status == 200) {
                            window.location.href = response.data.redirect_url;
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });	
                }
            })
        },
        bookmark(question_id) {
            // console.log($('#bookmark').css("background-color: hsl(47deg 76% 46%)"));
            let element = document.getElementById("bookmark");
            if (element.classList.contains('bookmarked')) {
                element.classList.remove("bookmarked");
                this.bookmarked --;
            } else {
                element.classList.add("bookmarked");
                this.bookmarked ++;
            }
            axios.post('/questions/' + question_id + '/bookmark')
            .then(function (response) {
                if (response.data.status == 200) {
                    console.log(response.data);
                }
            }).catch(function (error) {
                console.log(error);
            });	
        },
        parsedBody(content){
            return content.replace(/\n/g,"<br>");
        },
        deleteAnswer(answer_id) {
            Swal.fire({
                title: "Are you sure you want to delete this answer?",
                text: "You will not be able to recover data after deletion!!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Delete",
                cancelButtonText: "Cancel"
            }).then(function (result) {
                if (result.value) {
                    axios.delete('/answers/' + answer_id)
                    .then(function (response) {
                        if (response.data.status == 200) {
                            window.location.reload();
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });	
                }
            })
        }
    }
}
</script>

<style lang="scss" scoped>
    .question-detail{
        .vote-icon {
            font-size: 60px;
            cursor: pointer;
        }
        .voted {
            color: #F48225;
        }
        .is_best {
            color: #48a868;
        }
        .s-btn__link {
            display: inline;
            padding: 0;
            border: none;
            border-radius: 0;
            outline: none;
            font: inherit;
            background: none;
            box-shadow: none;
            text-align: inherit;
            text-decoration: none;
            color: hsl(210deg 8% 45%);
            cursor: pointer;
            user-select: auto;
        }
        .bookmarked {
            color: hsl(47deg 76% 46%);
        }
    }
</style>
