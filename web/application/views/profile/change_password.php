<div class="container" id="main">    
    <div id="loginbox" style="margin-top:80px;" class="mainbox col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
        <div class="panel panel-primary" >
            <div class="panel-heading">
                <div class="panel-title">Change Password</div>
            </div>     

            <div style="padding-top:30px" class="panel-body" >

                <?php if(!empty(@$notif)){ ?>
                <div id="login-alert" class="alert alert-<?php echo @$notif['type'];?> col-sm-12"><?php echo @$notif['message'];?></div>
                <?php } ?>
                
                <form method="post" action="" class="form-horizontal" role="form">

                    <div style="margin-bottom:7px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="old_password" placeholder="old password" value="<?php echo @$old_password;?>">
                    </div>

                    <div style="margin-bottom:7px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="new_password" placeholder="new password" value="<?php echo @$new_password;?>">
                    </div>

                    <div style="margin-bottom:7px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="confirm_password" placeholder="confirm password" value="<?php echo @$confirm_password;?>">
                    </div>

                    <div style="margin-top:15px" class="form-group">
                        <div class="col-sm-12 controls">
                            <input type="submit" class="btn btn-primary" value=" Change ">
                        </div>
                    </div>
                </form>     
                
            </div>                     
        </div>  
    </div>
</div>