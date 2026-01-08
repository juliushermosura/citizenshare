<link rel="stylesheet" type="text/css" href="/css/dashboard/dropzone.css" />
<link rel="stylesheet" type="text/css" href="/css/inline/simplecolorpicker.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.1/jquery-ui.min.js"></script>
<script src="/js/dashboard/jquery.simplecolorpicker.js"></script>
<h1>Website Manager</h1>
<hr />
<br />


<?php 
$colors = array(
'AliceBlue'=>'AliceBlue',
'AntiqueWhite'=>'AntiqueWhite',
'Aqua'=>'Aqua',
'Aquamarine'=>'Aquamarine',
'Azure'=>'Azure',
'Beige'=>'Beige',
'Bisque'=>'Bisque',
'Black'=>'Black',
'BlanchedAlmond'=>'BlanchedAlmond',
'Blue'=>'Blue',
'BlueViolet'=>'BlueViolet',
'Brown'=>'Brown',
'BurlyWood'=>'BurlyWoo',
'CadetBlue'=>'CadetBlue',
'Chartreuse'=>'Chartreuse',
'Chocolate'=>'Chocolate',
'Coral'=>'Coral',
'CornflowerBlue'=>'CornflowerBlue',
'Cornsilk'=>'Cornsilk',
'Crimson'=>'Crimson',
'Cyan'=>'Cyan',
'DarkBlue'=>'DarkBlue',
'DarkCyan'=>'DarkCyan',
'DarkGoldenRod'=>'DarkGoldenRod',
'DarkGray'=>'DarkGray',
'DarkGreen'=>'DarkGreen',
'DarkKhaki'=>'DarkKhaki',
'DarkMagenta'=>'DarkMagenta',
'DarkOliveGreen'=>'DarkOliveGreen',
'DarkOrange'=>'DarkOrange',
'DarkOrchid'=>'DarkOrchid',
'DarkRed'=>'DarkRed',
'DarkSalmon'=>'DarkSalmon',
'DarkSeaGreen'=>'DarkSeaGreen',
'DarkSlateBlue'=>'DarkSlateBlue',
'DarkSlateGray'=>'DarkSlateGray',
'DarkTurquoise'=>'DarkTurquoise',
'DarkViolet'=>'DarkViolet',
'DeepPink'=>'DeepPink',
'DeepSkyBlue'=>'DeepSkyBlue',
'DimGray'=>'DimGray',
'DodgerBlue'=>'DodgerBlue',
'FireBrick'=>'FireBrick',
'FloralWhite'=>'FloralWhite',
'ForestGreen'=>'ForestGreen',
'Fuchsia'=>'Fuchsia',
'Gainsboro'=>'Gainsboro',
'GhostWhite'=>'GhostWhite',
'Gold'=>'Gold',
'GoldenRod'=>'GoldenRod',
'Gray'=>'Gray',
'Green'=>'Green',
'GreenYellow'=>'GreenYellow',
'HoneyDew'=>'HoneyDew',
'HotPink'=>'HotPink',
'IndianRed'=>'IndianRed',
'Indigo'=>'Indigo',
'Ivory'=>'Ivory',
'Khaki'=>'Khaki',
'Lavender'=>'Lavender',
'LavenderBlush'=>'LavenderBlush',
'LawnGreen'=>'LawnGreen',
'LemonChiffon'=>'LemonChiffon',
'LightBlue'=>'LightBlue',
'LightCoral'=>'LightCoral',
'LightCyan'=>'LightCyan',
'LightGoldenRodYellow'=>'LightGoldenRodYellow',
'LightGray'=>'LightGray',
'LightGreen'=>'LightGreen',
'LightPink'=>'LightPink',
'LightSalmon'=>'LightSalmon',
'LightSeaGreen'=>'LightSeaGreen',
'LightSkyBlue'=>'LightSkyBlue',
'LightSlateGray'=>'LightSlateGray',
'LightSteelBlue'=>'LightSteelBlue',
'LightYellow'=>'LightYellow',
'Lime'=>'Lime',
'LimeGreen'=>'LimeGreen',
'Linen'=>'Linen',
'Magenta'=>'Magenta',
'Maroon'=>'Maroon',
'MediumAquaMarine'=>'MediumAquaMarine',
'MediumBlue'=>'MediumBlue',
'MediumOrchid'=>'MediumOrchid',
'MediumPurple'=>'MediumPurple',
'MediumSeaGreen'=>'MediumSeaGreen',
'MediumSlateBlue'=>'MediumSlateBlue',
'MediumSpringGreen'=>'MediumSpringGreen',
'MediumTurquoise'=>'MediumTurquoise',
'MediumVioletRed'=>'MediumVioletRed',
'MidnightBlue'=>'MidnightBlue',
'MintCream'=>'MintCream',
'MistyRose'=>'MistyRose',
'Moccasin'=>'Moccasin',
'NavajoWhite'=>'NavajoWhite',
'Navy'=>'Navy',
'OldLace'=>'OldLace',
'Olive'=>'Olive',
'OliveDrab'=>'OliveDrab',
'Orange'=>'Orange',
'OrangeRed'=>'OrangeRed',
'Orchid'=>'Orchid',
'PaleGoldenRod'=>'PaleGoldenRod',
'PaleGreen'=>'PaleGreen',
'PaleTurquoise'=>'PaleTurquoise',
'PaleVioletRed'=>'PaleVioletRed',
'PapayaWhip'=>'PapayaWhip',
'PeachPuff'=>'PeachPuff',
'Peru'=>'Peru',
'Pink'=>'Pink',
'Plum'=>'Plum',
'PowderBlue'=>'PowderBlue',
'Purple'=>'Purple',
'Red'=>'Red',
'RosyBrown'=>'RosyBrown',
'RoyalBlue'=>'RoyalBlue',
'SaddleBrown'=>'SaddleBrown',
'Salmon'=>'Salmon',
'SandyBrown'=>'SandyBrown',
'SeaGreen'=>'SeaGreen',
'SeaShell'=>'SeaShell',
'Sienna'=>'Sienna',
'Silver'=>'Silver',
'SkyBlue'=>'SkyBlue',
'SlateBlue'=>'SlateBlue',
'SlateGray'=>'SlateGray',
'Snow'=>'Snow',
'SpringGreen'=>'SpringGreen',
'SteelBlue'=>'SteelBlue',
'Tan'=>'Tan',
'Teal'=>'Teal',
'Thistle'=>'Thistle',
'Tomato'=>'Tomato',
'Turquoise'=>'Turquoise',
'Violet'=>'Violet',
'Wheat'=>'Wheat',
'White'=>'White',
'WhiteSmoke'=>'WhiteSmoke',
'Yellow'=>'Yellow',
'YellowGreen'=>'YellowGreen'
);

