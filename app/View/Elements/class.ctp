    <div class="classes floatleft">
      <div>
        <a class="teacher_photo_link" href="/classes/view/<?php echo $class['OnlineClass']['id'] ?>">
          <div class="teacher_photo">
            <div class="play_overlay"><img src="/img/play.png" border="0" /></div>
            <img src="/files/<?php echo $class['OnlineClass']['user_id'] ?>/class/<?php echo $class['File']['name'] ?>" border="0" />
            <div class="save_class">save</div>
          </div>
        </a>
      </div>
      <!-- <div class="rate"><img src="/img/approve_icon.png" border="0" /><br />100%</div> -->
      <div class="class_detail_container">
        <div class="expert_classes">
            <h3><a href="/classes/view/<?php echo $class['OnlineClass']['id'] ?>"><?php echo $class['OnlineClass']['title'] ?></a></h3>
        </div>
        <!-- <div class="expert_name clearboth">
            <h4><?php echo $class['OnlineClass']['teacher_professional_title'] ?></h4>
        </div>
        <div class="class_description">
            <h4><?php echo $class['OnlineClass']['teaser'] ?></h4>
        </div> -->
        <?php echo $this->element('avatar', array('size' => 'small', 'vars' => $class, 'container' => 'div')) ?>																
        <?php //echo $this->element('name', array('vars' => $class, 'container' => 'div', 'class_stat' => '<span class="class_stat"> &nbsp; | &nbsp; <img src="/img/student_icon.png" border="0" /> 8 &nbsp; | &nbsp; ' . $class['ClassCategory']['title'] . '</span>')) ?>
      <?php echo $this->element('name', array('vars' => $class, 'container' => 'div')) ?>
      </div>
    </div>
