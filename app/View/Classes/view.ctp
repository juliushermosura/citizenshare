<section class="fixed-bg cd-service classes_home" id="intro">
</section>

<div class="fixed_container">
  <div class="content_header">
    <hr style="margin-top:0" />
    <div class="contentarea paddingtop10 paddinghorizontal0">
      <div class="floatleft">
      <?php echo $this->element('content_header') ?>
      <?php if (empty($class['Project'])) $pCount = 0; else $pCount = count($class['Project']); ?>
      <?php if (empty($class['Discussion'])) $dCount = 0; else $dCount = count($class['Discussion']); ?>
      <?php echo $this->element('main_tab', array('id' => $class['OnlineClass']['id'], 'activetab' => 1, 'discussionscount' => $dCount, 'projectcount' => $pCount)) ?>
      </div>
      <div class="floatright boxes">
        <!-- <img src="/img/boxes.png" border="0" style="width: 400px" /> -->
        <li><div class="studentcount">18</div><div>Students</div></li>
        <li>
          <a href="#reviews" class="reviewpopup">
            <div class="reviewcount"><img border="0" src="/img/approve_icon.png" />
              <span>98%</span>
            </div>
            <div class="underline"><span><?php echo count($class['Review']) ?></span> Reviews</div>
          </a>
        </li>
        <li><a href="#share" class="sharepopup"><div class="share"><img border="0" src="/img/share_icon.png" /></div><div class="underline">Share</div></a></li>
        <li><a href="#save" class="save"><div class="save_icon">+</div><div class="underline">Save</div></a></li>
      </div>
    </div>
    <hr />
  </div>
  <div class="contentarea paddinghorizontal0 paddingtop10">
    <div class="toptab" id="class_info" style="display: block;">
  
      <div class="tab">
          <div class="share" id="share">
            <!-- <li><div class="fb-share-button" data-href="<?php echo $this->here ?>" data-layout="icon_link"></div></li>
            <li>
              <a class="twitter-share-button" data-count="none" href="<?php echo $this->here ?>">Tweet</a>
              <script type="text/javascript">
                window.twttr=(function(d,s,id){var t,js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);return window.twttr||(t={_e:[],ready:function(f){t._e.push(f)}})}(document,"script","twitter-wjs"));
              </script>
            </li> -->
            <li><a href="#"><img src="/img/facebook_share_icon.png" border="0" /></a></li>
            <li><a href="#"><img src="/img/pinterest_share_icon.png" border="0" /></a></li>
            <li><a href="#"><img src="/img/twitter_share_icon.png" border="0" /></a></li>
            <div class="greenbox">
              <div class="title">Message</div>
              <textarea>Take this class with me</textarea>
            </div>
            <div class="padding10">
              <div class="class_title">Class Title</div>
              <div class="class_title_title">How to create a class</div>
            </div>
            <div class="share_vid"><img src="/img/rabbit_video.png" border="0" /></div>
          </div>
  
        <div id="about" class="tab" style="display: block;">
        <?php if (!empty($class['OnlineClass'])): ?>
          <div class="viewport"><?php $ctr=1 ?>
          <?php foreach($class['Lesson'] as $lesson): ?>
          <?php $wistia = json_decode($lesson['wistia'], TRUE); ?>
          <?php
              unset($image);
              if (!empty($wistia['assets'])) {
                  foreach($wistia['assets'] as $asset) {
                    if ($asset['type'] == 'StillImageFile') {
                      $image = $asset;
                    }
                  }
              }
          ?>
                  <?php if (AuthComponent::user('id') && AuthComponent::user('id') == $lesson['user_id']): //add or enrolled to this class ?>
                  <iframe class="image_container" id="vid-<?php echo $lesson['id'] ?>" src="http://fast.wistia.com/embed/iframe/<?php echo $wistia['hashed_id'] ?>" frameborder="0" scrolling="no" allowtransparency="true" width="100%"></iframe>
                  <?php else: ?>
                  <div class="image_container" id="vid-<?php echo $lesson['id'] ?>">
                    <img src="/files/default/microsite/default_masthead.jpg<?php //echo $image['url'] ?>" />
                    <div class="play_overlay"><a href="#" class="play_disabled"><img src="/img/play.png" border="0" /></a></div>
                    <div class="restricted">Join Class</div>
                  </div>
              <?php endif ?>
          <?php endforeach ?>
          </div>
          <div class="expand2">
            <div class="join_class">
              <div class="floatright"><a href="#"><img src="/img/join2.png" border="0" /></a></div>
              <div class="total_vids">4 VIDEOS (5 s)</div>
            </div>
            <div class="playlist">
              <?php if (!empty($class['OnlineClass'])): ?>
              <?php $ctr = 1 ?>
            <?php foreach($class['Lesson'] as $lesson): ?>
              <li class="vid-<?php echo $lesson['id'] ?>">
                <div class="play_btn">&#9654;<!-- <img src="/img/play.png" border="0" /> --></div>
                <?php
                $seconds = $wistia['duration'];
                $hours = floor($seconds / 3600);
                $mins = floor(($seconds - ($hours*3600)) / 60);
                $secs = floor($seconds % 60);
                ?>
                <div class="title"><?php echo $ctr . ' ' . $lesson['title'] ?><div class="floatright duration"><?php echo $mins ?>:<?php echo $secs ?></div></div>
                <?php $ctr++ ?>
              </li>
              <?php endforeach ?>
                      <?php foreach($class['Lesson'] as $lesson): ?>
              <li class="vid-<?php echo $lesson['id'] ?>">
                <div class="play_btn">&#9654;<!-- <img src="/img/play.png" border="0" /> --></div>
                <?php
                $seconds = $wistia['duration'];
                $hours = floor($seconds / 3600);
                $mins = floor(($seconds - ($hours*3600)) / 60);
                $secs = floor($seconds % 60);
                ?>
                <div class="title"><?php echo $ctr . ' ' .$lesson['title'] ?><div class="floatright duration"><?php echo $mins ?>:<?php echo $secs ?></div></div>
                <?php $ctr++ ?>
              </li>
              <?php endforeach ?>
              <?php endif ?>
            </div>
          </div>
          <div class="share_link_bar">
            <img src="/img/share_link_bar.png" border="0" />
          </div>
          
          <hr class="margintop10" />
          <!-- <div class="class_stats">
            <span class="class_stat btn btn-gray bordernone colorgray"><img src="/img/student_icon.png" border="0" /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 8</span>
            <span class="class_stat btn btn-gray bordernone colorgray"><a href="#reviews" class="reviewpopup"><img src="/img/approve_icon.png" border="0" /> --%</a></span>
          </div> -->
          <div class="lesson_details2" style="width: 480px; float: left">
            <h2>About the Class</h2>
            <div class="description"><?php echo $class['OnlineClass']['description'] ?></div>
            <h2>More Information</h2>
            <div>Level: <span class="level"><?php echo $class['OnlineClass']['level'] ?></span></div>
            <div>Tags: <span class="tags"><a href="#">Fashion Design</a></span></div>
          </div>
          <div class="discussion_details2" style="float: right; width: 420px;">
            <h2>Conversations</h2>
            <div class="seeall"><a href="/classes/view/<?php echo $class['OnlineClass']['id'] ?>/conversations">See All</a></div>
            <?php if (!empty($discussion)): ?>
            <ul class="discussion_list">
              <?php $ctr = 0 ?>
            <?php foreach($discussion as $discuss): ?>
              <?php if ($ctr >= 4) break ?>
              <?php $ctr++ ?>
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
                      <a href="<?php echo SITE_URL ?>/users/profile/<?php echo $discuss['User']['id'] ?>" class="discussion_reply"><?php echo $discuss['User']['Profile']['0']['first_name'] . ' ' . $discuss['User']['Profile']['0']['last_name'] ?></a></span> &#8226;
                      <div class="teacher"><img src="/img/teacher.png" border="0" /></div>
                    </div>
                  <span class="date"><?php echo (date('Y', strtotime($discuss['Discussion']['created'])) == date('Y')) ? date('F dS', strtotime($discuss['Discussion']['created'])) : date('F dS, Y', strtotime($discuss['Discussion']['created'])) ?></span>
                </div>
              </li>
            <?php endforeach ?>
            </ul>
            <?php else: ?>
            <h3 class="empty">No conversation yet. Be the first to start a conversation.</h3>
            <?php endif ?>
          </div>
        <?php endif ?>
        </div>
        
        <div id="reviews" class="tab" style="display: none">
        <h2>Reviews</h2>
        <?php if (AuthComponent::user('id')): ?>
          <script type="text/javascript" src="/js/tinymce/jquery.tinymce.min.js"></script>
          <div id="inline">
            <form id="reviewsform" method="post">
              <label for="discussionmessage">New Post</label>
              <hr />
              <div class="input text">
                <label for="reviewmessage">Description</label>
                <textarea name="data[Review][message]" id="reviewmessage"></textarea>
              </div>
              <div class="submit">
                <input type="submit" value="Create" class="btn btn-green" />
              </div>
            </form>
          </div>
        <?php endif ?>
        
         <?php if (!empty($class['Review'])): ?>
          <?php if (AuthComponent::user('id')): ?>
          
          <div class="review_newpost">
            <a href="#inline" class="btn btn-green">New Review</a>
          </div>
          <?php else: ?>
          <h3 class="cd-sign-nav">You must <a href="#cd-signin" class="cd-signin">sign in</a> or <a href="#cd-signup" class="cd-signup">sign up</a> to post your review.</h3>
          <?php endif ?>
        <ul class="review_list">
        <?php foreach($class['Review'] as $review): ?>
          <li>
            <div class="message"><?php echo $review['message'] ?></div>
            <div class="author">
              <?php //echo $this->element('avatar', array('size' => 'small', 'vars' => $review, 'container' => 'span')) ?>
              <?php echo $this->element('name', array('vars' => $review, 'container' => 'span')) ?>
              <span class="date"><?php //echo date('M d, Y H:i:s', strtotime($review['created'])) ?></span>
            </div>
          </li>
        <?php endforeach ?>
        </ul>
        <?php else: ?>
        <h3>No reviews yet. Be the first to write a review.</h3>
        <?php endif ?>
        </div>
      </div>
  
      <div class="other_projects">
        <h1>Class Projects</h1>
  
          <?php if (!empty($class['Project'])): ?>
    <?php foreach($class['Project'] as $project): ?>
      <div class="project_container big">
        <div class="project_image_container"><a href="/projects/view/<?php echo $project['id'] ?>"><img src="/files/<?php echo $project['user_id'] ?>/project/<?php echo $project['File']['name'] ?>" border="0" /></a></div>
        <div class="details">
          <div class="description">
            <?php echo $this->Text->truncate($project['description'], 250, array('ellipsis' => '...', 'exact' => false)) ?>
          </div>
          <?php echo $this->element('avatar', array('size' => 'small', 'vars' => $project, 'container' => 'div')) ?>																
          <div class="title"><a href="/projects/view/<?php echo $project['id'] ?>"><?php echo $project['title'] ?></a></div>
          <?php echo $this->element('name', array('vars' => $project, 'container' => 'div')) ?>
        </div>
        <div class="likecomment"><span class="icon-heart"></span> <span class="likecount"><?php echo empty($project['LikeCount']) ? 0 : count($project['LikeCount']) ?></span> &nbsp; &nbsp; <span class="icon-comment"></span> <span class="commentcount"><?php echo empty($project['CommentCount']) ? 0 : count($project['CommentCount']) ?></span></div>
        <div class="class_title"><a href="/classes/view/<?php echo $project['OnlineClass']['id'] ?>"><?php echo $this->Text->truncate($project['OnlineClass']['title'], 22, array('ellipsis' => '...', 'exact' => false)) ?></a></div>
      </div> 
    <?php endforeach ?>
          <?php else: ?>
          <h3>Coming soon.</h3>
          <?php endif ?>
          
          <hr />
        <h1>Other Projects</h1>
          <?php if (!empty($class['Project'])): ?>
    <?php foreach($class['Project'] as $project): ?>
      <div class="project_container big">
        <div class="project_image_container"><a href="/projects/view/<?php echo $project['id'] ?>"><img src="/files/<?php echo $project['user_id'] ?>/project/<?php echo $project['File']['name'] ?>" border="0" /></a></div>
        <div class="details">
          <div class="description">
            <?php echo $this->Text->truncate($project['title'], 52, array('ellipsis' => '...', 'exact' => false)) ?>
          </div>
          <?php echo $this->element('avatar', array('size' => 'xsmall', 'vars' => $project, 'container' => 'div')) ?>																
          <?php echo $this->element('name', array('vars' => $project, 'container' => 'div')) ?>
        </div>
        <div class="likecomment"><span class="icon-heart"></span> <span class="likecount"><?php echo empty($project['LikeCount']) ? 0 : count($project['LikeCount']) ?></span> &nbsp; &nbsp; <span class="icon-comment"></span> <span class="commentcount"><?php echo empty($project['CommentCount']) ? 0 : count($project['CommentCount']) ?></span></div>
        <div class="class_title"><a href="/classes/view/<?php echo $project['OnlineClass']['id'] ?>"><?php echo $this->Text->truncate($project['OnlineClass']['title'], 22, array('ellipsis' => '...', 'exact' => false)) ?></a></div>
      </div> 
    <?php endforeach ?>
          <?php else: ?>
          <h3>Coming soon.</h3>
          <?php endif ?>
  
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="/css/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="/js/jquery.fancybox.js?v=2.1.5"></script>

