												<h3>Following</h3>
												<div class="following">
																<?php if (empty($profile['Following'])): ?>
																<span>Not following anyone one yet.</span>
																<?php else: ?>
																<?php foreach($profile['Following'] as $following): ?>
																<div class="people">
																				<?php $user['User'] = $following ?>
												        <?php echo $this->element('avatar', array('size' => 'small', 'vars' => $user, 'container' => 'span')) ?>
																				<?php //echo $this->element('name', array('vars' => $user, 'container' => 'span')) ?>
																</div>
																<?php endforeach ?>
																<div class="margin20 view_all_link"><a class="red" href="/users/followings/<?php echo $profile['User']['id'] ?>">View all &rarr;</a></div>
																<?php endif ?>
												</div>
