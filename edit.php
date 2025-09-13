<?php
include 'db.php';

// Get student ID
$id = $_GET['id'];

// Handle Update
if (isset($_POST['update'])) {
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
        // keep old photo
        $old = $conn->query("SELECT photo FROM students WHERE id=$id")->fetch_assoc();
        $photo = $old['photo'];
    }

    $sql = "UPDATE students SET
            name='$name', phone='$phone', address='$address', city='$city',
            state='$state', postal_code='$postal_code', email='$email', photo='$photo'
            WHERE id=$id";

    if ($conn->query($sql)) {
        header("Location: index.php");
        exit();
    }
}

// Handle Delete
if (isset($_POST['delete'])) {
    $conn->query("DELETE FROM students WHERE id=$id");
    header("Location: index.php");
    exit();
}

// Fetch student data
$result = $conn->query("SELECT * FROM students WHERE id=$id");
$student = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Edit Student</title>
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
                        <img src="uploads/<?= $student['photo'] ?>" alt="Student Photo">
                        <div class="mt-3">
                            <input type="file" class="form-control" name="photo" form="studentForm">
                        </div>
                    </div>

                    <!-- Right: Details -->
                    <div class="col-md-8">
                        <form id="studentForm" method="POST" enctype="multipart/form-data">
                            <h3 class="mb-3 text-primary"><?= $student['name'] ?></h3>

                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="<?= $student['name'] ?>" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="<?= $student['email'] ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" name="phone" value="<?= $student['phone'] ?>" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" value="<?= $student['city'] ?>" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label class="form-label">State</label>
                                    <input type="text" class="form-control" name="state" value="<?= $student['state'] ?>" required>
                                </div>
                                <div class="col">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" name="postal_code" value="<?= $student['postal_code'] ?> required">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" class="form-control" name="address" value="<?= $student['address'] ?> required">
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <button type="submit" name="update" class="btn btn-success">💾 Save Changes</button>
                                <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this student?')">🗑 Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>
