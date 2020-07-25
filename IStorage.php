<?php
/**
 * Created by PhpStorm.
 * User: mesko
 * Date: 21. 11. 2017
 * Time: 10:26
 */

interface IStorage
{
    public function store(Data $data);

    /**
     * @return Data[]
     */
    public function getAll();
}