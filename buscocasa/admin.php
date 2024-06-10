<html>

<head>
    <meta charset="UTF-8">
    <title>BUSCOCASA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>
    <?php
    require_once ("header.php");
    ?>
    <section class="container">
        <div class="w-75 my-5 mx-auto">
            <div class="mt-2 text-bg-primary text-center poetsen-one-regular">
                ADMINISTRACIÓN
            </div>
            <div class="bg-white p-3">
                <form id="formAcceso" name="formAcceso">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <input type="text" name="login" id="login" required class="form-control border-primary w-75">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label><span class="verPWD">
                            <i class="bi bi-eye-fill ojo"></i>
                        </span>
                        <input type="password" name="pwd" id="pwd" required class="form-control border-primary w-75">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-primary"><i class="bi bi-key"></i> Acceder</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/jsbuscocasa.js"></script>
</body>

</html>