<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {

	public function page_404(){
		$data['content'] = '404';
		$this->load->view('page_404',$data);
	}

}

/* End of file Control.php */
/* Location: ./application/controllers/Control.php */