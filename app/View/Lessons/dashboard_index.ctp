<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<div class="headerbar">
				<p>Here you can create a class description and include the number of video lessons for the class. Collaborate with the teacher to arrive at an engaging and accurate description of their class.</p>
				<p><a href="/dashboard/lessons/add2?inline=2" data-fancybox-type="iframe" class="btn teal textcolorblue addvideolesson">Add New Lesson</a></p>
</div>

<div class="class_listing">
				<?php if (!empty($classes)): ?>
				<?php foreach($classes as $class): ?>
				<div class="class_container" rel="<?php echo $class['OnlineClass']['id'] ?>">
								<div class="class_summary2">
												<div class="class_photo"><img src="/files/<?php echo !empty($class['File']) ? $class['OnlineClass']['user_id'] : 'default' ?>/class/<?php echo !empty($class['File']) ? $class['File']['name'] : 'default.png' ?>" border="0" /></div>
												<div class="class_detail">
																<div class="title"><?php echo $class['OnlineClass']['title'] ?></div>
																<div class="description"><?php echo $class['OnlineClass']['teaser'] ?></div>
																<div class="stats">
																				<span class="students_stat">0 Student</span> &#8226;
																				<span class="type"><?php echo $class['OnlineClass']['level'] ?></span>
																</div>
												</div>
												<div class="class_reviews"></div>
								</div>
								<div class="class_update">

												<div class="toptab" id="class_info" style="display: block;">
										
														<div class="class_view_left">
																<ul class="sidebar_panel_gray">
																		<li><a class="icon-language" href="#language-<?php echo $class['OnlineClass']['id'] ?>"> Language</a></li>
																		<li class="active"><a href="#about-<?php echo $class['OnlineClass']['id'] ?>" class="icon-clock"> Self-Paced Online Class</a></li>
																				<?php if (!empty($class['Lesson'])): ?>
																						<?php if (count($class['Lesson']) == 1): ?>
																						<li><a href="#lessons-<?php echo $class['OnlineClass']['id'] ?>" class="icon-camera"> 1 Video Lesson</a>
																						<?php else: ?>
																						<li><a href="#lessons-<?php echo $class['OnlineClass']['id'] ?>" class="icon-camera"> <span class="vidcount"><?php echo count($class['Lesson']) ?></span> Video Lessons</a>
																						<?php endif ?>
																								<ul class="submenu indent sortable">
																								<?php foreach($class['Lesson'] as $lesson): ?>
																										<li id="lesson-<?php echo $lesson['id'] ?>"><a href="#lesson-<?php echo $lesson['id'] ?>" class="lesson"><?php echo $lesson['title'] ?></a></li>
																								<?php endforeach ?>
																												<li class="ui-state-disabled" id="na"><a href="/dashboard/lessons/add/<?php echo $class['OnlineClass']['id'] ?>?inline=1" class="colorsteelblue addvideolesson" data-fancybox-type="iframe">+ Video Lesson</a></li>
																								</ul>
																						</li>        
																				<?php else: ?>
																				<li><a href="/dashboard/lessons/add/<?php echo $class['OnlineClass']['id'] ?>?inline=1" data-fancybox-type="iframe" class="icon-camera addvideolesson"> 0 Video Lesson</a></li>
																				<?php endif ?>
																		<li><a href="#project_guide-<?php echo $class['OnlineClass']['id'] ?>" class="icon-book"> Project Guide</a></li>
																</ul>
																<div class="title">FAQ</div>
																<div class="sidebar_panel_gray">How does this class work?</div>
																<div>Each class is project-based. You can collaborate with other students following you teachers's videos and project guide. Teachers will give you feedback as the class progress.</div>
																<div class="sidebar_panel_gray">When does a class end?</div>
																<div>Classes never end. Once you enroll in a class you will have access to that class, content, videos and all other materials.</div>
														</div>
										
														<div class="class_view_middle" class="tab">
																<div id="language-<?php echo $class['OnlineClass']['id'] ?>" class="tab language">
																		<h2>Language</h2>
  																<li><input type="checkbox" checked /> English</li>
																		<li><input type="checkbox" disabled /> Spanish (Coming Soon)</li>
																</div>
																<div id="about-<?php echo $class['OnlineClass']['id'] ?>" class="tab about" style="display: block;">
																<?php if (!empty($class['OnlineClass'])): ?>
																				<?php if (!empty($class['Lesson'])): ?>
																								<?php foreach($class['Lesson'] as $lesson): ?>
																								<?php $wistia = json_decode($lesson['wistia'], TRUE) ?>
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
																												<?php if ($lesson['show_to_main'] == 1): ?>
																																<?php if (AuthComponent::user('id') && AuthComponent::user('id') == $lesson['user_id']): //add or enrolled to this class ?>
																																<iframe src="http://fast.wistia.com/embed/iframe/<?php echo $wistia['hashed_id'] ?>" frameborder="0" scrolling="no" allowtransparency="true" width="100%"></iframe>
																																<?php else: ?>
																																<div class="image_container">
																																		<img src="<?php echo $image['url'] ?>" />
																																		<div class="restricted">Purchase this class to view video lessons.</div>
																																</div>
																																<?php endif ?>
																												<?php endif ?>
																								<?php endforeach ?>
																				<?php else: ?>
																		<div class="image_container">
																				<center class="verticalalignmiddle"><a href="/dashboard/lessons/add/<?php echo $class['OnlineClass']['id'] ?>?inline=1" class="colorsteelblue addvideolesson" data-fancybox-type="iframe">To add a video click here</a></center>
																		</div>
																				<?php endif ?>
																		<textarea class="description"><?php echo !empty($class['OnlineClass']['description']) ? $class['OnlineClass']['description'] : '<h2>About this class</h2><p>Lorem ipsum dolor set amet.</p>' ?></textarea>
																		<div class="margintop20"><a href="#" class="btn green save_class_description">Save</a></div>
																		<h2>More Information</h2>
																		<div>Level: <span class="level"><?php echo $class['OnlineClass']['level'] ?></span></div>
																<?php endif ?>
																</div>
																
																<div id="lessons-<?php echo $class['OnlineClass']['id'] ?>" class="tab lessons">
																<?php if (!empty($class['Lesson'])): ?>
																		<?php foreach($class['Lesson'] as $lesson): ?>
																		<div id="lesson-<?php echo $lesson['id'] ?>" class="subtab">
																				<div class="title">
																						<h2><?php echo $lesson['title'] ?></h2>
																				</div>
																				<div class="description"><?php echo $lesson['description'] ?></div>
																				<div class="video_container">
																				<?php $wistia = json_decode($lesson['wistia'], TRUE) ?>
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
																				<iframe src="http://fast.wistia.com/embed/iframe/<?php echo $wistia['hashed_id'] ?>" frameborder="0" scrolling="no" allowtransparency="true" width="100%"></iframe>
																				<?php else: ?>
																				<div class="image_container">
																						<img src="<?php echo $image['url'] ?>" />
																						<div class="restricted">Purchase this class to view video lessons.</div>
																				</div>
																				<?php endif ?>
																				</div>
																				<div class="description"><?php echo $lesson['description2'] ?></div>
																				<div class="lessonactions"><a href="/dashboard/lessons/edit/<?php echo $lesson['id'] ?>" data-fancybox-type="iframe" class="btn green addvideolesson">Update</a> | <a href="#" class="btn deletebtn">Delete</a></div>
																				<br /><br />
																		</div>
																		<?php endforeach ?>
																<?php endif ?>
																</div>
																
																<div id="about-<?php echo $class['OnlineClass']['id'] ?>" class="tab about">
																		<?php if (!empty($class['OnlineClass'])): ?>
																		<div class="image_container">
																				<img src="/files/<?php echo $class['OnlineClass']['user_id'] ?>/class/<?php echo $class['File']['name'] ?>" />
																		</div>
																		<div class="description"><?php echo $class['OnlineClass']['description'] ?></div>
																		<?php endif ?>
																</div>
																<div id="project_guide-<?php echo $class['OnlineClass']['id'] ?>" class="tab project_guide">
																		<h2>Project Guide</h2>
																		<textarea class="project_description">
																		<?php echo $class['OnlineClass']['project_guide'] ?>
																		</textarea>
																		<div class="margintop20"><a href="#" class="btn green save_project_guide">Save</a></div>
																</div>
												</div>
								
												  <div class="class_view_right">
																<h3>About the Teacher</h3>
																<div class="floatleft image_container">
																				<img src="/files/<?php echo $class['OnlineClass']['user_id'] ?>/class/<?php echo $class['File']['name'] ?>" />
																</div>
																<div class="floatleft">
																				<?php echo $class['OnlineClass']['teacher_professional_title'] ?>
																</div>
																<div class="clearboth"></div>
																<h3>Class Project</h3>
																<div>
																				<a target="_blank" href="http://<?php echo $class['User']['subdomain'] . '.' . DOMAIN_NAME ?>/projects/<?php echo $class['OnlineClass']['id'] ?>">View all projects &rarr;</a>
																</div>
														</div>
								</div>
														</div>
				</div>
				<?php endforeach ?>
				<?php else: ?>
				<h3>No entry yet. Try adding a class.</h3>
				<?php endif ?>
