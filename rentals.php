<?php include 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>จัดการการเช่ารถ</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">ระบบจัดการการเช่ารถ</h1>
        
        <div class="mb-6 flex justify-between">
            <a href="index.php" class="bg-gray-500 text-white p-2 rounded-lg">กลับไปหน้าหลัก</a>
            <button class="bg-green-500 text-white p-2 rounded-lg" onclick="showRentalForm()">เพิ่มการเช่ารถใหม่</button>
        </div>
        
        <!-- ฟอร์มเพิ่มการเช่ารถ -->
        <div id="rentalForm" class="hidden bg-white p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-xl font-bold mb-4">เพิ่มการเช่ารถใหม่</h2>
            <form action="rentals.php" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">เลือกรถ:</label>
                        <select name="car_id" class="w-full p-2 border rounded">
                            <option value="">-- เลือกรถ --</option>
                            <!-- PHP code จะเพิ่มรายการรถที่นี่ -->
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">ชื่อลูกค้า:</label>
                        <input type="text" name="customer_name" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">เบอร์โทรศัพท์:</label>
                        <input type="text" name="phone" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">อีเมล:</label>
                        <input type="email" name="email" class="w-full p-2 border rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">วันที่เริ่มเช่า:</label>
                        <input type="date" name="start_date" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">วันที่คืนรถ:</label>
                        <input type="date" name="end_date" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">ราคาเช่า/วัน (บาท):</label>
                        <input type="number" name="daily_rate" class="w-full p-2 border rounded" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">สถานะ:</label>
                        <select name="status" class="w-full p-2 border rounded">
                            <option value="จอง">จอง</option>
                            <option value="กำลังเช่า">กำลังเช่า</option>
                            <option value="คืนแล้ว">คืนแล้ว</option>
                            <option value="ยกเลิก">ยกเลิก</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4 flex justify-end">
                    <button type="button" class="bg-gray-500 text-white p-2 rounded-lg mr-2" onclick="hideRentalForm()">ยกเลิก</button>
                    <button type="submit" name="add_rental" class="bg-green-500 text-white p-2 rounded-lg">บันทึกข้อมูล</button>
                </div>
            </form>
        </div>

        <!-- ตารางแสดงรายการเช่า -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">รายการเช่ารถทั้งหมด</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2 border">รหัส</th>
                            <th class="p-2 border">รถ</th>
                            <th class="p-2 border">ลูกค้า</th>
                            <th class="p-2 border">วันที่เช่า</th>
                            <th class="p-2 border">วันที่คืน</th>
                            <th class="p-2 border">ราคา/วัน</th>
                            <th class="p-2 border">ราคารวม</th>
                            <th class="p-2 border">สถานะ</th>
                            <th class="p-2 border">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- PHP code จะเพิ่มข้อมูลรายการเช่าที่นี่ -->
                        <tr>
                            <td class="p-2 border text-center" colspan="9">ไม่พบข้อมูลการเช่ารถ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function showRentalForm() {
            document.getElementById('rentalForm').classList.remove('hidden');
        }
        
        function hideRentalForm() {
            document.getElementById('rentalForm').classList.add('hidden');
        }
    </script>
</body>
</html>