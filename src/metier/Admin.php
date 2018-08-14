<?php

class Admin
{
    private $login;
    private $role;
    private $hashPwd;


    public function getLogin()
    {
        return $this->login;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getHashPwd()
    {
        return $this->hashPwd;
    }

    function __construct($login,$role,$hashPwd='')
    {
        $this->login = $login;
        $this->role = $role;
        $this->hashPwd = $hashPwd;
    }

}