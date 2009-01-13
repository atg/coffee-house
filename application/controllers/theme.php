<?php

class Theme extends Controller {
	
	function index()
	{
	}
	
	function live()
	{
		$this->load->helper('file');
		$query = $this->db->get_where('sugars', array('id'=>$this->uri->segment(2)));
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row();
			
			header("Content-type: text/css");
			
			$theme = read_file('themes/'.$row->css_name.'.css');
			
			$style = $theme;
			
			# var.php => var_php
			$style = preg_replace('/(.*)\.(.*)\.(.*)\.(.*)/', "$1_$2_$3_$4", $style);
			$style = preg_replace('/(.*)\.(.*)\.(.*)/', "$1_$2_$3", $style);
			$style = preg_replace('/(.*)\.(.*)/', "$1_$2", $style);
			
			# var>php => var_php
			$style = preg_replace('/(.*)(\s{0,})(>)(\s{0,})(.*)/', "$1.$5", $style);
			
			# Make class
			$style = preg_replace('/(php|css|js|html)\s(.*)/', ".$1.$2", $style);
			$style = preg_replace('/\,\s{0,}(php|css|js|html)\s(.*)/', ", .$1.$2", $style);
			$style = preg_replace('/string\s(double|single)/', ".string_$1", $style);
			$style = preg_replace('/tag/', ".tag", $style);
			
			# CSS
			$style = preg_replace('/\.property-list /', "", $style);
			
			# Base
			$style = preg_replace('/(\@base)/', 'div.pre.base', $style);
			
			echo $style;
		}
	}
	
}