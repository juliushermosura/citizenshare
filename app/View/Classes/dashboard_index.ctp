<!--<ul>
<li><a href="/dashboard/users/add_teacher">Add Teacher</a></li>
<li><a href="/dashboard/users/teachers_list">Manage Teachers</a></li>
<li><a href="/dashboard/classes/add_category">Add Class Category</a></li>
<li><a href="/dashboard/classes/category_list">Manage Categories</a></li>
<li><a href="/dashboard/classes/add">Add Class</a></li>
<li><a href="/dashboard/classes/list">Manage Classes</a></li>
</ul> -->
<div class="headerbar">
				<div class="floatleft marginright50">
								<h3 class="category_menu">Category</h3>
								<ul class="category_menu">
												<li><a href="/dashboard/classes/index" class="icon-arrow-down"> <?php echo !empty($selected_category) ? $selected_category['ClassCategory']['title'] : 'Select' ?> </a>
																<ul>
																<?php if (!empty($selected_category)): ?>
																				<li><a href="/dashboard/classes/index">All</a></li>
																<?php endif ?>
																<?php foreach($categories as $category): ?>
																<li><a href="/dashboard/classes/list/<?php echo $category['ClassCategory']['id'] ?>"><?php echo $category['ClassCategory']['title'] ?></a></li>
																<?php endforeach ?>
																<li><a href="/dashboard/classes/add_category?inline=1" data-fancybox-type="iframe" class="addnewcategory">+ Add</a></li>
																</ul>
												</li>
								</ul>
				</div>
				<div class="floatleft">
								<p>In this module you can create a new class, preview it or delete a class. If you want to create a new category.</p>
								<p><a href="/dashboard/classes/add?inline=2" data-fancybox-type="iframe" class="btn teal textcolorblue addnewclass">Create a new class</a> &nbsp; &nbsp; &nbsp; <a href="/dashboard/classes/add_category?inline=1" class="btn teal textcolorblue addnewcategory" data-fancybox-type="iframe">Add New Category</a></p>
				</div>
</div>

<div class="class_listing">
				<?php if (!empty($classes)): ?>
				<?php foreach($classes as $class): ?>
				<div class="class_container">
								<div class="class_summary">
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
												<div class="class_photo_container">
																<div class="class_photo">
																				<img src="/files/<?php echo !empty($class['File']) ? $class['OnlineClass']['user_id'] : 'default' ?>/class/<?php echo !empty($class['File']) ? $class['File']['name'] : 'default.png' ?>" border="0" />
																</div>
																<p class="clearleft">
																				<form action="/files/upload/" name="data[Photo]" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
																						<input type="hidden" name="data[File][type]" class="classPhoto" value="class" />
																				</form>
																</p>
																<p>Click the upload button to browse computer</p>
												</div>
												<div class="class_form">
																<ol>
																				<li>
																								<p>Class list title:</p>
																								<div>
																												<input type="text" value="<?php echo $class['OnlineClass']['title'] ?>" class="class_title" />
																												<input type="hidden" value="<?php echo $class['OnlineClass']['id'] ?>" class="class_id" />
																								</div>
																				</li>
																				<li>
																								<p>Teacher name and professional title (if applicable):</p>
																								<div><input type="text" value="<?php echo $class['OnlineClass']['teacher_professional_title'] ?>" class="class_professional_title" /></div>
																				</li>
																				<li>
																								<p>A statement to create visitor interest:</p>
																								<div><input type="text" value="<?php echo $class['OnlineClass']['teaser'] ?>" class="class_visitor_interest" /></div>
																				</li>
																				<li>
																								<p>Class ticket price:</p>
																								<div><select class="class_ticket_price">
																												<option <?php echo (!empty($class['ClassPrice']['0']['price']) && ($class['ClassPrice']['0']['price'] == 15)) ? 'selected' : '' ?>>$15</option>
																												<option <?php echo (!empty($class['ClassPrice']['0']['price']) && ($class['ClassPrice']['0']['price'] == 20)) ? 'selected' : '' ?>>$20</option>
																												<option <?php echo (!empty($class['ClassPrice']['0']['price']) && ($class['ClassPrice']['0']['price'] == 23)) ? 'selected' : '' ?>>$23</option>
																								</select></div>
																				</li>
																				<li>
																								<p>Class Category:</p>
																								<div>
																												<select class="class_category">
																																<?php foreach($categories as $category): ?>
																																<option value="<?php echo $category['ClassCategory']['id'] ?>" <?php echo $category['ClassCategory']['id'] == $class['OnlineClass']['class_category_id'] ? 'selected' : '' ?>><?php echo $category['ClassCategory']['title'] ?></option>
																																<?php endforeach ?>
																												</select>
																								</div>
																				</li>
																</ol>
												</div>
												<div class="actions">
																<p><a href="#" class="green btn save">SAVE</a></p>
																<p><a href="#" class="blue btn preview">PREVIEW</a></p>
																<p><a href="#" class="btn delete">DELETE</a></p>
																<center>LEVEL</center>
																<p><input type="radio" class="class_level" name="level-<?php echo $class['OnlineClass']['id'] ?>" value="Beginner" <?php echo ($class['OnlineClass']['level'] == "Beginner") ? 'checked' : 'checked' ?> /> Beginner</p>
																<p><input type="radio" class="class_level" name="level-<?php echo $class['OnlineClass']['id'] ?>" value="Intermediate" <?php echo ($class['OnlineClass']['level'] == "Intermediate") ? 'checked' : '' ?> /> Intermediate</p>
																<p><input type="radio" class="class_level" name="level-<?php echo $class['OnlineClass']['id'] ?>" value="Advanced" <?php echo ($class['OnlineClass']['level'] == "Advanced") ? 'checked' : '' ?> /> Advanced</p>
												</div>
								</div>
				</div>
				<?php endforeach ?>
				<?php else: ?>
				<h3>No entry yet. Try adding a class.</h3>
				<?php endif ?>
