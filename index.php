<?php include 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">Welcome to Car Rental System</h1>
        <div class="grid grid-cols-2 gap-4">
            <a href="cars.php" class="block bg-blue-500 text-white p-4 rounded-lg text-center">Manage Cars</a>
            <a href="rentals.php" class="block bg-green-500 text-white p-4 rounded-lg text-center">Manage Rentals</a>
            <a href="payments.php" class="block bg-yellow-500 text-white p-4 rounded-lg text-center">Manage Payments</a>
            <a href="maintenance.php" class="block bg-red-500 text-white p-4 rounded-lg text-center">Manage Maintenance</a>
        </div>
    </div>
</body>
</html>