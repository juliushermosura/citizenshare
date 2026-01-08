<<?php echo empty($container) ? 'div' : $container ?> class="avatar<?php echo !empty($size) ? '-' . $size : '' ?>">
				<a href="<?php echo SITE_URL ?>/users/profile/<?php echo $vars['User']['id'] ?>">
								<img src="/files/<?php echo !empty($vars['User']['File']['0']) ? $vars['User']['id'] : 'default' ?>/user/<?php echo empty($vars['User']['File']['0']) ? 'blank-profile.png' : $vars['User']['File']['0']['name']  ?>" class="avatar-image" border="0" />
				</a>
</<?php echo empty($container) ? 'div' : $container ?>>