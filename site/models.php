<?php

class Username {
    public var $id = NULL;
    public var $username = NULL;
    public var $password = NULL;
    public var $is_seller = NULL;

    public function __construct($id, $username, $password, $is_seller){
        $this->id = (int)$id;
        $this->username = (string)$username;
        $this->password = (string)$password;
        if ($is_seller == 1 || $is_seller == "1"){
            $this->is_seller = true;
        } elseif ($is_seller == 0 || $is_seller == "0"){
            $this->is_seller = false;
        } else {
            $this->is_seller = NULL;
        }
    }
}