												<h3>Follower</h3>
												<div class="followers">
																<?php if (empty($profile['Follower'])): ?>
																<span>No follower yet.</span>
																<?php else: ?>
																<?php foreach($profile['Follower'] as $follower): ?>
																<div class="people">
																				<?php $user['User'] = $follower ?>
												        <?php echo $this->element('avatar', array('size' => 'small', 'vars' => $user, 'container' => 'span')) ?>																
												        <?php //echo $this->element('name', array('vars' => $user, 'container' => 'span')) ?>
																</div>
																<?php endforeach ?>
																<div class="margin20 view_all_link"><a class="red" href="/users/followers/<?php echo $profile['User']['id'] ?>">View all &rarr;</a></div>
																<?php endif ?>
												</div>