<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de connexion</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <!-- jQuery (requis pour Toastr) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="<?= base_url('login.css')?>">

</head>
<body>
    <div class="container">
        <div class="left-side">
            <h1>Nouveau ici ?</h1>
            <p>Inscrivez-vous et découvrez une grande quantité de nouvelles opportunités.</p>
            <a href="<?=base_url('/inscription') ?>" class="btn-register">S'inscrire</a>
        </div>
        <div class="right-side">
            <div class="login-header">
                <h1>Connexion</h1>
                <p>Veuillez vous connecter pour continuer</p>
            </div>
           
            
            <form action="/login" method="post">
                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Entrez votre email">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="pwd" id="password" class="form-control" placeholder="Entrez votre mot de passe">
                </div>
                <div class="forgot-password">
                    <a href="#">Mot de passe oublié ?</a>
                </div>
                <button type="submit" class="btn-login">Se connecter</button>
            </form>
        </div>
        
    </div>
    <script>
        <?php if (session()->getFlashdata('error')) : ?>
            toastr.warning("<?= session()->getFlashdata('error') ?>");
        <?php endif; ?>
    </script>
</body>
</html>