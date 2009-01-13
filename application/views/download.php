
<hr/>
<div class="list">
	<?php
		$detail = $this->core->detail($this->uri->segment(2));
		if ($detail[4])
		{
			$git_username = strtolower($detail[5]);
			$git_project = strtolower($detail[6]);
			echo "<p>http://github.com/{$git_username}/{$git_project}/zipball/master</p>";
		}
		else
		{
			echo "<p>{$detail[7]}</p>";
		}
	?>
</div>
<hr/>