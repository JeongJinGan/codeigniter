<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        
        $this->load->model('Board_model', 'board');
    }

	public function index()
	{
        $data['list'] = $this->board->getAll();

		$this->load->view('board/list', $data);
	}
    public function create()
	{
		$this->load->view('board/create');
	}
    public function store()
	{
        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('contents','Contents','required');
		
        if($this->form_validation->run())
        {
            $this->board->store();
            redirect('/board');
        }
        else
        {
            echo "Error";
        }
	}

    public function show($idx)
    {
        $data['view'] = $this->board->get($idx);

        $this->load->view("board/show", $data);
    }

    public function edit($idx)
    {
        $data['edit'] = $this->board->get($idx);

        $this->load->view("board/edit", $data);
    }

    public function update($idx)
	{
        $this->form_validation->set_rules('title','Title','required');
        $this->form_validation->set_rules('contents','Contents','required');
		
        if($this->form_validation->run())
        {
            $this->board->update($idx);
            redirect('/board');
        }
        else
        {
            echo "Error";
        }
	}

    public function delete($idx)
    {
        $item = $this->board->delete($idx);

        redirect("/board");
    }
}

?>