?>

<style>
.intro {
<?php if (!empty($this->data['Microsite']['0']['file_id'])): ?>
background-image: url(/files/<?php echo AuthComponent::user('id') ?>/microsite/<?php echo $intro['name'] ?>);
background-repeat: no-repeat;
background-position: center;
background-size: cover;
<?php endif ?>
<?php if (!empty($this->data['Microsite']['0']['color'])): ?>
background-color: <?php echo $this->data['Microsite']['0']['color'] ?>
<?php endif ?>
}

.about {
<?php if (!empty($this->data['Microsite']['1']['file_id'])): ?>
background-image: url(/files/<?php echo AuthComponent::user('id') ?>/microsite/<?php echo $about['name'] ?>);
background-repeat: no-repeat;
background-position: center;
background-size: cover;
<?php endif ?>
<?php if (!empty($this->data['Microsite']['1']['color'])): ?>
background-color: <?php echo $this->data['Microsite']['1']['color'] ?>
<?php endif ?>
}

.classes {
<?php if (!empty($this->data['Microsite']['2']['file_id'])): ?>
background-image: url(/files/<?php echo AuthComponent::user('id') ?>/microsite/<?php echo $classes['name'] ?>);
background-repeat: no-repeat;
background-position: center;
background-size: cover;
<?php endif ?>
<?php if (!empty($this->data['Microsite']['2']['color'])): ?>
background-color: <?php echo $this->data['Microsite']['2']['color'] ?>
<?php endif ?>
}

.projects {
<?php if (!empty($this->data['Microsite']['3']['file_id'])): ?>
background-image: url(/files/<?php echo AuthComponent::user('id') ?>/microsite/<?php echo $projects['name'] ?>);
background-repeat: no-repeat;
background-position: center;
background-size: cover;
<?php endif ?>
<?php if (!empty($this->data['Microsite']['3']['color'])): ?>
background-color: <?php echo $this->data['Microsite']['3']['color'] ?>
<?php endif ?>
}

.contact {
<?php if (!empty($this->data['Microsite']['4']['file_id'])): ?>
background-image: url(/files/<?php echo AuthComponent::user('id') ?>/microsite/<?php echo $contact['name'] ?>);
background-repeat: no-repeat;
background-position: center;
background-size: cover;
<?php endif ?>
<?php if (!empty($this->data['Microsite']['4']['color'])): ?>
background-color: <?php echo $this->data['Microsite']['4']['color'] ?>
<?php endif ?>
}

