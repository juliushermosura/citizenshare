<?php
if (empty($teachers)) {
				$teachers = array(
								'User' => array('0' => array(
																																					'photo' => '1.jpg',
																																					'full_name' => 'Richard Ben',
																																					'Class' => array(
																																								'title' => 'Fail Fast at Your Fashion',
																																								'ClassCategory'	=> array('title' => 'PR Career')
																																				 ),
																																					'Profile' => array('occupation' => 'Fashion PR'),
																								),
																								'1' => array(
																																				 'photo' => '2.jpg',
																																				 'full_name' => 'Jennifer Dawson',
																																					'Class' => array(
																																								'title' => 'Fail Fast at Your Fashion',
																																								'ClassCategory'	=> array('title' => 'PR Career')
																																				 ),
																																					'Profile' => array('occupation' => 'Fashion PR')
																								),
																								'2' => array(
																																				 'photo' => '3.jpg',
																																				 'full_name' => 'Bernadette Richards',
																																					'Class' => array(
																																								'title' => 'Fail Fast at Your Fashion',
																																								'ClassCategory'	=> array('title' => 'PR Career')
																																				 ),
																																					'Profile' => array('occupation' => 'Fashion PR')
																								),
																				),
				);
}
?>
    <div class="experts_container">
								<?php foreach($teachers['User'] as $teacher): ?>
								<div class="experts">
												<div class="expert_photo">
																<img src="/files/photos/<?php echo $teacher['photo'] ?>" border="0" />
												</div>
												<div class="expert_classes">
																<h3><?php echo $teacher['Class']['title'] ?></h3>
																<h3><?php echo $teacher['Class']['ClassCategory']['title'] ?></h3>
												</div>
												<div class="expert_name">
																<h4><?php echo $teacher['full_name'] ?>, <?php echo $teacher['Profile']['occupation'] ?></h4>
												</div>
								</div>
								<?php endforeach ?>
				</div>