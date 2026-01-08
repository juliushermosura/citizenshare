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
												<li><a href="/dashboard/classes/index" class="icon-arrow-down"> Select </a>
																<ul>
																<?php foreach($categories as $category): ?>
																<li><a href="/dashboard/classes/list/<?php echo $category['ClassCategory']['id'] ?>"><?php echo $category['ClassCategory']['title'] ?></a></li>
																<?php endforeach ?>
																<li><a href="#">+ Add</a></li>
																</ul>
												</li>
								</ul>
				</div>
				<div class="floatleft">
								<p>In this module you can create a new class, preview it or delete a class. If you want to create a new category.</p>
								<p><a href="#" class="btn teal textcolorblue">Create a new class</a> &nbsp; &nbsp; &nbsp; <a href="#" class="btn teal textcolorblue">Add New Category</a></p>
				</div>
</div>

<div class="class_listing">
				<?php if (!empty($classes)): ?>
				<?php foreach($classes as $class): ?>
				<div class="class_container">
								<div class="class_summary">
												<div class="class_photo"><img src="/files/<?php echo !empty($class['File']) ? $class['User']['id'] : 'default' ?>/class/<?php echo !empty($class['File']) ? $class['File']['name'] : 'default.png' ?>" border="0" /></div>
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
												<div class="class_photo">
																<a href="uploadphoto">Upload Photo</a>
																<p>1. Browse Computer</p>
																<p>2. Click the upload button to submit</p>
												</div>
												<div class="class_form">
																<ol>
																				<li>
																								<p>Class list title:</p>
																								<div><input type="text" value="" class="class_title" /></div>
																				</li>
																				<li>
																								<p>Teacher name and professional title (if applicable):</p>
																								<div><input type="text" value="" class="class_professional_title" /></div>
																				</li>
																				<li>
																								<p>A statement to create visitor interest:</p>
																								<div><input type="text" value="" class="class_visitor_interest" /></div>
																				</li>
																				<li>
																								<p>Class ticket price:</p>
																								<div><input type="text" value="" class="class_ticket_price" /></div>
																				</li>
																</ol>
												</div>
												<div class="actions">
																<p><a href="#" class="green btn">SAVE</a></p>
																<p><a href="#" class="blue btn">PREVIEW</a></p>
																<p><a href="#" class="btn">DELETE</a></p>
																<center>LEVEL</center>
																<p><input type="checkbox" value="beginner" /> Beginner</p>
																<p><input type="checkbox" value="intermediate" /> Intermediate</p>
																<p><input type="checkbox" value="advanced" /> Advanced</p>
												</div>
								</div>
				</div>
				<?php endforeach ?>
				<?php endif ?>
</div>