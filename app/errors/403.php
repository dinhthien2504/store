<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }

        .error-container {
            text-align: center;
            padding: 30px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .error-code {
            font-size: 5rem;
            font-weight: bold;
            color: #dc3545;
        }

        .error-message {
            font-size: 1.25rem;
            margin: 20px 0;
        }

        .btn-home {
            font-size: 1rem;
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-code">403</div>
        <h1 class="error-title">Access Denied</h1>
        <p class="error-message">Bạn không có quyền truy cập trang này. Vui lòng kiểm tra lại quyền hạn của mình hoặc
            liên hệ với quản trị viên.</p>
        <a href="<?= _WEB_ROOT_ ?>" class="btn btn-primary btn-home">
            <i class="bi bi-house-door-fill"></i> Quay về trang chủ
        </a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>
</body>

</html>