<?php $path = ($_SERVER['SERVER_NAME'] == 'localhost') ? 'http://localhost/~david/coffee-house/': base_url(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>SugarStore</title>
	<link rel="stylesheet" href="<?=$path?>style/main.css" type="text/css" media="screen" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script type="text/javascript" src="<?=$path?>js/mootools-1.2.1-core.js"></script>
	<script type="text/javascript" src="<?=$path?>js/core.js"></script>
</head>
<body>

<div id="main">

	<div id="coffeehouse"></div>
	
	<div id="navigation">
		<?php
			foreach ($menu as $menuitem)
			{
				$attribute = (@$menuitem[3] == true) ? "active" : '';
				echo "<span>" . anchor($menuitem[2], $menuitem[0], array('id'=>$menuitem[1], 'class'=>$attribute)) . "</span>";
			}
		?>
	</div>