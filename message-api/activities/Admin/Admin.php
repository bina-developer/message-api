<?php

namespace Activities\Admin;

use Activities\Auth\Authentication;

class Admin
{
    public $currentDomain;
    public $basePath;

    function __construct()
    {
        $auth = new Authentication();
        $auth->checkAdmin();
        $this->currentDomain = CURRENT_DOMAIN;
        $this->basePath = BASE_PATH;
    }
    protected function redirect($url)
    {
        header("Location: " . trim($this->currentDomain, '/ ') . '/' . trim($url, '/ '));
        exit;
    }
    protected function redirectBack()
    {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
