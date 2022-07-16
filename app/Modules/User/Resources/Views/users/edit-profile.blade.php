@extends('User::layouts.user')

@section('styles')
@endsection

@section('user-content')
    <div class="row profile-content">
        <div class="col-md-12">
            <div class="u-title">
                <h3>{{ __('My profile') }}</h3>
            </div>
            
            @include('User::includes.flash')
        </div>
        <div class="col-md-12">
            <form method="POST" action="{{ route('users.update-profile') }}" class="m-t-24" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-md-8">
                        <div class="row"> 
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Full name') }}*</label>
                                    <input type="text" name="fullname" placeholder="{{ __('Full name') }}" class="form-control form-custom {{ $errors->has('fullname') ? ' is-invalid' : '' }}" value="{{ old('fullname', $user->fullname ?? null)}}">
                                    @if ($errors->has('fullname'))
                                        <span class="help-block">
                                            <small class="text-danger">{{ $errors->first('fullname') }}</small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{ __('Email') }}*</label>
                                    <input type="text" name="email" placeholder="{{ __('Email') }}" class="form-control form-custom {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email', $user->email ?? null)}}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <small class="text-danger">{{ $errors->first('email') }}</small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div id="avatar">
                            <img class="thumbnail" src="{{ asset(Auth::user()->avatar) }}" />
                            <div class="upload-btn-wrapper m-t-12">
                                <button type="button" class="btn-file">{{ __('Upload avatar') }}</button>
                                <input type="file" name="avatar" onchange="changeImg(this)" />
                            </div>
                            <p class="m-t-12">{{ __('Max 1 MB Format:.JPEG, .PNG') }}</p>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="text-center m-t-24">
                            <button type="submit" class="btn btn-main btn-custom" style="align: center;">{{ __('Update') }} </button>
                        </div>    
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function changeImg(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#avatar img').attr('src',e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
