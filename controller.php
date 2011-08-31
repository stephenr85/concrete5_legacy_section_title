<?php  defined('C5_EXECUTE') or die(_("Access Denied."));

/**
 * Displays the title of an ancestor by a specified offset and optional page type.
 * @package Section Title
 * @author Stephen Rushing
 * @category Packages
 * @copyright  Copyright (c) 2011 Stephen Rushing. (http://www.esiteful.com)
 */
class SectionTitlePackage extends Package {

	protected $pkgHandle = 'section_title';
	protected $appVersionRequired = '5.4.0';
	protected $pkgVersion = '1.0';
	
	public function getPackageDescription() {
		return t("Displays the title of an ancestor by a specified offset and optional page type.");
	}
	
	public function getPackageName() {
		return t("Section Title");
	}
	
	public function install() {
		$pkg = parent::install();
		
		BlockType::installBlockTypeFromPackage('section_title', $pkg);	
	}
	
	public function upgrade(){
		parent::upgrade();
		
			
			
	}
}