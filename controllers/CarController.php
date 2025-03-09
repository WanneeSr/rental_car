<?php
include '../config/db.php';

class CarController {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function getAllCars() {
        $stmt = $this->pdo->query("SELECT * FROM cars");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getCarsById() {
       
    }
    public function createCars() {
       
    }
    public function updateCars() {
       
    }
    public function deleteCars() {
       
    }
}
?>
