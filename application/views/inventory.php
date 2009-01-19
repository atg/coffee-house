
<!-- <p>Filter: <?=anchor('view/sugars','Sugars')?> <?=anchor('view/themes','Themes')?> <?=anchor('view/both','Both')?></p> -->

<?=$this->load->view('search_form')?>
<hr/>
<div class="list">
	<div id="list_content">
		<?php
			foreach ($this->core->inventory() as $item)
			{
			    # 0 = ID
			    # 1 = Type
			    # 2 = Title
			    # 3 = Description
			    echo "<span class='{$item[1]}'>" . anchor('sugar/'.$item[0], $item[2]) . anchor('quickload/'.$item[0], 'Download', array('class'=>'quickload')) . "<div class='clear'></div></span>";
			}
		?>
	</div>
</div>
<hr/>