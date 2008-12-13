<?php
	Class extension_gcse extends Extension{
	
		public function about(){
			return array('name' => 'Google Custom Search Engine',
						 'version' => '2.0',
						 'release-date' => '2008-12-13',
						 'author' => array('name' => 'Marcin Konicki',
										   'website' => 'http://ahwayakchih.neoni.net',
										   'email' => 'ahwayakchih@neoni.net'),
						 'description' => 'Use Google Search API as data source in Symphony.'
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

		public function fetchNavigation() {
			return array(
				array(
					'location'	=> 300,
					'name'		=> 'GCSE',
					'link'		=> '/preferences/',
				)
			);
		}

	}
?>