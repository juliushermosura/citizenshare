<div class="contentarea">
				<div class="class_view_left profile">
								<?php echo $this->element('left_sidebar_profile') ?>
								<div class="network">
												<h3>Followers</h3>
												<?php echo $this->element('left_sidebar_follower') ?>
												<?php echo $this->element('left_sidebar_following') ?>
								</div>								
				</div>
				
				<div class="class_view_middle expand">
<?php if ($profile['Group']['title'] == 'Student'): ?>
								<h2>Classes Attended</h2>
								<ul class="classes_taken">
												<li>No available classes yet.</li>
								</ul>
<?php else: ?>
								<h2>Classes Offers</h2>
								<ul class="classes_taken">
												<?php if (!empty($profile['OnlineClass'])): ?>
												<?php foreach($profile['OnlineClass'] as $class): ?>
												<div class="classes">
														<div class="teacher_photo">
																						<img src="/files/<?php echo $class['user_id'] ?>/class/<?php echo $class['File']['name'] ?>" border="0" />
														</div>
														<div class="marginleft180">
																<div class="expert_classes">
																				<h3><?php echo $class['title'] ?></h3>
																</div>
																<div class="expert_name clearboth">
																				<h4><?php echo $class['teacher_professional_title'] ?></h4>
																</div>
																<div class="class_description">
																				<h4><?php echo $class['teaser'] ?></h4>
																</div>
																<div class="width200 marginleft5"><a href="http://<?php echo $class['User']['subdomain'] . '.' . SITE_DOMAIN ?>/classes/view/<?php echo $class['id'] ?>" class="btn btn-green">Membership Class</a></div>
														</div>
												</div>
												<?php endforeach ?>
												<?php else: ?>
												<li>No available classes yet.</li>
												<?php endif ?>
								</ul>
<?php endif ?>
								<hr />
								<h2>Made Projects</h2>
								<ul class="classes_taken">
												<?php if (!empty($profile['Project'])): ?>
												<?php foreach($profile['Project'] as $project): ?>
    <div class="project_container big">
      <div class="project_image_container"><a href="/projects/view/<?php echo $project['id'] ?>"><img src="/files/<?php echo $project['user_id'] ?>/project/<?php echo $project['File']['name'] ?>" border="0" /></a></div>
      <div class="details">
								<?php echo $this->element('avatar', array('size' => 'small', 'vars' => $project, 'container' => 'div')) ?>																
        <div class="title"><a href="/projects/view/<?php echo $project['id'] ?>"><?php echo $project['title'] ?></a></div>
								<?php echo $this->element('name', array('vars' => $project, 'container' => 'div')) ?>
        <div class="likecomment"><span class="icon-heart"></span> <span class="likecount"><?php echo empty($project['LikeCount']) ? 0 : count($project['LikeCount']) ?></span> &nbsp; &nbsp; <span class="icon-comment"></span> <span class="commentcount"><?php echo empty($project['CommentCount']) ? 0 : count($project['CommentCount']) ?></span></div>
      </div>
    </div> 
												<?php endforeach ?>
												<?php else: ?>
												<li>No available projects yet.</li>
												<?php endif ?>
								</ul>
				</div>
</div>
