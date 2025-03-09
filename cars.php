<?php
require_once 'config/db.php';
require_once 'controllers/CarController.php';
$carController = new CarController($pdo);
$cars = $carController->getAllCars();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_car'])) {
        $carController->createCar($_POST['brand'], $_POST['model'], $_POST['year'], $_POST['color'], $_POST['seats'], $_POST['price']);
        header('Location: cars.php');
    } elseif (isset($_POST['update_car'])) {
        $carController->updateCar($_POST['car_id'], $_POST['brand'], $_POST['model'], $_POST['year'], $_POST['color'], $_POST['seats'], $_POST['price']);
        header('Location: cars.php');
    } elseif (isset($_POST['delete_car'])) {
        $carController->deleteCar($_POST['car_id']);
        header('Location: cars.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">Car Management</h1>
        <form method="POST" class="mb-6 p-4 bg-white shadow rounded">
            <input type="hidden" name="car_id" id="car_id">
            <input type="text" name="brand" id="brand" placeholder="Brand" required class="border p-2 mr-2">
            <input type="text" name="model" id="model" placeholder="Model" required class="border p-2 mr-2">
            <input type="number" name="year" id="year" placeholder="Year" required class="border p-2 mr-2">
            <input type="text" name="color" id="color" placeholder="Color" required class="border p-2 mr-2">
            <input type="number" name="seats" id="seats" placeholder="Seats" required class="border p-2 mr-2">
            <input type="number" step="0.01" name="price" id="price" placeholder="Price" required class="border p-2 mr-2">
            <button type="submit" name="add_car" class="bg-blue-500 text-white px-4 py-2">Add Car</button>
            <button type="submit" name="update_car" class="bg-green-500 text-white px-4 py-2 hidden" id="update_button">Update Car</button>
        </form>
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Brand</th>
                    <th class="py-2">Model</th>
                    <th class="py-2">Year</th>
                    <th class="py-2">Color</th>
                    <th class="py-2">Seats</th>
                    <th class="py-2">Price</th>
                    <th class="py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td class="py-2 text-center"><?= htmlspecialchars($car['brand']) ?></td>
                        <td class="py-2 text-center"><?= htmlspecialchars($car['model']) ?></td>
                        <td class="py-2 text-center"><?= htmlspecialchars($car['year']) ?></td>
                        <td class="py-2 text-center"><?= htmlspecialchars($car['color']) ?></td>
                        <td class="py-2 text-center"><?= htmlspecialchars($car['seats']) ?></td>
                        <td class="py-2 text-center"><?= htmlspecialchars($car['price']) ?></td>
                        <td class="py-2 text-center">
                            <button class="bg-yellow-500 text-white px-4 py-2" onclick="editCar(<?= htmlspecialchars(json_encode($car)) ?>)">Edit</button>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="car_id" value="<?= $car['car_id'] ?>">
                                <button type="submit" name="delete_car" class="bg-red-500 text-white px-4 py-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
        function editCar(car) {
            document.getElementById('car_id').value = car.car_id;
            document.getElementById('brand').value = car.brand;
            document.getElementById('model').value = car.model;
            document.getElementById('year').value = car.year;
            document.getElementById('color').value = car.color;
            document.getElementById('seats').value = car.seats;
            document.getElementById('price').value = car.price;
            
            document.querySelector("[name='add_car']").classList.add("hidden");
            document.getElementById("update_button").classList.remove("hidden");
        }
    </script>
</body>
</html>
