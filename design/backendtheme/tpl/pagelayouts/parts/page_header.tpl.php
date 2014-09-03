<?php $currentUser = erLhcoreClassUser::instance(); ?>

<?php if($currentUser->isLogged()):?>
<?php $userData = $currentUser->getUserData(true); ?>

<!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="/" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                Eventizer.org
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only"><?=__t('pagelayout/menu','Toggle navigation')?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span><?=htmlspecialchars($userData->name.' '.$userData->surname)?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="<?php if ($userData->has_photo) : ?><?php echo $userData->photow_150;?><?php else : ?><?php echo erLhcoreClassDesign::design('images/avatar3.png');?><?php endif;?>" class="img-circle" alt="<?=htmlspecialchars($userData)?>" />
                                    <p>
                                        <?=htmlspecialchars($userData)?>
                                        <small><?=__t('pagelayout/menu','Last visit')?> <?=$userData->lastactivity_front?></small>
                                    </p>
                                </li>
                                
                               
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="<?=__url('user/account')?>" class="btn btn-default btn-flat"><?=__t('pagelayout/menu','Profile')?></a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="<?=__url('user/logout')?>" class="btn btn-default btn-flat"><?=__t('pagelayout/menu','Sign out')?></a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
       <?php endif;?>