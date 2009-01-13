<?php

class Sugarstore extends Controller {

	function Sugarstore()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->model('core', '', true);
		# get and set menu
		$data['menu'] = $this->core->menu();
		array_push($data['menu']['home'], true);
		$this->load->view('header', $data);
		$this->load->view('inventory');
		$this->load->view('footer');
	}
	
	function sugar()
	{
		$this->load->model('core', '', true);
		$this->load->helper('markdown');
		# get and set menu
		$data['menu'] = $this->core->menu();
		array_push($data['menu']['home'], true);
		$this->load->view('header', $data);
		$this->load->view('detail');
		$this->load->view('footer');
	}
	
	function download()
	{
		$this->load->model('core', '', true);
		# get and set menu
		$data['menu'] = $this->core->menu();
		array_push($data['menu']['home'], true);
		$this->load->view('header', $data);
		$this->load->view('download');
		$this->load->view('footer');
	}
	
	function quickload()
	{
		$this->load->model('core', '', true);
		$this->load->helper('download');
		# get and set menu
		$data['menu'] = $this->core->menu();
		array_push($data['menu']['home'], true);
		$this->load->view('header', $data);
		$this->load->view('quickload');
		$this->load->view('footer');
	}
	
	function search()
	{
		$this->load->model('core', '', true);
		$this->load->helper('form');
		# get and set menu
		$data['menu'] = $this->core->menu();
		array_push($data['menu']['search'], true);
		$this->load->view('header', $data);
		$this->load->view('search');
		$this->load->view('footer');
	}
	
	function about()
	{
		$this->load->model('core', '', true);
		# get and set menu
		$data['menu'] = $this->core->menu();
		array_push($data['menu']['about'], true);
		$this->load->view('header', $data);
		$this->load->view('about');
		$this->load->view('footer');
	}
	
	function submit()
	{
		$this->load->model('core', '', true);
		$this->load->helper('form');
		# get and set menu
		$data['menu'] = $this->core->menu();
		array_push($data['menu']['submit'], true);
		$this->load->view('header', $data);
		$this->load->view('submit');
		$this->load->view('footer');
	}
	
	function dev()
	{
		$this->load->model('core', '', true);
		if ($this->uri->segment(2) == 'xml')
		{
			header('Content-Type: application/xml');
			echo "<inventory>\n";
			if ($this->uri->segment(3) == 'by_date')
			{
				$query = $this->db->query("SELECT * FROM sugars ORDER BY datetime");
			}
			else
			{
				$query = $this->db->query("SELECT * FROM sugars ORDER BY name");
			}
			
			foreach ($query->result() as $row)
			{
				echo "\t<{$row->type}>\n";
					echo "\t\t<name>" . $row->name . "</name>\n";
					echo "\t\t<description>" . $row->description . "</description>\n";
					$use_github = ($row->use_git) ? 'true' : 'false';
					echo "\t\t<github>" . $use_github . "</github>\n";
					if ($row->use_git)
					{
						echo "\t\t<github_url>" . $this->core->git($row->git_username, $row->git_project) . "</github_url>\n";
						echo "\t\t<download_url>" . $this->core->git($row->git_username, $row->git_project, true) . "</download_url>\n";
					}
					else
					{
						echo "\t\t<download_url>" . $row->download_url . "</download_url>\n";
					}
					echo "\t</{$row->type}>\n";
			}
			echo "</inventory>";
		}
	}
}