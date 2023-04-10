
<?php

require_once __DIR__ . '/../interfaces/ModelInterface.php';
require_once __DIR__ . '/../utils/Database.php';

class Genre implements ModelInterface
{
    public $id;
    public $name;
    public $created_at;
    public $updated_at;


    
    public static function getAll()
    {
        $db = Database::getInstance();
        $result = $db->query("SELECT * FROM genres");
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = Database::getInstance();
        $result = $db->query("SELECT * FROM genres WHERE id = :id");
        $genreData = $result->fetch(PDO::FETCH_ASSOC);

        if (!$genreData) {
            return null;
        }

        $genre = new self();
        $genre->id = $genreData['id'];
        $genre->name = $genreData['name'];
        $genre->created_at = $genreData['created_at'];
        $genre->updated_at = $genreData['updated_at'];

        return $genre;
    }

    public function create($data)
    {
        $db = Database::getInstance();

        $sql = "INSERT INTO genres (name) VALUES (:name)";
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

        $sql = "UPDATE genres SET name = :name, updated_at = NOW() WHERE id = :id";
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
        $db->query(("DELETE FROM genres WHERE id = :id"));
    }
}