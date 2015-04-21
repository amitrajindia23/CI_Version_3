<?php
	class Layouts
	{
		private $CI;
		private $title_separator = ' | ';
		private $includes;
		public $data = array();

		
		public function __construct(){
			$this->CI =& get_instance();
		}

		//Magic method implemented to set values
		public function __set($name, $value){
			$this->data[$name] = $value;
		}

		//Magic method implemented to get values
		public function __get($name){
			if(array_key_exists($name, $this->data))
			{
				return $this->data[$name];
			}
			return null;
		}

		//Magic method implemented to set & get values
		public function __call($method,$arguments){
			$methodkey = substr($method, 0,3);
			$key = substr($method, 3);

			if($methodkey == 'set')
			{
				$value = $arguments[0];
				$this->__set(strtolower($key),$value);
			}
			else if($methodkey == 'get')
			{
				return $this->__get(strtolower($key));
			}
		}
	
		//following function is used in loading a view based on layout
		public function view($view_name, $params = array(), $layout){

			$renderedview = $this->CI->load->view($view_name,$params,TRUE);
			
			if($this->data['title'])
			{
				$this->data['title'] = $this->title_separator.$this->data['title'];
			}

			if(array_key_exists('error', $this->data)){
				$error = $this->data['error'];
			}
			else{
				$error = '';
			}

			$this->CI->load->view('layouts/'.$layout, array(
					'content_for_layout' => $renderedview,
					'title_for_layout' => $this->data['title'],
					'error' => $error
				));
		}

		//this method is used to include files in layout
		public function add_include($path,$prepend_base_url=TRUE){
			if($prepend_base_url){
				$this->CI->load->helper('url');
				$this->includes[] = base_url().$path;
			}else{
				$this->includes[] = $path;
			}
			return $this;  		//$this->layouts->add_include('fvgfgdfg')->add_include('dfsadfsdaf');
		}

		//this method is used to print included files in layout based on type like .css/.js
		public function print_includes(){
			$final_includes = '';
			foreach ($this->includes as $include) {
				if(preg_match('/js$/', $include)){
					$final_includes .= '<script src="'.$include.'"></script>';
				}elseif (preg_match('/css$/', $include)) {
					$final_includes .= '<link href="'.$include.'" rel="stylesheet"/>';
				}
			}
			return $final_includes;
		}
	}
?>