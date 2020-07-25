<?php
/**
 * Created by PhpStorm.
 * User: mesko
 * Date: 21. 11. 2017
 * Time: 10:54
 */
include "DataClanok.php";
include "pagination.php";

class DBStorage implements IStorage
{
    private $record_per_page = 7;
    private $page;

    public function __construct()
    {
        $this->db = new mysqli('localhost','root','', 'holubek7');
        $this->checkERR();
    }

    public function pagi(){
        $item_per_page = 5;
        //Get page number from Ajax
        if(isset($_POST["page"])){
            $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
            if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
        }else{
            $page_number = 1; //if there's no page number, set it to 1
        }

        //get total number of records from database
        $results = $this->db->query("SELECT COUNT(*) FROM clanok");
        $get_total_rows = $results->fetch_row(); //hold total records in variable
        //break records into pages
        $total_pages = ceil($get_total_rows[0]/$item_per_page);

        //position of records
        $page_position = (($page_number-1) * $item_per_page);

        $sql = "SELECT ID, Nadpis, Popis, Datum FROM clanok ORDER BY ID ASC '{$page_position}', '{$item_per_page}'";
        //Limit our results within a specified range.
        $results = $this->db->prepare($sql);

        $results->execute(); //Execute prepared Query

        $results->bind_result($Nadpis, $Popis, $Datum); //bind variables to prepared statement


        //Display records fetched from database.
        echo '<ul class="contents">';
        while($results->fetch()){ //fetch values
            echo '<li>';
            echo  $Nadpis. '. <strong>' .$Popis.'</strong> &mdash; '.$Datum;
            echo '</li>';
        }
        echo '</ul>';

        echo '<div align="center">';
        // To generate links, we call the pagination function here.
        echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
        echo '</div>';
    }

    public function selectMostViewed(){
        $sql = "SELECT * FROM clanok ORDER BY pocet_navstev DESC LIMIT 12";
        $DBResult = $this->db->query($sql);
        $this->checkERR();
        return $DBResult;
    }

    // Vyberie zadany clanok z tabulky clanok
    public function selectArticle($IdClanku, $sekcia = 0){
            if($sekcia === 0){
                $sql = "SELECT * FROM clanok ORDER BY ID DESC";
            } else {
                $sql = "SELECT * FROM clanok WHERE Sekcia = '{$sekcia}' ORDER BY ID DESC";
            }


            $DBResult = $this->db->query($sql);

            if($DBResult->num_rows > 0){

                $i = 0;
                while($i != $IdClanku){
                    $row = $DBResult->fetch_object();
                    $i++;
                }
            }
            $this->checkERR();


        return new DataClanok($row->Nadpis, $row->Popis, $row->Datum, $row->Sekcia, $row->ID);
    }

    public function incCountOfVisitors($idClanku){
        $sql = "UPDATE clanok SET pocet_navstev = pocet_navstev + 1 WHERE ID ='{$idClanku}'";
        $this->db->query($sql);
    }

    public function selectArticleID($idClanku){
        $sql = "SELECT * FROM clanok WHERE ID = '{$idClanku}'";
        $DBResult = $this->db->query($sql);
        $row = $DBResult->fetch_object();
        return new DataClanok($row->Nadpis, $row->Popis, $row->Datum);
    }

    public function updateArticle($idClanku, $nazov, $popis){
        $sql = "UPDATE clanok SET Nadpis ='{$nazov}', Popis ='{$popis}' WHERE ID ='{$idClanku}'";
        $this->db->query($sql);
        $this->checkERR();

    }

    public function check($userName, $password)
    {
        $r = [];
        //$sql = "SELECT * FROM uzivatel WHERE Meno = '$userName' AND Heslo = '$password'";//podmienka where a zistit jedneho pouzivatela
        $sql = "SELECT * FROM uzivatel WHERE Meno = '$userName'";
        $DBResult = $this->db->query($sql);
        if ($DBResult->num_rows > 0){
            while($row = $DBResult->fetch_object()){
                echo $row->Heslo;
                if(password_verify($password, $row->Heslo))
                {
                    $_SESSION['login_user'] = $row->ID;
                } else
                    {
                        $_SESSION['password_incorrect'] = 1;
                    }
            }


        } else {
            $_SESSION['user_not_exist']=1;
        }
    }



    public function store(Data $data)
    {
        $sql = "SELECT * FROM uzivatel WHERE Meno = '{$data->meno}' AND Email = '{$data->email}'";
        $DBResult = $this->db->query($sql);
        if($DBResult->num_rows > 0) {
            $_SESSION["user_exist"] = 1;
        } else {
            //$datum = date("c", $data->datum);
            $sql = "INSERT INTO uzivatel(Meno, Heslo, Email, Popis) VALUE ('{$data->meno}','{$data->heslo}','{$data->email}','{$data->popis}')";
            $this->db->query($sql);
            $this->checkERR();
        }
    }

    public function  getUserArticle($id_user){
        $sql = "SELECT * FROM clanok WHERE id_uzivatel = '{$id_user}' order by ID DESC";
        $DBResult = $this->db->query($sql);
        return $DBResult;
    }
    // pocita pocet navstevnikov
    public function counter(){
        $_SESSION['counter'] = 1;
        $sql = "SELECT * FROM user_counts";
        $DBResult = $this->db->query($sql);
        while($row = $DBResult->fetch_object()){

                $new_count = $row->count + 1;
                $sql = "UPDATE user_counts SET count='{$new_count}'";
                $this->db->query($sql);
        }
    }

