<?php
class User {
  private $conn;
  private $table_name = "users";

  public $id;
  public $nom;
  public $prenom;
  public $adresse;
  public $email;
  public $password;
  public $numero_bancaire;
  public $date_expiration;
  public $code_cvv;

  public function __construct($db) {
    $this->conn = $db;
  }

  public function register() {
    $query = "INSERT INTO " . $this->table_name . "
              (nom, prenom, adresse, email, password, numero_bancaire)
              VALUES(:nom, :prenom, :adresse, :email, :password, :numero_bancaire, :date_expiration, :code_cvv)";

    $stmt = $this->conn->prepare($query);

    $this->password = password_hash($this->password, PASSWORD_DEFAULT);

    $stmt->bindParam(":nom", $this->nom);
    $stmt->bindParam(":prenom", $this->prenom);
    $stmt->bindParam(":adresse", $this->adresse);
    $stmt->bindParam(":email", $this->email);
    $stmt->bindParam(":password", $this->password);
    $stmt->bindParam(":numero_bancaire", $this->numero_bancaire);
    $stmt->bindParam(":date_expiration", $this->date_expiration);
    $stmt->bindParam(":code_cvv", $this->code_cvv);

    return $stmt->execute();
  }

  public function login() {
    $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":email", $this->email);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if (password_verify($this->password, $row['password'])) {
        $this->id = $row['id'];
        $this->nom = $row['nom'];
        $this->prenom = $row['prenom'];
        $this->adresse = $row['adresse'];
        $this->numero_bancaire = $row['numero_bancaire'];
        $this->date_expiration = $row['date_expiration'];
        $this->code_cvv = $row['code_cvv'];
        return true;
      }
    }
    return false;
  }
  
  public function getLastInsertId($db) {
    return $db->lastInsertId();
  }  
}
?>
