<?php

$query = $this->uri->segment(2);

if ( ! $query)
{
	if ( ! $this->input->post('redirect'))
	{
		echo form_open('search');
		echo form_input(array('name'=>'query','class'=>'search left'));
		echo form_submit(array('name'=>'submit','class'=>'search right', 'value'=>'Search'));
		?>
			<div class="clear"></div>
		<?
		echo form_hidden('redirect','true');
		echo form_close();
	}
	else
	{
		redirect('search/'.$this->input->post('query'));
	}
}
else
{
		echo form_open('search');
		echo form_input(array('name'=>'query','class'=>'search', 'value'=>$query));
		echo form_submit(array('name'=>'submit','class'=>'search', 'value'=>'Search'));
		echo form_hidden('redirect','true');
		echo form_close();
	?>
	<hr/>
	<div class="list">
		<?php
			if ($this->core->inventory($query))
			{
				foreach ($this->core->inventory($query) as $item)
				{
				    # 0 = ID
				    # 1 = Type
				    # 2 = Title
				    # 3 = Description
				    echo "<span class='{$item[1]}'>" . anchor('sugar/'.$item[0], $item[2]) . anchor('quickload/'.$item[0], 'Download', array('class'=>'quickload')) . "<div class='clear'></div></span>";
				}
			}
			else
			{
				echo "<h2>Nothing found.</h2>";
				echo "<p>Check the search term again.</p>";
			}
		?>
	</div>
	<hr/>
	<?
}