<<?php echo empty($container) ? 'div' : $container ?> class="name">
				<a href="<?php echo SITE_URL ?>/users/profile/<?php echo $vars['User']['id'] ?>">
								<?php echo $vars['User']['Profile']['0']['first_name'] . ' ' . $vars['User']['Profile']['0']['last_name'] ?>
				</a>
				<?php echo !empty($class_stat) ? $class_stat : '' ?>
				<?php if (isset($follow) && $follow == true): ?>
								<div class="follow"><a href="#" class="btn-small btn-black btn-ghost">Follow</a></div>
				<?php endif ?>
</<?php echo empty($container) ? 'div' : $container ?>>