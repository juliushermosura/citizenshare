<div class="contentarea">
  <h2><?php echo $class['OnlineClass']['title'] ?></h2>
  <h3><?php echo $class['OnlineClass']['teacher_professional_title'] ?></h3>

  <?php if (empty($class['Project'])) $pCount = 0; else $pCount = count($class['Project']); ?>
  <?php if (empty($class['Discussion'])) $dCount = 0; else $dCount = count($class['Discussion']); ?>
  <?php echo $this->element('main_tab', array('id' => $class['OnlineClass']['id'], 'activetab' => 3, 'discussionscount' => $dCount, 'projectcount' => $pCount)) ?>
  <hr />

  <br />


  <div class="" id="public_discussions">

    <div class="class_view_left">
      <?php echo $this->element('sidebar_left_discussions', array('active' => 'events', 'id' => $class['OnlineClass']['id'])) ?>
    </div>
    
    <div class="class_view_middle expand">
      
      <?php if (AuthComponent::user('id')): ?>
        <script type="text/javascript" src="/js/tinymce/jquery.tinymce.min.js"></script>
        <div id="inline">
          <form id="discussionsform" method="post">
            <label for="discussionmessage">New Post</label>
            <hr />
            <div class="input text">
              <label for="discussiontitle">Title</label>
              <input type="text" class="discuss" id="discussiontitle" name="data[Discussion][message]" />
              <input type="hidden" class="discuss" id="discussiontype" name="data[Discussion][type]" value="events" />
            </div>
            <div class="input text">
              <label for="discussiondesc">Description</label>
              <textarea name="data[Discussion][message]" id="discussionmessage"></textarea>
            </div>
            <div class="submit">
              <input type="submit" value="Create" class="btn btn-green" />
            </div>
          </form>
        </div>
      <?php endif ?>
      
      <div class="" id="discussions">
      <h2>Events</h2>
      <?php if (AuthComponent::user('id')): ?>
        
        <div class="discussion_newpost">
          <a href="#inline" class="btn btn-green">New Post</a>
        </div>
      <?php else: ?>
        <h3 class="cd-sign-nav">You must <a href="#cd-signin" class="cd-signin">sign in</a> or <a href="#cd-signup" class="cd-signup">sign up</a> to post a discussion.</h3>
      <?php endif ?>
      <?php if (!empty($discussion)): ?>
      <ul class="discussion_list">
      <?php foreach($discussion as $discuss): ?>
        <li>
          <div class="floatleft border">
            <?php if (empty($discuss['MyLike'])): ?>
            <div class="icon-heart2 circlered"></div>
          <?php else: ?>
            <?php if ($discuss['MyLike']['like'] == 0): ?>
            <div class="icon-heart2 circlered"></div>
            <?php else: ?>
            <div class="icon-heart circlered"></div>
            <?php endif ?>
          <?php endif ?>
          <center><?php echo empty($discuss['LikeCount']) ? 0 : count($discuss['LikeCount'])  ?></center>
          </div>
          <div class="overflowauto">
            <div class="message"><a href="/discussions/view/<?php echo $discuss['Discussion']['id'] ?>" class="discussion_title"><?php echo $discuss['Discussion']['title'] ?></a></div>
          </div>
          <div class="actions">
            <span><a href="/discussions/view/<?php echo $discuss['Discussion']['id'] ?>" class="discussion_reply"><?php echo count($discuss['Comment']) ?> <?php echo count($discuss['Comment']) > 1 ? 'Comments' : 'Comment' ?></a></span> &#8226; 
            <span class="name"><a href="<?php echo SITE_URL ?>/users/profile/<?php echo $discuss['User']['id'] ?>" class="discussion_reply"><?php echo $discuss['User']['Profile']['0']['first_name'] . ' ' . $discuss['User']['Profile']['0']['last_name'] ?></a></span> &#8226; 
            <span class="date"><?php echo (date('Y', strtotime($discuss['Discussion']['created'])) == date('Y')) ? date('F dS', strtotime($discuss['Discussion']['created'])) : date('F dS, Y', strtotime($discuss['Discussion']['created'])) ?></span>
          </div>
        </li>
      <?php endforeach ?>
      </ul>
      <div class="pagination"><?php echo $this->Paginator->numbers(array('before'=> 'Page: ')) ?></div>
      <?php else: ?>
      <h3 class="empty">No discussion yet. Be the first to start a discussion.</h3>
      <?php endif ?>
      </div>
      
    </div>  
  </div>
</div>

<?php echo $this->element('script_discussions', array('class_id' => $class['OnlineClass']['id'], 'discussion_id' => null)) ?>
