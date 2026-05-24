<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: Arial, Helvetica, sans-serif;
        }

        .login-card {
            width: 380px;
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 18px;
            box-shadow: 0 20px 45px rgba(0, 0, 0, 0.18);
        }

        .login-title {
            text-align: center;
            font-size: 26px;
            margin-bottom: 28px;
            font-weight: 700;
            color: #2d3748;
        }

        .input-group {
            margin-bottom: 18px;
        }

        input {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #dcdfe6;
            border-radius: 10px;
            font-size: 14px;
            background: #f8fafc;
            transition: 0.2s;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
        }

        button {
            width: 100%;
            padding: 13px;
            border: none;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-size: 15px;
            font-weight: 600;
            border-radius: 10px;
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.35);
        }

        .error {
            background: #fff1f2;
            color: #e11d48;
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 18px;
            text-align: center;
            font-size: 14px;
        }
    </style>

</head>

<body>

<div class="login-card">

    <div class="login-title">
        Admin Login
    </div>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login_process') }}">
        @csrf

        <div class="input-group">
            <input type="text" name="name" placeholder="Username" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <button type="submit">
            Login
        </button>

    </form>

</div>

</body>
</html>
