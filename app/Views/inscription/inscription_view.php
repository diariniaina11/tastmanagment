

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
    <style>

        .container {
            height: 880px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-side">
            <center><h1>Vous avez déjà un compte ?</h1></center>
            <p></p>
            <a href="<?=base_url('/login') ?>" class="btn-register">Se Connecter</a>
        </div>
        <div class="right-side">
            <div class="login-header">
                <h1>Création Compte</h1>
                <p></p>
            </div>
            
            
            <form action="/inscription" method="post">
            
                    <div class="form-group">
                        <label for="nom">Nom d'utilisateur</label>
                        <input type="nom" id="nom" name="nom" class="form-control" placeholder="Veuillez choisir un nom d'utilisateur">
                    </div>

                    <div class="form-group">
                        <label for="email">Adresse email</label>
                        <input id="email" name="email" class="form-control" placeholder="Entrez votre email">
                    </div>

                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" name="pwd" id="password" class="form-control" placeholder="Entrez votre mot de passe">
                    </div>
                    <button type="submit" class="btn-login">Créer</button>
            </form>
        </div>
    </div>
    <script>
        toastr.options = {
            "closeButton": true, // Affiche un bouton pour fermer
            "debug": false,
            "newestOnTop": true,
            "progressBar": true, // Barre de progression
            "positionClass": "toast-bottom-right", // Position
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300", // Durée d'apparition (ms)
            "hideDuration": "1000", // Durée de disparition (ms)
            "timeOut": "5000", // Temps d'affichage (ms)
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn", // Animation d'entrée
            "hideMethod": "fadeOut" // Animation de sortie
        };
        function toast(){
            toastrerror()
            toastrsuccess()
        }
        function toastrsuccess() {
            toastr.success('Compte créé avec succè', 'Bravo 🎉', {
                timeOut: 10000,
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right'
            });
        }
    
        function toastrerror() {
            toastr.error('Il faut ... !', 'Bravo 🎉', {
                timeOut: 10000,
                closeButton: true,
                progressBar: true,
                positionClass: 'toast-top-right'
            });  
        }
        
        <?php if (session()->getFlashdata('success')) : ?>
            toastr.success("<?= session()->getFlashdata('success') ?>", 'Succès 🎉');
        <?php elseif (session()->getFlashdata('error')) : ?>
            toastr.error("<?= session()->getFlashdata('error') ?>", 'Erreur ❌');
        <?php elseif (session()->getFlashdata('warning')) : ?>
            toastr.warning("<?= session()->getFlashdata('warning') ?>", 'Avertissement ⚠️');
        <?php endif; ?>
    </script>
    
</body>
</html>