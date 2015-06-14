<section id="sidebar" class="mt-0">
	<div class="row">
		<div class="aside-property-profile">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="panel panel-default panel-aside media-item">
					<div class="panel-heading clearfix">
						<h4 class="panel-title"><?=__t('user/account','Account settings')?></h4>
					</div>
					<ul class="list-group list-group-link">
					     <li class="list-group-item <?php if (isset($Result['active']) && $Result['active'] == 'edit'):?> active<?php endif;?>">
					         <a href="<?=__url('user/editaccount')?>"><?=__t('user/account','Account information')?></a>
					     </li>
					     <li class="list-group-item <?php if (isset($Result['active']) && $Result['active'] == 'pass'):?> active<?php endif;?>">
					         <a href="<?=__url('user/changepassword')?>"><?=__t('user/account','Change password')?></a>
					     </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>