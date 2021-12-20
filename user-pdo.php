<?php
session_start();
/*$user = 'root';
$pass = '';

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=classes', $user, $pass);
    foreach ($bdd->query('SELECT * FROM utilisateurs') as $row) 
    {
        print_r($row);
    }
} catch (PDOException $e)
{
    print "Error: " . $e->getMessage() . "<br/>";
    die;
}*/

class User {
    protected $bdd;
    private $id;
    public $login;
    public $password;
    public $email;
    public $firstname;
    public $lastname;

    public function __construct($id, $login, $password, $email, $firstname, $lastname) {
        $this->id = $id;
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->bdd = new PDO('mysql:host=localhost;dbname=classes', 'root', '');
    }

    public function register($login, $password, $email, $firstname, $lastname) {
        $reqinsertsql = "INSERT INTO `utilisateurs` (`login`, `email`, `password`, `firstname`, `lastname`) VALUES ('$this->login', '$this->email', '$this->password', '$this->firstname', '$this->lastname')";
        $reqselecsql = "SELECT*FROM utilisateurs WHERE login = '$this->login'";
        $calcul1 = $this->bdd->prepare($reqinsertsql);
        $calcul1 -> execute();
        $calcul2 = $this->bdd->prepare($reqselecsql);
        $calcul2 -> execute();
        $result2 = $calcul2->fetchAll(PDO::FETCH_ASSOC);
        
        //var_dump($result2);

    }

    public function connect($login,$password) {
        $reqselectsql = "SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'";
        $selec = $this->bdd->prepare($reqselectsql);
        $selec-> execute();
        $result = $selec->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($result);

        $_SESSION['login'] = $result[0]['login'];
        $_SESSION['id'] = $result[0]['id'];
        //var_dump($_SESSION);



        /*$this->id = $result[0]['0'];
        $this->login = $result[0]['1'];
        $this->password = $result[0]['2'];
        $this->email = $result[0]['3'];
        $this->firstname = $result[0]['4'];
        $this->lastname = $result[0]['5'];

        $_SESSION = $result;
        var_dump($this->id);*/
        //var_dump($_SESSION);

    }

    public function disconnect() {
        unset($_SESSION);
        session_destroy();
    }

    public function delete() {
        $_SESSION['login'] = $this->login;
        //var_dump($_SESSION);
        $reqdelete = "DELETE FROM `utilisateurs` WHERE `login` = '$this->login'";
        $calcul1 = $this->bdd->prepare($reqdelete);
        $calcul1->execute();
        session_destroy();

    }

    
    public function update($login, $password, $email, $firstname, $lastname) {
        $this->id = $_SESSION['id'];
        $reqinsert = "UPDATE utilisateurs SET  login = '$login', email = '$email', password = '$password', firstname = '$firstname', lastname = '$lastname' WHERE id = $this->id";
        $calcul1 = $this->bdd->prepare($reqinsert);
        $calcul1-> execute();
        session_destroy();

       
    }

    public function getAllInfos(){


        $this->login = $_SESSION['login'];
        $reqselectsql = "SELECT * FROM utilisateurs WHERE login = '$this->login'";
        $selec = $this->bdd->prepare($reqselectsql);
        $selec-> execute();
        $result = $selec->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
        $this->id = $result[0]['id'];
        $this->login = $result[0]['login'];
        $this->password = $result[0]['password'];
        $this->email = $result[0]['email'];
        $this->firstname = $result[0]['firstname'];
        $this->lastname = $result[0]['lastname'];

  
    }

    public function getLogin() { 
        echo nl2br("Login : ". $this->login."\n");        
    }
    public function getEmail() { 
        echo nl2br("email : ". $this->email."\n");          
    }
    public function getFirstname() { 
        echo nl2br("firstname : ". $this->firstname."\n"); 
    }
    public function getLastname() { 
        echo nl2br("lastname : ". $this->lastname)."\n";         
    }

    public function isConnected() {
        if($_SESSION == true) {
            echo "utilisateur connecté";
        }
    }

}

$user = new User(" ", "jean", "jean", "jojo@aol.com", "Morera", "joan");
//$user->register("", "jean", "jean", "jojo@aol.com", "Morera", "joan");
$user ->connect("lolo", "lolo");
//$user->disconnect();
//$user->delete();
//var_dump($_SESSION); 
//var_dump($user);
//$user->update("lola","lolo","lolo","lolo","lolo",);
$user->getAllInfos();
?>