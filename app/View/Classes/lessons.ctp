<div class="contentarea">
  <h2><?php echo $class['OnlineClass']['title'] ?></h2>
  <h3><?php echo $class['OnlineClass']['teacher_professional_title'] ?></h3>

  <?php if (empty($class['Project'])) $pCount = 0; else $pCount = count($class['Project']); ?>
  <?php if (empty($class['Discussion'])) $dCount = 0; else $dCount = count($class['Discussion']); ?>
  <?php echo $this->element('main_tab', array('id' => $class['OnlineClass']['id'], 'activetab' => 2, 'discussionscount' => $dCount, 'projectcount' => $pCount)) ?>
  <hr />

  <br />
  <div class="" id="class_lessons">

    <div class="class_view_left">
      <div class="title">Lessons</div>
      <ul class="sidebar_panel_gray">
      <?php $ctr = 0 ?>
      <?php foreach($class['Lesson'] as $lesson): ?>
        <li<?php echo ($ctr == 0) ? ' class="active"' : '' ?>><a href="#lesson2-<?php echo $lesson['id'] ?>" class="lesson2"><?php echo $lesson['title'] ?></a></li>
        <?php $ctr++ ?>
      <?php endforeach ?>
      </ul>
    </div>
    
    <div class="class_view_middle">
      <div id="lessons2">
      <?php if (!empty($class['Lesson'])): ?>
        <?php $ctr = 0 ?>
        <?php foreach($class['Lesson'] as $lesson): ?>
        <div id="lesson2-<?php echo $lesson['id'] ?>" class="tab"<?php echo ($ctr == 0) ? ' style="display:block;"' : '' ?>>
          <div class="title">
            <h2><?php echo $lesson['title'] ?></h2>
          </div>
          <div class="description"><?php echo $lesson['description'] ?></div>
          <div class="video_container">
          <?php $wistia = json_decode($lesson['wistia'], TRUE) ?>
          <?php
          unset($image);
          foreach($wistia['assets'] as $asset) {
            if ($asset['type'] == 'StillImageFile') {
              $image = $asset;
            }
          }
          ?>
          <?php if (AuthComponent::user('id') && AuthComponent::user('id') == $lesson['user_id']): //add or enrolled to this class ?>
          <?php echo $wistia['embedCode'] ?>
          <?php else: ?>
          <div class="image_container">
            <img src="<?php echo $image['url'] ?>" />
            <div class="restricted">Purchase this class to view video lessons.</div>
          </div>
          <?php endif ?>
          </div>
        </div>
        <?php $ctr++ ?>
        <?php endforeach ?>
      <?php endif ?>
      </div>
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
    
  });
</script>