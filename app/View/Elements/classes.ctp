<?php if (!empty($user['OnlineClass'])): ?>
<?php $ctr = 0 ?>
<?php foreach($user['OnlineClass'] as $class): ?>
  <?php $ctr++ ?>
  <div class="cd-class-detail class-<?php echo $ctr ?>">
		<div class="cd-class-detail-pict">
			<!--<img src="/files/photos/class-detail-img-1.jpg" alt="Class image">-->
		</div> <!-- cd-member-bio-pict -->

		<div class="cd-detail-content">
			<h1><?php echo $class['title'] ?></h1>
			<p><?php echo nl2br($class['description']) ?></p>
      <a class="btn btn-green" href="/classes/view/<?php echo $class['id'] ?>">I want to learn more &rarr;</a>
		</div> <!-- cd-bio-content -->
	</div> <!-- cd-member-bio -->
<?php endforeach ?>
<?php else: ?>
  <div class="cd-class-detail class-1">
		<div class="cd-class-detail-pict">
			<!--<img src="/files/photos/class-detail-img-1.jpg" alt="Class image">-->
		</div> <!-- cd-member-bio-pict -->

		<div class="cd-detail-content">
			<h1>How to fail fast in fashion...</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non, amet, voluptatibus et omnis dolore illo saepe voluptatem qui quibusdam sunt corporis ut iure repellendus delectus voluptate explicabo temporibus quos eaque?</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, explicabo, doloribus, esse rem officia quas facilis eius alias similique ducimus amet quam odio perspiciatis dolorem ipsam! Ab, dolores, adipisci, explicabo pariatur illum deleniti quam iusto placeat nisi aliquam praesentium mollitia eligendi a! Sequi, voluptatibus sed quos possimus harum rem tempore fugiat? Corporis, officia, assumenda, asperiores blanditiis quidem aliquam fugiat vel excepturi velit provident aut omnis quos aliquid tempora eaque. Nemo, eveniet, sint maxime eum maiores totam est inventore numquam voluptatem hic nam blanditiis placeat illum nesciunt voluptatum eos cum quos magni voluptates ipsam. Perspiciatis alias ducimus libero. Quo provident omnis fugiat ut repellendus optio cum quaerat odio et ipsa. Molestias, atque repellat non maxime amet corporis magni libero quam numquam error beatae at asperiores et a porro nostrum ab necessitatibus esse aliquid iure repellendus obcaecati unde quo eius eum dolores quasi consectetur culpa velit optio! Sequi, dolor, minima, veniam doloribus in ullam cupiditate iste animi ipsum esse eaque similique illo temporibus magni et earum amet sint deleniti est reiciendis. Maxime, quis, animi, ad quasi adipisci suscipit alias iste reprehenderit ea placeat nulla commodi nobis magnam provident veniam earum odit eveniet possimus aut voluptatum dolorum culpa necessitatibus facere totam quisquam. Ipsam.</p>
		</div> <!-- cd-bio-content -->
	</div> <!-- cd-member-bio -->

	<div class="cd-class-detail class-2">
		<div class="cd-class-detail-pict">
			<!--<img src="/files/photos/class-detail-img-2.jpg" alt="Class image">-->
		</div> <!-- cd-member-bio-pict -->

		<div class="cd-detail-content">
			<h1>Extreme yoga techniques for business</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non, amet, voluptatibus et omnis dolore illo saepe voluptatem qui quibusdam sunt corporis ut iure repellendus delectus voluptate explicabo temporibus quos eaque?</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, explicabo, doloribus, esse rem officia quas facilis eius alias similique ducimus amet quam odio perspiciatis dolorem ipsam! Ab, dolores, adipisci, explicabo pariatur illum deleniti quam iusto placeat nisi aliquam praesentium mollitia eligendi a! Sequi, voluptatibus sed quos possimus harum rem tempore fugiat? Corporis, officia, assumenda, asperiores blanditiis quidem aliquam fugiat vel excepturi velit provident aut omnis quos aliquid tempora eaque. Nemo, eveniet, sint maxime eum maiores totam est inventore numquam voluptatem hic nam blanditiis placeat illum nesciunt voluptatum eos cum quos magni voluptates ipsam. Perspiciatis alias ducimus libero. Quo provident omnis fugiat ut repellendus optio cum quaerat odio et ipsa. Molestias, atque repellat non maxime amet corporis magni libero quam numquam error beatae at asperiores et a porro nostrum ab necessitatibus esse aliquid iure repellendus obcaecati unde quo eius eum dolores quasi consectetur culpa velit optio! Sequi, dolor, minima, veniam doloribus in ullam cupiditate iste animi ipsum esse eaque similique illo temporibus magni et earum amet sint deleniti est reiciendis. Maxime, quis, animi, ad quasi adipisci suscipit alias iste reprehenderit ea placeat nulla commodi nobis magnam provident veniam earum odit eveniet possimus aut voluptatum dolorum culpa necessitatibus facere totam quisquam. Ipsam.</p>
		</div> <!-- cd-bio-content -->
	</div> <!-- cd-member-bio -->


	<div class="cd-class-detail class-3">
		<div class="cd-class-detail-pict">
			<!--<img src="/files/photos/class-detail-img-3.jpg" alt="Class image">-->
		</div> <!-- cd-member-bio-pict -->

		<div class="cd-detail-content">
			<h1>Marketing your great product 201</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non, amet, voluptatibus et omnis dolore illo saepe voluptatem qui quibusdam sunt corporis ut iure repellendus delectus voluptate explicabo temporibus quos eaque?</p>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex, explicabo, doloribus, esse rem officia quas facilis eius alias similique ducimus amet quam odio perspiciatis dolorem ipsam! Ab, dolores, adipisci, explicabo pariatur illum deleniti quam iusto placeat nisi aliquam praesentium mollitia eligendi a! Sequi, voluptatibus sed quos possimus harum rem tempore fugiat? Corporis, officia, assumenda, asperiores blanditiis quidem aliquam fugiat vel excepturi velit provident aut omnis quos aliquid tempora eaque. Nemo, eveniet, sint maxime eum maiores totam est inventore numquam voluptatem hic nam blanditiis placeat illum nesciunt voluptatum eos cum quos magni voluptates ipsam. Perspiciatis alias ducimus libero. Quo provident omnis fugiat ut repellendus optio cum quaerat odio et ipsa. Molestias, atque repellat non maxime amet corporis magni libero quam numquam error beatae at asperiores et a porro nostrum ab necessitatibus esse aliquid iure repellendus obcaecati unde quo eius eum dolores quasi consectetur culpa velit optio! Sequi, dolor, minima, veniam doloribus in ullam cupiditate iste animi ipsum esse eaque similique illo temporibus magni et earum amet sint deleniti est reiciendis. Maxime, quis, animi, ad quasi adipisci suscipit alias iste reprehenderit ea placeat nulla commodi nobis magnam provident veniam earum odit eveniet possimus aut voluptatum dolorum culpa necessitatibus facere totam quisquam. Ipsam.</p>
		</div> <!-- cd-bio-content -->
	</div> <!-- cd-member-bio -->
<?php endif ?>
	<a href="#0" class="cd-class-detail-close">Close</a> <!-- close the author bio section -->
