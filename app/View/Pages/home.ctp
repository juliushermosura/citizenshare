<section class="fixed-bg cd-service" id="intro" data-slide="1">
  <div class="slogan">
    Learn real-world skills taught by industry professionals.
  </div>
  <a href="#about" class="cd-scroll-down"><img src="/img/cd-arrow-bottom.svg" border="0" /></a>
</section>

<section class="scrolling-bg cd-service cd-section"  id="about" data-slide="2">
  <div class="contentarea">
    <div class="avatar-front">
          <?php if (!empty($user['File']['0'])) $users = array('User' => array('id' => $user['User']['id'], 'File' => array('0' => array('name' => $user['File']['0']['name'])))); else $users = $user ?>
          <?php echo $this->element('avatar', array('container' => false, 'vars' => $users, 'size' => 'large')) ?>
    </div>
    <div class="follow"><a href="/users/follow/<?php echo $user['User']['id'] ?>" class="btn btn-green btn-follow-front">Follow</a></div>
    <div class="avatar-following-front">
      <?php echo $this->element('left_sidebar_following', array('profile' => $user)) ?>
    </div>
    <div class="avatar-followers-front">
      <?php echo $this->element('left_sidebar_follower', array('profile' => $user)) ?>
    </div>
    <h1><?php echo $user['Profile']['0']['first_name'] . ' ' . $user['Profile']['0']['last_name'] ?></h1>
    <h3>Welcome to my awesome online school.</h3>
    <p>To learn more just continue to scroll down and browser my classes and projects. Click on the images and witness the awesomeness of this site.</p>
    <p>Want to have your own school?</p>
    <div class="green clearboth marginbottom20">
      <a class="red" href="/pages/join">Join For Free &rarr;</a>
    </div>
  </div>
</section>
<section class="scrolling-bg cd-service cd-section"  id="classes" data-slide="3">
  <div class="contentarea">
    <h2>Classes</h2>
    <h3>Hand picked classes in business, design, fitness...</h3>
      <div class="cd-class-container">
        <ul>
        <?php if (!empty($user['OnlineClass'])): ?>
        <?php $ctr = 0 ?>
        <?php foreach($user['OnlineClass'] as $class): ?>
          <?php $ctr++ ?>
          <li>
            <a href="/classes/view/<?php echo $class['id'] ?>" data-type="class-<?php echo $ctr ?>">
              <figure>
                <img src="/files/<?php echo $user['User']['id'] ?>/class/<?php echo $class['File']['name'] ?>" alt="<?php echo $class['title'] ?>">
                <div class="cd-img-overlay"><span>View Class</span></div>
              </figure>
              <div class="cd-class-info"><?php echo $class['teacher_professional_title'] ?></div>
            </a>
          </li>
        <?php endforeach ?>
        <?php else: ?>
          <li>
            <a href="#0" data-type="class-1">
              <figure>
                <img src="/files/default/class/fashion.png" alt="How to fail fast in fashion...">
                <div class="cd-img-overlay"><span>View Class</span></div>
              </figure>
              <div class="cd-class-info">John Smith <span>Fashion Designer</span></div>
            </a>
          </li>
            
          <li>
            <a href="#0" data-type="class-2">
              <figure>
                <img src="/files/default/class/yoga.jpg" alt="Extreme yoga techniques for business">
                <div class="cd-img-overlay"><span>View Class</span></div>
              </figure>
              <div class="cd-class-info">Jane Doe <span>Guru, Fitness First</span></div>
            </a>
          </li>

          <li>
            <a href="#0" data-type="class-3">
              <figure>
                <img src="/files/default/class/marketing.jpg" alt="Marketing your great product 201">
                <div class="cd-img-overlay"><span>View Class</span></div>
              </figure>
              <div class="cd-class-info">Kevin Nick <span>Marketing Director, Brands Inc.</span></div>
            </a>
          </li>
          <?php endif ?>
        </ul>
      </div>
      <div class="green clearboth marginbottom20">
      <a class="red" href="/classes">See more classes &rarr;</a>
  </div>
</section>
<section class="scrolling-bg cd-service cd-section"  id="projects" data-slide="4">
  <div class="contentarea">
    <h2>Projects</h2>
    <ul id="cd-gallery-items" class="cd-container">
    <?php if (!empty($user['Project'])): ?>
    <?php foreach($user['Project'] as $project): ?>
        <li>
            <ul class="cd-item-wrapper">
                <li class="cd-item-front"><img src="/files/<?php echo $user['User']['id'] ?>/project/<?php echo $project['File']['name'] ?>"></li>
                <!-- <li class="cd-item-out">...</li> -->
            </ul> <!-- cd-item-wrapper -->
     
            <div class="cd-item-info">
                <b><?php echo $project['title'] ?></b>
                <em></em>
            </div> <!-- cd-item-info -->
     
            <nav>
                <ul class="cd-item-navigation">
                    <li><a class="cd-img-replace" href="#0">Prev</a></li>
                    <li><a class="cd-img-replace" href="#0">Next</a></li>
                </ul>
            </nav>
     
            <a class="cd-3d-trigger cd-img-replace" href="#0">Open</a>
        </li>
    <?php endforeach ?>
    <?php else: ?>
        <li>
            <ul class="cd-item-wrapper">
                <li class="cd-item-front"><a href="#0"><img src="/files/default/project/yoga2.jpg"></a></li>
                <li class="cd-item-middle"><a href="#0"><img src="/files/default/project/yoga3.jpg"></a></li>
                <li class="cd-item-back"><a href="#0"><img src="/files/default/project/yoga4.jpg"></a></li>
                <li class="cd-item-out"><a href="#0"><img src="/files/default/project/yoga5.jpg"></a></li>
                <!-- <li class="cd-item-out">...</li> -->
            </ul> <!-- cd-item-wrapper -->
     
            <div class="cd-item-info">
                <b><a href="#0">Yoga</a></b>
                <em></em>
            </div> <!-- cd-item-info -->
     
            <nav>
                <ul class="cd-item-navigation">
                    <li><a class="cd-img-replace" href="#0">Prev</a></li>
                    <li><a class="cd-img-replace" href="#0">Next</a></li>
                </ul>
            </nav>
     
            <a class="cd-3d-trigger cd-img-replace" href="#0">Open</a>
        </li>
     <?php endif ?>
    </ul>
    <div class="green clearboth marginbottom20">
      <a class="red" href="/projects">All Projects &rarr;</a>
    </div>
  </div>
</section>
