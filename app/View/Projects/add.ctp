<h1>Add Project</h1>
<hr />
<br />
<?php echo $this->Session->flash() ?>
<label>Upload Photo</label>
<form action="/files/upload/" name="data[File]" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
  <input type="hidden" name="data[File][type]" value="project" />
</form>

<?php echo $this->Form->create('Project') ?>
<?php echo $this->Form->input('title', array('label' => 'Project Title')) ?>
<?php echo $this->Form->input('description') ?>
<?php echo $this->Form->input('online_class_id', array('options' => $classes)) ?>
<?php echo $this->Form->hidden('file_id') ?>
<?php echo $this->Form->hidden('order', array('value' => 0)) ?>
<?php echo $this->Form->end('Save') ?>

<script src="/js/dashboard/dropzone.js"></script>
<script type="text/javascript" src="/js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
		$('textarea').tinymce({
				// Location of TinyMCE script
				script_url : '/js/tinymce/tinymce.min.js',
				toolbar: "bold italic underline | bullist numlist outdent indent",
				menubar: false,
				schema: "html5",
				height: 100
		});
  Dropzone.options.myAwesomeDropzone = {
    paramName: "data[File][file]", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
    maxFiles: 1,
    dictDefaultMessage: 'Upload Photo',
    success: function(file, response) {
      var file_id = document.getElementById("ProjectFileId");
      file_id.value = response;
      return file.previewElement.classList.add("dz-success");
    }
  };
});
</script>
