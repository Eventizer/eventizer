<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <div class="box-tools">
                <div class="btn-group pull-right">
                    <a class="btn btn-primary" href="<?=__url('event/new')?>"><?=__t('event/list','Create new event')?></a>
                    <a class="btn btn-primary" href="<?=__url('event/widget')?>"><?=__t('event/list','Create widget')?></a>
                </div>
            </div>
       </div><!-- /.box-header -->

       <div class="box-body table-responsive">
       <?php if ($pages->items_total > 0):?>
            <table class="table table-hover valignm">
            <tr>
                <th><?=__t('event/list','Name')?></th>
                <th><?=__t('event/list','Start - End date')?></th>
                <th></th>
            </tr>
            <?php foreach ($items as $item):?>
                <tr>
                    <td class="valign">
                    	<b><?=htmlspecialchars($item->title)?></b>
                    </td>
                    <td class="valign">
                    	<?=$item->start_date_front?> - <?=$item->end_date_front?>
                    </td>
                    <td>
                        <div class="btn-group pull-right">
                            <a class="btn btn-default" href="<?=__url('event/edit')?>/<?=$item->id?>"><?=__t('event/list','Edit')?></a>
                            <a class="btn btn-default csfr-required" href="<?=__url('event/remove')?>/<?=$item->id?>"><?=__t('event/list','Remove')?></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            </table>
            	<?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
            
            <?php else:?>
                <p><?=__t('event/lit','No events for this moment')?></p>    
            <?php endif;?>                          
        </div><!-- /.box-body -->
     </div>
</div>
<script type="text/javascript">
	var _lactq = _lactq || [];
	_lactq.push({'f':'init_protectCSFR','a':[]});
</script> 