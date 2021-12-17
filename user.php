<?php
/*$bdd_username = 'root';
$bdd_password = '';
$bdd_name     = 'classes';
$bdd_host     = 'localhost';
$bdd = mysqli_connect($bdd_host, $bdd_username, $bdd_password,$bdd_name);
mysqli_set_charset($bdd, 'utf8');
*/

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
        $this->bdd = mysqli_connect('localhost', 'root', '', 'classes');
    }

    public function register($login, $password, $email, $firstname, $lastname) {
        /*$login = ($_POST['username']);
        $password = ($_POST['password']);
        $email = ($_POST['email']);
        $firstname = ($_POST['firstname']);
        $lastname = ($_POST['lastname']);*/
        $reqinsert = mysqli_query($this->bdd,"INSERT INTO `utilisateurs` (`login`, `email`, `password`, `firstname`, `lastname`) VALUES ('$this->login', '$this->email', '$this->password', '$this->firstname', '$this->lastname')");
        $req = mysqli_query($this->bdd,"SELECT*FROM utilisateurs WHERE login = '$this->login'");
        $result = $req->fetch_array(MYSQLI_ASSOC);
        //var_dump($result);



    }

    public function connect($login,$password) {
        $reqselect = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'");
        $result = mysqli_fetch_all($reqselect); 
        var_dump($result);

    }
    /*$reqinsert = mysqli_query($bdd, "INSERT INTO utilisateurs(login, password) VALUES ('$login','$mdp')");*/


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
    public function getAllInfos() {
        var_dump ($array = [
            
            id => $this->id,
            login => $this->login,
            password=>$this->password,
            email => $this->email,
            firstname => $this->firstname,
            lastname => $this->lastname,
    
    
                        ]);
    }

}

$user = new User(" ", "jojofou", "jojo", "jojo@aol.com", "Morera", "joan");
/*$user->getLogin();
$user->getEmail();
$user->getFirstname();
$user->getLastname();
$user->getAllInfos();
$user->register("", "jojofou", "jojo", "jojo@aol.com", "Morera", "joan");*/
$user->connect("jojofou", "jojo");
?>
