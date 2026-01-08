<hr class="margintop50" />
<div class="contentarea2">
  <h2 class="colorgray">Projects</h2>
  <h4 class="colorgray">See the  projects people from around the world are creating</h4>
</div>
<hr class="margintop30" />

<div class="contentarea paddingtop10 paddinghorizontal0">
<?php if (!empty($projects)): ?>
  <?php foreach($projects as $project): ?>
    <div class="project_container big">
      <div class="project_image_container"><a href="/projects/view/<?php echo $project['Project']['id'] ?>"><img src="/files/<?php echo $project['Project']['user_id'] ?>/project/<?php echo $project['File']['name'] ?>" border="0" /></a></div>
      <div class="details">
        <div class="description"><a href="/projects/view/<?php echo $project['Project']['id'] ?>"><?php echo $this->Text->truncate($project['Project']['title'], 52, array('ellipsis' => '...', 'exact' => false)) ?></a></div>
        <?php echo $this->element('avatar', array('size' => 'xsmall', 'vars' => $project, 'container' => 'div')) ?>																
        
        <?php echo $this->element('name', array('vars' => $project, 'container' => 'div')) ?>
      </div>
      <div class="likecomment"><span class="icon-heart"></span> <span class="likecount"><?php echo empty($project['LikeCount']) ? 0 : count($project['LikeCount']) ?></span> &nbsp; &nbsp; <span class="icon-comment"></span> <span class="commentcount"><?php echo empty($project['CommentCount']) ? 0 : count($project['CommentCount']) ?></span></div>
      <div class="class_title"><a href="/projects/view/<?php echo $project['Project']['id'] ?>"><?php echo $this->Text->truncate($project['Project']['description'], 32, array('ellipsis' => '...', 'exact' => false)) ?></a></div>
    </div> 
  <?php endforeach ?>
<?php else: ?>
  <p>Coming Soon.</p>
<?php endif ?>
</div>