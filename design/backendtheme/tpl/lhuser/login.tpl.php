<div class="form-box" id="login-box">
            <div class="header">Sign In</div>
           
            <form action="<?=__url('user/login')?>" method="post">
            
                <div class="body bg-gray">
                 <?php include(erLhcoreClassDesign::designtpl('lhkernel/validation_error.tpl.php'));?>
                    <div class="form-group">
                        <input type="text" name="Username" class="form-control" value="<?=$data->username?>" placeholder="<?=__t('user/login','User ID')?>"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="Password" value="" class="form-control" placeholder="<?=__t('user/login','Password')?>"/>
                    </div>          
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/><?=__t('user/login','Remember me')?>
                    </div>
                </div>
                <div class="footer">                                                               
                    <input type="submit" name="Login" class="btn bg-olive btn-block" value="<?=__t('user/login','Sign me in')?>"/>  
                    
                    <p><a href="<?=__url('user/forgotpassword')?>"><?=__t('user/login','I forgot my password')?></a></p>
                </div>
            </form>

            
        </div>
