<?php
include '../config/db.php';
include '../controllers/CarController.php';
$carController = new CarController($pdo);
$cars = $carController->getAllCars();
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
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2">Brand</th>
                    <th class="py-2">Model</th>
                    <th class="py-2">Year</th>
                    <th class="py-2">Color</th>
                    <th class="py-2">Seats</th>
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
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>