
<?php

require_once __DIR__ . '/../interfaces/ModelInterface.php';
require_once __DIR__ . '/../utils/Database.php';

class Author implements ModelInterface
{
    public $id;
    public $name;
    public $created_at;
    public $updated_at;


    
    public static function getAll()
    {
        $db = Database::getInstance();
        $result = $db->query("SELECT * FROM authors");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = Database::getInstance();
        $result = $db->query("SELECT * FROM authors WHERE id = :id");
        $authorData = $result->fetch(PDO::FETCH_ASSOC);

        if (!$authorData) {
            return null;
        }

        $author = new self();
        $author->id = $authorData['id'];
        $author->name = $authorData['name'];
        $author->created_at = $authorData['created_at'];
        $author->updated_at = $authorData['updated_at'];

        return $author;
    }

    public function create($data)
    {
        $db = Database::getInstance();

        $sql = "INSERT INTO authors (name) VALUES (:name)";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
          
        ]);

        $this->id = $db->lastInsertId();
        $this->name = $data['name'];
     

        return $this;
    }

    public function update($data)
    {
        $db = Database::getInstance();

        $sql = "UPDATE authors SET name = :name, updated_at = NOW() WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id' => $this->id,
            ':name' => $data['name'],
        ]);

        $this->name = $data['name'];
        $this->updated_at = new DateTime();

        return $this;
    }

    public function delete()
    {
        $db = Database::getInstance();
        $db->query(("DELETE FROM authors WHERE id = :id"));
    }
}