</div>

<link href="/css/jquery.fancybox.css" type="text/css" rel="stylesheet" />
<script src="/js/dashboard/dropzone.js"></script>
<script src="/js/jquery.fancybox.js"></script>
<script type="text/javascript">
$(document).ready(function() {
				$(document.body).on('click', '.btn.save', function(e) {
								e.preventDefault();
								var frm = $(this);
								$.ajax({
												url: '/dashboard/classes/update',
												type: 'POST',
												dataType: 'json',
												data: {
																id: frm.parents('.actions').prev('.class_form').find('.class_id').val(),
																title: frm.parents('.actions').prev('.class_form').find('.class_title').val(),
																teacher_professional_title: frm.parents('.actions').prev('.class_form').find('.class_professional_title').val(),
																teaser: frm.parents('.actions').prev('.class_form').find('.class_teaser').val(),
																price: frm.parents('.actions').prev('.class_form').find('.class_ticket_price').val(),
																class_category_id: frm.parents('.actions').prev('.class_form').find('.class_category').val(),
																level: frm.parents('.actions').find('.class_level:checked').val(),
																photo: frm.parents('actions').prev().prev('.class_photo_container').find('.classPhoto').val()
												}
								}).done(function(msg) {
												if (msg == 'success') {
																alert('Record was saved successfully.');
																$(".class_update").hide();
																$(".class_summary").show();
												} else {
																alert('Oops! Something went wrong. Please reload the page and try again.');
												}
								}).fail(function() {
												alert('Oops! Something went wrong. Please reload the page and try again.');
								});
				});
				$(document.body).on('click', '.btn.preview', function(e) {
								e.preventDefault();
								var linkid = $(this).parents('.actions').prev('.class_form').find('.class_id').val();
								window.open('http://<?php echo AuthComponent::user('subdomain') . '.' . SITE_DOMAIN ?>/classes/view/' + linkid, 'preview', 'width:960,height:400')
				});
				$(document.body).on('click', '.btn.delete', function(e) {
								e.preventDefault();
								var ans = confirm('This will be deleted permanently. Do you want to proceed?');
								if (ans) {
												$(this).parents('.class_container').remove();
												var class_id = $(this).parents('.actions').prev('.class_form').find('.class_id').val();
												$.ajax({
																url: '/dashboard/classes/delete/' + class_id,
												});
								}
				});
				$(".addnewclass").fancybox({
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
				$(".addnewcategory").fancybox({
								maxWidth	: 800,
								maxHeight	: 300,
								fitToView	: false,
								width		: '70%',
								height		: '30%',
								autoSize	: false,
								closeClick	: false,
								openEffect	: 'none',
								closeEffect	: 'none',
								topRatio: -10,
								afterClose: function() {
												location.reload();
								}
				});

});

Dropzone.options.myAwesomeDropzone = {
  paramName: "data[File][file]", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  dictDefaultMessage: 'Upload Photo',
  success: function(file, response) {
    var file_id = document.getElementByClassName("class_id");
    file_id.value = response;
    return file.previewElement.classList.add("dz-success");
  }
};
</script>
