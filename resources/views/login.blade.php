@extends('backend.layouts.layout')

@section('content')
<div class="h-100 bg-cover bg-center py-5 d-flex align-items-center" style="background-image: url({{ asset('assets/images/login.jpg') }})">
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-xl-4 mx-auto">
            <div class="card text-left"  style="">
                <div class="card-body" style="">
                    <div class="mb-2 text-center">
                        <img src="{{ asset('assets/images/logo.png') }}" class="mw-100 mb-4" >
                        {{-- <p>{{  trans('messages.Login to your account.') }}</p> --}}
                      
                    </div>
                    <div class="form-group">
                        <input id="email" type="password" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="{{  trans('messages.email') }}">
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    
                    <button id="checkEmail" class="btn btn-primary btn-lg btn-block">
                        {{  trans('messages.submit') }}
                    </button>

                    <p id="message" style="color: red;text-align:center" class="mt-2"></p>
                    
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@section('header')
<style>

.eye-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
        }
    </style>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        $('#checkEmail').on('click', function () {
            var email = $('#email').val();

            $.ajax({
                url: '/check-email',
                type: 'POST',
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}' // CSRF protection for Laravel
                },
                success: function (response) {
                    if (response.status === 'success') {
                        window.location.href = response.redirect; // Redirect to the specific page
                    } else {
                        $('#message').text(response.message);
                    }
                }
            });
        });
    });
</script>

@endsection