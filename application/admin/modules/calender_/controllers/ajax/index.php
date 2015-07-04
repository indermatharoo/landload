<?php

class Index extends Admin_Controller {

    function complete() {
//        e($_REQUEST);
        $this->load->model('Calendermodel');
        $arr = rSF('event_complete');        
        $this->Calendermodel->eventComplete($arr);
    }

}
