<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>MEDIAMAKR</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    
    <section class="container my-5">
        <div class="w-50 mx-auto">
            <h2 class="text-bg-primary text-center py-3 rounded">Acceso al Sistema</h2>
            <div class="my-2 border border-1 border-dark rounded p-3">
                <form id="acceso" name="acceso">
                    <label class="form-label">Usuario</label>
                    <input type="text" name="user" id="user" maxlength="30" required class="form-control border-dark w-75">
                    <label class="form-label">Password</label>
                    <input type="password" name="pwd" id="pwd" maxlength="30" required class="form-control border-dark w-75">
                    <div class="my-3">
                       <button type="submit" class="btn btn-outline-secondary">Acceder</button> 
                    </div>
                    
                </form>
            </div>
        </div>
    </section>



<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/administracion.js"></script>
</body>
</html>