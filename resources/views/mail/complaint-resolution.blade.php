<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Complaint Resolution</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2dc9ff;">Complaint Resolution</h2>
        
        <p>Dear {{ $complaint->name }},</p>
        
        <p>Thank you for contacting us regarding your complaint. We have reviewed your concern and are pleased to inform you that it has been resolved.</p>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #28a745; margin: 20px 0;">
            <h3 style="margin-top: 0;">Complaint Details:</h3>
            <p><strong>Submitted:</strong> {{ $complaint->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Resolved:</strong> {{ $complaint->resolved_at->format('d/m/Y H:i') }}</p>
            <p><strong>Status:</strong> <span style="color: #28a745; font-weight: bold;">Resolved</span></p>
        </div>
        
        @if($complaint->resolution_notes)
        <div style="background-color: #fff; padding: 15px; border: 1px solid #ddd; margin: 20px 0;">
            <h3 style="margin-top: 0;">Resolution Notes:</h3>
            <p style="white-space: pre-wrap;">{{ $complaint->resolution_notes }}</p>
        </div>
        @endif
        
        <p>We appreciate your patience and feedback. If you have any further concerns or questions, please don't hesitate to contact us.</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/contact') }}" 
               style="background-color: #2dc9ff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                Contact Us
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
