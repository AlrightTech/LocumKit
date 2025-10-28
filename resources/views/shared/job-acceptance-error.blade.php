<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Acceptance Error - LocumKit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .error-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .error-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
            max-width: 500px;
        }
        .error-icon {
            font-size: 4rem;
            color: #dc3545;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-card">
            <div class="error-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h2 class="text-danger mb-3">Unable to Accept Job</h2>
            <p class="lead">{{ $error }}</p>
            
            <div class="alert alert-warning">
                <strong>Possible reasons:</strong>
                <ul class="mb-0 mt-2">
                    <li>The job invitation link has expired</li>
                    <li>The job is no longer available</li>
                    <li>The job date has already passed</li>
                    <li>The link has already been used</li>
                </ul>
            </div>
            
            <p class="mb-3">If you believe this is an error, please contact the employer directly or reach out to our support team.</p>
            
            <a href="{{ url('/') }}" class="btn btn-primary">Return to LocumKit</a>
            <a href="{{ url('/contact') }}" class="btn btn-outline-secondary">Contact Support</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>
