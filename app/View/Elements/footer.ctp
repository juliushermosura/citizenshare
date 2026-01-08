		<div class="footer">
			<div class="contentarea">
<?php if (!empty($this->params['pass']['0']) && $this->params['pass']['0'] == 'home'): ?>
				<div class="col">
					<li><h2>Company</h2></li>
					<li><a href="/pages/about">About</a></li>
					<li><a href="/pages/careers">Careers</a></li>
					<li><a href="/pages/press">Press</a></li>
					<li><a href="/pages/contact">Contact</a></li>
					<li><a href="http://blog.<?php echo DOMAIN_NAME ?>">Blog</a></li>
				</div>
				<div class="col">
					<li><h2>Community</h2></li>
					<li><a href="/pages/teach">Teach a Class</a></li>
					<li><a href="/pages/guidelines">Guidelines</a></li>
				</div>
				<div class="col widthauto">
					<li><h2>Connect</h2></li>
					<li>
						<a target="_blank" href="http://www.facebook.com/pages/Citizenshare" class="facebook_light">Facebook<span></span></a> &nbsp;
						<a target="_blank" href="http://twitter.com/Citizenshare" class="twitter_light">Twitter<span></span></a> &nbsp;
						<a target="_blank" href="http://linkedin.com/in/Citizenshare" class="linkedin_light">Linkedin<span></span></a> &nbsp;
						<a target="_blank" href="http://plus.google.com/Citizenshare" class="googleplus_light">Google Plus<span></span></a> &nbsp;
						<a target="_blank" href="http://pinterest.com/Citizenshare" class="pinterest_light">Pinterest<span></span></a>&nbsp;
						<a target="_blank" href="http://www.youtube.com/user/citizenshare" class="youtube_light">Youtube<span></span></a> &nbsp;
						<a target="_blank" href="http://vimeo.com/citizenshare/videos/" class="vimeo_light">Vimeo<span></span></a> &nbsp;
						<a target="_blank" href="http://<?php echo DOMAIN_NAME ?>/feeds" class="rss_light">RSS<span></span></a>
					</li>
				</div>
				<div class="margintopbottom40">
					<div id="fb-root"></div>
					<script>(function(d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) return;
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
							fjs.parentNode.insertBefore(js, fjs);
					}(document, 'script', 'facebook-jssdk'));</script>
					<div class="fb-like" data-href="http://www.citizenshare.net" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
				</div>
				<hr />
				<div class="margintop20bottom40">
					&copy; Citizenshare 2014 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="/pages/help">Help</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="/pages/privacy">Privacy</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="/pages/terms">Terms</a>
				</div>
<?php else: ?>
				<div class="margintop20bottom40">
					&copy; Citizenshare 2014 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<a href="/pages/about">About</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<a href="/pages/teach">Teach</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<a href="/pages/careers">Careers</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<a href="http://blog.<?php echo DOMAIN_NAME ?>">Blog</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<a href="/pages/help">Help</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<a href="/pages/privacy">Privacy</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<a href="/pages/terms">Terms</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
					<div class="floatright">
						<div id="fb-root"></div>
						<script>(function(d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0];
								if (d.getElementById(id)) return;
								js = d.createElement(s); js.id = id;
								js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
								fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));</script>
						<div class="fb-like" data-href="http://www.citizenshare.net" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>
					</div>
				</div>
<?php endif ?>
			</div>
		</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56888001-1', 'auto');
  ga('send', 'pageview');

</script>