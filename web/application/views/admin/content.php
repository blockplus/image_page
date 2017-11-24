<div class="container" role="main" style="margin-top: 50px;">
  <div class ="starter-template">
    
    <div class="container" style="text-align: left;">
      <div class="panel panel-default">
        <div class="panel-heading">Website Policy</div>
        <div class="panel-body">
           <form method="post" action="" role="form">

                    <?php if(!empty(@$notif['policy'])){ ?>
                    <div id="resultalert" class="alert alert-<?php echo @$notif['policy']['type'];?>">
                        <p><?php echo @$notif['policy']['message'];?></p>
                        <span></span>
                    </div>
                    <?php } ?>

              <div class="form-group">
                <label for="excel_path label-default" style="text-align: left;">Title:</label>
                <input type="text" class="form-control" required name='title' value="<?php echo isset($items['policy']) ? @$items['policy']['title'] : '';?>"></input>
              </div>

              <div class="form-group">
                <label for="excel_path label-default" style="text-align: left;">Content:</label>
                <textarea class="form-control tinyMCE" rows="15" cols="80" name="content"><?php echo isset($items['policy']) ? $items['policy']['content'] : '';?></textarea>
              </div>

              <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                  <input type="submit" class="btn btn-default" name="submit_policy" value="&nbsp Save &nbsp">
              </div>
            </form>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">About</div>
        <div class="panel-body">
           <form method="post" action="" role="form">

                    <?php if(!empty(@$notif['about'])){ ?>
                    <div id="resultalert" class="alert alert-<?php echo @$notif['about']['type'];?>">
                        <p><?php echo @$notif['about']['message'];?></p>
                        <span></span>
                    </div>
                    <?php } ?>

              <div class="form-group">
                <label for="excel_path label-default" style="text-align: left;">Title:</label>
                <input type="text" class="form-control" required name='title' value="<?php echo isset($items['about']) ? @$items['about']['title'] : '';?>"></input>
              </div>

              <div class="form-group">
                <label for="excel_path label-default" style="text-align: left;">Content:</label>
                <textarea class="form-control tinyMCE" name="content"><?php echo isset($items['about']) ? $items['about']['content'] : '';?></textarea>
              </div>

              <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                  <input type="submit" class="btn btn-default" name="submit_about" value="&nbsp Save &nbsp">
              </div>
            </form>
        </div>
      </div>


      <div class="panel panel-default">
        <div class="panel-heading">Contact Us</div>
        <div class="panel-body">
           <form method="post" action="" role="form">

                    <?php if(!empty(@$notif['contact'])){ ?>
                    <div class="alert alert-<?php echo @$notif['contact']['type'];?>">
                        <p><?php echo @$notif['contact']['message'];?></p>
                        <span></span>
                    </div>
                    <?php } ?>

              <div class="form-group">
                <label for="excel_path label-default" style="text-align: left;">Title:</label>
                <input type="text" class="form-control" required name='title' value="<?php echo isset($items['contact']) ? @$items['contact']['title'] : '';?>"></input>
              </div>

              <div class="form-group">
                <label for="excel_path label-default" style="text-align: left;">Content:</label>
                <textarea class="form-control tinyMCE" name="content"><?php echo isset($items['contact']) ? $items['contact']['content'] : '';?></textarea>
              </div>
              <div class="col-md-offset-3 col-md-6" style="text-align: center;">
                  <input type="submit" class="btn btn-default" name="submit_contact" value="&nbsp Save &nbsp">
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>