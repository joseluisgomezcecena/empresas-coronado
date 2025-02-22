<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Car Parts Store</title>
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

    <header class="hero">
        <div class="container">
            <h1 class="display-4 font-bolder">Empresas Coronado</h1>
            <p class="lead">Partes para todas las marcas y modelos</p>
        </div>
    </header>

    <div class="search-card mb-5">
        <h2 class="font-bolder mb-2">Busqueda de piezas</h2>
        <p class="lead">Busca piezas en nuestro amplio inventario.</p>
        <form class="row g-3 mb-4">
            <div class="col-md-2">
                <select class="form-select" aria-label="Seleccionar Marca">
                    <option selected>Marca</option>
                    <option value="1">Toyota</option>
                    <option value="2">Honda</option>
                    <option value="3">Ford</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" aria-label="Seleccionar Modelo">
                    <option selected>Modelo</option>
                    <option value="1">Corolla</option>
                    <option value="2">Civic</option>
                    <option value="3">Mustang</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" aria-label="Seleccionar Año">
                    <option selected>Año</option>
                    <option value="1">2023</option>
                    <option value="2">2022</option>
                    <option value="3">2021</option>
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Buscar Parte">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-dark w-100">Buscar</button>
            </div>
            <a style="text-decoration:none;" href="<?php echo base_url("catalogo") ?>">Busqueda Avanzada ></a>
        </form>
    </div>
    
    <section id="about" class="py-5 text-center mt-5">
        <div class="container margin-mobile">
            <h2 class="mt-5 font-bolder">Encuentra las Mejores Autopartes al Mejor Precio</h2>
            <p class="lead">En Empresas Coronado, ofrecemos una amplia selección de autopartes para todas las marcas y modelos.
                 Nuestro yonque cuenta con piezas originales a precios accesibles, garantizando calidad y rendimiento para tu vehículo.
                Aquí encontrarás lo que buscas con la mejor atención y servicio.</p>
            <div class="row mt-5">
                <div class="col-md-8">
                    <div class="card shadow p-3 bg-dark text-white mb-5">
                        <h3 style="font-weight:800">¿Por qué elegirnos?</h3>

                        <h5>Calidad Y Disponibilidad</h5>
                        <p>
                        Nuestro inventario en línea te permite encontrar autopartes fácilmente, 
                        con disponibilidad garantizada y acceso 24/7 desde cualquier dispositivo. ¡Compra rápido y sin complicaciones!
                        </p>
                        <br><br/>
                        <a href="<?php echo base_url("catalogo") ?>" class="btn btn-primary btn-lg mb-3">Ver Catalogo</a>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <img src="<?php echo base_url("assets/images/pickup-01.png") ?>" alt="">
                </div>
            </div>
        </div>
    </section>
    
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-3">
                    <h5>Empresas Coronado S.A. de C.V.</h5>
                    <ul class="list-unstyled">
                        <li><p href="#" class="text-white">
                            Blvd. Lázaro Cárdenas Km 2.5, La Bodega, 21298 Mexicali, B.C.
                        </p></li>
                        <li>
                            <p href="#" class="text-white">Tel. (686) 216 7037</p>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Navegación</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Sobre la empresa</a></li>
                        <li><a href="#" class="text-white">Catalogo</a></li>
                        <li><a href="#" class="text-white">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Politicas</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Politica de privacidad</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Redes Sociales</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Facebook</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="bg-black text-white text-center py-2">
        <p class="mt-2">© <?php echo date("Y") ?> Empresas Coronado S.A. de C.V. Todos los derechos reservados.</p>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
