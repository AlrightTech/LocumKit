<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Locumkit</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .logout-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 450px;
            width: 100%;
        }
        .logout-icon {
            font-size: 64px;
            color: #667eea;
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
            margin-bottom: 15px;
            font-size: 28px;
        }
        p {
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .btn {
            padding: 12px 30px;
            margin: 5px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-logout {
            background: #dc3545;
            color: white;
        }
        .btn-logout:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220,53,69,0.3);
        }
        .btn-cancel {
            background: #6c757d;
            color: white;
        }
        .btn-cancel:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108,117,125,0.3);
        }
        .user-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="logout-icon">⚠️</div>
        <h1>Confirm Logout</h1>
        
        <div class="user-info">
            <strong>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</strong><br>
            <small>{{ Auth::user()->email }}</small>
        </div>
        
        <p>Are you sure you want to logout from Locumkit?</p>
        
        <form action="{{ route('logout') }}" method="POST" style="display: inline-block;">
            @csrf
            <button type="submit" class="btn btn-logout">
                Yes, Logout
            </button>
        </form>
        
        <a href="javascript:history.back()" class="btn btn-cancel">
            Cancel
        </a>
    </div>

    <script>
        // Auto-submit logout after 3 seconds if user doesn't interact
        setTimeout(function() {
            document.querySelector('form').submit();
        }, 3000);
    </script>
</body>
</html>

