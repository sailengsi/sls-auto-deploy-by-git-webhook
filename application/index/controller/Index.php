<?php

namespace app\index\controller;

use app\index\model\Log;

class Index {
    public function index() {
        $LogModel = new Log();
        return $LogModel->select();
    }
}
