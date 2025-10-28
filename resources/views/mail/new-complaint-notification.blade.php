<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>New Complaint Received</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #2dc9ff;">New Complaint Received</h2>
        
        <p>A new complaint has been submitted through the LocumKit contact form.</p>
        
        <div style="background-color: #f9f9f9; padding: 15px; border-left: 4px solid #ff6b6b; margin: 20px 0;">
            <h3 style="margin-top: 0;">Complaint Details:</h3>
            <p><strong>Name:</strong> {{ $complaint->name }}</p>
            <p><strong>Email:</strong> {{ $complaint->email }}</p>
            <p><strong>Submitted:</strong> {{ $complaint->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($complaint->status) }}</p>
        </div>
        
        <div style="background-color: #fff; padding: 15px; border: 1px solid #ddd; margin: 20px 0;">
            <h3 style="margin-top: 0;">Message:</h3>
            <p style="white-space: pre-wrap;">{{ $complaint->message }}</p>
        </div>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('/admin/complaints/' . $complaint->id) }}" 
               style="background-color: #2dc9ff; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">
                View Complaint
            </a>
        </div>
        
        <p>Please review this complaint and take appropriate action.</p>
        
        <hr style="border: none; border-top: 1px solid #eee; margin: 30px 0;">
        
        <p style="font-size: 12px; color: #666;">
            This is an automated notification from LocumKit Admin Panel.
        </p>
    </div>
</body>
</html>
