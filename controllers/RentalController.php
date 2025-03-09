<?php
include dirname(__DIR__) . '/config/db.php';

class RentalController {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    
   
    public function getAll() {
        $query = "SELECT r.*, c.brand, c.model, cu.first_name, cu.last_name 
                  FROM rentals r
                  JOIN cars c ON r.car_id = c.car_id
                  JOIN customers cu ON r.customer_id = cu.customer_id
                  ORDER BY r.rental_start_date DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        
        $rentals = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rentals[] = $row;
        }
        
        return json_encode($rentals);
    }
    
    public function getOne($id) {
        $query = "SELECT r.*, c.brand, c.model, cu.first_name, cu.last_name 
                  FROM rentals r
                  JOIN cars c ON r.car_id = c.car_id
                  JOIN customers cu ON r.customer_id = cu.customer_id
                  WHERE r.rental_id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        
        $rental = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($rental) {
            return json_encode($rental);
        } else {
            http_response_code(404);
            return json_encode(['error' => 'Rental not found']);
        }
    }
    
    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $query = "INSERT INTO rentals (customer_id, car_id, rental_start_date, rental_end_date, total_price, rental_status) 
                  VALUES (?, ?, ?, ?, ?, ?)";
                  
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute([
            $data['customer_id'] ?? null,
            $data['car_id'] ?? null,
            $data['rental_start_date'] ?? null,
            $data['rental_end_date'] ?? null,
            $data['total_price'] ?? 0.00,
            $data['rental_status'] ?? 'Pending'
        ]);
        
        if ($result) {
            $rental_id = $this->pdo->lastInsertId();
            http_response_code(201);
            return json_encode(['message' => 'Rental created successfully', 'id' => $rental_id]);
        } else {
            http_response_code(500);
            return json_encode(['error' => 'Failed to create rental']);
        }
    }
    
    public function update($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $query = "UPDATE rentals SET 
                  customer_id = ?, 
                  car_id = ?, 
                  rental_start_date = ?, 
                  rental_end_date = ?, 
                  total_price = ?, 
                  rental_status = ?,
                  update_date = CURRENT_TIMESTAMP
                  WHERE rental_id = ?";
                  
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute([
            $data['customer_id'] ?? null,
            $data['car_id'] ?? null,
            $data['rental_start_date'] ?? null,
            $data['rental_end_date'] ?? null,
            $data['total_price'] ?? 0.00,
            $data['rental_status'] ?? 'Pending',
            $id
        ]);
        
        if ($result) {
            return json_encode(['message' => 'Rental updated successfully']);
        } else {
            http_response_code(500);
            return json_encode(['error' => 'Failed to update rental']);
        }
    }
    
    public function delete($id) {
        $query = "DELETE FROM rentals WHERE rental_id = ?";
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute([$id]);
        
        if ($result) {
            return json_encode(['message' => 'Rental deleted successfully']);
        } else {
            http_response_code(500);
            return json_encode(['error' => 'Failed to delete rental']);
        }
    }
}
?>