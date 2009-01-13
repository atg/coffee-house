<hr/>
<div class="list">
	<?php
		
		$query = $this->db->get_where('sugars', array('id'=>$this->uri->segment(2)));
		
		if ($query->num_rows() > 0)
		{
			$row = $query->row();
			
			echo "<h2>{$row->name} ".ucfirst($row->type)." &middot; ".anchor('quickload/'.$row->id, 'Download')."</h2>";
			echo Markdown($row->description);
			
			$github = $this->core->git($row->git_username, $row->git_project);
			
			if ($row->use_git)
			{
				echo "<h3>This ".$row->type." is hosted on Github.</h3>";
				echo "<p>Project URL: ".anchor($github, '<code>'.$github.'</code>')."</p>";
				echo "<div class='clear'></div>";
			}
			
			if ($row->type == 'theme')
			{
				?>
					<div class="preview_header"></div>
					<link rel="stylesheet" href="<? echo base_url().'index.php/theme/'.$row->id; ?>" type="text/css" media="screen" />
					<div class="preview">
						<div class="pre base"><span class="php">&lt;?php

<span class="php include">include(<span class="tag">'</span><span class="php string_single">functions.php</span><span class="tag">'</span>)</span>;
<span class="php keyword">if</span> (<span class="php variable_php">$this</span><span class="keyword">-></span><span class="php variable_php">logged_in</span>)
{
    <span class="php function">echo</span> <span class="tag">"</span><span class="php string_double">You are logged in!</span><span class="tag">"</span>;
}</span>

?>

<span class="css comment">/* CSS */</span>
<span class="css selector_css">body</span> {
    <span class="css property-name">color</span>: <span class="css color">#410fb9</span>;
    <span class="css property-name">font-family</span>: <span class="css property-value">Espresso Mono, monospace</span>;
}

/* JS */
<span class="invalid">Invalid</span>
</div>
					</div>
					<div class="preview_footer"></div>
					
				<?
			}
		}
		/*

		$detail = $this->core->detail($this->uri->segment(2));
		echo "<h2 class='{$detail[1]}'><span class='first'>{$detail[2]} " . ucfirst($detail[1]) . "</span><span>" . anchor('quickload/'.$detail[0], 'Download', array('class'=>'download')) . "</span></h2>";
		$description = Markdown($detail[3]);
		echo "<div class='description'>{$description}</div>";
		if ($detail[4])
		{
			echo "<p>This " . $detail[1] . " is hosted on Github.<br/>Project URL: <a href='" . $this->core->git($detail[5], $detail[6]) . "'><code>" . $this->core->git($detail[5], $detail[6]) . "</code></a></p>";
		}
*/
		/* echo "<p>If you are the creator of this " . $detail[1] . ", you can " . anchor('sugar/'.$detail[0].'/edit', 'edit') . " it."; */
	?>
	<!--
<p>Vote it: <em>(Not yet supported)</em>
		<div class="vote">
			<a href="#"></a>
			<a href="#"></a>
			<a href="#"></a>
			<a href="#"></a>
			<a href="#"></a>
			<div class="clear"></div>
		</div>
	</p>
-->
</div>
<hr/>