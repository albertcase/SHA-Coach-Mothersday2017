<?php
namespace CampaignBundle;

use Core\Controller;


class RegisterController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function userAction(){
        $this->dataPrint(array('status' => success));
    }

}
