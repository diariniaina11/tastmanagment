<?php if (session()->get('logged_in')) : ?>
    <p>Bienvenue, <?= session()->get('user_email') ?></p>
    <a href="/logout">Se déconnecter</a>
<?php else : ?>
    <a href="/login">Connexion</a>
<?php endif; ?>
