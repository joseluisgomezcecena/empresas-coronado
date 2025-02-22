<div class="d-flex justify-content-center align-items-center w-100" style="min-height: 100vh;">
    <div class="col-md-8 col-lg-4">
        <div class="card shadow-lg opacity-mobile">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between m-b-30">
                    <a style="color:black; font-weight:900" class="navbar-brand text-brand" href="http://localhost/yonque/">
                        Empresas<span class="text-dark">Coronado</span>
                    </a>
                    <h2 class="m-b-0"></h2>
                </div>
                <form action="http://localhost/yonque/auth/login" method="post">
                    <div class="form-group">
                        <label class="font-weight-semibold" for="userName">Usuario:</label>
                        <input type="text" class="form-control" id="userName" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-semibold" for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <div class="d-flex align-items-center justify-content-between p-t-15">
                            <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
