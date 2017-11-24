<div class="header general">
  <div class="col-md-1 outer-logo">
    <a href="<?php echo site_url('welcome');?>" style="width: fit-content;">
      <div class="logo">
        <img src="<?php echo site_url('assets/images/logo.png');?>" style="height: 100%;">
        <span class="title-font-small">motuin</span>
      </div>
    </a>
  </div>
  <div class="col-md-offset-1 col-md-10 title"><?php echo @$content['title'] ? $content['title'] : ''; ?></div>
</div>

<div class="container" role="main" style="min-height: calc(100vh - 95px);">
  <div class ="starter-template col-md-8">
      <div class="text-info"><?php echo @$content['content'] ? $content['content'] : ''; ?></div> 
  </div>
  
  <div class ="starter-template col-md-4">
    <?php foreach ($advertise_items as $item) { ?>
      <a href="<?php echo $item['link'];?>" target='_blank'>
      <img src="<?php echo site_url(ADVERTISE_PATH.$item['imagename']);?>" style="width: 250px; margin-bottom: 15px;">
      </a>
    <?php } ?>
  </div>
</div>