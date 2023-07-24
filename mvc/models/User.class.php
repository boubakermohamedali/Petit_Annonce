<?php
class UserModel{

    private $table = 'membres';
    private $table_photo= 'photo';
    private $table_annonce= 'annonce';
//Extraction toutes les informations d user
function getusers(){
    try {
        // Récupération de l'objet PDO
          //$db = connect();
        global $db;

        // Requête pour récupérer tous les abos
        $userQuery=$db->query('SELECT * FROM '.$this->table);

        // Renvoie tous les lignes
        return $userQuery->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // En cas d'erreur afficher le message
        echo $e->getMessage();
    }
}

//Extraction des données d user par ID
function chargerUserById($id_user){
    try {
          //$db = connect();
        global $db;
        $query=$db->prepare('SELECT * FROM '. $this->table. ' WHERE id= :id');
        $query->execute(['id'=>$id_user]);
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            
            return $query->fetchALL();
            //print_r($query->fetchALL());
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return false;
}


 
//Extraction des données d user par mail

function getUserByEmail($email) {
   
    try {
          //$db = connect();
        global $db;
        $query=$db->prepare('SELECT * FROM '.$this->table.' WHERE email= :email');
        $query->execute(['email'=>$email]);
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            //print_r($query->fetchALL());
            return $query->fetchALL();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return false;
}


//Extraction des données d user par toket pour l'enregistrement ou lors du changement de mot de passe
function getUserByToken($token) {
    try {
          //$db = connect();
        global $db;
        $query=$db->prepare('SELECT * FROM '.$this->table.' WHERE token= :token');
        $query->execute(['token'=>$token]);
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            return $query->fetch();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return false;
}

// Afficher tous les usernames pour add username de nouveau User
function getUsernames($username) {
    try {
          //$db = connect();
        global $db;
        $query=$db->prepare('SELECT username FROM '.$this->table.' WHERE username= :username');
        $query->execute(['username'=>$username]);
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            return $query->fetchAll();
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return false;
}

//Connexion d'un user déjà enregistré à son compte
function logUser() {
$UserModel=new UserModel();
$email=filter_var($_POST["email"],FILTER_VALIDATE_EMAIL);
//print_r($email);
$user=$UserModel->getUserByEmail($email);

//print_r($user);
if($user){
    //$password=new User();
   // $password = $user->getPassword($email);
     //print_r($user['hash']);
    if(password_verify($_POST["password"],$user[0]['hash'])){
        
         //print_r($user[0]['id']);
            $_SESSION['id']=$user[0]['id'];
           
            $_SESSION['actif']=1;
          
           
            //print_r($_SESSION['id']);
            return "Connexion réussie";
    }else{
        return "Mauvais identifiants";}
    }else{
        return "Mauvais identifiants";
}
}



function ActivationUserByMail($pwd,$email,$username,$token){
        try{
      //$db = connect();
        global $db;
    $query=$db->prepare('INSERT INTO '.$this->table.' ( hash ,email, username,token) VALUES (:hash,:email,:username,:token)');
    $query->execute(['hash'=>$pwd,'email'=>$email,'username'=>$username, 'token'=>$token]);
    //print_r($query->fetchAll());
    if ($query->rowCount()){

        $content="<p><a href='localhost/projet/index.php?p=activation&t=$token'> Merci de cliquer sur ce lien pour activer votre compte</a></p>";
        // Mail de activation d'account
        $headers= array(
        'MIME-Version' => '1.0',
        'Content-type'=> 'text/html; charset=utf8',
        'X-Mailer'=> 'PHP/'. phpversion()
        );
        mail($email, "Veuillez activer votre compte", $content, $headers);
        return "Inscription réussi. Vous allez recevoir un mail pour activer votre compte";

        }else{
            echo "Problème lors de enregistrement"  ; 
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    } 

 }

//Changer le mot de passe d user s'il l'a oublié
function mailChangePwd(){
 $UserModel=new UserModel();
if(!empty($_POST["email"])&& filter_var($_POST["email"],FILTER_VALIDATE_EMAIL)){
    if($UserModel->getUserByEmail($_POST["email"])){
        $email=htmlentities($_POST["email"]);
        //var_dump($email);
       $token=bin2hex(random_bytes(16));

       // Date d'expiration du token de 20 minutes
       $datetime=new DateTime();
       $datetime->setTime(0,0,1200);
       $date_validite_token=$datetime->format('H:i:s');
      
            try{

                 //$db = connect();
                global $db;
               $query=$db->prepare('UPDATE '.$this->table.' SET token=:token, date_validite_token=:date_validite_token WHERE email=:email');
               $query->execute(['token'=>$token,'date_validite_token'=>$date_validite_token,'email'=>$email]); 
               //var_dump($query->rowCount());
            
                    if ($query->rowCount()){ 
                        $content="<p><a href='localhost/projet/index.php?p=reset&t=$token'> Merci de cliquer sur ce lien pour activer votre compte</a></p>";
                        // Mail de activation d'account
                        $headers= array(
                        'MIME-Version' => '1.0',
                        'Content-type'=> 'text/html; charset=utf8',
                        'X-Mailer'=> 'PHP/'. phpversion()
                        );
                        mail($email, "Réinitialisation de mot de passe", $content, $headers);
                        return "Vous allez recevoir un mail pour réinitialiser votre mot de passe".$content;
                        var_dump($content);

                }else{
                 echo "Problème lors du process de réinitialisation"; 
                 }
             } catch (Exception $e) {
                echo $e->getMessage();
             }   
    }else{
        echo "Aucun compte ne correspond pas à cette email";
    }
}
}

// Activation de la session utilisateur
function setActif($actif,$id){
    //print_r($actif);
    //print_r($id);
try {
          //$db = connect();
        global $db;
        $query=$db->prepare('UPDATE '.$this->table.' SET actif=:actif WHERE id= :id');
        $query->execute(['actif'=>$actif,'id'=>$id]);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    return false;
}    

function activUser(){
 $UserModel=new UserModel();
 $token=htmlspecialchars($_GET['t']);
 $user= $UserModel->getUserByToken($token);
 //print_r($user);
    if($user){
        if(!$user['actif']){
            try{
                //$db = connect();
                global $db;
              $query=$db->prepare('UPDATE '.$this->table.' SET actif=1, token=NULL WHERE token= :token');
              $query->execute(['token'=>$token]);
            } catch (Exception $e) {
                echo $e->getMessage();
            }
            return false;
        }else{
        echo "Ce compte est déjà actif";       
      }
    }else{
        echo "Lien invalide";
    }
}
 public function adminModificationUser($id, $montant_cagnotte, $actif, $is_admin){
    //print_r($actif);
    try{

      //$db = connect();
        global $db;
    $query=$db->prepare('UPDATE '.$this->table.' SET montant_cagnotte=:montant_cagnotte, actif=:actif, is_admin=:is_admin WHERE id=:id');
    $query->execute(['montant_cagnotte'=>$montant_cagnotte, 'actif'=>$actif, 'is_admin'=>$is_admin, 'id'=>$id]); 
    
} catch (Exception $e) {
  echo $e->getMessage();
 }
    return false;
 }


public function setModificationUserById($id, $nom, $prenom, $username, $adresse, $email,$code_postale, $telephone, $date_naissance, $ville, $url_photo_profil){

try{

      //$db = connect();
        global $db;
    $query=$db->prepare('UPDATE '.$this->table.' SET nom=:nom, prenom=:prenom, username=:username, adresse_postale=:adresse_postale, email=:email, code_postale=:code_postale, telephone=:telephone, ville=:ville, url_photo_profil=:url_photo_profil WHERE id_membre=:id_membre');
    $query->execute(['nom'=>$nom, 'prenom'=>$prenom, 'username'=>$username, 'adresse'=>$adresse, 'email'=>$email, 'code_postale'=>$code_postale, 'telephone'=>$telephone, 'date_naissance'=>$date_naissance, 'ville'=>$ville, 'url_photo_profil'=>$url_photo_profil, 'id'=>$id]); 
    
} catch (Exception $e) {
  echo $e->getMessage();
 }
    return false;
}


function SupprimerUserByID($id){
//print_r("test".$id);
try{

      //$db = connect();
        global $db;

    $query=$db->prepare('DELETE m, a, ph FROM '.$this->table.' AS m LEFT JOIN '. $this->table_annonce .' AS a ON a.idMembre = m.id LEFT JOIN '. $this->table_photo .' AS ph ON a.id = ph.idAnnonce WHERE m.id = :id');
    $query->execute(['id'=>$id]); 
   var_dump( $query);
} catch (Exception $e) {
  echo $e->getMessage();
 }
    return false;
}

function getPasswordbyID($id){
   
    try{

          //$db = connect();
        global $db;
        $query=$db->prepare('SELECT hash FROM '.$this->table.' WHERE id=:id');
        $query->execute(['id'=>$id]); 
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
            
            return $query->fetch();
            //print_r($query->fetch());
        }
        
    } catch (Exception $e) {
    echo $e->getMessage();
    }
        return false;

}
public function CountUserForAdmin(){
 try {
        //$db = connect();
      global $db;
        $query=$db->prepare('SELECT COUNT(id) FROM '.$this->table.' LIMIT 10');
        $query->execute();
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'Annonce
            $result=$query->fetch();
            return $result[0];

        }
      } catch (Exception $e) {
        echo $e->getMessage();
      }
    return false;

}
public function showUsers(){
try {
        global $db;
        $query=$db->prepare('SELECT * FROM '.$this->table.' LIMIT 10');
        $query->execute(); 
        if ($query->rowCount()){
            // Renvoie toutes les infos de l'utilisateur
         
            return $query->fetchAll();
           
        }
        
    } catch (Exception $e) {
    echo $e->getMessage();
    }
        return false;

}
}