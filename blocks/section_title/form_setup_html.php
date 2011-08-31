<?php  defined('C5_EXECUTE') or die("Access Denied."); ?> 
<?php

	$form = Loader::helper('form');
?>

<p>
<?php echo $form->label('offset', t('Offset')) ?> <?php echo $form->text('offset', $offset) ?><br/>
<small><?php echo t('A negative number will start from the current page and work up the tree. A positive number will start from the highest ancestor and work down.') ?></small>
</p>

<p>
<?php echo t('%s the following page types:', $form->select('ctMode', array('exclude'=>t('Do not use'), 'include'=>t('Use only')), $ctMode)) ?>
</p>
<ul>
<?php 
	$ctHandlesArray = $this->controller->getCollectionTypeHandles();
foreach($this->controller->getAvailableCollectionTypeHandles() as $ctHandle=>$ctName){
	$checked = is_array($ctHandlesArray) && in_array($ctHandle, $ctHandlesArray) ? 'checked' : '';
	echo "<li><label><input name='ctHandles[]' type='checkbox' value='$ctHandle' $checked /> $ctName</label></li>";
}?>
</ul>

