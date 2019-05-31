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
{{ Html::script('assets/js/vanillaCalendar.js') }}



<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script>
  $(window).load(function(){
	 $('[data-toggle="tooltip"]').tooltip();
	var url = window.location;
	$('ul.nav li').removeClass('active'); //remove active class from all li
	$('ul.nav a[href="'+ url +'"]').parents('li').addClass('active');
  });
</script>



