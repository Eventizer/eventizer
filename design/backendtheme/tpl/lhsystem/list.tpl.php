<div class="col-md-12">
	<div class="box box-primary">
	    <div class="box-body table-responsive">
            <table class="table table-hover valignm">
            <thead>
            <tr>
                <th width="1%"><?=erTranslationClassLhTranslation::getInstance()->getTranslation('systemconfig/list','Identifier');?></th>
                <th><?=erTranslationClassLhTranslation::getInstance()->getTranslation('systemconfig/list','Explain');?></th>
                <th width="1%">&nbsp;</th>
            </tr>
            </thead>
            <?php foreach (erLhcoreClassModelSystemConfig::getList(array('filter' => array('hidden' => 0))) as $item) : ?>
                <tr>
                    <td><?php if (isset($item->identifier)) { echo $item->identifier;}?></td>
                    <td><?php if (isset($item->explain)) { echo $item->explain;}?></td>
                    <td nowrap><a class="btn btn-default csfr-required" href="<?=__url('system/edit')?>/<?=$item->identifier?>"><?=__t('systemconfig/list','Edit');?></a></td>
                </tr>
            <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>

<script type="text/javascript">
    var _lactq = _lactq || [];
	_lactq.push({'f':'init_protectCSFR','a':[]});
</script> 