    public function getCountOfVisitors(){
        $sql = "SELECT * FROM user_counts";
        $DBResult = $this->db->query($sql);
        while($row = $DBResult->fetch_object()){
            return $row->count;
        }
    }


    public function storeArticle($nadpis, $popis, $sekcia,$idUzivatel) {
        $datum = date("Y-m-d");
        $sql = "INSERT INTO clanok(Nadpis, Popis, Datum, Sekcia, id_uzivatel) VALUE ('{$nadpis}','{$popis}','{$datum}','{$sekcia}','{$idUzivatel}')";
        $result = $this->db->query($sql);
        if ($result === TRUE) {
            $_SESSION['successInsert'] = 1;
        }
        $this->checkERR();
    }

    /**
     * @return Data[]
     */
    public function getAll()
    {
        $r = [];
        $sql = "SELECT * FROM clanok";
        $DBResult = $this->db->query($sql);
        if ($DBResult->num_rows > 0){
            while($row = $DBResult->fetch_object()){
                $r[] = new Data($row->Meno, $row->Heslo, $row->Email, $row->Popis);
            }
        }
        $this->checkERR();
        return $r;
    }

    public function getAllArticleCycle($sekcia){
        $this->record_per_page = 7;
        $this->page = '';
        if(isset($_GET["page"]))
        {
            $this->page = $_GET["page"];
        }
        else
        {
            $this->page = 1;
        }

        $start_from = ($this->page-1)*$this->record_per_page;
        $sql = "SELECT * FROM clanok WHERE Sekcia = '{$sekcia}' order by ID DESC LIMIT $start_from, $this->record_per_page";
        $DBResult = $this->db->query($sql);
        return $DBResult;
    }

    public function showPagination($sekcia = 0, $id_user = 0){
        if($sekcia === 0){
            $sql = "SELECT * FROM clanok WHERE id_uzivatel = '{$id_user}' ORDER BY ID DESC";
        } else if($id_user === 0){
            $sql = "SELECT * FROM clanok WHERE Sekcia = '{$sekcia}' ORDER BY ID DESC";
        }

        $page_result = $this->db->query($sql);
        //pocet clankov danej sekcie
        $total_records = $page_result->num_rows;//3
        //pocet stran kolko sa ma zobrazit
        $total_pages = ceil($total_records/$this->record_per_page);//1
        //echo $total_pages;
        $start_loop = $this->page;//1


        $difference = $total_pages - $this->page;
        if($difference <= 3)
        {
            $start_loop = $total_pages - 3;
        }
        $end_loop = $start_loop + 2;



        if($this->page > 1)
        {
            if(strcmp($sekcia,'cyklistika') == 0) {
                echo "<a href='cyklistika.php?page=1'>First</a>";
                echo "<a href='cyklistika.php?page=" . ($this->page - 1) . "'><<</a>";
            } else if(strcmp($sekcia,'auto') == 0){
                echo "<a href='autoTuristika.php?page=1'>First</a>";
                echo "<a href='autoTuristika.php?page=" . ($this->page - 1) . "'><<</a>";
            } else if(strcmp($sekcia,'cestna') == 0){
                echo "<a href='cestnaTuristika.php?page=1'>First</a>";
                echo "<a href='cestnaTuristika.php?page=" . ($this->page - 1) . "'><<</a>";
            }
        }
        for($i=$start_loop; $i<=$end_loop; $i++)
        {
            if(strcmp($sekcia,'cyklistika') == 0){
                echo "<a href='cyklistika.php?page=".$i."'>".$i."</a>";
            } else if(strcmp($sekcia,'auto') == 0) {
                echo "<a href='autoTuristika.php?page=" . $i . "'>" . $i . "</a>";
            } else if(strcmp($sekcia,'cestna') == 0){
                echo "<a href='cestnaTuristika.php?page=".$i."'>".$i."</a>";
            }

        }
        if($this->page <= $end_loop)
        {
            if(strcmp($sekcia,'cyklistika') == 0) {
                echo "<a href='cyklistika.php?page=".($this->page + 1)."'>>></a>";
                echo "<a href='cyklistika.php?page=".$total_pages."'>Last</a>";
            } else if(strcmp($sekcia,'auto') == 0){
                if($total_pages != $this->page) {
                    echo "<a href='autoTuristika.php?page=" . ($this->page + 1) . "'>>></a>";
                    echo "<a href='autoTuristika.php?page=".$total_pages."'>Last</a>";
                }

            } else if(strcmp($sekcia,'cestna') == 0){
                if($total_pages != $this->page) {
                    echo "<a href='cestnaTuristika.php?page=" . ($this->page + 1) . "'>>></a>";
                    echo "<a href='cestnaTuristika.php?page=".$total_pages."'>Last</a>";
                }

            }
        }
    }

    private function checkERR()
    {
        if ($this->db->error){
            echo "CHYBA: " . $this->db->error;
            die;
        }
    }
}