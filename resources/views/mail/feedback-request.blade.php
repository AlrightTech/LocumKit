<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback Request - Job Completed</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2dc9ff;">Job Completed - Feedback Request</h2>
        
        <p>Dear {{ $recipientType == 'employer' ? $otherParty->firstname : $otherParty->firstname }},</p>
        
        <p>A job has been completed and we would like to collect your feedback.</p>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #2dc9ff; margin: 20px 0;">
            <h3 style="margin-top: 0;">Job Details:</h3>
            <p><strong>Job Title:</strong> {{ $job->job_title }}</p>
            <p><strong>Date:</strong> {{ $job->job_date->format('d/m/Y') }}</p>
            <p><strong>Rate:</strong> £{{ $job->job_rate }}</p>
            <p><strong>Location:</strong> {{ $job->job_address }}</p>
        </div>
        
        <p>Please take a moment to provide your feedback about this job completion. Your feedback helps maintain the quality of our platform and assists other users in making informed decisions.</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/feedback') }}?job_id={{ $job->id }}" 
               style="background-color: #2dc9ff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                Provide Feedback
            </a>
        </div>
        
        <p>Thank you for using LocumKit!</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #666;">
            This is an automated message from LocumKit. Please do not reply to this email.
        </p>
    </div>
</body>
</html>
