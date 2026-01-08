<link rel="stylesheet" href="/css/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen">
<script type="text/javascript" src="/js/jquery.fancybox.js?v=2.1.5"></script>

<div class="headerbar">
				<div class="floatleft marginright50">
								<h3 class="category_menu">Preview Page</h3>
								<ul class="category_menu">
												<li class="icon-arrow-down"> Select</a>
															<ul>
																<li><a class="previewpage" data-fancybox-type="iframe" href="http://<?php echo AuthComponent::user('subdomain') ?>.<?php echo DOMAIN_NAME ?>/" target="blank">Home</a></li>
																<li><a class="previewpage" data-fancybox-type="iframe" href="http://<?php echo AuthComponent::user('subdomain') ?>.<?php echo DOMAIN_NAME ?>/teach" target="blank">Teach</a></li>
																<li><a class="previewpage" data-fancybox-type="iframe" href="http://<?php echo AuthComponent::user('subdomain') ?>.<?php echo DOMAIN_NAME ?>/join" target="blank">Join</a></li>
															</ul>
												</li>
								</ul>
				</div>
				<div class="floatleft">
								<p></p>
				</div>
</div>

<div class="listing">
	<div class="floatleft width100 margin20">
		<div class="image_container">
			<a class="previewpage" data-fancybox-type="iframe" target="_blank" href="http://<?php echo AuthComponent::user('subdomain') ?>.<?php echo DOMAIN_NAME ?>/"><img src="/files/templates/1.png" border="0" /></a>
		</div>
		<center><a class="previewpage" data-fancybox-type="iframe" target="_blank" href="http://<?php echo AuthComponent::user('subdomain') ?>.<?php echo DOMAIN_NAME ?>/">Home</a></center>
	</div>

	<div class="floatleft width100 margin20">
		<div class="image_container">
			<a class="previewpage" data-fancybox-type="iframe" target="_blank" href="http://<?php echo AuthComponent::user('subdomain') ?>.<?php echo DOMAIN_NAME ?>/teach"><img src="/files/templates/1.png" border="0" /></a>
		</div>
		<center><a class="previewpage" data-fancybox-type="iframe" target="_blank" href="http://<?php echo AuthComponent::user('subdomain') ?>.<?php echo DOMAIN_NAME ?>/teach">Teach</a></center>
	</div>
	
	<div class="floatleft width100 margin20">
		<div class="image_container">
			<a class="previewpage" data-fancybox-type="iframe" target="_blank" href="http://<?php echo AuthComponent::user('subdomain') ?>.<?php echo DOMAIN_NAME ?>/jkoin"><img src="/files/templates/1.png" border="0" /></a>
		</div>
		<center><a class="previewpage" data-fancybox-type="iframe" target="_blank" href="http://<?php echo AuthComponent::user('subdomain') ?>.<?php echo DOMAIN_NAME ?>/join">Join</a></center>
	</div>
	
</div>

<div class="clearboth">
<?php
if (isset($this->request->query['inline']) && $this->request->query['inline'] == 2) {
  echo '<a class="various" href="/dashboard/microsites/subdomain/?inline=2">Next</a>';
}
?>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(".previewpage").fancybox({
			maxWidth	: '100%',
			maxHeight	: '100%',
			fitToView	: false,
			width		: '100%',
			height		: '100%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none',
			topRatio: -10
		});
	})
</script>