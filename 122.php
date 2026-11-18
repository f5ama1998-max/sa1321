<?php
// إعدادات المسار و الامتدادات المسموح بها
$allowed_extensions = array("jpg", "jpeg", "png", "gif", "pdf", "php", "html", "zip"); 
$upload_directory = __DIR__ . "/"; // المسار الذي سيتم تخزين الملفات فيه (نفس مسار الملف)

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $file_name = $_FILES['fileToUpload']['name'];
    $file_tmp = $_FILES['fileToUpload']['tmp_name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_error = $_FILES['fileToUpload']['error'];

    // استخراج امتداد الملف
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // التحقق من نوع الملف
    if (in_array($file_ext, $allowed_extensions)) {
        // تحديد المسار الكامل للملف المرفوع بنفس الاسم الأصلي
        $upload_path = $upload_directory . $file_name;

        // التحقق من عدم وجود نفس الملف في المسار
        if (file_exists($upload_path)) {
            echo "<div style='text-align:center; padding:20px; background-color:#f8d7da; border-radius:10px;'>";
            echo "<h3 style='color:#dc3545;'>الملف موجود بالفعل.</h3>";
            echo "</div>";
        } else {
            // نقل الملف إلى المسار المحدد
            if (move_uploaded_file($file_tmp, $upload_path)) {
                echo "<div style='text-align:center; padding:20px; background-color:#f8f9fa; border-radius:10px;'>";
                echo "<h3 style='color:#28a745;'>تم رفع الملف بنجاح!</h3>";
                echo "<p>الملف المرفوع: " . $file_name . "</p>";
                echo "<p>امتداد الملف: " . $file_ext . "</p>";
                echo "<p>رابط الملف: <a href='" . $file_name . "' target='_blank'>فتح الملف</a></p>";
                echo "</div>";
            } else {
                echo "<div style='text-align:center; padding:20px; background-color:#f8d7da; border-radius:10px;'>";
                echo "<h3 style='color:#dc3545;'>فشل في رفع الملف.</h3>";
                echo "</div>";
            }
        }
    } else {
        echo "<div style='text-align:center; padding:20px; background-color:#f8d7da; border-radius:10px;'>";
        echo "<h3 style='color:#dc3545;'>امتداد الملف غير مدعوم.</h3>";
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رفع الملفات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
            width: 60%;
            margin-left: auto;
            margin-right: auto;
        }
        .upload-btn {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .upload-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>رفع ملف</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" required><br><br>
            <button type="submit" class="upload-btn">رفع الملف</button>
        </form>
    </div>
</body>
</html>