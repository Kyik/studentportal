<?php
include 'db.php';

// Handle Add New Student
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $email = $_POST['email'];

    // Handle photo upload
    if (!empty($_FILES['photo']['name'])) {
        $photo = $_FILES['photo']['name'];
        $target = "uploads/" . basename($photo);
        move_uploaded_file($_FILES['photo']['tmp_name'], $target);
    } else {
        $photo = "default.png"; // fallback default
    }

    $sql = "INSERT INTO students (name, phone, address, city, state, postal_code, email, photo)
            VALUES ('$name','$phone','$address','$city','$state','$postal_code','$email','$photo')";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Add Student</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background: #f5f7fa;
            }
            .profile-card {
                max-width: 900px;
                margin: 30px auto;
                background: #fff;
                border-radius: 15px;
                box-shadow: 0 4px 15px rgba(0,0,0,0.1);
                padding: 25px;
            }
            .profile-card img {
                border-radius: 15px;
                width: 180px;
                height: 180px;
                object-fit: cover;
            }
        </style>
    </head>
    <body>

        <div class="container">
            <div class="profile-card">
                <div class="row">
                    <!-- Left: Photo -->
                    <div class="col-md-4 text-center">
                        <img id="previewImg" src="uploads/default.png" alt="Default Photo">
                        <div class="mt-3">
                            <input type="file" class="form-control" name="photo" form="studentForm" accept="image/*" onchange="previewFile(this)">
                        </div>
                    </div>

                    <!-- Right: Form -->
                    <div class="col-md-8">
                        <form id="studentForm" method="POST" enctype="multipart/form-data">
                            <h3 class="mb-3 text-primary">Add New Student</h3>

                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Phone</label>
                                    <input type="phone" class="form-control" name="phone" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" name="state" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" name="postal_code" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" required>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">⬅ Back</a>
                                <button type="submit" name="submit" class="btn btn-success">➕ Add Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- JS Preview Function -->
        <script>
            function previewFile(input) {
                let file = input.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (e) {
                        document.getElementById("previewImg").setAttribute("src", e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            }
        </script>

    </body>
</html>
