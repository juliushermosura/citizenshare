<section class="fixed-bg cd-service classes_home" id="intro">
</section>

<div class="content_header">
  <hr style="margin-top: 0;" />
  <div class="contentarea paddingtop10 paddinghorizontal0">
    <?php echo $this->element('content_header', array('class' => $discussion)) ?>
    <?php if (empty($discussion['Project'])) $pCount = 0; else $pCount = count($discussion['Project']); ?>
    <?php if (empty($discussion['Discussion'])) $dCount = 0; else $dCount = count($discussion['Discussion']); ?>
    <?php echo $this->element('main_tab', array('id' => $discussion['OnlineClass']['id'], 'activetab' => 3, 'discussionscount' => $dCount, 'projectcount' => $pCount)) ?>
  </div>
  <hr />
</div>

<div class="contentarea">

  <div class="" id="public_discussions">

    <div class="class_view_middle expand">
      <div class="discussions">
        <?php
          switch($discussion['Discussion']['type']) {
            case 'events':
              $listing = 'Events';
              break;
            case'teacher_announcements':
              $listing = 'Teacher Announcements';
              break;
            default:
              $listing = 'Public Discussions';
          }
        ?>
      <div class="back_to_discussion_page"><a href="/classes/view/<?php echo $discussion['Discussion']['online_class_id'] ?>/<?php echo $discussion['Discussion']['type'] ?>">&larr; Back to <?php echo $listing ?></a></div>
          <div class="floatleft border">
            <?php if (empty($discussion['MyLike'])): ?>
            <div class="icon-heart2 circlered"></div>
          <?php else: ?>
            <?php if ($discussion['MyLike']['like'] == 0): ?>
            <div class="icon-heart2 circlered"></div>
            <?php else: ?>
            <div class="icon-heart circlered"></div>
            <?php endif ?>
          <?php endif ?>
          <center><?php echo empty($discussion['LikeCount']) ? 0 : count($discussion['LikeCount'])  ?></center>
          </div>
          <div class="overflowauto">
            <h2><?php echo $discussion['Discussion']['title'] ?></h2>
            <div class="description">
              <?php echo $discussion['Discussion']['message'] ?>
            </div>
          </div>
      <div class="author2">
  								<?php echo $this->element('avatar', array('size' => 'small', 'vars' => $discussion, 'container' => 'span')) ?>																
  								<?php echo $this->element('name', array('vars' => $discussion, 'container' => 'span')) ?>
      </div>
      <div class="date"><?php echo (date('Y', strtotime($discussion['Discussion']['created'])) == date('Y')) ? date('F dS', strtotime($discussion['Discussion']['created'])) : date('F dS, Y', strtotime($discuss['Discussion']['created'])) ?></div>
      <hr />
      <h3>Comments</h3>
      <?php if (AuthComponent::user('id')): ?>

          <form class="discuss_reply_form" method="post">
            <div class="input text">
              <textarea name="data[Comment][message]" class="discuss_reply_message"></textarea>
            </div>
            <div class="submit">
              <input type="submit" value="Post" class="btn btn-green" />
            </div>
          </form>
      <?php else: ?>
        <h3 class="cd-sign-nav">You must <a href="#cd-signin" class="cd-signin">sign in</a> or <a href="#cd-signup" class="cd-signup">sign up</a> to post a discussion.</h3>
      <?php endif ?>
      <hr />
      <ul class="post_list">
      <?php if (!empty($comments)): ?>
      <?php foreach($comments as $comment): ?>
        <li>
          <div class="author">
    								<?php echo $this->element('avatar', array('size' => 'small', 'vars' => $comment, 'container' => 'span')) ?>																
            <?php echo $this->element('name', array('vars' => $comment, 'container' => 'span')) ?>
          </div>
          <div class="message"><?php echo $comment['Comment']['message'] ?></div>
          <div class="date"><span class="icon-heart"></span> <span class="likecount"><?php echo empty($comment['LikeCount']) ? 0 : count($comment['LikeCount']) ?></span> &nbsp; <a class="like_unlike" href="#<?php echo $comment['Comment']['id'] ?>"><?php echo empty($comment['MyLike']) ? 'Like' : ($comment['MyLike']['like'] == 0) ? 'Like' : 'Unlike' ?></a> &#8226; <a class="comment_reply" href="#<?php echo $comment['Comment']['id'] ?>">Reply</a> &#8226; <?php echo (date('Y', strtotime($comment['Comment']['created'])) == date('Y')) ? date('F dS', strtotime($comment['Comment']['created'])) : date('F dS, Y', strtotime($comment['Comment']['created'])) ?></div>
          <div class="floatright marginleft60">
            <ul>
              <?php if (!empty($comment['CommentReply'])): ?>
              <?php foreach ($comment['CommentReply'] as $reply_comment): ?>
              <li>
                <div class="author">
          								<?php echo $this->element('avatar', array('size' => 'small', 'vars' => $reply_comment, 'container' => 'span')) ?>
                  <?php echo $this->element('name', array('vars' => $reply_comment, 'container' => 'span')) ?>
                </div>
                <div class="message"><?php echo $reply_comment['message'] ?></div>
                <div class="date"><?php echo (date('Y', strtotime($reply_comment['created'])) == date('Y')) ? date('F dS', strtotime($reply_comment['created'])) : date('F dS, Y', strtotime($reply_comment['created'])) ?></div>
              </li>
              <?php endforeach ?>
              <?php endif ?>
            </ul>
            <?php if (AuthComponent::user('id')): ?>
            <form class="comment_reply_form" method="post" rel="<?php echo $comment['Comment']['id'] ?>" >
              <div class="input text">
                <input name="data[Comment][message]" class="comment_reply_message" />
              </div>
              <div class="submit">
                <input type="submit" value="Post" class="btn btn-green" />
              </div>
            </form>
            <?php else: ?>
            <h3 class="cd-sign-nav">You must <a href="#cd-signin" class="cd-signin">sign in</a> or <a href="#cd-signup" class="cd-signup">sign up</a> to reply to this post.</h3>
            <?php endif ?>
          </div>
        </li>
      <?php endforeach ?>
      <?php else: ?>
      <h3 class="empty">No comments yet. Be the first to comment.</h3>
      <?php endif ?>
      </ul>
      </div>
    </div>
    
  </div>
</div>

<?php if (AuthComponent::user('id')): ?>
<script type="text/javascript" src="/js/tinymce/jquery.tinymce.min.js"></script>
<?php endif ?>

<?php echo $this->element('script_discussions', array('class_id' => $discussion['OnlineClass']['id'], 'discussion_id' => $discussion['Discussion']['id'])) ?>
