<div class="headerbar">
				<div class="floatleft">
								<p>Domain Center</p>
								<p>A sub-domain is a website URL, it's a website address that people will type into their browser to find your microsite as a Citizenshare Partner (for example: awesomeschool.citizenshare.com)
				</div>
</div>

<div class="listing">
				<p>http://<input class="displayinline" type="text" value="<?php echo AuthComponent::user('subdomain') ?>" />.citizenshare.com</p>
</div>

<div class="clearboth">
<?php
if (isset($this->request->query['inline']) && $this->request->query['inline'] == 2) {
  echo '<a class="various" href="/dashboard/classes/add/?inline=2">Next</a>';
}
?>
</div>