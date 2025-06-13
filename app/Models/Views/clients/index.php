<!DOCTYPE html>
<html>
<head>
    <title>Liste des clients</title>
</head>
<body>
    <h1>Liste des clients</h1>

    <ul>
        <?php foreach ($clients as $client): ?>
            <li><?= esc($client['nom']) ?> - <?= esc($client['email']) ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
