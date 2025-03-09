<?php
include dirname(__DIR__) . '/config/db.php';

class CarController {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    // ดึงรถทั้งหมด
    public function getAllCars() {
        $stmt = $this->pdo->query("SELECT * FROM cars");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ดึงรถจาก ID
    public function getCarById($car_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM cars WHERE car_id = ?");
        $stmt->execute([$car_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // เพิ่มรถใหม่
    public function createCar($brand, $model, $year, $color, $seats, $price) {
        $stmt = $this->pdo->prepare("
            INSERT INTO cars (brand, model, year, color, seats, price, create_date, update_date)
            VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())
        ");
        return $stmt->execute([$brand, $model, $year, $color, $seats, $price]);
    }

    // อัปเดตรถ
    public function updateCar($car_id, $brand, $model, $year, $color, $seats, $price) {
        $stmt = $this->pdo->prepare("
            UPDATE cars SET brand = ?, model = ?, year = ?, color = ?, seats = ?, price = ?, update_date = NOW()
            WHERE car_id = ?
        ");
        return $stmt->execute([$brand, $model, $year, $color, $seats, $price, $car_id]);
    }

    // ลบรถ
    public function deleteCar($car_id) {
        $stmt = $this->pdo->prepare("DELETE FROM cars WHERE car_id = ?");
        return $stmt->execute([$car_id]);
    }
}
?>