</style>


<div class="web_container">
  <h3 class="marginleft100">Introduction Section</h3>
  <div class="manager intro">
  <?php echo !empty($this->request->data['Microsite']['0']) ? $this->request->data['Microsite']['0']['content'] : '' ?>
  </div>
  <div class="controls">
    <div id="upload0">
      <label>Upload Background Image</label>
      <form action="/files/upload/" name="data[File]" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone">
        <input type="hidden" name="data[File][type]" value="microsite" />
      </form>
    </div>

  <?php echo $this->Form->create('Microsite') ?>
    <?php echo $this->Form->input('Microsite.0.color', array('class'=>'colorpicker', 'label'=>'Pick a background color', 'options'=>$colors, 'empty' => 'Select here')) ?>
    <?php echo $this->Form->input('Microsite.0.is_fixed_bg', array('legend'=>'Section Type', 'type'=>'radio', 'options'=>array('0'=>'Scrolling background', '1'=>'Fixed background'))) ?>
    <?php echo $this->Form->input('Microsite.0.content') ?>
    <?php echo $this->Form->hidden('Microsite.0.file_id') ?>
    <?php echo $this->Form->hidden('Microsite.0.section', array('value' => 'intro')) ?>
  <?php echo $this->Form->end('Save') ?>
  </div>
</div>

<hr class="clearboth" /><br />

<div class="web_container">
  <h3 class="marginleft100">About Section</h3>
  <div class="manager about">
  <?php echo !empty($this->request->data['Microsite']['1']) ? $this->request->data['Microsite']['1']['content'] : '' ?>
  </div>
  <div class="controls">
    <div id="upload1">
      <label>Upload Background Image</label>
      <form action="/files/upload/" name="data[File]" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone2">
        <input type="hidden" name="data[File][type]" value="microsite" />
      </form>
    </div>
    
  <?php echo $this->Form->create('Microsite') ?>
    <?php echo $this->Form->input('Microsite.1.color', array('class'=>'colorpicker', 'label'=>'Pick a background color', 'options'=>$colors, 'empty' => 'Select here')) ?>
    <?php echo $this->Form->input('Microsite.1.is_fixed_bg', array('legend'=>'Section Type', 'type'=>'radio', 'options'=>array('0'=>'Scrolling background', '1'=>'Fixed background'))) ?>
    <?php echo $this->Form->input('Microsite.1.content') ?>
    <?php echo $this->Form->hidden('Microsite.1.file_id') ?>
    <?php echo $this->Form->hidden('Microsite.1.section', array('value' => 'about')) ?>
  <?php echo $this->Form->end('Save') ?>
  </div>
</div>

<hr class="clearboth" /><br />

<div class="web_container">
  <h3 class="marginleft100">Classes Section</h3>
  <div class="manager classes">
  <?php echo !empty($this->request->data['Microsite']['2']) ? $this->request->data['Microsite']['2']['content'] : '' ?>
  </div>
    <div class="controls">
    <div id="upload2">
      <label>Upload Background Image</label>
      <form action="/files/upload/" name="data[File]" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone3">
        <input type="hidden" name="data[File][type]" value="microsite" />
      </form>
    </div>

  <?php echo $this->Form->create('Microsite') ?>
    <?php echo $this->Form->input('Microsite.2.is_fixed_bg', array('legend'=>'Section Type', 'type'=>'radio', 'options'=>array('0'=>'Scrolling background', '1'=>'Fixed background'))) ?>
    <?php echo $this->Form->input('Microsite.2.color', array('class'=>'colorpicker', 'label'=>'Pick a background color', 'options'=>$colors, 'empty' => 'Select here')) ?>
    <?php echo $this->Form->input('Microsite.2.content') ?>
    <?php echo $this->Form->hidden('Microsite.2.file_id') ?>
    <?php echo $this->Form->hidden('Microsite.2.section', array('value' => 'classes')) ?>
  <?php echo $this->Form->end('Save') ?>
  </div>
</div>

<hr class="clearboth" /><br />

