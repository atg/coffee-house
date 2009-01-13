<?php

class Core extends Model {

	var $name = '';
	
	function menu()
	{
		return array(
			'home' => array('Home', 't1', ''),
			'search' => array('Search', 't2', 'search'),
			'submit' => array('Submit', 't3', 'submit'),
			'about' => array('About', 't4', 'about'),
		);
	}
	
	function inventory($term = false)
	{
		if ($term)
		{
			$query = $this->db->query("SELECT * FROM sugars WHERE name REGEXP '(.*){0,}{$term}(.*){0,}' ORDER BY name");
		}
		else
		{
			$query = $this->db->query("SELECT * FROM sugars ORDER BY name");
		}
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				$list[] = array($row->id, $row->type, $row->name, $row->description);
			}
			# 0 = ID
			# 1 = Type
			# 2 = Title
			# 3 = Description
			return $list;
		}
	}
	
	function detail($id)
	{
		$query = $this->db->query("SELECT * FROM sugars WHERE id LIKE {$id}");
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row();
			return array($row->id, $row->type, $row->name, $row->description, $row->use_git, $row->git_username, $row->git_project, $row->download_url);
		}
	}
	
	function git($git_username, $git_project, $download = false)
	{
		$git_username = strtolower($git_username);
		$git_project = strtolower($git_project);
		
		if ($download)
		{
			return "http://github.com/{$git_username}/{$git_project}/zipball/master";
		}
		else
		{
			return "http://github.com/{$git_username}/{$git_project}";
		}
	}

}