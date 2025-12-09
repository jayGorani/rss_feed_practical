<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import RSS Feed - RSS Scheduler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #0cebeb 0%, #20e3b2 100%);
        }
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background: var(--primary-gradient) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            transition: transform 0.3s ease;
        }
        .navbar-brand:hover {
            transform: scale(1.05);
        }
        .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 1rem !important;
        }
        .nav-link:hover {
            color: white !important;
            transform: translateY(-2px);
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: white;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after {
            width: 80%;
        }
        .main-container {
            max-width: 800px;
            margin: 3rem auto;
            padding: 0 1rem;
        }
        .import-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: fadeInUp 0.6s ease;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .card-header-custom {
            background: var(--primary-gradient);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        .card-header-custom h2 {
            margin: 0;
            font-weight: 700;
            font-size: 2rem;
        }
        .card-header-custom i {
            font-size: 3rem;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }
        .card-body-custom {
            padding: 3rem;
        }
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #e0e0e0;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 1rem;
        }
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.25rem rgba(102, 126, 234, 0.15);
            transform: translateY(-2px);
        }
        .btn-custom {
            padding: 0.875rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-custom::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255,255,255,0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }
        .btn-custom:hover::before {
            width: 300px;
            height: 300px;
        }
        .btn-custom span {
            position: relative;
            z-index: 1;
        }
        .btn-import {
            background: var(--primary-gradient);
            color: white;
        }
        .btn-import:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
        }
        .btn-view {
            background: var(--success-gradient);
            color: white;
        }
        .btn-view:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(12, 235, 235, 0.3);
        }
        .info-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-left: 4px solid #2196f3;
            border-radius: 12px;
            padding: 1.5rem;
            margin-top: 2rem;
            animation: slideInLeft 0.6s ease 0.3s both;
        }
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        .info-box h5 {
            color: #1565c0;
            font-weight: 700;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .info-box p {
            color: #424242;
            margin: 0;
            line-height: 1.6;
        }
        .button-group {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        @media (max-width: 768px) {
            .card-body-custom {
                padding: 2rem 1.5rem;
            }
            .button-group {
                flex-direction: column;
            }
            .btn-custom {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div id="flash-messages" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
        <?php
            $types = ['success', 'error', 'warning', 'info'];
            foreach ($types as $msg) {
                if ($this->session->flashdata($msg)) {
                    $alertType = $msg === 'error' ? 'danger' : $msg;
                    echo '
                        <div class="alert alert-' . $alertType . ' alert-dismissible fade show" role="alert">
                            ' . $this->session->flashdata($msg) . '
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    ';
                }
            }
        ?>
    </div>

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="bi bi-rss-fill"></i> RSS Scheduler
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('rss_feeds'); ?>">
                            <i class="bi bi-cloud-download"></i> Import Rss
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('rss_feeds/feed_list'); ?>">
                            <i class="bi bi-file-text"></i> Posts
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url('rss_feeds/dashboard'); ?>">
                            <i class="bi bi-grid"></i> Dashboard
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>