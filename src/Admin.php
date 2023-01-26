<?php

declare(strict_types=1);
session_start();

class AdminLogin
{
    protected string $adminName;
    protected string $adminPsw;

    public function __construct($adminName, $adminPsw)
    {
        $this->adminName = $adminName;
        $this->adminPsw  = $adminPsw;
    }

    public function checkLogin($adminName, $adminPsw, $userLogin, $userPsw)
    {


        if ($userLogin === $this->adminName && $userPsw === $this->adminPsw) {
            $_SESSION['admin'] = $this->adminName;
            header('Location: hotelAdmin.php');
        } else {
            throw new Exception('Not an Admin');
        }
    }
}
