<?php 
include '../db.php';


class gebruiker {

    private $dbh;
    private $table = "gebruikers"; 
  
    public function __construct(DB $dbh)
    {
        $this->dbh = $dbh;
    }


    public function aanmelden($naam, $achternaam, $email, $role, $wachtwoord): PDOStatement
{
    $hashedWachtwoord = password_hash($wachtwoord, PASSWORD_BCRYPT);

    return $this->dbh->execute("INSERT INTO $this->table (naam, achternaam, email, role, wachtwoord)
        VALUES (?, ?, ?, ?, ?)", [$naam, $achternaam, $email, $role, $hashedWachtwoord]);
}


public function overzichtManager(): PDOStatement
{
    return $this->dbh->execute("SELECT * FROM $this->table");
}

public function invoegenDocenten($naam, $achternaam, $role, $diploma, $email, $wachtwoord): PDOStatement
{
    $hashedWachtwoord = password_hash($wachtwoord, PASSWORD_BCRYPT);

    return $this->dbh->execute("INSERT INTO $this->table (naam, achternaam, role, diploma, email, wachtwoord)
        VALUES (?, ?, ?, ?, ?,?)", [$naam, $achternaam, $role, $diploma, $email, $hashedWachtwoord]);
}

public function updateDocent($naam, $achternaam, $diploma, $email, $wachtwoord,$iDGebruiker ): PDOStatement
{
    $hashedWachtwoord = password_hash($wachtwoord, PASSWORD_BCRYPT);
    return $this->dbh->execute("UPDATE $this->table SET naam = ?, achternaam = ?, diploma = ?, email = ?, wachtwoord = ? WHERE iDGebruiker = ?", [$naam, $achternaam, $diploma, $email, $hashedWachtwoord, $iDGebruiker]);
    
}

public function login($email) {
    $result = $this->dbh->execute("SELECT * FROM gebruikers WHERE email = '$email'");
    return $result->fetch();
}

public function getUserByEmail($email) {
    $result = $this->dbh->execute("SELECT * FROM gebruikers WHERE email = '$email'");
    return $result->fetch();
}
}


























?>