<div class="headerbar">
				<div class="floatleft">
								<p>Promote a Class</p>
								<p>Here you can generate referral links and discount codes to give your teacher to promote their class. When the teacher promotes a class resulting in a student signing up, the teacher receives 85% of the ticket price and the Branch Manager receives 15%. It's only fair that teachers are compensated for their efforts, right?
				</div>
</div>

<div class="class_listing2">
				<?php if (!empty($classes)): ?>
				<?php foreach($classes as $class): ?>
				<div class="class_container2">
								<div class="class_summary2">
												<div class="class_photo2"><img src="/files/<?php echo !empty($class['File']) ? $class['User']['id'] : 'default' ?>/class/<?php echo !empty($class['File']) ? $class['File']['name'] : 'default.png' ?>" border="0" /></div>
												<div class="class_detail2">
																<div class="title"><?php echo $class['OnlineClass']['title'] ?></div>
																<div class="description"><?php echo $class['OnlineClass']['teaser'] ?></div>
												</div>
												<div class="class_link">
													<span>Referral Link</span><input class="inline" type="" />
												</div>
												<div class="class_link">
													<span>Discount Codes</span><input class="inline" type="" />
												</div>
								</div>
				</div>
				<?php endforeach ?>
				<?php else: ?>
				<h3>No classes yet. Try adding one.</h3>
				<?php endif ?>
</div>

<div class="clearboth">
<?php
if (isset($this->request->query['inline']) && $this->request->query['inline'] == 2) {
  echo '<a class="various" href="/dashboard/classes/add/?inline=2">Next</a>';
}
?>
</div>