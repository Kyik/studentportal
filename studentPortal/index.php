<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Student List</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    </head>
    <body class="bg-light">

        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="text-primary">Student List</h2>
                <a href="add.php" class="btn btn-primary">+ Add New Student</a>
            </div>

            <table id="studentTable" class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT * FROM students");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                        <td><img src='uploads/" . $row['photo'] . "' width='50' ></td>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['phone'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['city'] . "</td>
                        <td>" . $row['state'] . "</td>
                        <td>
                            <a href='edit.php?id=" . $row['id'] . "' class='btn btn-sm btn-info'>View / Edit</a>
                        </td>
                      </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

        <script>
            $(document).ready(function () {
                $('#studentTable').DataTable({
                    "pageLength": 10,
                    "lengthMenu": [5, 10, 25, 50],
                    "ordering": true,
                    "searching": true
                });
            });
        </script>

    </body>
</html>
