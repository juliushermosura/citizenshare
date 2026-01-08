  <div class="main_tab">
    <span><a href="/classes/view/<?php echo $id ?>"<?php echo ($activetab == 1) ? ' class="active"' : '' ?>>Home</a></span>
    <span><a href="/classes/view/<?php echo $id ?>/project_task"<?php echo ($activetab == 2) ? ' class="active"' : '' ?>>Project task</a></span>
    <span><a href="/classes/view/<?php echo $id ?>/conversations"<?php echo ($activetab == 3) ? ' class="active"' : '' ?>>Conversations <?php echo !empty($discussionscount) ? '<sup>'.$discussionscount.'</sup>' : '' ?></a></span>
    <span><a href="/classes/view/<?php echo $id ?>/class_projects"<?php echo ($activetab == 4) ? ' class="active"' : '' ?>>Class Projects <?php echo !empty($projectcount) ? '<sup>'.$projectcount.'</sup>' : '' ?></a></span>
  </div>
