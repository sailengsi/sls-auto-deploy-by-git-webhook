<?php

namespace app\index\controller;

use app\index\model\Log;

class Index {
    public function index() {
        $requestBody = file_get_contents("php://input");
        $data        = json_decode($requestBody, true);
        $LogModel = new Log();
        if (empty($data)) {
            return $LogModel->select();
        }
        $data=[
            'content'=>$requestBody
        ];
        $LogModel->save($data);
        return $LogModel->id;
    }
}
