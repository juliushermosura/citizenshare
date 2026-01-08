								<div class="profile_details">
												<div class="image_container">
																<img src="/files/<?php echo !empty($profile['File']) ? $profile['User']['id'] : 'default' ?>/user/<?php echo !empty($profile['File']) ? $profile['File']['0']['name'] : 'blank-profile.png' ?>" border="0" />
												</div>
												<div class="name">
																<?php echo $profile['Profile']['0']['first_name'] . ' ' . $profile['Profile']['0']['last_name'] ?>
												</div>
												<?php if (!empty($profile['Profile']['0']['industry_title'])): ?>
												<div class="industry_title">
																<?php echo $profile['Profile']['0']['industry_title'] ?>
												</div>
												<?php endif ?>
												<?php if ($profile['User']['id'] != AuthComponent::user('id')): ?>
												<div class="follow">
																<?php if (empty($profile['Followed']['id'])): ?>
																<a href="/users/follow/<?php echo $profile['User']['id'] ?>" class="btn btn-green">Follow</a>
																<?php else: ?>
																<a href="/users/unfollow/<?php echo $profile['User']['id'] ?>" class="btn btn-green btn-ghost">Unfollow</a>
																<?php endif ?>
												</div>
												<?php endif ?>
								</div>
