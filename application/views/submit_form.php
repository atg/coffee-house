	
	<?=validation_errors("<p class='error'>", "</p>")?>
	
	<?=form_open('submit')?>
		
		<h2>Name of your
		<select name="type">
			<option value="sugar" <?=set_select('type','sugar',TRUE)?>>Sugar</option>
			<option value="theme" <?=set_select('type','theme')?>>Theme</option>
		</select></h2>
		<input type="text" class="full" name="name" value="<?=set_value('name')?>" />
		
		<hr class="space"/>
		
		<h2 class="half left">Github Username</h2>
		<h2 class="half right">Github Project</h2>
			<div class="clear"></div>
		<input type="text" class="half left" name="github_name" value="<?=set_value('github_name')?>" />
		<input type="text" class="half right" name="github_project" value="<?=set_value('github_project')?>" />
			<div class="clear"></div>
		
		<h2 class="half left"><em>OR</em> Direct Download URL</h2>
		<h2 class="half right">Language XML file</h2>
			<div class="clear"></div>
		<input type="text" class="half left" name="download_url" value="<?=set_value('download_url')?>" />
		<div class="half right"><input type="file" name="languagexml" /></div>
		<hr class="space"/>
		
		<h2>Description*</h2>
		<textarea name="description" class="full" cols="20" rows="8"><?=set_value('description')?></textarea>
		
		<hr class="space"/>
		
		<h2 class="half left">Your Mail</h2>
		<h2 class="half right">Password</h2>
			<div class="clear"></div>
		<input type="text" class="half left" name="mail" value="<?=set_value('mail')?>" />
		<input type="text" class="half right" name="password" value="<?=set_value('password')?>" />
			<div class="clear"></div>
		
		<hr class="space"/>
		
		<h2>That was all.</h2>
		<p class="alt">*: You can use <a href="http://daringfireball.net/projects/markdown/syntax" rel="external">Markdown</a> to format the text.</p>
		<?=form_submit('submit', 'Submit')?>
		
	<?=form_close()?>