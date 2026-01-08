<h1>Latest Branch Manager Updates</h1>
<?php if (key($posts) == '0'): ?>
<?php foreach($posts as $temp_item): ?>
  <h2><?php echo date('d M Y', strtotime($temp_item['pubDate'])) ?></h2>
  <h3><a href="<?php echo $temp_item['link'] ?>" target="_blank"><?php echo $temp_item['title'] ?></a></h3>
  <p><?php echo $temp_item['description'] ?></p>
  <a href="<?php echo $temp_item['link'] ?>" target="_blank">Read More...</a>
<?php endforeach ?>	
<?php else: ?>
    <h2><?php echo date('d M Y', strtotime($posts['pubDate'])) ?></h2>
		<h3><a href="<?php echo $posts['link'] ?>" target="_blank"><?php echo $posts['title'] ?></a></h3>
    <p><?php echo $posts['description'] ?></p>
    <a href="<?php echo $posts['link'] ?>" target="_blank">Read More...</a>
<?php endif ?>