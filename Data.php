<?php
/**
 * Created by PhpStorm.
 * User: mesko
 * Date: 21. 11. 2017
 * Time: 10:23
 */

class Data
{
    public $meno;
    public $heslo;
    public $email;
    public $popis;

    public function __construct($meno, $heslo, $email, $popis)
    {
        $this->meno = $meno;
        $this->heslo = $heslo;
        $this->email = $email;
        $this->popis = $popis;
    }
}