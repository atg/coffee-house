<?php

$config = array (
	
	'submit' => array (
		
		array (
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|required|max_length[100]'
		),
		
		array (
			'field' => 'type',
			'label' => 'Type',
			'rules' => 'required'
		),
		
		array (
			'field' => 'github_name',
			'label' => 'Github Username',
			'rules' => 'trim|max_length[100]'
		),
		
		array (
			'field' => 'github_project',
			'label' => 'Github Project',
			'rules' => 'trim|max_length[100]'
		),
		
		array (
			'field' => 'download_url',
			'label' => 'Download URL',
			'rules' => 'trim|max_length[500]|xss_clean|prep_url'
		),
		
		array (
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'trim|required|max_length[1000]'
		),
		
		array (
			'field' => 'mail',
			'label' => 'Mail',
			'rules' => 'trim|required|valid_email'
		),
		
		array (
			'field' => 'password',
			'label' => 'Password',
			'rules' => 'trim|required'
		),
		
	)
	
);