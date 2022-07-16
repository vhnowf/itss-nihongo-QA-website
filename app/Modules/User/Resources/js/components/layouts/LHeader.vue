<template>
    <div>
        <section id="header" class="w-100 header">
            <div class="container">
                <div class="h-content">
                    <div class="logo">
                        <a :href="baseUrl('')">
                            <img :src="baseUrl('images/logo.png?v=2.0.2')" alt="Stackoverflow logo">
                        </a>
                    </div>
                     <div class="d-flex gs4">
                        <div class="menu-item">
                            <a :href="baseUrl('questions')" class="item">
                                Question
                            </a>
                        </div> 
                        <div class="menu-item">
                            <a :href="baseUrl('tags')" class="item">
                                Tag
                            </a>
                        </div> 
                        <div class="menu-item">
                            <a :href="baseUrl('users')" class="item">
                                User
                            </a>
                        </div> 
                    </div> 
                    <div class="search-form">
                        <form :action="baseUrl(searchUrl)" id="search" method="GET" class="search frmSearchProduct">
                            <input v-model="search" dir="auto" id="sKeyword" :name="searchUrl == 'search' ? 'keyword' : null" placeholder="Search...." tabindex="1" type="text" autocomplete="off" class="input_search"> 
                                <button type="submit" class="icon_seach_web"><img src="http://stackoverflow.local/images/icon-search.png" alt="search icon"></button>
                        </form> 
                        <div class="popup_keyword hidden"></div>
                    </div> 

                    <ul class="h-user">
                        <li class="h-m-search show-sm">
                            <span v-on:click="showSearchMobile()">
                                <img :src="baseUrl('images/icon-search.png')" alt="search icon" />
                            </span>
                        </li>
                        <li v-if="!$store.getters.isLoggedIn" class="h-not-signed hide-sm">
                            <img :src="baseUrl('images/user-icon.png')" alt="user icon" />
                            <a href="javascript:void(0)" v-on:click="showLoginModal('register')">{{ $t('Register') }}</a> / 
                            <a href="javascript:void(0)" v-on:click="showLoginModal('login')">{{ $t('Log in') }}</a>
                        </li>

                        <li v-if="$store.getters.isLoggedIn" class="hide-sm">
                            <div class="user-dropdown">
                                <div class="dropbtn">
                                    <div class="avatar">
                                        <img :src="$store.state.auth.user.avatar" :alt="$store.state.auth.user.fullname">
                                    </div>
                                    <div class="username">
                                        <!-- <span class="welcome">Welcome</span> -->
                                        <span class="f-name">{{ $store.state.auth.user.fullname }}</span>
                                    </div>
                                </div>
                                <div class="d-user-content">
                                    <a :href="baseUrl('users/' + $store.state.auth.user.id)">My profile</a>
                                    <a :href="baseUrl('logout')">Log out</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    
                    <div class="lp-sm-menu">
                        <div class="sm-menu-head">
                            <a :href="baseUrl('')">
                                <img :src="baseUrl('images/logo.png')" alt="StackOverFlow logo">
                            </a>
                            <div class="close-menu" onclick="openMenu()"><i class="feather-x"></i></div>
                        </div>
                        <div class="h-sm-content">
                            <div v-if="!$store.getters.isLoggedIn" class="list-btn-user">
                                <a href="javascript:void(0)" v-on:click="showLoginModal('register')" class="btn btn-register">Register</a>
                                <a href="javascript:void(0)" v-on:click="showLoginModal('login')" class="btn btn-main">Log in</a>
                            </div>
                            <div v-if="$store.getters.isLoggedIn" class="user-info">
                                <div
                                    data-toggle="collapse"
                                    data-parent="#user_collapse"
                                    href="#user_collapse"
                                    aria-expanded="false"
                                    aria-controls="user_collapse"
                                    class="collapse-click"
                                 >
                                    <div class="avatar">
                                        <img :src="$store.state.auth.user.avatar" :alt="$store.state.auth.user.fullname">
                                    </div>
                                    <div class="username">
                                        <span>Xin chào</span>
                                        {{ $store.state.auth.user.fullname }}
                                    </div>
                                    <div class="arrow">
                                        <i class="feather-chevron-up"></i>
                                    </div>
                                </div>
                                <div id="user_collapse" class="collapse show" role="tabpanel" aria-labelledby="heading1" data-parent="#user_collapse">
                                    <ul>
                                        <li>
                                            <div class="box-collapse">
                                                <a :href="baseUrl('profile')"><i class="feather-user"></i> My account</a>
                                                <span 
                                                    class="arrow collapsed"
                                                    data-toggle="collapse"
                                                    aria-controls="collapse_sidebar_profile"
                                                    data-target="#collapse_sidebar_profile"
                                                ><i class="feather-chevron-right"></i></span>
                                            </div>
                                            <div class="p-l-12 collapse" id="collapse_sidebar_profile">
                                                <a :href="baseUrl('profile')">My profile</a>
            
                                                <a :href="baseUrl('change-password')">Change password</a>
                                            </div>
                                        </li>
                                        <!-- <li><a :href="baseUrl('notifications')"><i class="feather-bell"></i> Thông báo</a></li> -->
                                        <li class="logout"><a :href="baseUrl('logout')">Log out</a></li>
                                    </ul>
                                </div>
                            </div>
                            <ul>
                                <li><a :href="baseUrl('')">Home</a></li>
                                <li><a :href="baseUrl('gioi-thieu-ve-chung-toi')">Về chúng tôi</a></li>
                                <li><a :href="baseUrl('lien-he')">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="box-search-mobile">
                        <form :action="baseUrl('search')" method="GET">
                            <input class="search_mobile" name="keyword" placeholder="Tìm kiếm" type="text"  autocomplete="off"/>
                            <button class="btn_search_m"><img :src="baseUrl('images/icon-search.png')" alt="search icon" /></button>
                        </form>
                        <span class="cancel_search" v-on:click="cancelSearchMobile()"><i class="feather-x"></i></span>

                        <div class="popup_keyword_mobile hidden"></div>
                    </div>
                </div>

                <div id="menu_mask" onclick="openMenu()"></div>
            </div>
        </section>

        <div class="modal fade popup-custom" id="popup_user" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal"><i class="feather-x"></i></button>
                        <div class="modal-login-left">
                            <h5>Log In</h5>
                            <div class="text-center">
                                <!-- <img src="{{ asset('images/img_res_lg.png') }}" alt=""> -->
                            </div>
                        </div>
                        <div class="modal-login-right">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Log in</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                    <div class="alert alert-warning" v-if="apiErrors.login">{{ apiErrors.login }}</div>

                                    <form :action="baseUrl('login')" @submit.prevent="handleSubmitLogin">
                                        <div class="m-b-24">
                                            <div class="popup-input">
                                                <input
                                                    type="text"
                                                    v-model="formLogin.email"
                                                    :class="classValid(loginErrors.email, 'p-input')"
                                                    placeholder="Email"
                                                />
                                                <i class="feather-mail"></i>
                                                <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                                            </div>
                                            <span v-if="loginErrors.email" class="help-block">
                                                <small class="text-danger">{{ loginErrors.email }}</small>
                                            </span>
                                        </div>
                                        
                                        <div class="m-b-24">
                                            <div class="popup-input">
                                                <input
                                                    type="password"
                                                    v-model="formLogin.password"
                                                    :class="classValid(loginErrors.password, 'p-input')"
                                                    placeholder="Password"
                                                />
                                                <i class="feather-lock"></i>
                                                <span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                                            </div>
                                            <span v-if="loginErrors.password" class="help-block">
                                                <small class="text-danger">{{ loginErrors.password }}</small>
                                            </span>
                                        </div>

                                        <div class="m-b-24 text-right">
                                            <a v-on:click="showforgotPasswordModal()" href="javascript:void(0)">Forgot password?</a>
                                        </div>

                                        <div class="text-center">
                                            <input type="submit" value="Login" class="p-btn">
                                        </div>
                                    </form>
                                    <span class="line-other"><p>Or login by</p></span>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <a href="javascript:void(0)" class="btn btn-info with-full" :onclick="openFacebook" >
                                                <i class="fab fa-facebook-f"></i> Facebook
                                            </a>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-6">
                                            <a href="javascript:void(0)" class="btn btn-danger with-full" :onclick="openGoogle">
                                                <i class="fab fa-google-plus-g"></i> Google
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <div class="alert alert-warning" v-if="apiErrors.register">{{ apiErrors.register }}</div>

                                    <form :action="baseUrl('register')" @submit.prevent="handleSubmitRegister" method="Post">
                                        <div class="m-b-24">
                                            <div class="popup-input">
                                                <input
                                                    type="text"
                                                    v-model="formRegister.fullname"
                                                    :class="classValid(registerErrors.fullname, 'p-input')"
                                                    class="p-input"
                                                    placeholder="Fullname"
                                                />
                                                <i class="feather-user"></i>
                                                <span class="field-validation-valid" data-valmsg-for="Firstname" data-valmsg-replace="true"></span>
                                            </div>
                                            <span v-if="registerErrors.fullname" class="help-block">
                                                <small class="text-danger">{{ registerErrors.fullname }}</small>
                                            </span>
                                        </div>
                                        <div class="m-b-24">
                                            <div class="popup-input">
                                                <input
                                                    type="text"
                                                    v-model="formRegister.username"
                                                    :class="classValid(registerErrors.username, 'p-input')"
                                                    class="p-input"
                                                    placeholder="Username"
                                                />
                                                <i class="feather-user"></i>
                                                <span class="field-validation-valid" data-valmsg-for="Firstname" data-valmsg-replace="true"></span>
                                            </div>
                                            <span v-if="registerErrors.username" class="help-block">
                                                <small class="text-danger">{{ registerErrors.username }}</small>
                                            </span>
                                        </div>
                                        <div class="m-b-24">
                                            <div class="popup-input">
                                                <input
                                                    type="email"
                                                    v-model="formRegister.email"
                                                    :class="classValid(registerErrors.email, 'p-input')"
                                                    placeholder="Email"
                                                />
                                                <i class="feather-mail"></i>
                                                <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                                            </div>
                                            <span v-if="registerErrors.email" class="help-block">
                                                <small class="text-danger">{{ registerErrors.email }}</small>
                                            </span>
                                        </div>
                                        <div class="m-b-24">
                                            <div class="popup-input">
                                                <input
                                                    v-model="formRegister.password"
                                                    type="password"
                                                    :class="classValid(registerErrors.password, 'p-input')"
                                                    placeholder="Password"
                                                />
                                                <div id="password-strength-status" style="padding-top:5px"></div>
                                                <i class="feather-lock"></i>
                                                <span class="field-validation-valid" data-valmsg-for="Password" data-valmsg-replace="true"></span>
                                            </div>
                                            <span v-if="registerErrors.password" class="help-block">
                                                <small class="text-danger">{{ registerErrors.password }}</small>
                                            </span>
                                        </div>
                                        <div class="m-b-24">
                                            <div class="popup-input">
                                                <input
                                                    v-model="formRegister.confirm_password"
                                                    type="password"
                                                    :class="classValid(registerErrors.confirm_password, 'p-input')"
                                                    placeholder="Confirm password"
                                                />
                                                <i class="feather-lock"></i>
                                                <span class="field-validation-valid" data-valmsg-for="confirm_password" data-valmsg-replace="true"></span>
                                            </div>
                                            <span v-if="registerErrors.confirm_password" class="help-block">
                                                <small class="text-danger">{{ registerErrors.confirm_password }}</small>
                                            </span>
                                        </div>
                                        <div class="text-center">
                                            <input type="submit" value="Register" class="p-btn">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Popup quen mat khau -->
        <div class="modal fade popup-forgot-password popup-custom" id="forgotPasswordModal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal"><i class="feather-x"></i></button>
                        <h5>Đặt lại mật khẩu</h5>
                        <span>Vui lòng nhập địa chỉ email bạn đã đăng ký lên chúng tôi để lấy lại mật khẩu.</span>

                        <form @submit.prevent="handleSubmitForgotPassword" method="Post">
                            <div class="m-b-24">
                                <div class="popup-input">
                                    <input
                                        :class="classValid(forgotErrors.email, 'p-input')"
                                        v-model="formForgot.email"
                                        placeholder="Nhập địa chỉ email"
                                        type="text"
                                    />
                                    <i class="feather-mail"></i>
                                    <span class="field-validation-valid" data-valmsg-for="Email" data-valmsg-replace="true"></span>
                                </div>
                                <span v-if="forgotErrors.email" class="help-block">
                                    <small class="text-danger">{{ forgotErrors.email }}</small>
                                </span>
                                <span v-else-if="apiErrors.forgotPassword" class="help-block">
                                    <small class="text-danger">{{ apiErrors.forgotPassword }}</small>
                                </span>
                            </div>
                            
                            <div class="text-center">
                                <input type="submit" value="Gửi" class="p-btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { validEmail } from '@core/helpers/valid'; 
    
    export default {
        data() {
            return {
                formLogin: {},
                formRegister: {},
                formForgot: {},
                loginErrors: [],
                registerErrors: [],
                forgotErrors: [],
                apiErrors: [],
                isLoggedIn: false,
                searchUrl: 'search',
                search: ''
            }
        },
        props: {
            openFacebook: {
                type: String,
                required: true,
            },
            openGoogle: {
                type: String,
                required: true,
            },
        },
        updated() {
            if (this.search) {
                if (this.search.substring(0, 1) == '[' && this.search.substring(this.search.length - 1) == ']') {
                    this.searchUrl = 'questions/tagged/' + this.search.substring(1, this.search.length - 1);
                    console.log(this.searchUrl);
                }
            }
        },
        created: function() {
            
        },
        methods: {
            showSearchMobile: function() {
                $('.box-search-mobile').show();
            },
            cancelSearchMobile: function() {
                $('.box-search-mobile').hide();
            },
            showforgotPasswordModal: function() {
                $("#popup_user").modal("hide");
                $("#forgotPasswordModal").modal("show");
            },
            showLoginModal: function(type) {
                if (type == 'login') {
                    $('#login-tab').trigger('click');
                } else {
                    $('#register-tab').trigger('click');
                }
                $("#popup_user").modal("show");
            },
            handleSubmitLogin: function() {
                let scop = this;
                scop.loginErrors = [];
                if (!scop.formLogin.email) {
                    scop.loginErrors['email'] = 'Please enter email address';
                } else if (!validEmail(scop.formLogin.email)) {
                    scop.loginErrors['email'] = 'Email address is not valid';
                }

                if (!scop.formLogin.password) {
                    scop.loginErrors['password'] = 'Please enter password';
                } else if(scop.formLogin.password.length < 6) {
                    scop.loginErrors['password'] = 'Password must be more than 6 characters';
                }

                if (Object.keys(scop.loginErrors).length == 0) {
                    scop.$loading(true);
                    scop.$store.dispatch('login', scop.formLogin).then(response => {
                        if(response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: '',
                                text: response.message,
                            }).then((result) => {
                                $("#popup_user").modal("hide");
                                scop.isLoggedIn = true;
                                window.location.reload();
                            })
                        } else if(response.status == 400) {
                            scop.registerErrors = [];
                            if(response.data.email) {
                                scop.registerErrors['email'] = response.data.email[0];
                            }
                            if(response.data.password) {
                                scop.registerErrors['password'] = response.data.password[0];
                            }
                        } else if(response.status == 403) {
                            scop.apiErrors = [];
                            scop.apiErrors['login'] = response.message;
                        }

                        scop.$loading(false);
                    }).catch((error) => {
                        console.log(error)
                        scop.$loading(false);
                    });
                }
            },
            handleSubmitRegister: function() {
                let scop = this;
                scop.registerErrors = [];
                if (!scop.formRegister.fullname) {
                    scop.registerErrors['fullname'] = 'Please enter fullname';
                }

                if (!scop.formLogin.username) {
                    scop.loginErrors['username'] = 'Please enter username';
                } 

                if (!scop.formRegister.email) {
                    scop.registerErrors['email'] = 'Please enter email address';
                } else if (!validEmail(scop.formRegister.email)) {
                    scop.registerErrors['email'] = 'Email address is not valid';
                }

                if (!scop.formRegister.password) {
                    scop.registerErrors['password'] = 'Please enter password';
                } else if(scop.formRegister.password.length < 6) {
                    scop.registerErrors['password'] = 'Password must be more than 6 characters';
                }

                if (!scop.formRegister.confirm_password) {
                    scop.registerErrors['confirm_password'] = 'Please enter password_confirm';
                } else {
                    if (scop.formRegister.password != scop.formRegister.confirm_password) {
                        scop.registerErrors['confirm_password'] = 'Password_confirm is incorrect';
                    }
                }

                if (Object.keys(scop.registerErrors).length == 0) {
                    scop.$loading(true);
                    scop.$store.dispatch('register', scop.formRegister).then(response => {
                        if(response.status == 200) {
                            Swal.fire({
                                icon: 'success',
                                title: '',
                                text: response.message,
                            }).then((result) => {
                                 $("#popup_user").modal("hide");
                            })
                        } else if(response.status == 400) {
                            scop.registerErrors = [];
                            if(response.data.fullname) {
                                scop.registerErrors['fullname'] = response.data.fullname[0];
                            }
                            if(response.data.email) {
                                scop.registerErrors['email'] = response.data.email[0];
                            }
                            if(response.data.password) {
                                scop.registerErrors['password'] = response.data.password[0];
                            }
                            if(response.data.confirm_password) {
                                scop.registerErrors['confirm_password'] = response.data.confirm_password[0];
                            }
                        } else if(response.status == 403) {
                            scop.apiErrors = [];
                            scop.apiErrors['register'] = response.message;
                        }

                        scop.$loading(false);
                    }).catch((error) => {
                        console.log(error)
                        scop.$loading(false);
                    });
                }
            },
            handleSubmitForgotPassword: function() {
                let scop = this;
                scop.forgotErrors = [];
                if (!scop.formForgot.email) {
                    scop.forgotErrors['email'] = 'Please enter email address';
                } else if (!validEmail(scop.formForgot.email)) {
                    scop.forgotErrors['email'] = 'Email address is not valid';
                }

                if (Object.keys(scop.forgotErrors).length == 0) {
                    scop.$loading(true);
                    scop.$store.dispatch('forgotPassword', scop.formForgot).then(response => {
                        scop.apiErrors = [];
                        if(response.status == 200) {
                            $('#forgotPasswordModal').modal('hide');

                            $('#popup_alert .title').html('Change password successful');
                            $('#popup_alert .message').html(response.message);
                            $('#popup_alert').modal('show');
                        } else if(response.status == 403) {
                            scop.apiErrors['forgotPassword'] = response.message;
                        }
                        scop.$loading(false);
                    }).catch((error) => {
                        console.log(error)
                        scop.$loading(false);
                    });
                }
            },
        }
    };
</script>
