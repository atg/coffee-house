<?php

	$detail = $this->core->detail($this->uri->segment(2));
	if ($detail[4])
	{
		$git_username = strtolower($detail[5]);
		$git_project = strtolower($detail[6]);
		$url = "http://github.com/{$git_username}/{$git_project}/zipball/master";
	}
	else
	{
		$url = $detail[7];
	}

if ($url)
{
	header("Location: {$url}");
}
else
{
	?><h2>There was an error downloading the file.</h2><?
}