<?php

class App
{

    /**
     * @var bool Ak je false ma sa zobrazit formular pre odoslanie. Ak je true zobrazi sa zoznam zozbieranych dat
     */
    private $options = [
        'cost' => 12,
    ];


    /**
     * @var IStorage
     */
    private $storage;

    public function __construct()
    {
        //$this->storage = new FileStorage(); // zapis do subora
        $this->storage = new DBStorage(); // zapis do DB


        if (isset($_POST['op']) and $_POST['op'] == 'save') {
            $this->storage->storeArticle($_POST['nadpis'], $_POST['popis'], $_POST['sekcia'],$_SESSION['login_user']);
        }

        if (isset($_SESSION['OK'])){

            /*$this->storage->store(new Data($_POST['meno'], password_hash($_POST['heslo'],PASSWORD_BCRYPT,$this->options), $_POST['email'], $_POST['popis'])); // ulozenie dat
            if(!isset($_SESSION["user_exist"])){$_SESSION['login_user'] = $_POST['meno'];}
            */

            unset($_SESSION['OK']);
        }

        if(isset($_POST['login'])) {
            $this->storage->check($_POST['meno'], $_POST['heslo']);

        }

        if(isset($_POST['saveArticle'])){

            $this->storage->storeArticle($_POST['nadpis'], $_POST['popis'], $_POST['sekcia'],$_SESSION['login_user']);

        }

        if(isset($_POST['updateArticle'])){
            $this->storage->updateArticle($_POST['idClanku'],$_POST['nadpis'],$_POST['popis']);
        }



    }

    public function pagi(){
        $this->storage->pagi();
    }

    /**
     * @return Data[]
     */
    public function getAllData()
    {
        return $this->storage->getAll();
    }

    public function getAllArticleCycle($sekcia){
        return $this->storage->getAllArticleCycle($sekcia);
    }
    public function showPagination($sekcia){
        $this->storage->showPagination($sekcia);
    }

    public function selectArticle($idClanku, $sekcia = 0){
        return $this->storage->selectArticle($idClanku, $sekcia);
    }

    public function incCountOfVisitors($idClanku){
        $this->storage->incCountOfVisitors($idClanku);
    }

    public function selectMostViewed(){
        return $this->storage->selectMostViewed();
    }

    public function getCountOfVisitors(){
        return $this->storage->getCountOfVisitors();
    }

    public function selectArticleID($idClanku){
        return $this->storage->selectArticleID($idClanku);
    }

    public function getUserArticles($id_user){
        return $this->storage->getUserArticle($id_user);
    }

    public function counter() {
        $this->storage->counter();
    }
}