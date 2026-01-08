<div class="contentarea">
				<div class="class_view_left profile">
								<?php echo $this->element('left_sidebar_profile'); ?>
								<div class="network">
												<?php echo $this->element('left_sidebar_following') ?>
								</div>								
				</div>
				
				<div class="class_view_middle expand">
								<h2>Followers</h2>
								<ul class="classes_taken">
												<?php if (!empty($profile['Follower'])): ?>
												<?php foreach($profile['Follower'] as $follower): ?>
												<div class="classes">
														<div class="teacher_photo">
																						<img src="/files/<?php echo !empty($follower['File']['0']) ? $follower['id'] : 'default' ?>/user/<?php echo !empty($follower['File']['0']) ? $follower['File']['0']['name'] : 'blank-profile.png' ?>" border="0" />
														</div>
														<div class="marginleft180">
																<div class="expert_classes">
																				<h3><?php echo $follower['Profile']['0']['first_name'] ?> <?php echo $follower['Profile']['0']['last_name'] ?></h3>
																</div>
																<div class="expert_name clearboth">
																				<h4><?php echo $follower['Profile']['0']['industry_title'] ?></h4>
																</div>
																<div class="width200 marginleft5">
																				<div class="follow"><a href="/users/follow/<?php echo $follower['id'] ?>" class="btn btn-green">Follow</a></div>
																				<a href="<?php echo SITE_URL ?>/users/profile/<?php echo $follower['id'] ?>" class="btn">View Profile</a>
																</div>
														</div>
												</div>
												<?php endforeach ?>
												<?php else: ?>
												<li>No available classes yet.</li>
												<?php endif ?>
								</ul>
				</div>
</div>
