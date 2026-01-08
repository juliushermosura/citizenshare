<link rel="stylesheet" href="/css/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="/js/jquery.fancybox.js?v=2.1.5"></script>

<script type="text/javascript">
  $(document).ready(function() {
    var class_id = "<?php echo $class_id ?>";
    var discussion_id = "<?php echo $discussion_id ?>";
    var discuss_type = "<?php echo empty($discuss_type) ? 'discussion' : $discuss_type ?>";
    
    $("#discussionsform").submit(function(e) {
      e.preventDefault();
      if ($("#discussionmessage").val().length > 1) {
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "/discussions/add",
          data: { message: $("#discussionmessage").val(), online_class_id: class_id, title: $("#discussiontitle").val(), type: $("#discussiontype").val() }
        })
        .done(function( message ) {
          $('.fresh').removeClass('fresh');
          $("ul.discussion_list").prepend('<li class="fresh"><div class="message"><a href="/discussions/view/' + message.id + '" class="discussion_title">' + $("#discussiontitle").val() + '</a></div><div class="actions"><span><a class="discussion_reply" href="/discussions/view/'+ message.id +'">0 Comment</a></span> &#8226; <span><a class="discussion_reply" href="<?php echo SITE_URL ?>/users/profile/'+ message.id +'">' + message.full_name + '</a></span> &#8226; <span class="date">' + message.date + '</span></div></li>');
          $("#discussiontitle").val("");
          $("#discussionmessage").val("");
          $(".discussion_list .empty").remove();
          parent.jQuery.fancybox.close();
        });
      }
    });
    
    $(".discussion_newpost a.btn").fancybox({
      maxWidth	: 400,
      maxHeight	: 600,
      fitToView	: false,
      scrolling: 'no',
      width		: '50%',
      height		: '100%',
      autoSize	: false,
      closeClick	: false,
      openEffect	: 'none',
      closeEffect	: 'none'<?php if (AuthComponent::user('id')): ?>,
      helpers: {
        overlay: {
          locked: false
        }
      },
      beforeShow: function () {
        $('textarea#discussionmessage').tinymce({
          // Location of TinyMCE script
          script_url : '/js/tinymce/tinymce.min.js',
          toolbar: "bold italic underline | bullist numlist outdent indent",
          menubar: false,
          schema: "html5",
          height: 300
        });
      },
      beforeClose: function () { tinyMCE.remove(); }
      <?php endif ?>
    });
    
    $(document.body).on('click', '.icon-heart2', function() {
    <?php if (!AuthComponent::user('id')): ?>
      $(".cd-sign-nav a.cd-signin").click();
    <?php else: ?>
      var liked = $(this);
      var disc_id = discussion_id;
      var varurl = "/discussions/like";
      if ($(this).hasClass("project")) {
        varurl = "/projects/like";
      }
      if (disc_id.length == 0) {
        disc_id = liked.parent('div.border').next('div.overflowauto').children('div.message').children('a.discussion_title').attr('href').replace('/discussions/view/', '');
      }
      $.ajax({
        type: "POST",
        dataType: "json",
        url: varurl,
        data: { discussion_id : disc_id }
      })
      .done(function(message){
        if (message == 'success') {
          liked.addClass('icon-heart');
          liked.removeClass('icon-heart2');
          liked.next('center').text(parseInt(liked.next('center').text())+1);
          if (liked.hasClass('project')) {
            $('.project_stat .likecount').text(parseInt($('.project_stat .likecount').text())+1);
          }
        }
      });
    <?php endif ?>
    });

    $(document.body).on('click', '.icon-heart', function() {
    <?php if (!AuthComponent::user('id')): ?>
      $(".cd-sign-nav a.cd-signin").click();
    <?php else: ?>
      var unliked = $(this);
      var disc_id = discussion_id;
      var varurl = "/discussions/unlike";
      if ($(this).hasClass("project")) {
        varurl = "/projects/unlike";
      }

      if (disc_id.length == 0) {
        disc_id = unliked.parent('div.border').next('div.overflowauto').children('div.message').children('a.discussion_title').attr('href').replace('/discussions/view/', '');
      }
      $.ajax({
        type: "POST",
        dataType: "json",
        url: varurl,
        data: { discussion_id : disc_id }
      })
      .done(function(message){
        if (message == 'success') {
          unliked.addClass('icon-heart2');
          unliked.removeClass('icon-heart');
          unliked.next('center').text(parseInt(unliked.next('center').text())-1);
          if (unliked.hasClass('project')) {
            $('.project_stat .likecount').text(parseInt($('.project_stat .likecount').text())-1);
          }
        }
      });
    <?php endif ?>
    });
    
    <?php if (AuthComponent::user('id')): ?>    
    $('.leavecomment').click(function(e) {
      e.preventDefault();
      tinyMCE.get('project_reply_message').focus();
    });
    <?php endif ?>
    
    <?php if (!empty($discussion_id)): ?>
      <?php if (AuthComponent::user('id')): ?>
    $('textarea.discuss_reply_message').tinymce({
      // Location of TinyMCE script
      script_url : '/js/tinymce/tinymce.min.js',
      toolbar: "bold italic underline | bullist numlist outdent indent",
      menubar: false,
      schema: "html5",
      height: 100
    });
      <?php endif ?>
    
    $(document.body).on('click', 'a.like_unlike', function(e) {
      e.preventDefault();
      <?php if (!AuthComponent::user('id')): ?>
      $(".cd-sign-nav a.cd-signin").click();
      <?php else: ?>
      var likethis = $(this);
      var likeval = 0;
      if ($(this).text() == "Like") {
        likeval = 1;
      }
      $.ajax({
        type: "POST",
        dataType: "json",
        url: "/comments/like_unlike",
        data: { comment_id : likethis.attr('href').replace('#', ''), likeval: likeval }
      })
      .done(function(message){
        if (message == 'success') {
          if (likeval == 1) {
            likethis.text("Unlike");
            likethis.prev('span.likecount').text(parseInt(likethis.prev('span.likecount').text())+1);
          } else {
            likethis.text("Like");
            likethis.prev('span.likecount').text(parseInt(likethis.prev('span.likecount').text())-1);
          }
        }
      });
      <?php endif ?>
    });
        
    <?php if (AuthComponent::user('id')): ?>

    $('.discuss_reply_form').submit(function(e) {
      e.preventDefault();
      var form = $(this);
      if ($(this).children().children(".discuss_reply_message").val().length > 1) {
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "/comments/add",
          data: { message: form.children().children(".discuss_reply_message").val(), parent_id: discussion_id, type: discuss_type }
        })
        .done(function( message ) {
          $('.fresh').removeClass('fresh');
          $("ul.post_list").append('<li class="fresh"><div class="author"><span class="avatar-small"><a href="<?php echo SITE_URL ?>/users/profile/'+ message.user_id +'"><img src="/files/'+ message.user_id +'/user/' + message.avatar + '" border="0" class="avatar-image"></a></span><span class="name"><a href="<?php echo SITE_URL ?>/users/profile/'+ message.user_id +'">' + message.full_name + '</a></span></div><div class="message">' + form.children().children(".discuss_reply_message").val() + '</div><div class="date"><span class="icon-heart"></span> <span class="likecount">0</span> &nbsp; <a href="#' + message.id + '" class="like_unlike">Like</a> &#8226; <a href="#' + message.id + '" class="comment_reply">Reply</a> &#8226; ' + message.date + '</div><div class="floatright marginleft60"><ul></ul><form class="comment_reply_form" method="post" rel="' + message.id + '"><div class="input text"><input name="data[Comment][message]" class="comment_reply_message"></div><div class="submit"><input type="submit" value="Post" class="btn btn-green"></div></form></div></li>');
          form.children().children(".discuss_reply_message").val("");
          $(".post_list .empty").remove();
          $("html, body").animate({ scrollTop: $(document).height() }, "slow");
        });
      }
    });
      
    <?php endif ?>
    
    $(document.body).on('click', '.comment_reply', function(e) {
      e.preventDefault();
      <?php if (!AuthComponent::user('id')): ?>
      $(".cd-sign-nav a.cd-signin").click();
      <?php else: ?>
      $(this).parents('.date').next('.floatright').children('form').children('div.input.text').children('.comment_reply_message').focus();
      <?php endif ?>
    });
    
    <?php if (AuthComponent::user('id')): ?>
    $(document.body).on('submit', '.comment_reply_form', function(e) {
      e.preventDefault();
      var form = $(this);
      if ($(this).children().children(".comment_reply_message").val().length > 1) {
        $.ajax({
          type: "POST",
          dataType: "json",
          url: "/comments/add",
          data: { message: form.children().children(".comment_reply_message").val(), parent_id: form.attr('rel'), type: 'comment' }
        })
        .done(function( message ) {
          $('.fresh').removeClass('fresh');
          form.prev('ul').append('<li class="fresh"><div class="author"><span class="avatar-small"><a href="<?php echo SITE_URL ?>/users/profile/'+ message.user_id +'"><img src="/files/'+ message.user_id +'/user/' + message.avatar + '" border="0" class="avatar-image"></a></span><span class="name"><a href="<?php echo SITE_URL ?>/users/profile/'+ message.user_id +'">' + message.full_name + '</a></span></div><div class="message">' + form.children().children(".comment_reply_message").val() + '</div><div class="date">' + message.date + '</div></li>');
          form.children().children(".comment_reply_message").val("");
          $(".post_list .empty").remove();
        });
      }
    });
    <?php endif ?>
    
    <?php endif ?>
  window.scrollTo(0, 623);

  });
</script>