<?php defined('C5_EXECUTE') or die("Access Denied.") ?>
<?php
	$title = $this->controller->getSectionCollection()->getCollectionName();
	if(empty($title)){
		$title = t('Section Title Placeholder');	
	}
?>


<h4 class="section-title">
	<span><?php echo $title ?></span>
</h4>