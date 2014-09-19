<div class="col-xs-12">
    <div class="box">
        <div class="box-header">
            <div class="box-tools">
                <a class="btn btn-primary pull-right" href="<?=__url('eventadmin/new')?>"><?=__t('eventadmin/list','Create new')?></a>
            </div>
       </div><!-- /.box-header -->

       <div class="box-body table-responsive">
       <?php if ($pages->items_total > 0):?>
       
            <?php foreach ($items as $item):?>
                <div class="row">
                    <div class="col-xs-4">
                    <?=htmlspecialchars($item->title)?>
                    </div>
                    <div class="col-xs-4">
                    </div>
                    <div class="col-xs-4 pull-right">
                        <div class="btn-group" data-toggle="buttons">
                            <a class="btn" href="<?=__url('eventadmin/edit')?>/<?=$item->id?>"><?=__t('eventadmin/list','Edit')?></a>
                            <a class="btn" href=""><?=__t('eventadmin/list','Remove')?></a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
            	<?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>
            
            <?php else:?>
                <p><?=__t('eventadmin/lit','No events for this moment')?></p>    
            <?php endif;?>                          
        </div><!-- /.box-body -->
     </div>
</div>