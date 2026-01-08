<div class="headerbar">
				<p>Here is where you can post a student's project to appear on your website. Simply search for the class by name, teacher name, or keyword</p>
				<p><a data-fancybox-type="iframe" class="btn green update" href="/dashboard/projects/add/?inline=1">Add New Project</a></p>
</div>

<div class="project_listing">
				
				<?php if (!empty($projects)): ?>
  <?php foreach($projects as $project): ?>
    <div class="project_container big">
      <div class="project_image_container"><a data-fancybox-type="iframe" class="update" href="/dashboard/projects/edit/<?php echo $project['Project']['id'] ?>"><img src="/files/<?php echo $project['Project']['user_id'] ?>/project/<?php echo $project['File']['name'] ?>" border="0" /></a></div>
      <div class="details">
        <?php echo $this->element('avatar', array('size' => 'small', 'vars' => $project, 'container' => 'div')) ?>																
        <div class="title"><a data-fancybox-type="iframe" class="update" href="/dashboard/projects/edit/<?php echo $project['Project']['id'] ?>"><?php echo $project['Project']['title'] ?></a></div>
        <?php echo $this->element('name', array('vars' => $project, 'container' => 'div')) ?>
								<div class="floatright margintop20">
												<a data-fancybox-type="iframe" href="/dashboard/projects/edit/<?php echo $project['Project']['id'] ?>" class="btn green update">Update</a> | <a href="#<?php echo $project['Project']['id'] ?>" class="btn delete">Delete</a>
								</div>
      </div>
    </div> 
  <?php endforeach ?>
<?php else: ?>
  <p>No project yet. Try adding one.</p>
<?php endif ?>

				
</div>

<link href="/css/jquery.fancybox.css" type="text/css" rel="stylesheet" />
<script src="/js/dashboard/dropzone.js"></script>
<script src="/js/jquery.fancybox.js"></script>
<script type="text/javascript">
$(document).ready(function() {
				$('.delete').click(function(e) {
								//e.preventDefault();
								var t = $(this);
								var ans = confirm('This will delete this permanently. Do you want to proceed?');
								if (ans) {
												$(this).parents('.project_container.big').remove();
												$.ajax({
																url: '/dashboard/projects/delete/' + t.attr('href').replace('#', ''),
																type: 'post',
																dataType: 'json'
												}).done(function(msg) {
																if (msg == 'success') {
																				alert('Deleted successfully.');
																} else {
																				alert('Ooops! Something went wrong. Please reload the page and try deleting again.')
																}
												}).fail(function() {
																alert('Ooops! Something went wrong. Please reload the page and try deleting again.')
												});
								}
				});
				$(".update").fancybox({
								maxWidth	: 800,
								maxHeight	: 700,
								fitToView	: false,
								width		: '70%',
								height		: '70%',
								autoSize	: false,
								closeClick	: false,
								openEffect	: 'none',
								closeEffect	: 'none',
								topRatio: -10,
								afterClose: function() {
												location.reload();
								}
				});	
});

Dropzone.options.myAwesomeDropzone = {
  paramName: "data[File][file]", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  dictDefaultMessage: 'Upload Photo',
  success: function(file, response) {
    var file_id = document.getElementByClassName("class_id");
    file_id.value = response;
    return file.previewElement.classList.add("dz-success");
  }
};
</script>