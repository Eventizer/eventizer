<select class="form-control" name="ModuleFunction">
<option value="*"><?=__t('permission/modulefunctions','All functions')?></option>
<?php foreach ($functions as $key => $Function) : ?>
    <option value="<?php echo $key?>"><?=htmlspecialchars($Function['explain'])?></option>
<?php endforeach; ?>
</select>