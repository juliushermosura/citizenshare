<div class="contentarea">
				<div class="class_view_left profile">
								<?php echo $this->element('left_sidebar_profile') ?>
								<div class="network">
												<?php echo $this->element('left_sidebar_follower') ?>
								</div>								
				</div>
				
				<div class="class_view_middle expand">
								<h2>Followings</h2>
								<ul class="classes_taken">
												<?php if (!empty($profile['Following'])): ?>
												<?php foreach($profile['Following'] as $following): ?>
												<div class="classes">
														<div class="teacher_photo">
																						<img src="/files/<?php echo !empty($following['File']['0']) ? $following['id'] : 'default' ?>/user/<?php echo !empty($following['File']['0']) ? $following['File']['0']['name'] : 'blank-profile.png' ?>" border="0" />
														</div>
														<div class="marginleft180">
																<div class="expert_classes">
																				<h3><?php echo $following['Profile']['0']['first_name'] ?> <?php echo $following['Profile']['0']['last_name'] ?></h3>
																</div>
																<div class="expert_name clearboth">
																				<h4><?php echo $following['Profile']['0']['industry_title'] ?></h4>
																</div>
																<div class="width200 marginleft5">
																				<div class="follow"><a href="/users/follow/<?php echo $following['id'] ?>" class="btn btn-green">Follow</a></div>
																				<a href="<?php echo SITE_URL ?>/users/profile/<?php echo $following['id'] ?>" class="btn">View Profile</a>
																</div>
														</div>
												</div>
												<?php endforeach ?>
												<?php else: ?>
												<li>Not following anyone one yet.</li>
												<?php endif ?>
								</ul>
				</div>
</div>
