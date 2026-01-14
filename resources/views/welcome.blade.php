<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sleepy Panda - Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1a1d3f 0%, #252850 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            padding: 30px 20px;
            overflow: auto;
        }

        .container {
            width: 100%;
            max-width: 380px;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo-container {
            text-align: center;
            margin-bottom: auto;
            padding-top: 60px;
        }

        .logo-container img {
            width: 100px;
            height: auto;
            margin: 0 auto 15px;
            display: block;
            filter: drop-shadow(0 6px 12px rgba(0, 0, 0, 0.3));
        }

        .logo-container h1 {
            font-size: 24px;
            font-weight: 600;
            color: #ffffff;
            letter-spacing: 0.5px;
            margin: 0;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .card {
            background: rgba(30, 33, 66, 0.7);
            border: 2px solid rgba(255, 255, 255, 0.6);
            border-radius: 1px;
            padding: 40px;
            backdrop-filter: blur(20px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4),
                0 0 40px rgba(0, 191, 165, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            height: 85vh;
            max-height: 700px;
            min-height: 550px;
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        }

        .description {
            text-align: center;
            font-size: 12px;
            font-weight: 300;
            color: rgba(255, 255, 255, 0.85);
            line-height: 1.7;
            margin: auto 0 35px 0;
            padding: 0 15px;
        }

        .button-group {
            padding-bottom: 20px;
        }

        .btn {
            width: 100%;
            padding: 14px 24px;
            border: none;
            border-radius: 6px;
            font-size: 15px;
            font-weight: 500;
            font-family: 'Poppins', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            text-align: center;
            margin-bottom: 12px;
            letter-spacing: 0.2px;
        }

        .btn-primary {
            background: #00bfa5;
            color: white;
            box-shadow: 0 4px 12px rgba(0, 191, 165, 0.3);
        }

        .btn-primary:hover {
            background: #00d4b8;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 191, 165, 0.4);
        }

        .btn-outline {
            background: white;
            color: #00bfa5;
            border: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.95);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 480px) {
            .logo-container {
                padding-top: 40px;
            }

            .logo-container img {
                width: 85px;
            }

            .logo-container h1 {
                font-size: 22px;
            }

            .card {
                padding: 30px;
                min-height: 500px;
            }

            .description {
                font-size: 11px;
                margin-bottom: 30px;
            }

            .btn {
                padding: 13px 20px;
                font-size: 14px;
            }

            .button-group {
                padding-bottom: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="logo-container">
                <img src="{{ asset('images/panda.png') }}" alt="Sleepy Panda Logo">
                <h1>Sleepy Panda</h1>
            </div>

            <p class="description">
                Mulai dengan masuk atau<br>mendaftar untuk melihat analisa<br> tidur mu
            </p>

            <div class="button-group">
                <a href="{{ route('login') }}" class="btn btn-primary">Masuk</a>
                <a href="{{ route('register') }}" class="btn btn-outline">Daftar</a>
            </div>
        </div>
    </div>
</body>

</html>
