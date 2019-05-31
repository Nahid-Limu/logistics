<!DOCTYPE html>
<html lang="en">
<head><title>Log In </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Loading bootstrap css-->
    <!--Loading bootstrap css-->
{{ Html::style('http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700') }}
{{ Html::style('http://fonts.googleapis.com/css?family=Oswald:400,700,300') }}
{{ Html::style('assets/vendors/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui-1.10.4.custom.min.css') }}
{{ Html::style('assets/vendors/font-awesome/css/font-awesome.min.css') }}
{{ Html::style('assets/vendors/bootstrap/css/bootstrap.css') }}
<!--LOADING STYLESHEET FOR PAGE-->
{{ Html::style('assets/vendors/intro.js/introjs.css') }}
{{ Html::style('assets/vendors/calendar/zabuto_calendar.min.css') }}
<!--Loading style vendors-->
{{ Html::style('assets/vendors/animate.css/animate.css') }}
{{ Html::style('assets/vendors/jquery-pace/pace.css') }}
{{ Html::style('assets/vendors/iCheck/skins/all.css') }}
{{ Html::style('assets/vendors/jquery-news-ticker/jquery.news-ticker.css') }}
<!--Loading style-->
{{ Html::style('assets/css/themes/style1/orange-blue.css') }}
{{ Html::style('assets/css/style-responsive.css') }}
{{ Html::style('assets/css/datatable.css') }}
{{ Html::style('assets/css/select2.css') }}
</head>
<body id="signin-page">
<div class="page-form">
    <form class="form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
         @csrf
        <div class="header-content">
            <h1>Log In</h1>
        </div>
        <div class="body-content">

            <div class="form-group">
                <div class="input-icon right"><i class="fa fa-user"></i>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus></div>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                    @endif
             </div>
            <div class="form-group">
                <div class="input-icon right"><i class="fa fa-key"></i><input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="password" required></div>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                @endif
            </div>
            <div class="form-group pull-left">
                <div class="checkbox-list"><label>
                        <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>&nbsp;
                        Keep me signed in</label>
                </div>
            </div>
            <div class="form-group pull-right">
                <button type="submit" class="btn btn-success">Log In
                    &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
            </div>
            <div class="clearfix"></div>
            {{--<div class="forget-password"><h4>Forgotten your Password?</h4>--}}
                {{--<p>no worries, click <a href='{{ route('password.request') }}' class='btn-forgot-pwd'>here</a> to reset your password.</p></div>--}}
            <hr>
         </div>
    </form>
</div>
{{ Html::script('assets/js/jquery-1.10.2.min.js') }}
{{ Html::script('assets/js/jquery-migrate-1.2.1.min.js') }}
{{ Html::script('assets/js/jquery-ui.js') }}
{{ Html::script('assets/js/datatable.js') }}
<!--loading bootstrap js-->
{{ Html::script('assets/vendors/bootstrap/js/bootstrap.js') }}
{{ Html::script('assets/vendors/bootstrap-hover-dropdown/bootstrap-hover-dropdown.js') }}
{{ Html::script('assets/js/html5shiv.js') }}
{{ Html::script('assets/js/respond.min.js') }}
{{ Html::script('assets/vendors/metisMenu/jquery.metisMenu.js') }}
{{ Html::script('assets/vendors/slimScroll/jquery.slimscroll.js') }}
{{ Html::script('assets/vendors/jquery-cookie/jquery.cookie.js') }}
{{ Html::script('assets/vendors/iCheck/icheck.min.js') }}
{{ Html::script('assets/vendors/iCheck/custom.min.js') }}
{{ Html::script('assets/vendors/jquery-news-ticker/jquery.news-ticker.js') }}
{{ Html::script('assets/js/jquery.menu.js') }}
{{ Html::script('assets/vendors/jquery-pace/pace.min.js') }}
{{ Html::script('assets/vendors/holder/holder.js') }}
{{ Html::script('assets/vendors/responsive-tabs/responsive-tabs.js') }}
{{ Html::script('assets/js/select2.js') }}
<script>
    $('input[type="checkbox"]').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        increaseArea: '20%' // optional
    });
    $('input[type="radio"]').iCheck({
        radioClass: 'iradio_minimal-grey',
        increaseArea: '20%' // optional
    });
</script>
</body>
</html>