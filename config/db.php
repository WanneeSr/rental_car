<?php
$host = 'localhost';
$dbname = '650112230046_carrent';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>



/* controllers/CarController.php */
<?php
include '../config/database.php';

class CarController {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function getAllCars() {
        $stmt = $this->pdo->query("SELECT * FROM cars");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
