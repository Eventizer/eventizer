<section id="sidebar">
	<section id="aside-property-search">
		<div class="property-list-search aside">
			<div class="inner">
				<div id="accordion" class="panel-group">
					<div class="panel panel-default panel-search">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a href="#collapseOne" data-parent="#accordion" data-toggle="collapse"> Refine Search </a>
							</h4>
						</div>
						<div class="panel-collapse collapse in" id="collapseOne">
							<div class="panel-body">
								<form role="form" action="<?=__url('event/list')?>" method="get" class="form-search clearfix">
									<div class="form-group col-lg-12">
										<label for="searchInput"><?=__t('event/list','Search Property')?></label>
										<input type="text" name="searchText" placeholder="Search" id="searchInput" class="form-control" />
									</div>
								
									<div class="form-group col-lg-12">
										<button class="btn btn-flat-green" name="Submit" type="submit" ><?=__t('event/list','Refine Search')?></button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</section>