<script type="text/javascript">
  $(document).ready(function() {
    var class_id = "<?php echo $class['OnlineClass']['id'] ?>";
    
    $('ul.sidebar_panel_gray>li>a').click(function(e) {
      e.preventDefault();
      $('.tab').hide();
      $($(this).attr('href')).show();
    });

    $('ul.sidebar_panel_gray>li>ul.submenu>li>a.lesson').click(function() {
      $('.subtab').hide();
      $($(this).attr('href')).show();
    });

    $('ul.sidebar_panel_gray>li>a.lesson2').click(function() {
      $('div.subtab2').hide();
      $($(this).attr('href')).show();
    });

    $("#reviewsform").submit(function(e) {
      e.preventDefault();
      if ($("#reviewmessage").val().length > 1) {
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "/reviews/add",
          data: { message: $("#reviewmessage").val(), online_class_id: class_id }
        })
        .done(function( message ) {
          $("ul.review_list").prepend('<li class="fresh"><div class="author"><span class="avatar-small"><img src="/files/'+ message.user_id +'/user/' + message.avatar + '" border="0" class="avatar-image"></span><span class="name">' + message.full_name + '</span><span class="date">' + message.date + '</span></div><div class="message">' + $("#reviewmessage").val() + '</div></li>');
          $("#reviewmessage").val("");
          parent.jQuery.fancybox.close();
        });
      }
    });
    
    $("ul.sidebar_panel_gray>li").click(function() {
      $('ul.sidebar_panel_gray>li').removeClass('active');
      $(this).addClass('active');
    });
    
    $(".review_newpost a.btn").fancybox({
      maxWidth	: 400,
      maxHeight	: 600,
      fitToView	: false,
      width		: '50%',
      height		: '100%',
      autoSize	: false,
      closeClick	: false,
      scrolling: 'no',
      openEffect	: 'none',
      closeEffect	: 'none'<?php if (AuthComponent::user('id')): ?>,
      helpers: {
        overlay: {
          locked: false
        }
      },
      beforeShow: function() {
          $('textarea#reviewmessage').tinymce({
            // Location of TinyMCE script
            script_url : '/js/tinymce/tinymce.min.js',
            toolbar: "bold italic underline | bullist numlist outdent indent | link image",
            menubar: false,
            schema: "html5",
            height: 300
          });
      },
      beforeClose: function() { tinyMCE.remove(); }
      <?php endif ?>
    });
    
    $("a.reviewpopup").fancybox({
      maxWidth	: 400,
      maxHeight	: 600,
      fitToView	: false,
      scrolling: 'no',
      width		: '50%',
      height		: '100%',
      autoSize	: false,
      closeClick	: false,
      openEffect	: 'none',
      closeEffect	: 'none',
      helpers: {
        overlay: {
          locked: false
        }
      }
    });

    $("a.sharepopup").fancybox({
      maxWidth	: 410,
      maxHeight	: 600,
      fitToView	: false,
      width		: '50%',
      height		: '100%',
      autoSize	: false,
      closeClick	: false,
      openEffect	: 'none',
      scrolling: 'no',
      closeEffect	: 'none',
      helpers: {
        overlay: {
          locked: false
        }
      }
    });
    
    $('.play_disabled').click(function(e) {
      e.preventDefault();
      $(this).parents('.play_overlay').next('.restricted').show();
    });
    
    $('.playlist li').click(function(e) {
							e.preventDefault();							
							$('.viewport .image_container').hide();
       $('.restricted').hide();
							$('#' + $(this).attr('class')).show();
    });
    
    $('.heartthis').click(function(e) {
      e.preventDefault();
      $(this).find('tr:first-child').addClass('heartened');
      $(this).find('tr:last-child').find('td').find('center').text(parseInt($(this).find('tr:last-child').find('td').find('center').text()) + 1);
    });
window.scrollTo(0, 623);

  });
</script>

<style>
  .cd-header {
    background: rgba(255,255,255,0.9) !important;
  }
</style>