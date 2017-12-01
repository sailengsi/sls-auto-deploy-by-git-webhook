<?php

namespace app\index\controller;

use app\index\model\Log;

class Index {
    public function index() {
        $requestBody = file_get_contents("php://input");
        $pushData = null;
        if ($requestBody) {
            $pushData = json_decode($requestBody, true);
        }
        $LogModel = new Log();
        if (empty($pushData)) {
            return $LogModel->select();
        }
        $data=[
            'content'=>$requestBody
        ];
        $LogModel->data($data)->save();
        return [
            'id'=>$LogModel->id
        ];
    }
}
