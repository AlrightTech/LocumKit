<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback Approved</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2dc9ff;">Feedback Approved</h2>
        
        @if($recipientType === 'giver')
            <p>Dear {{ $feedback->feedback_by_user->firstname ?? 'User' }},</p>
            <p>Great news! Your feedback has been automatically approved and is now visible to the recipient.</p>
        @else
            <p>Dear {{ $feedback->feedback_for_user->firstname ?? 'User' }},</p>
            <p>You have received new feedback that has been automatically approved and is now visible on your profile.</p>
        @endif
        
        <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #28a745; margin: 20px 0;">
            <h3 style="margin-top: 0;">Job Details:</h3>
            <p><strong>Job Title:</strong> {{ $feedback->job->job_title ?? 'N/A' }}</p>
            <p><strong>Date:</strong> {{ $feedback->job->job_date->format('d/m/Y') ?? 'N/A' }}</p>
            <p><strong>Rate:</strong> £{{ $feedback->job->job_rate ?? 'N/A' }}</p>
        </div>
        
        <div style="background-color: #fff; padding: 15px; border: 1px solid #ddd; margin: 20px 0;">
            <h3 style="margin-top: 0;">Feedback Details:</h3>
            <p><strong>Rating:</strong> {{ $feedback->rating ?? 'N/A' }}/5</p>
            @if($feedback->feedback_text)
                <p><strong>Comments:</strong></p>
                <div style="background-color: #f8f9fa; padding: 10px; border-radius: 4px;">
                    {{ $feedback->feedback_text }}
                </div>
            @endif
        </div>
        
        @if($recipientType === 'giver')
            <p>Your feedback is now live and will help other users make informed decisions. Thank you for taking the time to provide valuable feedback!</p>
        @else
            <p>This feedback will help you understand how others perceive your work and can be used to improve your professional reputation.</p>
        @endif
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/feedback') }}" 
               style="background-color: #2dc9ff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                View All Feedback
            </a>
        </div>
        
        <p>Thank you for using LocumKit!</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #666;">
            This is an automated notification from LocumKit. Please do not reply to this email.
        </p>
    </div>
</body>
</html>
