<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Rangking Kurir Terbaik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:700,400&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #e0eafc 0%, #cfdef3 100%);
            font-family: 'Montserrat', Arial, sans-serif;
            min-height: 100vh;
        }

        .login-link {
            position: absolute;
            top: 30px;
            right: 40px;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .main-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 40px 30px 30px 30px;
            margin-top: 60px;
            margin-bottom: 40px;
        }

        h2 {
            font-weight: 700;
            color: #2b5876;
            letter-spacing: 1px;
            margin-bottom: 30px;
        }

        .form-group label {
            font-weight: 600;
            color: #2b5876;
        }

        .btn-primary {
            background: linear-gradient(90deg, #36d1c4 0%, #2b5876 100%);
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #2b5876 0%, #36d1c4 100%);
        }

        .table {
            margin-top: 25px;
            background: #f8fafc;
            border-radius: 12px;
            overflow: hidden;
        }

        .table thead {
            background: linear-gradient(90deg, #36d1c4 0%, #2b5876 100%);
            color: #fff;
        }

        .table tbody tr:nth-child(1) {
            background: #ffe082;
            font-weight: bold;
        }

        .table tbody tr:nth-child(2) {
            background: #b2ebf2;
        }

        .table tbody tr:nth-child(3) {
            background: #c8e6c9;
        }

        .alert-warning {
            margin-top: 30px;
            font-size: 1.1em;
        }

        @media (max-width: 768px) {
            .main-card {
                padding: 20px 10px 20px 10px;
            }

            .login-link {
                top: 15px;
                right: 15px;
            }
        }
    </style>
</head>

<body>

    @yield('value')

</body>

</html>
