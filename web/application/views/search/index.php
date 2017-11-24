<div class="header" style="width: 100%;">
      <a href="<?php echo site_url('welcome');?>">
        <div class="col-sm-3 search-logo">
          <img src="<?php echo site_url('assets/images/logo.png');?>" style="height: 100%;">
          <span class="title-font-small">motuin</span> 
        </div>
      </a>
      <div class="col-sm-6 searchbox">
        <?php echo form_open_multipart('', 'id="fileForm"');?>
          <label class="btn btn-primary" style="float: left;">
              Upload <input type="file" style="display: none !important;" name='userfile' id='userfile' required>
          </label> 

          <div class="input-group stylish-input-group">

             <input type="text" class="form-control" name="search_url" id="search_url" placeholder="Upload or enter Image URL" value="<?php echo @$origin['filename'] ? $origin['filename'] : '';?>">
              <span class="input-group-addon">
                  <button id='search_submit'>
                      <span class="glyphicon glyphicon-search"></span>
                  </button>  
              </span>
          </div>
        <?php echo "</form>"; ?>
      </div>
</div>

<div class="container content" role="main" style="width: 100%;">
  <div class ="starter-template col-md-9">
    <?php if (count($origin) > 0) { ?>
      <div class="row" style="align-items: center; padding: 5px; margin-bottom: 20px;">
        <div class="col-md-3" style="text-align: center;">
          <img src="<?php echo site_url(SEARCH_THUMB_PATH.$origin['image']);?>" class="img-rounded" style="max-height: 160px; max-width: 100%;" alt="Original image"/>
        </div>
        <div class="col-md-9" style="text-align: left;">
          <div style="width: 100%; word-break: break-all;margin: 5px;"><span class="text-default" style="font-size: medium;">File name: <?php echo $origin['filename'];?></span></div>

          <div style="width: 100%; word-break: break-all;margin: 5px;"><span class="text-info" style="font-size: medium;"> Result: <?php echo $match_count;?></span></div>
        </div>
      </div>
    <?php } ?>

    <div>
    <?php foreach ($items as $item) { ?>
      <div class="row" style="align-items: center; border: solid 1px #eee; padding: 5px;">
        <div class="col-md-3" style="text-align: center;">
          <img src="<?php echo site_url(BANK_THUMB_PATH.$item['image']);?>" class="img-rounded" style="max-height: 160px; max-width: 160px;" alt="Search image"/>
          <div>
            <button type="button" class="btn btn-link" onclick="javascript: onCompare('<?php echo site_url(SEARCH_PATH.$origin['image']);?>', '<?php echo site_url(BANK_PATH.$item['image']);?>');">Compare Similarity</button>
          </div>
        </div>
        <div class="col-md-9" style="text-align: left;">
          <div style="width: 100%;"><a href="<?php echo $item['url'];?>" style="font-size: large;" target='_blank'><?php echo $item['title'];?></a></div>
          <div style="width: 100%; word-break: break-all;margin-top: 10px;">
            <span class="text-success" style="font-size: medium;">
              <?php echo $item['desc'];?>
            </span>
          </div>
          <div style="width: 100%; word-break: break-all;margin-top: 10px;">
            <span class="text-primary" style="font-size: small;">
              Similarity score: <?php echo $item['similarity'];?>%
            </span>
          </div>

        </div>
      </div>
    <?php } ?>
    </div>

        <!-- Page navigation -->
        <div class="col-md-12" style="text-align: right;">
            <?php echo $this->pagination->create_links(); ?>
        </div>
  </div>
  <div class ="starter-template col-md-3" style="text-align: right; padding-right: 0px;">
    <?php foreach ($advertise_items as $item) { ?>
      <a href="<?php echo $item->{'ta_link'};?>" target='_blank'>
        <img src="<?php echo site_url(ADVERTISE_PATH.$item->{'ta_imagename'});?>" style="max-width: 250px; margin-bottom: 15px;">
      </a>
    <?php } ?>
  </div>
</div>

<div class="footer2">
    © MOTUIN All Rights Reserved | <a href="<?php echo site_url('policy');?>" target='_blank'>Website Policy</a> | <a href="<?php echo site_url('about'); ?>" target='_blank'>About</a> | <a href="<?php echo site_url('contact');?>" target='_blank'>Contact Us</a> | <a  href="<?php echo site_url('admin');?>" target='_blank'>Admin</a>
</div>

<div style="text-align: center; margin: 10px;">
  <div><b><?php echo $search_image_count;?></b></div>
  <div>TOTAL IMAGES SEARCHED</div>
</div>


<script type="text/javascript">
  $('#userfile').on('change',function ()
  {
      var filePath = $(this).val();
      if (filePath) {
          var startIndex = (filePath.indexOf('\\') >= 0 ? filePath.lastIndexOf('\\') : filePath.lastIndexOf('/'));
          var filename = filePath.substring(startIndex);
          if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
              filename = filename.substring(1);
          }
      }
      $('#search_url').val(filename);
  });

  $('#search_submit').on('click',function ()
  {
      $('#fileForm').submit();
  });

  var onCompare = function(origin, similar) {
    $('#compare_img_origin').attr('src', origin);
    $('#compare_img_similar').attr('src', similar);
    $('#dialog_compare').show();
  }

  var closeDialog = function() {
    $('#dialog_compare').hide();
  }

</script>

            <div role="dialog" id="dialog_compare" tabindex="-1" class="modal fade-in" style="display: none;">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                          <h3 class="modal-title">Compare similarity</h3>
                        </div>

                        <div class="modal-body">
                          <div class="row">
                            <div class="col-sm-6" style="text-align: center; border-right: solid 1px #007777;">
                              <div style="text-align: center;">
                                <h4>Your image</h4>
                              </div>
                                <img src="" id='compare_img_origin' class="compare-image"  style="margin-top: 5px;">
                            </div>

                            <div class="col-sm-6" style="text-align: center">
                              <div style="text-align: center;">
                                <h4>Similar image</h4>
                              </div>
                                <img src="" id='compare_img_similar' class="compare-image" style="margin-top: 5px;">
                            </div>
                          </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button" onClick="javascript: closeDialog();">Close</button>
                        </div>
                    </div>
                </div>    
            </div>  
            