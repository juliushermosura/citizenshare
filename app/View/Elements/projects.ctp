<?php
if (empty($projects)) {
  $projects = array(
    'Project' => array(
      '0' => array(
        'photo' => '4.jpg',
        'title' => 'Sketch Layering: A hands on Approach',
        'description' => 'There are many projects that enjoy participating in, but this class was by far the most exciting. I learned that some new concepts in charcoal, shading and even layering, I always thought was impossible to execute on.',
        'User' => array(
          'full_name' => 'Jacob Cortino',
          'photo' => '6.jpg'
        ),
        'Profile' => array(
          'occupation' => 'Creative Director'
        )
      ),
      '1' => array(
        'photo' => '5.jpg',
        'title' => 'Sketch Layering: A hands on Approach',
        'description' => 'There are many projects that enjoy participating in, but this class was by far the most exciting. I learned that some new concepts in charcoal, shading and even layering, I always thought was impossible to execute on.',
        'User' => array(
          'full_name' => 'Sasha Lee',
          'photo' => '7.jpg'
        ),
        'Profile' => array(
          'occupation' => 'Creative Director'
        )
      )
    )
  );
}
?>
<h1>Here's what members are making:</h1>
<h2>Share project ideas, collaborate with other students worldwide</h2>
<?php foreach($projects['Project'] as $project): ?>
<div class="project_container">
  <div class="photo"><img src="/files/projects/<?php echo $project['photo'] ?>" border="0" /></div>
  <div class="details">
    <div class="title"><?php echo $project['title'] ?></div>
    <div class="name_title"><?php echo $project['User']['full_name'] ?>, <?php echo $project['Profile']['occupation'] ?></div>
    <div class="userphoto"><img src="/files/photos/<?php echo $project['User']['photo'] ?>" border="0" /></div>
    <div class="description"><?php echo $project['description'] ?></div>
  </div>  
</div>
<?php endforeach ?>
