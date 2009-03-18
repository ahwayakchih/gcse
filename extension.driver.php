<?php
	Class extension_gcse extends Extension{
	
		public function about(){
			return array('name' => 'Google Custom Search Engine',
						 'version' => '2.2',
						 'release-date' => '2008-12-18',
						 'author' => array('name' => 'Marcin Konicki',
										   'website' => 'http://ahwayakchih.neoni.net',
										   'email' => 'ahwayakchih@neoni.net'),
						 'description' => 'Use Google AJAX Search API as data source in Symphony.'
				 		);
		}

		function install(){
			$this->_Parent->Configuration->set('size', '4', 'gcse');
			$this->_Parent->Configuration->set('safe', 'moderate', 'gcse');
			return $this->_Parent->saveConfig();
		}

		function uninstall(){
			$this->_Parent->Configuration->remove('gcse');
			return $this->_Parent->saveConfig();
		}

		function enable(){
			if (!$this->_Parent->Configuration->get('safe', 'gcse'))
				return $this->install();
			return true;
		}

		function update($previousVersion=false){
			$needSave = true;
			switch ($previousVersion) {
				case false:
				case 0:
				case 2.0:
				case 2.1:
					if (!($temp = $this->_Parent->Configuration->get('qname', 'gcse'))) $temp = '{$q:$url-q}';
					$this->_Parent->Configuration->set('qname', '$'.$temp.':$url-'.$temp, 'gcse');
	
					if (!($temp = $this->_Parent->Configuration->get('pname', 'gcse'))) $temp = '{$p:$url-p}';
					$this->_Parent->Configuration->set('pname', '$'.$temp.':$url-'.$temp, 'gcse');

				default:
					$needSave = false;
					break;
			}

			return ($needSave ? $this->_Parent->saveConfig() : true);
		}

		public function fetchNavigation() {
			return array(
				array(
					'location'	=> 300,
					'name'		=> 'GCSE',
					'link'		=> '/preferences/',
					'limit'		=> 'developer',
				)
			);
		}

	}
?>