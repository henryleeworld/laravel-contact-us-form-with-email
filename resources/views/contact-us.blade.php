<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Laravel</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/23.1.0/css/intlTelInput.css" integrity="sha512-OkSoWyaoScjXhOm87XO5hDz1E5buvm2aAkq+5zJmaYpylA0OKJ5no5qc4ZRrmApoaXEgXc3n0iyVS1q5FgiJjg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" type="text/css" href="{{ asset('css/contact-us.css') }}" />
    </head>
    <body>
        <div class="container mt-5">
            <!-- Success message -->
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
            <form action="" method="post" action="{{ route('contact.store') }}">
                @csrf
                <div class="mb-3 row">
                    <label>{{ __('Name') }}</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" name="name" id="name" />
                    <!-- Error -->
                    @if ($errors->has('name'))
                        <div class="error">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3 row">
                    <label>{{ __('Email') }}</label>
                    <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="email" id="email" />

                    @if ($errors->has('email'))
                        <div class="error">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3 row">
                    <label>{{ __('Phone') }}</label>
                    <input type="hidden" id="phone-iso-2" name="phone-iso-2" value="">
                    <input type="hidden" id="phone-dial-code" name="phone-dial-code" value="">
                    <input type="tel" class="form-control {{ $errors->has('phone') ? 'error' : '' }}" name="phone" id="phone" />
                    @if ($errors->has('phone'))
                        <div class="error">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3 row">
                    <label>{{ __('Subject') }}</label>
                    <input type="text" class="form-control {{ $errors->has('subject') ? 'error' : '' }}" name="subject" id="subject" />
                    @if ($errors->has('subject'))
                        <div class="error">
                            {{ $errors->first('subject') }}
                        </div>
                    @endif
                </div>
                <div class="mb-3 row">
                    <label>{{ __('Message') }}</label>
                    <textarea class="form-control {{ $errors->has('note') ? 'error' : '' }}" name="note" id="note" rows="4"></textarea>
                    @if ($errors->has('note'))
                        <div class="error">
                            {{ $errors->first('note') }}
                        </div>
                    @endif
                </div>
                <input type="submit" name="send" value="{{ __('Submit') }}" class="btn btn-dark btn-block" />
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/23.1.0/js/intlTelInput.min.js" integrity="sha512-nSv4TmHKiFdWKcAEKs+OW4rd9OPo4ZNNVHxhpIQj/dZwLSDrjO8Lq6YJn5AzFeFwqXaA+u9xdVvRbfkfExTkLg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            var input = document.querySelector("#phone");
            var instance = window.intlTelInput(input, {
                allowDropdown: true,
                geoIpLookup: function(success, failure) {
                    $.get("https://ipinfo.io?token={{ config('services.ipinfo.token') }}", function() {}, "jsonp").always(function(resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        success(countryCode);
                    });
                },
                initialCountry: "auto",
                separateDialCode: true
            });
            input.addEventListener("countrychange",function() {
                var countryData = instance.getSelectedCountryData();
                $("#phone-iso-2").val(countryData.iso2);
                $("#phone-dial-code").val(countryData.dialCode);
            });
        </script>
    </body>
</html>