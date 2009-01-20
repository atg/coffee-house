<?php

# File: ajax.php
# Controller
# Ajax support

class Ajax extends Controller {
	
	function index()
	{
		header("Location: ".base_url());
	}
	
	function search()
	{
		$term = $this->input->get_post('term');
		
		if ($term)
		{
			$query = $this->db->query("SELECT * FROM sugars WHERE name REGEXP '{$term}' ORDER BY name");
		}
		else
		{
			$query = $this->db->query("SELECT * FROM sugars ORDER BY name");
		}
		
		if ($query->num_rows() > 0)
		{
			foreach ($query->result() as $row)
			{
				?>
				<span class="<?=$row->type?>">
					<?=anchor('sugar/'.$row->id, $row->name)?>
					<?=anchor('quickload/'.$row->id, 'Download', array('class'=>'quickload'))?>
					<div class="clear"></div>
				</span>
				<?
			}
		}
		else
		{
			echo "<h3>Nothing found.</h3>";
		}
		echo "<div class='clear'></div>";
	}	
}