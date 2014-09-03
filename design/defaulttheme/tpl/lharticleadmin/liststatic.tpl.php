<h1><?=__t('articleadmin/liststatic','Static articles')?></h1>

<table cellpadding="0" cellspacing="0" width="100%">
<thead>
<tr>
    <th>ID</th>
    <th><?=__t('articleadmin/liststatic','Name')?></th>
    <th><?=__t('articleadmin/liststatic','Active')?></th>
    <th><?=__t('articleadmin/liststatic','Modified')?></th>
    <th width="1%">&nbsp;</th>      
</tr>
</thead>
<? foreach (erLhcoreClassModelArticleStatic::getList(array('limit' => false)) as $article) : ?>
    <tr>
        <td width="1%"><?=htmlspecialchars($article->id)?></td>
        <td><?=htmlspecialchars($article->name)?></td>      
        <td><?=($article->active) ? __t('system/message','Yes') : __t('system/message','No') ?></td>      
        <td><?=$article->mtime_front?></td>      
        <td><a class="button tiny radius" href="<?=__url('articleadmin/editstatic')?>/<?=$article->id?>"><?=__t('system/button','Edit')?></a></td>       
    </tr>
<? endforeach; ?>
</table>

<a class="small button radius" href="<?=__url('articleadmin/newstatic')?>"><?=__t('system/button','New')?></a>