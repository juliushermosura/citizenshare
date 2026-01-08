<h1>Update Lesson</h1>
<hr />
<br />
<?php echo $this->Session->flash() ?>
<label>Upload Video</label>
<form action="/files/upload/" name="data[File]" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
  <input type="hidden" name="data[File][type]" value="lesson" />
</form>

<?php echo $this->Form->create('Lesson') ?>
<?php echo $this->Form->input('title', array('label' => 'Lesson Title')) ?>
<?php echo $this->Form->input('description', array('label' => 'Intro description')) ?>
<?php echo $this->Form->input('description2', array('label' => 'Full description')) ?>
<?php echo $this->Form->hidden('file_id') ?>
<?php echo $this->Form->hidden('order') ?>
<?php echo $this->Form->end('Save', array('id' => 'submit')) ?>

<?php
if (!empty($lessons)) {
  if (isset($this->request->query['inline']) && $this->request->query['inline'] == 1) {
    echo '<a class="various" href="/dashboard/projects/add/?inline=1">Next</a>';
  }
}
?>
<script src="/js/dashboard/dropzone.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#LessonDashboardEditForm').submit(function(e) {
    if ($('#LessonFileId').val().length == 0) {
      alert('Still uploading... Please let the upload finish before submitting again.');
      return false;
    }
    return true;
  });
});
Dropzone.options.myAwesomeDropzone = {
  paramName: "data[File][file]", // The name that will be used to transfer the file
  maxFilesize: 100, // MB
  maxFiles: 1,
  dictDefaultMessage: 'Upload Video',
  sending: function() {
  },
  success: function(file, response) {
    var file_id = document.getElementById("LessonFileId");
    file_id.value = response;
    return file.previewElement.classList.add("dz-success");
  }
};
</script>
