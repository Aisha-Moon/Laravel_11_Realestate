<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 20px;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
            color: #333;
        }

        section {
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
        }

        input[type="password"] {
            padding: 10px;
            font-size: 14px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        button {
            padding: 10px;
            font-size: 16px;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <header>
        <h1>Reset Your Password</h1>
    </header>

    <section>
        <form action="{{ url('set_new_password/'.$token) }}" method="POST">
            @csrf
            <label for="password">New Password</label>
            <input type="password" id="password" name="password" required>
            <span style="color:red">{{ $errors->has('password') ? $errors->first('password') : '' }}</span>

            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm_password" required>
            <span style="color:red">{{ $errors->has('confirm_password') ? $errors->first('confirm_password') : '' }}</span>


            <button type="submit">Reset Password</button>
        </form>
    </section>
</div>

</body>
</html>
