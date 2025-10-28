<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Accepted</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2dc9ff;">Job Accepted</h2>
        
        <p>Great news! A freelancer has accepted your job invitation.</p>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #28a745; margin: 20px 0;">
            <h3 style="margin-top: 0;">Job Details:</h3>
            <p><strong>Job Title:</strong> {{ $job->job_title }}</p>
            <p><strong>Date:</strong> {{ $job->job_date->format('d/m/Y') }}</p>
            <p><strong>Rate:</strong> £{{ $job->job_rate }}</p>
            <p><strong>Location:</strong> {{ $job->job_address }}</p>
        </div>
        
        <div style="background-color: #fff; padding: 15px; border: 1px solid #ddd; margin: 20px 0;">
            <h3 style="margin-top: 0;">Freelancer Information:</h3>
            @if($freelancer instanceof \App\Models\PrivateUser)
                <p><strong>Name:</strong> {{ $freelancer->firstname }} {{ $freelancer->lastname }}</p>
                <p><strong>Email:</strong> {{ $freelancer->email }}</p>
                <p><strong>Phone:</strong> {{ $freelancer->mobile }}</p>
            @else
                <p><strong>Name:</strong> {{ $freelancer->firstname }} {{ $freelancer->lastname }}</p>
                <p><strong>Email:</strong> {{ $freelancer->email }}</p>
            @endif
        </div>
        
        <p>The freelancer has confirmed their availability for this job. You can now proceed with any necessary preparations.</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/employer/job-listing') }}" 
               style="background-color: #2dc9ff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                View Job Management
            </a>
        </div>
        
        <p>If you have any questions or need to make changes, please contact the freelancer directly or use the LocumKit platform.</p>
        
        <p>Thank you for using LocumKit!</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #666;">
            This is an automated notification from LocumKit. Please do not reply to this email.
        </p>
    </div>
</body>
</html>
