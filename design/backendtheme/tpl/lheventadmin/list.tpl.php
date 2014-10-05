<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <div class="box-tools">
                <div class="btn-group pull-right">
                    <a class="btn btn-primary" href="<?=__url('eventadmin/new')?>"><?=__t('eventadmin/list','Create new event')?></a>
                    <a class="btn btn-primary" href="<?=__url('eventadmin/widget')?>"><?=__t('eventadmin/list','Create widget')?></a>
                </div>
            </div>
       </div><!-- /.box-header -->

       <div class="box-body table-responsive">
       <?php if ($pages->items_total > 0):?>
            <table class="table table-hover valignm">
            <tr>
                <th><?=__t('eventadmin/list','Name')?></th>
                <th><?=__t('eventadmin/list','Start - End date')?></th>
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
                            <a class="btn btn-default" href="<?=__url('eventadmin/edit')?>/<?=$item->id?>"><?=__t('eventadmin/list','Edit')?></a>
                            <a class="btn btn-default" href=""><?=__t('eventadmin/list','Remove')?></a>
                        </div>
                    </td>
                </tr>
            <?php endforeach;?>
            </table>
            	<?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
            
            <?php else:?>
                <p><?=__t('eventadmin/lit','No events for this moment')?></p>    
            <?php endif;?>                          
        </div><!-- /.box-body -->
     </div>
</div>