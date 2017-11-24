<div class="container" role="main" style="margin-top: 50px;">
  <div class ="starter-template">
                    <?php if(!empty(@$notif)){ ?>
                    <div id="resultalert" class="alert alert-<?php echo @$notif['type'];?>">
                        <p><?php echo @$notif['message'];?></p>
                        <span></span>
                    </div>
                    <?php } ?>

      <div class="panel panel-default">
        <div class="panel-heading">Please choose image to upload</div>
        <div class="panel-body">
          <?php echo form_open_multipart('');?>
          <!-- <form method="post" action="" role="form"> -->
            <div class="row">
              <div class="col-md-4">
                  <input type="file" name='userfile' required style="width: 100%;" />
              </div>

              <div class="col-md-6" style="text-align: left;">
                <div class="input-group">
                  <span class="input-group-addon">Link</span>
                  <input type="text" class="form-control" name='link' placeholder="image url for advertisement" required>
                </div>
              </div>

              <div class="col-md-2" style="text-align: right;">
                <input type="submit" name="submit_add" class="btn btn-default" style="width: 100%;" value="Upload"/>
              </div>
            </div>
          <?php echo "</form>"; ?>
        </div>
      </div>

      <div>
      <?php foreach ($items as $item) { ?>
        <form method="post" action="" role="form">
          <div class="row" style="align-items: center; border: solid 1px #eee; padding: 5px;">
              <div class="col-md-3" style="text-align: center;">
                <img src="<?php echo site_url(ADVERTISE_THUMB_PATH.$item['imagename']);?>" class="img-rounded" style="max-height: 160px; max-width: 160px;" alt="advertisement"/>
              </div>
              <div class="col-md-8" style="text-align: left;">
                <div style="width: 100%; word-break: break-all;">
                  <a href="<?php echo $item['link'];?>" class="text-primary" style="font-size: medium;"  target='_blank'>Go to link</a>
                </div>
              </div>
              <div class="col-md-1" style="text-align: right; padding: 5px;">
                  <input type="submit" name="submit_delete" class="btn btn-default" style="width: 100%; margin-bottom: 5px;" value="Delete"/>
              </div>
          </div>
          <input type="hidden" name="id" value="<?php echo $item['id'];?>"/>
        </form>
      <?php }?>
      </div>

  </div>
</div>