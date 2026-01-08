    <h2 class="classname"><?php echo $class['OnlineClass']['title'] ?></h2>
    <?php echo $this->element('avatar', array('size' => 'small', 'vars' => $class, 'container' => 'div')) ?>																
    <?php echo $this->element('name', array('vars' => $class, 'container' => 'div', 'follow' => true)) ?>