</div>

<link rel="stylesheet" href="/css/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="/js/jquery.fancybox.js?v=2.1.5"></script>

<script src="/js/dashboard/dropzone.js"></script>
<script type="text/javascript" src="/js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    var class_id = "<?php echo $class['OnlineClass']['id'] ?>";
    
    $('ul.sidebar_panel_gray>li>a').click(function(e) {
      e.preventDefault();
      $(this).parents('.class_container').find('.tab').hide();
      $($(this).attr('href')).show();
    });

    $('ul.sidebar_panel_gray>li>ul.submenu>li>a.lesson').click(function() {
      $(this).parents('.class_container').find('.subtab').hide();
      $($(this).attr('href')).show();
    });

    $("ul.sidebar_panel_gray>li").click(function() {
      $('ul.sidebar_panel_gray>li').removeClass('active');
      $(this).addClass('active');
    });
				
				$('textarea.description').tinymce({
      // Location of TinyMCE script
      script_url : '/js/tinymce/tinymce.min.js',
      toolbar: "bold italic underline | bullist numlist outdent indent",
      menubar: false,
      schema: "html5",
      height: 100
    });
				$('textarea.project_description').tinymce({
      // Location of TinyMCE script
      script_url : '/js/tinymce/tinymce.min.js',
      toolbar: "bold italic underline | bullist numlist outdent indent",
      menubar: false,
      schema: "html5",
      height: 100
    });
				$(".addvideolesson").fancybox({
								maxWidth	: 800,
								maxHeight	: 600,
								fitToView	: false,
								width		: '70%',
								height		: '70%',
								autoSize	: false,
								closeClick	: false,
								openEffect	: 'none',
								closeEffect	: 'none',
								topRatio: -10,
								afterClose: function() {
												location.reload();
								}
				});
				$('.deletebtn').click(function() {
								var ans = confirm('This will permanently delete this lesson. Do you want to proceed?');
								if (ans) {
												var id = $(this).parents('.subtab').prop('id');
												$(this).parents('.subtab').remove();
												$('.vidcount').text(parseInt($('.vidcount').text()) -1);
												$('.sidebar_panel_gray').find('.active').find('.submenu').find('a[href="#'+id+'"]').parent('li').remove();
												$.ajax({
															url: '/dashboard/lessons/delete/' + id.replace('lesson-', ''),
															dataType: 'json'
												}).done(function(msg) {
																if (msg == 'success') {
																				alert('Lesson has been successfully deleted.');
																} else {
																				alert('Oops! Something went wrong. Reload the page and try deleting the record again.');
																}
												}).fail(function() {
																alert('Oops! Something went wrong. Reload the page and try deleting the record again.');
												});
												//
								}
				});
				
				$('.save_project_guide').click(function() {
								var e = $(this);
								$.ajax({
												url: '/dashboard/classes/field/'+e.parents('.class_container').attr('rel'),
												data: { field: 'project_guide', value: $('#project_guide .project_description').val() },
												dataType: 'json',
												type: 'POST'
								}).done(function(msg) {
												if (msg == 'success') {
																alert('Record has been successfully saved.');
												} else {
																alert('Oops! Something went wrong. Reload the page and try deleting the record again.');
												}
								}).fail(function() {
												alert('Oops! Something went wrong. Reload the page and try deleting the record again.');
								});
				});
				
				$('.save_class_description').click(function() {
								var e = $(this);
								$.ajax({
												url: '/dashboard/classes/field/'+e.parents('.class_container').attr('rel'),
												data: { field: 'description', value: $('#about .description').val() },
												dataType: 'json',
												type: 'POST'
								}).done(function(msg) {
												if (msg == 'success') {
																alert('Record has been successfully saved.');
												} else {
																alert('Oops! Something went wrong. Reload the page and try deleting the record again.');
												}
								}).fail(function() {
												alert('Oops! Something went wrong. Reload the page and try deleting the record again.');
								});
				});
				
				$('.sortable').sortable({
								items: "li:not(.ui-state-disabled)",
								update: function(event, ui) {
              var order = []; 
                //loop trought each li...
               $('.sortable>li').each( function(e) {

               //add each li position to the array...     
               // the +1 is for make it start from 1 instead of 0
              order.push( $(this).attr('id')  + '=' + ( $(this).index() + 1 ) );
              });
              // join the array as single variable...
              var positions = order.join(';')
               //use the variable as you need!
												//console.log(positions);
												$.ajax({
																url: '/dashboard/lessons/sort',
																data: { positions: positions },
																type: 'POST',
																dataType: 'json'
												}).fail(function(msg) {
																alert('Oops! Something went wrong during saving of your lessons order. Please reload the page and try sorting again.');
												});
								}
				});
});
</script>