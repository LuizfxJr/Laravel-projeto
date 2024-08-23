<?php

namespace App\Http\Services\Helper;

use App\Models\Helper as HelperInterface;

class Helper {

    protected $helper;

    public function __construct(HelperInterface $helper){
        $this->helper = $helper;
    }

    public function getFederativeUnit(){
        return $this->helper->getFederativeUnit();
    }

}