<div class="web_container">
  <h3 class="marginleft100">Projects Section</h3>
  <div class="manager projects">
  <?php echo !empty($this->request->data['Microsite']['3']) ? $this->request->data['Microsite']['3']['content'] : '' ?>
  </div>
  <div class="controls">
    <div id="upload3">
      <label>Upload Background Image</label>
      <form action="/files/upload/" name="data[File]" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone4">
        <input type="hidden" name="data[File][type]" value="microsite" />
      </form>
    </div>
    
  <?php echo $this->Form->create('Microsite') ?>
    <?php echo $this->Form->input('Microsite.3.color', array('class'=>'colorpicker', 'label'=>'Pick a background color', 'options'=>$colors, 'empty' => 'Select here')) ?>
    <?php echo $this->Form->input('Microsite.3.is_fixed_bg', array('legend'=>'Section Type', 'type'=>'radio', 'options'=>array('0'=>'Scrolling background', '1'=>'Fixed background'))) ?>
    <?php echo $this->Form->input('Microsite.3.content') ?>
    <?php echo $this->Form->hidden('Microsite.3.file_id') ?>
    <?php echo $this->Form->hidden('Microsite.3.section', array('value' => 'projects')) ?>
  <?php echo $this->Form->end('Save') ?>
  </div>
</div>

<hr class="clearboth" /><br />

<div class="web_container">
  <h3 class="marginleft100">Contact Section</h3>
  <div class="manager contact">
  <?php echo !empty($this->request->data['Microsite']['4']) ? $this->request->data['Microsite']['4']['content'] : '' ?>
  </div>
  <div class="controls">
    <div id="upload4">
      <label>Upload Background Image</label>
      <form action="/files/upload/" name="data[File]" method="post" enctype="multipart/form-data" class="dropzone" id="my-awesome-dropzone5">
        <input type="hidden" name="data[File][type]" value="microsite" />
      </form>
    </div>
    
  <?php echo $this->Form->create('Microsite') ?>
    <?php echo $this->Form->input('Microsite.4.color', array('class'=>'colorpicker', 'label'=>'Pick a background color', 'options'=>$colors, 'empty' => 'Select here')) ?>
    <?php echo $this->Form->input('Microsite.4.is_fixed_bg', array('legend'=>'Section Type', 'type'=>'radio', 'options'=>array('0'=>'Scrolling background', '1'=>'Fixed background'))) ?>
    <?php echo $this->Form->input('Microsite.4.content') ?>
    <?php echo $this->Form->hidden('Microsite.4.file_id') ?>
    <?php echo $this->Form->hidden('Microsite.4.section', array('value' => 'contact')) ?>
  <?php echo $this->Form->end('Save') ?>
  </div>
</div>


<?php echo $this->Form->create('User', array('url' => array('controllers' => 'users', 'dashboard' => true, 'action' => 'live_offline'))) ?>
<?php echo $this->Form->label('Make your site:') ?>
<?php echo $this->Form->submit('Preview', array('type' => 'button')) ?>
<?php echo $this->Form->submit('Live', array('name' => 'live')) ?>
<?php echo $this->Form->submit('Offline', array('name' => 'offline')) ?>
<?php echo $this->Form->end(null) ?>

<script src="/js/dashboard/dropzone.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('select.colorpicker').simplecolorpicker();
});
Dropzone.options.myAwesomeDropzone = {
  paramName: "data[File][file]", // The name that will be used to transfer the file
  maxFilesize: 5, // MB
  success: function(file, response) {
    var file_id = document.getElementById("Microsite0FileId");
    file_id.value = response;
    return file.previewElement.classList.add("dz-success");
  }
};
Dropzone.options.myAwesomeDropzone2 = {
  paramName: "data[File][file]", // The name that will be used to transfer the file
  maxFilesize: 5, // MB
  success: function(file, response) {
    var file_id = document.getElementById("Microsite1FileId");
    file_id.value = response;
    return file.previewElement.classList.add("dz-success");
  }
};
Dropzone.options.myAwesomeDropzone3 = {
  paramName: "data[File][file]", // The name that will be used to transfer the file
  maxFilesize: 5, // MB
  success: function(file, response) {
    var file_id = document.getElementById("Microsite2FileId");
    file_id.value = response;
    return file.previewElement.classList.add("dz-success");
  }
};
Dropzone.options.myAwesomeDropzone4 = {
  paramName: "data[File][file]", // The name that will be used to transfer the file
  maxFilesize: 5, // MB
  success: function(file, response) {
    var file_id = document.getElementById("Microsite3FileId");
    file_id.value = response;
    return file.previewElement.classList.add("dz-success");
  }
};
Dropzone.options.myAwesomeDropzone5 = {
  paramName: "data[File][file]", // The name that will be used to transfer the file
  maxFilesize: 100, // MB
  success: function(file, response) {
    var file_id = document.getElementById("Microsite4FileId");
    file_id.value = response;
    return file.previewElement.classList.add("dz-success");
  }
};
</script>