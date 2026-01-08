<h1>Update Profile</h1>
<div class="absoluteright">
<?php if (empty($photo)): ?>
  <img src="/files/default/user/blank-profile.png" width="200px" />
<?php else: ?>
  <img src="/files/<?php echo AuthComponent::user('id') . '/' . $photo['File']['type'] . '/' . $photo['File']['name'] ?>" width="200px" />
<?php endif ?>
  <form action="/files/upload/" name="data[Photo]" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
    <input type="hidden" name="data[File][type]" value="user" />
  </form>
</div>
<?php
echo $this->Form->create('Profile', array('method'=>'post'));
echo $this->Form->hidden('id');
echo $this->Form->input('first_name');
echo $this->Form->input('last_name');
echo $this->Form->input('industry_title');
echo $this->Form->input('gender', array('options'=>array('M'=>'Male', 'F'=>'Female')));
echo $this->Form->input('birth_date', array('type'=>'date', 'maxYear'=>date('Y'), 'minYear'=>'1920'));
echo $this->Form->end('Save');
if (isset($this->request->query['inline']) && $this->request->query['inline'] == 2) {
  echo '<a class="various" href="/dashboard/microsites/index/?inline=2">Next</a>';
}
?>
<script src="/js/dashboard/dropzone.js"></script>
<script type="text/javascript">
Dropzone.options.myAwesomeDropzone = {
  paramName: "data[File][file]", // The name that will be used to transfer the file
  maxFilesize: 2, // MB
  dictDefaultMessage: 'Upload Photo'
};
</script>