<?php

require_once __DIR__ . '/../interfaces/ModelInterface.php';
require_once __DIR__ . '/../utils/Database.php';

class User implements ModelInterface
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $created_at;
    private $updated_at;


    
    public static function getAll()
    {
        $db = Database::getInstance();
        $result = $db->query('SELECT * FROM users');
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = Database::getInstance();
        $result = $db->query("SELECT * FROM users WHERE id = $id");
        $userData = $result->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }

        $user = new self();
        $user->id = $userData['id'];
        $user->name = $userData['name'];
        $user->email = $userData['email'];
        $user->password = $userData['password'];
        $user->created_at = $userData['created_at'];
        $user->updated_at = $userData['updated_at'];

        return $user;
    }

    public function create($data)
    {
        $db = Database::getInstance();

        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);

        $this->id = $db->lastInsertId();
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];

        return $this;
    }

    public function update($data)
    {
        $db = Database::getInstance();

        $sql = "UPDATE users SET name = :name, email = :email, password = :password, updated_at = NOW() WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id' => $this->id,
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);

        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->updated_at = new DateTime();

        return $this;
    }

    public function delete()
    {
        $db = Database::getInstance();
        $db->query("DELETE FROM users WHERE id = {$this->id}");
    }

    public function findByEmail($email)
{
    $db = Database::getInstance();
    $query = 'SELECT * FROM users WHERE email = :email LIMIT 1';
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
public function register(string $username, string $email, string $password)
{
    $db = Database::getInstance();
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password, created_at, updated_at) VALUES (:username, :email, :password, NOW(), NOW())";
    $statement = $db->prepare($query);
    $statement->execute([
        ':username' => $username,
        ':email' => $email,
        ':password' => $hashedPassword
    ]);

    return $db->lastInsertId();
}
}
