<div class="contentarea">
    <h2><?php echo $class['OnlineClass']['title'] ?></h2>
    <h3><?php echo $class['OnlineClass']['teacher_professional_title'] ?></h3>

  <?php if (empty($class['Project'])) $pCount = 0; else $pCount = count($class['Project']); ?>
  <?php if (empty($class['Discussion'])) $dCount = 0; else $dCount = count($class['Discussion']); ?>
  <?php echo $this->element('main_tab', array('id' => $class['OnlineClass']['id'], 'activetab' => 4, 'discussionscount' => $dCount, 'projectcount' => $pCount)) ?>
    <hr />

  <br />

  <div class="" id="projects">
    
    <div class="class_view_middle expand">
      <h2>Projects</h2>
        <?php if (!empty($class['Project'])): ?>
        <?php foreach($class['Project'] as $project): ?>
        <div class="project_container">
          <div class="project_image_container"><a href="/projects/view/<?php echo $project['id'] ?>"><img src="/files/<?php echo $project['user_id'] ?>/project/<?php echo $project['File']['name'] ?>" border="0" /></a></div>
          <div class="details">
            <div class="avatar-small"><a href="<?php echo SITE_URL ?>/users/profile/<?php echo $project['User']['id'] ?>"><img src="/files/<?php echo $project['User']['id'] ?>/user/<?php echo empty($project['User']['File']['0']) ? 'blank-profile.png' : $project['User']['File']['0']['name']  ?>" class="avatar-image" border="0" /></a></div>
            <div class="title"><a href="/projects/view/<?php echo $project['id'] ?>"><?php echo $project['title'] ?></a></div>
            <div class="name"><a href="/users/profile/<?php echo $project['User']['id'] ?>"><?php echo $project['User']['Profile']['0']['first_name'] . ' ' . $project['User']['Profile']['0']['last_name'] ?></a></div>
            <div class="likecomment"><span class="icon-heart"></span> <span class="likecount"><?php echo empty($project['LikeCount']) ? 0 : count($project['LikeCount']) ?></span> &nbsp; &nbsp; <span class="icon-comment"></span> <span class="commentcount"><?php echo empty($project['CommentCount']) ? 0 : count($project['CommentCount']) ?></span></div>
          </div>
        </div> 
        <?php endforeach ?>
        <?php else: ?>
        <h3>Coming soon.</h3>
        <?php endif ?>
    </div>
    
  </div>
</div>