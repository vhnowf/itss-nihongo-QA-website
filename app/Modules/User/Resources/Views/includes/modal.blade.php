
@if (Auth::guest())
    <!-- Modal -->
    <div class="modal fade" id="errorFacebook" role="dialog">
        <div class="modal-dialog">
        <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Thông báo') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Địa chỉ mail này đã được đăng kí bằng Google. Vui lòng đăng nhập bằng Google với Account này.') }}</p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('social.redirect','google') }}" class="btn btn-danger" style="width:49%; margin-right:36%"><i class="fab fa-google-plus-g" aria-hidden="true"></i> {{__('Sign In with Google')}}</a>    
                    <button type="button" class="btn btn-info" data-dismiss="modal">{{__('Đóng')}}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="errorGoogle" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Thông báo') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>{{__('Địa chỉ mail này đã được đăng kí bằng Facebook. Vui lòng đăng nhập bằng Facebook với Account này.')}}</p>
                </div>
                <div class="modal-footer">
                        <a href="{{ route('social.redirect','facebook') }}" class="btn btn-primary"style="width:49% ; margin-right:36%"><i class="fab fa-facebook-f" aria-hidden="true"></i> {{__('Sign In with Facebook')}}</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('Đóng') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="errorWeb" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('Thông báo') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Địa chỉ email này đã tồn tại trên hệ thống. Vui lòng đăng nhập bằng hệ thống của chúng tôi') }}</p>
                </div>
                <div class="modal-footer">
                        <a href="javascript:void(0)" data-dismiss="modal" data-target="#forgotPasswordModal" data-toggle="modal" class="btn btn-danger"style="width:49% ; margin-right:36%"> {{ __('Quên mật khẩu') }}</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('Đóng') }}</button>
                </div>
            </div> 
        </div>
    </div>
    @if(!empty(Session::get('error')) && Session::get('error') == 1)
        @push('js')
            <script>
                $(function() {
                    $('#errorFacebook').modal('show');
                });
            </script>
        @endpush
    @endif

    @if(!empty(Session::get('error')) && Session::get('error') == 2)
        @push('js')
            <script>
                $(function() {
                    $('#errorGoogle').modal('show');
                });
            </script>
        @endpush
    @endif

    @if(!empty(Session::get('error')) && Session::get('error') == 3)
        @push('js')
            <script>
                $(function() {
                    $('#errorWeb').modal('show');
                });
            </script>
        @endpush
    @endif
@endif

<!-- Popup thông báo -->
<div class="modal fade" id="popup_alert" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="title">{{ __('Đăng ký Account thành công') }}</h5>
                <span class="message">{{ __('Chúc mừng bạn đã đăng ký tài khoàn thành công!') }}</span>
            </div>
        </div>
    </div>
</div>
