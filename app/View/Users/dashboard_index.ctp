<iframe name="viewport" src="/dashboard/users/welcome" class="expand" id="viewport" scrolling="no" seamless="seamless">
</iframe>
<div class="clearboth"></div>
<script>
$(document).ready(function() {
  $('#menu>li>a').click(function() {
    $('#menu>li').removeClass('active');
    $(this).parent('li').addClass('active');
  });
  
  $('.submenu>li>a').click(function() {
    $('#menu>li').removeClass('active');
    $(this).parents('.submenu').parent().addClass('active');
  });
  
});
</script>