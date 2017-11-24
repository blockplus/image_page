<div class="container" role="main"   style="padding-top: 50px;">
    <form method="post" action="" role="form" id="searchForm">
        <div class="input-group stylish-input-group" style="padding-top: 30px;">
           <input type="text" class="form-control" name="search_text" id="search_text" placeholder="Search file name" value="<?php echo @$search_text;?>">
            <span class="input-group-addon">
                <button id='search_submit'>
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </span>
        </div>
        <input type="hidden" name="submit_search" value="1">
    </form>

    <h2  class="text-primary" style="margin: 20px; text-align: center;font-size: large;">Search image count: <?php echo isset($search_count) ? $search_count : 0;?></h2>

    <div>
    <?php foreach ($items as $item) { ?>
        <form method="post" action="" role="form">
            <div class="row" style="align-items: center; border: solid 1px #eee; padding: 5px;">
                <div class="col-md-3" style="text-align: center;">
                  <img src="<?php echo site_url(BANK_THUMB_PATH.$item->{'tb_image'});?>" class="img-rounded" style="max-height: 160px; max-width: 160px;" alt="Bank image"/>
                </div>
                <div class="col-md-8" style="text-align: left;">
                    <div style="width: 100%;">
                        <a href="<?php echo $item->{'tb_url'};?>" class="text-primary" style="font-size: large;" target='_blank'>
                            <?php echo $item->{'tb_title'};?>  
                        </a>
                    </div>
                    <div style="width: 100%; word-break: break-all;">
                        <span class="text-success" style="font-size: medium;"><?php echo $item->{'tb_desc'};?></span>
                    </div>
                </div>
                <div class="col-md-1" style="text-align: right; padding: 5px;">
                    <input type="submit" class="btn btn-default" name="delete" value="Delete"  style="width: 100%; margin-bottom: 5px;"/>
                    <input type="submit" class="btn btn-default" name="edit" value="Edit"  style="width: 100%; margin-bottom: 5px;"/>
                </div>
            </div>
            <input type="hidden" name="id" value="<?php echo $item->{'tb_id'}?>">
        </form>
    <?php }?>

        <div class="col-md-12" style="text-align: right;">
            <?php echo $this->pagination->create_links(); ?>
        </div>
    </div>
</div>

<div style="text-align: center; margin: 10px;">
  <div><b><?php echo $total_count;?></b></div>
  <div>TOTAL IMAGES</div>
</div>

<script>
      $('#search_submit').on('click',function ()
      {
          $('#searchForm').submit();
      });
</script>