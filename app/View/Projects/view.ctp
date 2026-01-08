<div class="contentarea">
    <h2><?php echo $class['OnlineClass']['title'] ?></h2>
    <h3><?php echo $class['OnlineClass']['teacher_professional_title'] ?></h3>

  <?php if (empty($class['OnlineClass']['Project'])) $pCount = 0; else $pCount = count($class['OnlineClass']['Project']); ?>
  <?php if (empty($class['OnlineClass']['Discussion'])) $dCount = 0; else $dCount = count($class['OnlineClass']['Discussion']); ?>
  <?php echo $this->element('main_tab', array('id' => $class['OnlineClass']['id'], 'activetab' => 4, 'discussionscount' => $dCount, 'projectcount' => $pCount)) ?>
    <hr />

  <br />

  <div class="" id="projects">
    
				<div class="class_view_right">
								<div class="positionfixed">
												<div class="project_creator">
																<div class="title">Project by</div>
																<?php echo $this->element('avatar', array('size' => 'small', 'vars' => $class, 'container' => 'span')) ?>
																<?php echo $this->element('name', array('vars' => $class, 'container' => 'span')) ?>
												</div>
												<div class="project_stat">
																<div class="title">Stats</div>
																<div class="likecomment"><span class="icon-heart"></span> <span class="likecount"><?php echo empty($class['LikeCount']) ? 0 : count($class['LikeCount']) ?></span> &nbsp; &nbsp; <span class="icon-comment"></span> <span class="commentcount"><?php echo empty($class['CommentCount']) ? 0 : count($class['CommentCount']) ?></span></div>
																<div class="margintop20"><a href="#" class="btn btn-green leavecomment">Leave Comment</a></div>
												</div>
												<div class="project_share">
																<div class="title">Share</div>
																<div><a href="#">Facebook</a></div>
																<div><a href="#">Twitter</a></div>
																<div><a href="#">LinkedIn</a></div>
																<div><a href="#">Pinterest</a></div>
												</div>
								</div>
				</div>
				
    <div class="class_view_middle expand">
								<div class="back_to_discussion_page"><a href="/classes/view/<?php echo $class['OnlineClass']['id'] ?>/projects">&larr; Back to Projects</a></div>

								<h2 class="project_title"><?php echo $class['Project']['title'] ?></h2>
								<div class="project_date">
												<?php echo date('F d Y', strtotime($class['Project']['modified'])) ?>
												<div class="floatright width46">
            <?php if (empty($class['MyLike'])): ?>
																<div class="icon-heart2 circlered project"></div>
												<?php else: ?>
																<?php if ($class['MyLike']['like'] == 0): ?>
																<div class="icon-heart2 circlered project"></div>
																<?php else: ?>
																<div class="icon-heart circlered project"></div>
																<?php endif ?>
												<?php endif ?>
												</div>
								</div>
								<div class="project_desc">
								<?php echo $class['Project']['description'] ?>				
								</div>
								<hr />
								<div class="project_feedback_form">
												<h3>Leave Comment</h3>
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
            <h3 class="cd-sign-nav">You must <a href="#cd-signin" class="cd-signin">sign in</a> or <a href="#cd-signup" class="cd-signup">sign up</a> to reply to this post.</h3>
            <?php endif ?>
								</div>
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
          <div class="date">
												<span class="icon-heart"></span>
												<span class="likecount"><?php echo empty($comment['LikeCount']) ? 0 : count($comment['LikeCount']) ?></span>
												&nbsp;
												<a class="like_unlike" href="#<?php echo $comment['Comment']['id'] ?>"><?php echo empty($comment['MyLike']) ? 'Like' : ($comment['MyLike']['like'] == 0) ? 'Like' : 'Unlike' ?></a>
												&#8226;
												<a class="comment_reply" href="#<?php echo $comment['Comment']['id'] ?>">Reply</a>
												&#8226;
												<?php echo (date('Y', strtotime($comment['Comment']['created'])) == date('Y')) ? date('F dS', strtotime($comment['Comment']['created'])) : date('F dS, Y', strtotime($comment['Comment']['created'])) ?>
								  </div>
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
												<li class="empty">No comments yet. Be the first to post.</li>
												<?php endif ?>
								</ul>
				</div>
				
		</div> <!-- div#projects -->
</div> <!-- contentarea -->

<?php if (AuthComponent::user('id')): ?>
<script type="text/javascript" src="/js/tinymce/jquery.tinymce.min.js"></script>
<?php endif ?>

<?php echo $this->element('script_discussions', array('class_id' => $class['OnlineClass']['id'], 'discussion_id' => $class['Project']['id'], 'discuss_type' => 'project')) ?>
