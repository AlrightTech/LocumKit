<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New CPD Submission Received</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2dc9ff;">New CPD Submission Received</h2>
        
        <p>A new CPD submission has been submitted by a freelancer.</p>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #2dc9ff; margin: 20px 0;">
            <h3 style="margin-top: 0;">Submission Details:</h3>
            <p><strong>Freelancer:</strong> {{ $submission->user->firstname }} {{ $submission->user->lastname }}</p>
            <p><strong>Email:</strong> {{ $submission->user->email }}</p>
            <p><strong>CPD Points:</strong> {{ $submission->cpd_points }}</p>
            <p><strong>Submission Date:</strong> {{ $submission->submission_date->format('d/m/Y') }}</p>
            <p><strong>Cycle:</strong> {{ $submission->cycle_start_date->format('d/m/Y') }} - {{ $submission->cycle_end_date->format('d/m/Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($submission->status) }}</p>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/admin/cpd-submissions/' . $submission->id) }}" 
               style="background-color: #2dc9ff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                Review Submission
            </a>
        </div>
        
        <p>Please review this CPD submission and approve or reject it with appropriate feedback.</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #666;">
            This is an automated notification from LocumKit Admin Panel.
        </p>
    </div>
</body>
</html>
