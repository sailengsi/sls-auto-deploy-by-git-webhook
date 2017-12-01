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
            $data = $LogModel->order('id desc')->find();
            return json_decode($data['content'], true);
        }
        $data=[
            'content'=>$requestBody
        ];
        $LogModel->data($data)->save();
        //        http://sailengsi:f1ca0de95f2c8b4c0e661cc55f14448b@119.28.176.58:8080/generic-webhook-trigger/invoke
        http('http://sailengsi:f1ca0de95f2c8b4c0e661cc55f14448b@119.28.176.58:8080/generic-webhook-trigger/invoke', $pushData, 'POST');
        return [
            'id'=>$LogModel->id
        ];
    }
}
