<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        .error-code {
            font-size: 72px;
            font-weight: bold;
        }
        .error-message {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .home-link {
            text-decoration: none;
            color: #0d6efd;
            font-size: 18px;
        }
        .home-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">404</div>
        <div class="error-message">Looks like this page is on vacation. Let’s get you back on track</div>

        <div>Every end is a new beginning.   <a href="{{ url('/') }}" class="home-link">Click here to start fresh</a>     </div>
    </div>
</body>
</html>
