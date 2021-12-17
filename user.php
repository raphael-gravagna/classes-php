<?php

class User {
    public $login;
    public $email;
    public $firstname;
    public $lastname;

    public function __construct($login, $email, $firstname, $lastname) {
        $this->login = $login;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;        
    }

    public function echologin() { 
        echo nl2br("Login : ". $this->login."\n");        
    }
    public function echoemail() { 
        echo nl2br("email : ". $this->email."\n");          
    }
    public function echofirstname() { 
        echo nl2br("firstname : ". $this->firstname."\n"); 
    }
    public function echolastname() { 
        echo nl2br("lastname : ". $this->lastname)."\n";         
    }

}

$user = new User("jojo", "jojo@aol.com", "Morera", "joan");
$user->echologin();
$user->echoemail();
$user->echofirstname();
$user->echolastname();

?>