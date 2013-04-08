<?php
	Class extension_gcse extends Extension{
	
		public function about(){
			return array('name' => 'Google Custom Search Engine',
						 'version' => '2.4.0',
						 'release-date' => '2012-09-07',
						 'author' => array('name' => 'Marcin Konicki',
										   'website' => 'http://ahwayakchih.neoni.net',
										   'email' => 'ahwayakchih@neoni.net'),
						 'description' => 'Use Google AJAX Search API as data source in Symphony.'
				 		);
		}

		function install(){
			Symphony::Configuration()->set('size', '4', 'gcse');
			Symphony::Configuration()->set('safe', 'moderate', 'gcse');
			return Symphony::Engine()->saveConfig();
		}

		function uninstall(){
			Symphony::Configuration()->remove('gcse');
			return Symphony::Engine()->saveConfig();
		}

		function enable(){
			if (!Symphony::Configuration()->get('safe', 'gcse'))
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
					if (!($temp = Symphony::Configuration()->get('qname', 'gcse'))) $temp = '{$q:$url-q}';
					Symphony::Configuration()->set('qname', '$'.$temp.':$url-'.$temp, 'gcse');
	
					if (!($temp = Symphony::Configuration()->get('pname', 'gcse'))) $temp = '{$p:$url-p}';
					Symphony::Configuration()->set('pname', '$'.$temp.':$url-'.$temp, 'gcse');

				default:
					$needSave = false;
					break;
			}

			return ($needSave ? Symphony::Engine()->saveConfig() : true);
		}

		public function fetchNavigation() {
			return array(
				array(
					'location'	=> __('System'),
					'name'		=> 'GCSE',
					'link'		=> '/preferences/',
					'limit'		=> 'developer',
				)
			);
		}

	}
?>