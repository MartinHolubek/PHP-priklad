<?php
/**
 * Created by PhpStorm.
 * User: mesko
 * Date: 21. 11. 2017
 * Time: 10:23
 */

class DataClanok
{
    public $nazov;
    public $popis;
    public $datum;
    public $sekcia;
    public $idClanku;


    public function __construct($nazov, $popis, $datum,$sekcia = NULL,$idClanku = NULL)
    {
        $this->nazov = $nazov;
        $this->popis = $popis;
        $this->datum = $datum;
        $this->sekcia = $sekcia;
        $this->idClanku = $idClanku;
    }
}