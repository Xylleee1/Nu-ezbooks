<?php
require_once "database.php";

class Product {
    public $title = "";
    public $author = "";
    public $genre = "";
    public $publicationYear = "";

    //database connection
    protected $db;
//constructor: oinitaliza the daabase clasees
    public function __construct() {
        $this->db = new Database();
    }

    public function addProduct() {
        $sql = "INSERT INTO product (title, author, genre, publicationYear)
                VALUES (:title, :author, :genre, :publicationYear)"; 
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':title', $this->title);
        $query->bindParam(':author', $this->author);
        $query->bindParam(':genre', $this->genre);
        $query->bindParam(':publicationYear', $this->publicationYear);
        return $query->execute();
    }

    public function viewProduct() {
        $sql = "SELECT * FROM product ORDER BY title ASC;";
        $query = $this->db->connect()->prepare($sql);

        if ($query->execute()) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function fetchProduct($id) {
        $sql = "SELECT * FROM product WHERE id = :id";
        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(':id', $id);

        if ($query->execute()) {
            return $query->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }

     public function editProduct($pid) {
        $sql = "UPDATE product SET title = :title, author = :author, genre = :genre, publicationYear = :publicationYear WHERE id = :id"; 
        $query = $this->db->connect()->prepare($sql);

        $query->bindParam(':title', $this->title);
        $query->bindParam(':author', $this->author);
        $query->bindParam(':genre', $this->genre);
        $query->bindParam(':publicationYear', $this->publicationYear);
        $query->bindParam(':id', $pid);
        return $query->execute();
    }

    public function deleteProduct($pid){
        $sql = "DELETE FROM product WHERE id = :id";

        $query = $this->db->connect()->prepare($sql);
        $query->bindParam(":id", $pid);

        return $query->execute();
    }


}
//$product = new Product();
//$product->addProduct();
//$products = $product->viewProduct();
