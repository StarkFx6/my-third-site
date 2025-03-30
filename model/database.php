<?php
class Database {
    private $db;
    private $dbName;
    public function __construct($dbName) {
        $this->dbName = $dbName;
    }
    public function connect() {
        $this->db = new mysqli("localhost", "root", "Kondratskyi", $this->dbName);
        return !$this->db->connect_error;
    }
    public function disconnect() {
        return $this->db->close();
    }
    public function read($id) {
        $stmt = $this->db->prepare("SELECT * FROM Items WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function readAll() {
        return $this->db->query("SELECT * FROM Items");
    }
    public function insert($name, $country, $producer, $price) {
        $stmt = $this->db->prepare("INSERT INTO Items (Name, Country, Producer, Price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssd", $name, $country, $producer, $price);
        return $stmt->execute();
    }
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM Items WHERE ID = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    public function change($id, $name, $country, $producer, $price) {
        $stmt = $this->db->prepare("UPDATE Items SET Name=?, Country=?, Producer=?, Price=? WHERE ID=?");
        $stmt->bind_param("sssdi", $name, $country, $producer, $price, $id);
        return $stmt->execute();
    }
    // Метод для перевірки користувача за логіном
    public function readUser($login) {
        $stmt = $this->db->prepare("SELECT * FROM Users WHERE Login = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    // Метод для перевірки, чи є користувач адміністратором
    public function isAdmin($userId) {
        $stmt = $this->db->prepare("SELECT administrator FROM Users WHERE ID = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['administrator'] == 1;
    }
}
?>
