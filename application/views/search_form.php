<?php

$this->load->helper('form');

echo form_open('search');
echo form_input(array('name'=>'query','class'=>'search full', 'id'=>'search_field'));
?>
    <div class="clear"></div>
<?
echo form_hidden('redirect','true');
echo form_close();