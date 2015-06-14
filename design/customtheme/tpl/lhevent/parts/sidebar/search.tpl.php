<div class="form-group col-lg-12">
	<label for="searchInput"><?=__t('event/list','Search Property')?></label> <input type="text" name="searchText" placeholder="<?=__t('event/list','Search')?>" id="searchInput" class="form-control" value="<?=(isset($Result['filterParams']))?$Result['filterParams']['input_form']->searchText:''?>" />
</div>

<div class="form-group col-lg-12">
	<button class="btn btn-flat-green" name="Submit" type="submit"><?=__t('event/list','Refine Search')?></button>
</div>