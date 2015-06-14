<div class="modal notlogged fade bs-example-modal-sm" id="save-event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
                              <?php if(isset($modal['header']) && $modal['header'] != ''):?>
                              <div class="text-center">
					<h3 class="modal-title"><?=htmlspecialchars($modal['header'])?></h3>
				</div>
                              <?php endif;?>
                          </div>

			<div class="modal-body text-center">
                            <?=htmlspecialchars($modal['contnet'])?>
                          </div>
			<div class="modal-footer text-center">
				<a href="<?=__url('user/registration')?>/(d)/<?=erLhcoreClassModuleFunctions::urlEncode(erLhcoreClassModuleFunctions::currentPage())?>" class="btn btn-success btn-block"><?=__t('modal/notlogged','Sign UP')?></a>
                             <?=__t('modal/notlogged','Already have an account? ')?><a href="<?=__url('user/login')?>/(d)/<?=erLhcoreClassModuleFunctions::urlEncode(erLhcoreClassModuleFunctions::currentPage())?>" class="link"><?=__t('modal/notlogged','Log in')?></a>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->