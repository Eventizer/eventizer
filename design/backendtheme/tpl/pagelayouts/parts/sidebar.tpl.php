<?php if ( erLhcoreClassUser::instance()->isLogged()):?>
<aside class="left-side sidebar-offcanvas">
	<!-- sidebar: style can be found in sidebar.less -->
    	 <section class="sidebar">
         <!-- sidebar menu: : style can be found in sidebar.less -->
             <?php $userData = erLhcoreClassUser::instance()->getUserData(true); ?>
              <ul class="sidebar-menu">
                  <li class="<?php if(isset($Result['menu']) && $Result['menu'] == 'dashboard'):?>active<?php endif;?>">
                      <a href="<?=__url();?>">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                      </a>
                   </li>
					<li class="treeview <?php if(isset($Result['menu']) && $Result['menu'] == 'events'):?>active<?php endif;?>">
						<a href="#"><i class="fa fa-users"></i>&nbsp; <?=__t('pagelayout/pagelayout','Events')?></a>
			  			<ul class="treeview-menu">
			  				<li <?php if(isset($Result['submenu']) && $Result['submenu'] == 'events'):?>class="active"<?php endif;?>><a href="<?=__url('event/events')?>"><i class="fa fa-angle-double-right"></i> <?=__t('pagelayout/pagelayout','Events list')?></a></li>
                       		<li <?php if(isset($Result['submenu']) && $Result['submenu'] == 'EventCategory'):?>class="active"<?php endif;?>><a href="<?=__url('abstract/list')?>/EventCategory"><i class="fa fa-angle-double-right"></i> <?=__t('pagelayout/pagelayout','Event categories')?></a></li>
	                     </ul>
					</li>
						
                        <?php //if ($currentUser->hasAccessTo('lhsystem','use')) : ?>
					<li class="treeview <?php if(isset($Result['menu']) && $Result['menu'] == 'settings'):?>active<?php endif;?>">
				  		<a href="#"><i class="fa fa-cog fa-fw"></i>&nbsp; <?=__t('pagelayout/pagelayout','Settings')?></a>
						<ul class="treeview-menu">
                        	<li <?php if(isset($Result['submenu']) && $Result['submenu'] == 'smtp'):?>class="active"<?php endif;?>><a href="<?=__url('system/smtp')?>"><i class="fa fa-angle-double-right"></i> <?=__t('pagelayout/pagelayout','SMTP')?></a></li>
                            <li <?php if(isset($Result['submenu']) && $Result['submenu'] == 'EmailTemplate'):?>class="active"<?php endif;?>><a href="<?=__url('abstract/list')?>/EmailTemplate"><i class="fa fa-angle-double-right"></i> <?=__t('pagelayout/pagelayout','Email tamplates')?></a></li>
                            <li <?php if(isset($Result['submenu']) && $Result['submenu'] == 'Country'):?>class="active"<?php endif;?>><a href="<?=__url('abstract/list')?>/Country"><i class="fa fa-angle-double-right"></i> <?=__t('pagelayout/pagelayout','Countries')?></a></li>
                            <li <?php if(isset($Result['submenu']) && $Result['submenu'] == 'timezone'):?>class="active"<?php endif;?>><a href="<?=__url('system/timezone')?>"><i class="fa fa-angle-double-right"></i> <?=__t('pagelayout/pagelayout','Time zone')?></a></li>
                            <li <?php if(isset($Result['submenu']) && $Result['submenu'] == 'developer'):?>class="active"<?php endif;?>><a href="<?=__url('system/developer')?>"><i class="fa fa-angle-double-right"></i> <?=__t('pagelayout/pagelayout','Developer')?></a></li>
                            <li class="treeview <?php if(isset($Result['submenu_active']) && $Result['submenu_active'] == 'users'):?>active<?php endif;?>"><a href="#"><i class="fa fa-angle-double-right"></i> <?=__t('pagelayout/pagelayout','Users')?></a>
                            	<ul class="treeview-menu">
		                        	<li <?php if(isset($Result['subsubmenu']) && $Result['subsubmenu'] == 'users'):?>class="active"<?php endif;?>><a href="<?=__url('user/list')?>"><i class="fa fa-angle-double-right"></i> <?=__t('pagelayout/pagelayout','Users list')?></a></li>
                                	<li <?php if(isset($Result['subsubmenu']) && $Result['subsubmenu'] == 'groups'):?>class="active"<?php endif;?>><a href="<?=__url('user/grouplist')?>"><i class="fa fa-angle-double-right"></i> <?=__t('pagelayout/pagelayout','List of groups')?></a></li>
                                	<li <?php if(isset($Result['subsubmenu']) && $Result['subsubmenu'] == 'roles'):?>class="active"<?php endif;?>><a href="<?=__url('permission/roles')?>"><i class="fa fa-angle-double-right"></i> <?=__t('pagelayout/pagelayout','List of roles')?></a></li>
		                        </ul>
                             </li>
                          </ul>
						</li>
					<?php //endif; ?>
					<li class="<?php if(isset($Result['menu']) && $Result['menu'] == 'articles'):?>active<?php endif;?>">
						<a href="<?=__url('article/managecategories')?>"><i class="fa fa-info"></i>&nbsp; <?=__t('pagelayout/pagelayout','Manage articles')?></a>
					</li>
					<li class="<?php if(isset($Result['menu']) && $Result['menu'] == 'about'):?>active<?php endif;?>">
						<a href="<?=__url('system/about')?>"><i class="fa fa-info"></i>&nbsp; <?=__t('pagelayout/pagelayout','About system')?></a>
			</li>
    	</ul>
	</section>
    <!-- /.sidebar -->
</aside>
<?php endif;?>