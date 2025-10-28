<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CPD Submission Reminder</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2dc9ff;">CPD Submission Reminder</h2>
        
        <p>Dear {{ $freelancer->firstname }} {{ $freelancer->lastname }},</p>
        
        <p>This is a friendly reminder that your CPD submission is due soon.</p>
        
        <div style="background-color: #fff3cd; padding: 15px; border-left: 4px solid #ffc107; margin: 20px 0;">
            <h3 style="margin-top: 0; color: #856404;">Important Information:</h3>
            <p><strong>Current Cycle:</strong> {{ \Carbon\Carbon::parse($currentCycle['start'])->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($currentCycle['end'])->format('d/m/Y') }}</p>
            <p><strong>Days Remaining:</strong> {{ $daysUntilEnd }} days</p>
            <p><strong>Deadline:</strong> {{ \Carbon\Carbon::parse($currentCycle['end'])->format('d/m/Y') }}</p>
        </div>
        
        <p>To maintain your professional registration and continue using LocumKit, please submit your CPD evidence before the deadline.</p>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #2dc9ff; margin: 20px 0;">
            <h3 style="margin-top: 0;">What you need to do:</h3>
            <ol>
                <li>Gather your CPD evidence (certificates, training records, etc.)</li>
                <li>Calculate your CPD points</li>
                <li>Submit your evidence through the LocumKit platform</li>
                <li>Wait for admin review and approval</li>
            </ol>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/freelancer/cpd/create') }}" 
               style="background-color: #2dc9ff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                Submit CPD Evidence Now
            </a>
        </div>
        
        <p>If you have already submitted your CPD evidence, please ignore this reminder.</p>
        
        <p>If you have any questions about CPD requirements or the submission process, please contact our support team.</p>
        
        <p>Thank you for using LocumKit!</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #666;">
            This is an automated reminder from LocumKit. Please do not reply to this email.
        </p>
    </div>
</body>
</html>
