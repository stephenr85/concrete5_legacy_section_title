<?php
	class SectionTitleBlockController extends BlockController {
		
		protected $btDescription = "A block for displaying the section title.";
		protected $btName = "Section Title";
		protected $btTable = 'btSectionTitle';
		protected $btInterfaceWidth = "400";
		protected $btInterfaceHeight = "300";
		
		
		public function getTrailToCollection($c=NULL, $ctHandles=NULL, $ctMode=NULL){
			if(is_null($c)){
				$c = Page::getCurrentPage();	
			}
			$nh = Loader::helper('navigation');
			$ancestors = $nh->getTrailToCollection($c);
			$trail = array();
			
			//Filter trail by ct handles
			foreach($ancestors as $ancestor){
				$isCtFilter = is_array($ctHandles) && in_array($ancestor->getCollectionTypeHandle(), $ctHandlesArray);
				if(!$isCtFilter && $ctMode=='exclude'){
					$trail[]=$ancestor;
				}else if($isCtFilter && $ctMode=='include'){
					$trail[]=$ancestor;	
				}
			}	
			
			return $trail;
		}
		
		public function getSectionCollection($isExact=FALSE){
			$c = Page::getCurrentPage();
			$section = NULL;
			$trail = $this->getTrailToCollection($c, $this->getCollectionTypeHandles(), $this->getCollectionTypeMode());			
			
			//Get the section by offset
			
			if(!is_null($this->offset)){
				$offset = $this->offset;	
			}
			
			if($offset > 0){
				$trail = array_reverse($trail);
			}else{
				$offset = $this->offset * -1;
			}
			
			if($offset > count($trail) && !$isExact){
				$offset = count($trail)-1;	
			}
			
			if(is_object($trail[$offset])){
				$section = $trail[$offset];	
			}else if(!$isExact){
				//Return the current page if we're out of options and not looking for an exact match
				$section = $c;	
			}
			
			return $section;
		}
		
		public function getAvailableCollectionTypeHandles(){
			$allTypes = CollectionType::getList();
			$types = array();
			foreach($allTypes as $cType){
				$types[$cType->getCollectionTypeHandle()] = $cType->getCollectionTypeName();
			}	
			return $types;
		}
		
		public function getCollectionTypeHandles(){
			if(!empty($this->ctHandles)){
				return explode(',',$this->ctHandles);
			}
			return NULL;
		}
		
		public function getCollectionTypeMode(){
			if(!empty($this->ctMode)){
				return $this->ctMode;	
			}
			return 'exclude';
		}
		
		
		public function save($data){
			
			if(empty($data['ctHandles'])){
				$data['ctHandles'] = NULL;	
			}else if(is_array($data['ctHandles'])){
				$data['ctHandles'] = implode(',',$data['ctHandles']);	
			}
			
			parent::save($data);
		}
		
		public function view(){
			$sectionCollection = $this->getSectionCollection();
			if($sectionCollection){
				$title = $sectionCollection->getCollectionName();
				if(empty($title)){
					$title = t('Section Title Placeholder');	
				}
				$this->set('title', $title);
				
				if($sectionCollection){
					$nh = Loader::helper('navigation');
					$this->set('url', $nh->getCollectionURL($sectionCollection));
				}else{
					$this->set('url', NULL);	
				}
				$this->set('sectionCollection', $sectionCollection);	
			}
		}
		
		public function pre($thing, $save=FALSE){
			$str = '<pre style="white-space:pre; border:1px solid #ccc; padding:8px; margin:0 0 8px 0;">'.print_r($thing, TRUE).'</pre>';
			if(!$save){
				echo $str;	
			}
			return $str;
		}
		
	}
	
?>