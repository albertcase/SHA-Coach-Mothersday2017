<?php
namespace CampaignBundle;

use Core\Controller;


class CollectionController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function indexAction(){
        $this->statusPrint('success');
    }

}
