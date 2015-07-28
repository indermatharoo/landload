<?php

class Messages extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('messagemodel');
         $this->load->library('form_validation');
    }
    function index()
    {
        $this->load->model('messagemodel');
        $messages = $this->messagemodel->getAllmessages();
        
        $inner = array();
        $inner['allMessages'] = $messages;
        $page['content'] = $this->load->view('messages', $inner, TRUE);
        $this->load->view($this->default, $page);
    }
    function delete($offset=false)
    {
        if(!$offset)
        {
            redirect('user/messages');
            return false;
        }
        $messages = $this->messagemodel->DeleteAllConversation($offset);
        $this->session->set_flashdata('SUCCESS', 'message_added');
        redirect(createUrl('user/messages/'));        
    }
    function reply($offset=false)
    {
        if(!$offset)
        {
            redirect('user/messages');
            return false;
        }       
        $this->form_validation->set_rules('message', 'Message', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $messages = $this->messagemodel->getMessagesByUserId($offset);
            $inner['allMessages'] = $messages;
            $page['content'] = $this->load->view('reply', $inner, TRUE);
            $this->load->view($this->default, $page);
        }
        else{
            $messages = $this->messagemodel->addReply($offset);
            $this->session->set_flashdata('SUCCESS', 'message_deleted');
            redirect(createUrl('user/messages/reply/'.$offset));     
        }
    }

}