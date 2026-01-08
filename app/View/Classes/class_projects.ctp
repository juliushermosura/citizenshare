<section class="fixed-bg cd-service classes_home" id="intro">
</section>

<div class="content_header">
  <hr style="margin-top: 0;" />
  <div class="contentarea paddingtop10 paddinghorizontal0">
    <?php echo $this->element('content_header') ?>
    <?php if (empty($class['Project'])) $pCount = 0; else $pCount = count($class['Project']); ?>
    <?php if (empty($class['Discussion'])) $dCount = 0; else $dCount = count($class['Discussion']); ?>
    <?php echo $this->element('main_tab', array('id' => $class['OnlineClass']['id'], 'activetab' => 4, 'discussionscount' => $dCount, 'projectcount' => $pCount)) ?>
  </div>
  <hr />
</div>

<div class="contentarea">
  <div class="" id="projects">
    
    <div class="">
        <?php if (!empty($class['Project'])): ?>
  <?php foreach($class['Project'] as $project): ?>
    <div class="project_container big">
      <div class="project_image_container"><a href="/projects/view/<?php echo $project['id'] ?>"><img src="/files/<?php echo $project['user_id'] ?>/project/<?php echo $project['File']['name'] ?>" border="0" /></a></div>
      <div class="details">
        <div class="description">
          <?php echo $this->Text->truncate($project['title'], 52, array('ellipsis' => '...', 'exact' => false)) ?>
        </div>
        <?php echo $this->element('avatar', array('size' => 'xsmall', 'vars' => $project, 'container' => 'div')) ?>																
        <?php echo $this->element('name', array('vars' => $project, 'container' => 'div')) ?>
      </div>
      <div class="likecomment"><span class="icon-heart"></span> <span class="likecount"><?php echo empty($project['LikeCount']) ? 0 : count($project['LikeCount']) ?></span> &nbsp; &nbsp; <span class="icon-comment"></span> <span class="commentcount"><?php echo empty($project['CommentCount']) ? 0 : count($project['CommentCount']) ?></span></div>
      <div class="class_title"><a href="/classes/view/<?php echo $project['OnlineClass']['id'] ?>"><?php echo $this->Text->truncate($project['OnlineClass']['title'], 22, array('ellipsis' => '...', 'exact' => false)) ?></a></div>
    </div> 
  <?php endforeach ?>
        <?php else: ?>
        <h3>Coming soon.</h3>
        <?php endif ?>
    </div>
    
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    window.scrollTo(0, 623);
  });
</script>