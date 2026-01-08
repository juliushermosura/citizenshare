<section class="fixed-bg cd-service classes_home" id="intro">
</section>

<div class="content_header">
  <hr style="margin-top: 0;" />
  <div class="contentarea paddingtop10 paddinghorizontal0">
    <?php echo $this->element('content_header') ?>
    <?php if (empty($class['Project'])) $pCount = 0; else $pCount = count($class['Project']); ?>
    <?php if (empty($class['Discussion'])) $dCount = 0; else $dCount = count($class['Discussion']); ?>
    <?php echo $this->element('main_tab', array('id' => $class['OnlineClass']['id'], 'activetab' => 2, 'discussionscount' => $dCount, 'projectcount' => $pCount)) ?>
  </div>
  <hr />
</div>

<div class="contentarea">

  <div class="" id="class_lessons">
    
    <div class="class_view_middle">
      <h1>Project Task</h1>
      <br /><br /><br /><br /><br /><br /><br /><br />
    </div>
    
    <div class="class_view_right">
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    
    $('ul.sidebar_panel_gray>li>a').click(function(e) {
      e.preventDefault();
      $('.tab').hide();
      $($(this).attr('href')).show();
      $('ul.sidebar_panel_gray>li').removeClass('active');
      $(this).parent('li').addClass('active');
    });
    window.scrollTo(0, 623);

  });
</script>