<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Laravel</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha512-MoRNloxbStBcD8z3M/2BmnT+rg4IsMxPkXaGh2zD6LGNNFE80W3onsAhRcMAMrSoyWL9xD7Ert0men7vR8LUZg==" crossorigin="anonymous" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/css/intlTelInput.min.css" integrity="sha512-yye/u0ehQsrVrfSd6biT17t39Rg9kNc+vENcCXZuMz2a+LWFGvXUnYuWUW6pbfYj1jcBb/C39UZw2ciQvwDDvg==" crossorigin="anonymous" />
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
                <div class="form-group">
                    <label>{{ trans('frontend.contact_us.content.name') }}</label>
                    <input type="text" class="form-control {{ $errors->has('name') ? 'error' : '' }}" name="name" id="name" />
                    <!-- Error -->
                    @if ($errors->has('name'))
                        <div class="error">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('frontend.contact_us.content.email') }}</label>
                    <input type="email" class="form-control {{ $errors->has('email') ? 'error' : '' }}" name="email" id="email" />

                    @if ($errors->has('email'))
                        <div class="error">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('frontend.contact_us.content.phone') }}</label>
                    <input type="tel" class="form-control {{ $errors->has('phone') ? 'error' : '' }}" name="phone" id="phone" />
                    @if ($errors->has('phone'))
                        <div class="error">
                            {{ $errors->first('phone') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('frontend.contact_us.content.subject') }}</label>
                    <input type="text" class="form-control {{ $errors->has('subject') ? 'error' : '' }}" name="subject" id="subject" />
                    @if ($errors->has('subject'))
                        <div class="error">
                            {{ $errors->first('subject') }}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>{{ trans('frontend.contact_us.content.note') }}</label>
                    <textarea class="form-control {{ $errors->has('note') ? 'error' : '' }}" name="note" id="note" rows="4"></textarea>
                    @if ($errors->has('note'))
                        <div class="error">
                            {{ $errors->first('note') }}
                        </div>
                    @endif
                </div>
                <input type="submit" name="send" value="{{ trans('frontend.contact_us.content.submit') }}" class="btn btn-dark btn-block" />
            </form>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js" integrity="sha512-kkBkPRO6dSkCJDPNpW4Bb/1Z585gN++HKcIpClQW9IYI+4gk4yPC+eaE3CSQp3Ex+48NvzUvqmroZtR4gZnt4g==" crossorigin="anonymous"></script>
        <script>
            
            var input = document.querySelector("#phone");
            window.intlTelInput(input, {
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
        </script>
    </body>
</html>