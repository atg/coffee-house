<?php

class Submit extends Controller {
	
	function getLanguageXML($path, &$err)
	{
		$err = "";
		
		//Check that $path is valid
		if (!isset($path) || file_exists($path))
		{
			$err = "Please upload a langauge.xml file..";
			return "";
		}

	/*	$file = $_FILES['languagexml'];
		if (!$file)
		{
			$err = "Please upload a valid langauge.xml file..";
			return "";
		}

		if ($file['size'] > (1024 * 1024) || $file['size'] == 0) // 1 megabyte
		{
			$err = "Language.xml must be under 1MB.";
			return "";
		}
		*/

		//Open the file
		$h = fopen($path, 'r');
		
		//Extract the string rep
		$lang = fgets($h);
		
		//Close the file
		fclose($h);
		
		//Delete the temp file
		unlink($path);
		
		//Check that the file wasn't empty
		if (!strlen($lang))
		{
			$err = "Please upload a non-empty langauge.xml file.";
			return "";
		}

		return $lang;
	}
	
	
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
			
			//Upload the language.xml file
			$err = "";
			$langXML = "";
			if ($use_github == 0)
			{
				$opts = array();
				$opts['upload_path'] = './tmp_uploads/';
				$opts['allowed_types'] = 'xml';
				$opts['max_size']	= '1024';

				$this->load->library('upload', $opts);

				if (!$this->upload->do_upload())
				{
					//Error
					$this->load->view('submit_form', array('error_text' => $this->upload->display_errors()));
					$this->load->view('footer');
					return;
				}
			
				$fileData = $this->upload->data();
				$langXML = $this->getLanguageXML($fileData["full_path"], $err);
				if ($langXML == "" || $err != "")
				{
					//Error
					$this->load->view('submit_form', array('error_text' => $this->upload->display_errors()));
					$this->load->view('footer');
					return;
				}
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
				'language_xml'	=> $langXML,
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