<?php

namespace WPCADASTROPERSONALIZADO\Controllers;

abstract class BaseController
{
    protected $baseURL = WP_PLUGIN_URL_BASE;
    protected $assetsBaseURL = WP_PLUGIN_URL_BASE_ASSETS;

    public function printJSON(string $status, string $msg, $data, $action)
    {
        echo json_encode([
            'status' => $status,
            'msg' => $msg,
            'data' => $data,
            'action' => $action
        ]);
    }
}