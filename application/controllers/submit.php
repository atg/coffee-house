<?php

class Submit extends Controller {
	
	function index()
	{
		$this->load->model('core', '', TRUE);
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		# get and set menu
		$data['menu'] = $this->core->menu();
		array_push($data['menu']['submit'], true);
		$this->load->view('header', $data);
		
		if ($this->form_validation->run('submit') == FALSE)
		{
			$this->load->view('submit_form');
		}
		else
		{
			if ($this->input->post('download_url') != '')
			{
				$use_github = 0;
				$github_name = '';
				$github_project = '';
				$download_url = $this->input->post('download_url');
			}
			else
			{
				$use_github = 1;
				$github_name = $this->input->post('github_name');
				$github_project = $this->input->post('github_project');
				$download_url = '';
			}
			
			$data = array(
				'id'			=> '',
				'name'			=> $this->input->post('name'),
				'type'			=> $this->input->post('type'),
				'description'	=> $this->input->post('description'),
				'use_git'		=> $use_github,
				'git_username'	=> $github_name,
				'git_project'	=> $github_project,
				'download_url'	=> $download_url,
				'datetime'		=> date('Y-m-d H:i:s'),
				'mail'			=> $this->input->post('mail'),
				'password'		=> md5($this->input->post('password')),
				'vote'			=> '',
				'vote_count'	=> 0,
				'css_name'		=> '',
			);
			$this->db->insert('sugars', $data);
			
			$message = "Hello Sugar Daddy!\n\nThanks for submitting your ".$this->input->post('type').".\nYour password: ".$this->input->post('password')."\nKeep it in a safe place!\n\nThe SugarStore";
			mail($this->input->post('mail'), "SugarStore", $message, "From:me@davidczihak.com");
			
			$this->load->view('submit_success');
		}
		$this->load->view('footer');
	}
	
}