<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Acceptance Success - LocumKit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .success-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .success-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            text-align: center;
            max-width: 500px;
        }
        .success-icon {
            font-size: 4rem;
            color: #28a745;
            margin-bottom: 1rem;
        }
        .job-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin: 1.5rem 0;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="success-container">
        <div class="success-card">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2 class="text-success mb-3">Job Accepted Successfully!</h2>
            <p class="lead">Congratulations! You have successfully accepted the job invitation.</p>
            
            <div class="job-details">
                <h5>Job Details:</h5>
                <p><strong>Job Title:</strong> {{ $job->job_title }}</p>
                <p><strong>Date:</strong> {{ $job->job_date->format('d/m/Y') }}</p>
                <p><strong>Rate:</strong> £{{ $job->job_rate }}</p>
                <p><strong>Location:</strong> {{ $job->job_address }}</p>
            </div>
            
            <p class="mb-3">The employer has been notified of your acceptance. You should receive further communication from them soon.</p>
            
            <div class="alert alert-info">
                <strong>Next Steps:</strong>
                <ul class="mb-0 mt-2">
                    <li>Wait for confirmation from the employer</li>
                    <li>Prepare for the job on the scheduled date</li>
                    <li>Contact the employer if you have any questions</li>
                </ul>
            </div>
            
            <a href="{{ url('/') }}" class="btn btn-primary">Return to LocumKit</a>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>
