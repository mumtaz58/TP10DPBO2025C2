<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Course Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            padding-top: 20px;
            padding-bottom: 40px;
            background-color: #e6f2ff; /* Light blue background */
        }
        .navbar {
            margin-bottom: 20px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%) !important; /* Purple to blue gradient */
        }
        .card {
            margin-bottom: 20px;
            border-color: #d4c4fb; /* Light purple border */
            box-shadow: 0 4px 8px rgba(106, 17, 203, 0.1);
        }
        .card-header {
            background-color: #d4c4fb; /* Light purple header */
            color: #4a4a4a;
        }
        .btn-primary {
            background-color: #6a11cb; /* Purple buttons */
            border-color: #6a11cb;
        }
        .btn-primary:hover {
            background-color: #5a00cc;
            border-color: #5a00cc;
        }
        .btn-secondary {
            background-color: #2575fc; /* Blue buttons */
            border-color: #2575fc;
        }
        .btn-secondary:hover {
            background-color: #1565db;
            border-color: #1565db;
        }
        .footer {
            background-color: #d4c4fb; /* Light purple footer */
            padding: 15px 0;
            margin-top: 30px;
            border-radius: 5px;
        }
        .section-title {
            color: #6a11cb; /* Purple section titles */
            border-bottom: 2px solid #d4c4fb;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .table {
            border-color: #d4c4fb;
        }
        .table thead {
            background-color: #e6f2ff; /* Light blue table headers */
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark rounded">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">College Course Management</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=departments">Departments</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=professors">Professors</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=courses">Courses</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="content mt-4">
            <!-- Sample content to showcase the light blue and purple theme -->
            <h2 class="section-title">Meladin College</h2>
            
            
        
        <div class="footer text-center">
          
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>