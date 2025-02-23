<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Empresas Coronado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .hero {
            background: url('<?php echo base_url() ?>assets/images/car1.jpg') center/cover no-repeat;
            height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            flex-direction: column;
            position: relative;
        }

        .search-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: absolute;
            width: 80%;
            left: 50%;
            transform: translateX(-50%);
            top: 70vh;
            z-index: 10;
        }

        .font-bolder {
            font-weight: 700 !important;
        }

        .btn{
            border-radius:.25rem!important;
            font-weight: 700 !important;
        }

        /* on mobile */
        @media (max-width: 768px) {
            .hero {
                height: 80vh;
            }

            .search-card {
                top: 65vh;
            }

            .margin-mobile {
                margin-top: 250px;
            }
        }

        .navbar-toggler{
            border: none;
        }

        a{
            text-decoration: none !important;
        }

        .bg-black{
            background-color: #000 !important;
        }

    </style>
</head>
<body>

    <!-- Navigation -->
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Empresas Coronado</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="#nosotros">Nosotros</a></li>
                    <li class="nav-item"><a class="nav-link" href="#catalogo">Catálogo</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
    </nav>