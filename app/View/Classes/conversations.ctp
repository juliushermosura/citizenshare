<section class="fixed-bg cd-service classes_home" id="intro">
</section>

<div class="content_header">
  <hr style="margin-top: 0;" />
  <div class="contentarea paddingtop10 paddinghorizontal0">
    <?php echo $this->element('content_header') ?>
    <?php if (empty($class['Project'])) $pCount = 0; else $pCount = count($class['Project']); ?>
    <?php if (empty($class['Discussion'])) $dCount = 0; else $dCount = count($class['Discussion']); ?>
    <?php echo $this->element('main_tab', array('id' => $class['OnlineClass']['id'], 'activetab' => 3, 'discussionscount' => $dCount, 'projectcount' => $pCount)) ?>
  </div>
  <hr />
</div>

<div class="contentarea">
  <div class="" id="public_discussions">

    <div class="">
      
      <?php if (AuthComponent::user('id')): ?>
        <script type="text/javascript" src="/js/tinymce/jquery.tinymce.min.js"></script>
        <div id="inline">
          <form id="discussionsform" method="post">
            <label for="discussionmessage">New Post</label>
            <hr />
            <div class="input text">
              <label for="discussiontitle">Title</label>
              <input type="text" class="discuss" id="discussiontitle" name="data[Discussion][title]" />
              <input type="hidden" class="discuss" id="discussiontype" name="data[Discussion][type]" value="public_discussions" />
            </div>
            <div class="input text">
              <label for="discussionmessage">Description</label>
              <textarea name="data[Discussion][message]" id="discussionmessage"></textarea>
            </div>
            <div class="submit">
              <input type="submit" value="Create" class="btn btn-green" />
            </div>
          </form>
        </div>
      <?php endif ?>
      
      <div class="" id="discussions">
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
              <div class="heartthis floatleft border">
              <table>
                <tr><td>
                <?php if (empty($discuss['MyLike'])): ?>
                <div class="icon-heart circlered"></div>
              <?php else: ?>
                <?php if ($discuss['MyLike']['like'] == 0): ?>
                <div class="icon-heart circlered"></div>
                <?php else: ?>
                <div class="icon-heart circlered"></div>
                <?php endif ?>
              <?php endif ?>
                </td></tr>
                <tr><td>
              <center><?php echo empty($discuss['LikeCount']) ? 0 : count($discuss['LikeCount'])  ?></center>
              </td></tr>
              </table>
              </div>
          <div class="overflowauto">
            <div class="message"><a href="/discussions/view/<?php echo $discuss['Discussion']['id'] ?>" class="discussion_title"><?php echo $discuss['Discussion']['title'] ?></a></div>
          </div>
          <div class="actions">
            <span><a href="/discussions/view/<?php echo $discuss['Discussion']['id'] ?>" class="discussion_reply"><?php echo count($discuss['Comment']) ?> <?php echo count($discuss['Comment']) > 1 ? 'Comments' : 'Comment' ?></a></span> &#8226; 
            <span class="name">
              <div class="name_container">
                <a href="<?php echo SITE_URL ?>/users/profile/<?php echo $discuss['User']['id'] ?>" class="discussion_reply"><?php echo $discuss['User']['Profile']['0']['first_name'] . ' ' . $discuss['User']['Profile']['0']['last_name'] ?></a></span>
                <div class="teacher"><img src="/img/teacher.png" border="0" /></div>
              </div>
            </span> &#8226; 
            <span class="date"><?php echo (date('Y', strtotime($discuss['Discussion']['created'])) == date('Y')) ? date('F dS', strtotime($discuss['Discussion']['created'])) : date('F dS, Y', strtotime($discuss['Discussion']['created'])) ?></span>
          </div>
        </li>
      <?php endforeach ?>
      </ul>
      <div class="pagination"><?php echo $this->Paginator->numbers(array('before'=> 'Page: ')) ?></div>
      <?php else: ?>
      <h3 class="empty">No conversation yet. Be the first to start a conversation.</h3>
      <?php endif ?>
      </div>
      
    </div>  
  </div>
</div>

<?php echo $this->element('script_discussions', array('class_id' => $class['OnlineClass']['id'], 'discussion_id' => null)) ?>
