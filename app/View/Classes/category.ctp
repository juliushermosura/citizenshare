<?php if (!empty($category)): ?>
<hr class="margintop50" />
<div class="class_save_notification">Saved to your account <span class="close">x</span></div><div class="contentarea2">
  <h2 class="colorgray">
    <?php echo $category['ClassCategory']['title'] ?>
  </h2>
  <div class="category_follow">
    <div class="inlineblock"><span class="count">111,565</span> Followers</div>
    <div class="inlineblock"><a href="#" class="btn btn-red btn-ghost">FOLLOW</a></div>
  </div>
  <h4 class="colorgray" style="clear:both">Learn from people around the world with real-world skills.</h4>
</div>
<?php endif ?>
<hr class="margintop30" />

<div class="contentarea paddingtop10 paddinghorizontal0 minheight375">
<?php if (!empty($classes)): ?>
<?php foreach($classes as $class): ?>
<?php echo $this->element('class', array('class' => $class)) ?>
<?php endforeach ?>
<?php else: ?>
<h3>No class belongs to this category.</h3>
<?php endif ?>
</div>
