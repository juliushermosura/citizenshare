<h1>Add Class</h1>
<hr />
<br />
<?php echo $this->Form->label('Add image') ?>
<form action="/files/upload/" name="data[File]" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
  <input type="hidden" name="data[File][type]" value="class" />
</form>

<?php echo $this->Form->create('OnlineClass') ?>
<?php echo $this->Form->hidden('file_id') ?>
<?php echo $this->Form->input('title', array('label' => 'Class title')) ?>
<?php echo $this->Form->input('teacher_professional_title', array('label' => 'Teacher name and professional title (if applicable)')) ?>
<?php echo $this->Form->input('teaser', array('label' => 'A statement to create visitor interest')) ?>
<?php echo $this->Form->input('description', array('label' => 'Class description', 'class' => 'class_description')) ?>
<?php //echo $this->Form->input('share', array('label' => 'Do you want to share this class with other BMs', 'options' => array('Yes' => 'Yes', 'No' => 'No'))) ?>
<?php echo $this->Form->input('class_category_id', array('label' => 'Category', 'options' => $my_category)) ?>
<?php echo $this->Form->input('price', array('label' => 'Class Ticket Price', 'options' => array('15' => '$15', '20' => '$20', '23' => '$23'))) ?>
<?php echo $this->Form->input('level', array('label' => 'Level', 'type' => 'radio', 'options' => array('Beginner' => 'Beginner', 'Intermediate' => 'Intermediate', 'Advanced' => 'Advanced'))) ?>
<?php echo $this->Form->end('Save') ?>

<script src="/js/dashboard/dropzone.js"></script>
<script type="text/javascript" src="/js/tinymce/jquery.tinymce.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
				$('textarea.class_description').tinymce({
      // Location of TinyMCE script
      script_url : '/js/tinymce/tinymce.min.js',
      toolbar: "bold italic underline | bullist numlist outdent indent",
      menubar: false,
      schema: "html5",
      height: 100
    });
  });
Dropzone.options.myAwesomeDropzone = {
  paramName: "data[File][file]", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  maxFiles: 1,  
  dictDefaultMessage: 'Upload Photo',
  success: function(file, response) {
    var file_id = document.getElementById("OnlineClassFileId");
    file_id.value = response;
    return file.previewElement.classList.add("dz-success");
  }
};
</script>