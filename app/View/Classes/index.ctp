<hr class="margintop50" />
<div class="class_save_notification">Saved to your account <span class="close">x</span></div>
<div class="contentarea2 paddingtop10 paddinghorizontal0">
  <h4 class="colorgray">Learn from people around the world with real-world skills.</h4>
</div>

<hr class="margintop30" />

<div class="contentarea paddingtop10">
<?php if (!empty($classes)): ?>

<?php foreach($classes as $class): ?>
<?php echo $this->element('class', array('class' => $class)) ?>
<?php endforeach ?>

<?php endif ?>
</div>
