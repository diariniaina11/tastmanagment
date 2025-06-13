<?php
$session = session();
$session->set(['events'=>$events]);

$eventsLength = count($events);

$selectedEventKey = $_GET['event'] ?? array_key_first($events);
$selectedEvent = $events[$selectedEventKey] ?? null;

$eventData = [
    'name' => 'Concert de Jazz',
    'date' => '15 juillet 2025',
    'location' => 'Centre Culturel, Paris',
    'totalTickets' => 500,
    'soldTickets' => 347,
    'revenue' => 17350,
    'price' => 50,
    'rating' => 4.8,
    'reviews' => 23
];

if ($selectedEvent) {
    $info = json_decode($selectedEvent['info'], true);
    $localisation = json_decode($selectedEvent['localisation'], true);
    $date_event = json_decode($selectedEvent['date_event'], true);
    $heure = json_decode($selectedEvent['heure'], true);
    $tarif = json_decode($selectedEvent['tarif'], true);
    
    if (is_array($info)) {
        $eventData = [
            'name' => $info['title'] ?? $eventData['name'],
            'date' => $date_event['date'] ?? $eventData['date'],
            'location' => $info['location'] ?? $eventData['location'],
            'totalTickets' => (int)($info['totalTickets'] ?? $eventData['totalTickets']),
            'soldTickets' => (int)($info['soldTickets'] ?? $eventData['soldTickets']),
            'revenue' => (int)($info['revenue'] ?? $eventData['revenue']),
            'price' => (int)($info['price'] ?? $eventData['price']),
            'rating' => (float)($info['rating'] ?? $eventData['rating']),
            'reviews' => (int)($info['reviews'] ?? $eventData['reviews'])
        ];
    }
}

$remainingTickets = $eventData['totalTickets'] - $eventData['soldTickets'];
$salesPercentage = ($eventData['soldTickets'] / $eventData['totalTickets']) * 100;

if(isset($_GET['submitBtn'])){
    $_GET['submitBtn'];
    echo $_GET['submitBtn'];
    $session->set(['eventId' => $_GET['submitBtn']]);   
    ?>
<script>
    window.location.href = "<?= site_url('event-ending-creation') ?>";
</script><?php
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Organisateur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-900">
    <!-- Header -->
    <header class="bg-white border-b border-gray-200 shadow-sm">
        <nav class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-gray-800">MonApp</div>
            <div class="flex items-center space-x-6">
                <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                <a href="<?=base_url('/event-creation')?>" class="text-gray-700 hover:text-green-600 text-2xl">
                    <i class="fas fa-plus-circle"></i>
                </a>
                <a href="<?=base_url('/profile')?>">
                    <img src="https://randomuser.me/api/portraits/men/75.jpg" 
                         alt="Profil" 
                         class="w-10 h-10 rounded-full border-2 border-blue-500">
                </a>
            </div>
        </nav>
    </header>
    <?php foreach ($events as $eventKey => $event): ?>
        <?php $info = json_decode($event['info'], true); ?>


    <div class="max-w-7xl mx-auto px-4 py-6">
        <!-- Sélecteur d'événement -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
            <form method="GET" class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="flex items-center gap-4">
                    <i class="fas fa-calendar text-gray-500"></i>
                    <div name="event" onchange="this.form.submit()" 
                        class="text-lg font-semibold border-none bg-transparent cursor-pointer outline-none">
                        <?php if (is_array($info) && isset($info['title'])): ?>
                        <div value="<?= htmlspecialchars($eventKey) ?>"> 
                                <?= htmlspecialchars($info['title']) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-600">
                    <i class="fas fa-map-marker-alt"></i>
                    <span><?= htmlspecialchars($eventData['location']) ?></span>
                    <span>•</span>
                    <i class="fas fa-clock"></i>
                    <span><?= htmlspecialchars($eventData['date']) ?></span>
                </div>
                <div class="flex justify-end">
                    <button type='submit' name='submitBtn' value="<?=$event['id'];?>" class="bg-gray-200 hover:bg-gray-300 p-2 rounded-lg transition-colors">
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>

        <!-- Statistiques principales -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Billets Vendus -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-center mb-4">
                    <div class="bg-green-100 p-3 rounded-lg">
                        <i class="fas fa-ticket-alt text-green-600"></i>
                    </div>
                    <div class="flex items-center text-green-600 text-sm font-medium">
                        <i class="fas fa-trending-up mr-1"></i>
                        +12%
                    </div>
                </div>
                <div class="text-2xl font-bold mb-1"><?= number_format($eventData['soldTickets']) ?></div>
                <div class="text-gray-600 text-sm mb-1">Billets Vendus</div>
                <div class="text-gray-400 text-xs">sur <?= number_format($eventData['totalTickets']) ?> disponibles</div>
            </div>

            <!-- Billets Restants -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-center mb-4">
                    <div class="bg-blue-100 p-3 rounded-lg">
                        <i class="fas fa-users text-blue-600"></i>
                    </div>
                </div>
                <div class="text-2xl font-bold mb-1"><?= number_format($remainingTickets) ?></div>
                <div class="text-gray-600 text-sm mb-1">Billets Restants</div>
                <div class="text-gray-400 text-xs"><?= number_format($salesPercentage, 1) ?>% vendus</div>
            </div>

            <!-- Revenus -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-center mb-4">
                    <div class="bg-purple-100 p-3 rounded-lg">
                        <i class="fas fa-mga-sign text-purple-600"></i>
                    </div>
                    <div class="flex items-center text-green-600 text-sm font-medium">
                        <i class="fas fa-trending-up mr-1"></i>
                        +8%
                    </div>
                </div>
                <div class="text-2xl font-bold mb-1"><?= number_format($eventData['revenue']) ?> MGA</div>
                <div class="text-gray-600 text-sm mb-1">Revenus</div>
                <div class="text-gray-400 text-xs">Prix moyen: <?= $eventData['price'] ?>MGA</div>
            </div>

            <!-- Note Moyenne -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition-shadow">
                <div class="flex justify-between items-center mb-4">
                    <div class="bg-yellow-100 p-3 rounded-lg">
                        <i class="fas fa-star text-yellow-600"></i>
                    </div>
                </div>
                <div class="text-2xl font-bold mb-1"><?= $eventData['rating'] ?></div>
                <div class="text-gray-600 text-sm mb-1">Note Moyenne</div>
                <div class="text-gray-400 text-xs"><?= $eventData['reviews'] ?> avis</div>
            </div>
        </div>

        <!-- Graphiques et Progression -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold mb-4">Alertes et Notifications</h3>
                
                <div class="flex items-start gap-3 p-3 border border-gray-200 rounded-lg mb-3">
                    <div class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                    <div>
                        <div class="font-medium">Ventes en hausse</div>
                        <div class="text-sm text-gray-600">+12% cette semaine</div>
                    </div>
                </div>
                
                <div class="flex items-start gap-3 p-3 border border-gray-200 rounded-lg mb-3">
                    <div class="w-2 h-2 bg-yellow-500 rounded-full mt-2 flex-shrink-0"></div>
                    <div>
                        <div class="font-medium">Objectif proche</div>
                        <div class="text-sm text-gray-600">11% restants pour atteindre 80%</div>
                    </div>
                </div>
                
                <div class="flex items-start gap-3 p-3 border border-gray-200 rounded-lg">
                    <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                    <div>
                        <div class="font-medium">Nouvel avis</div>
                        <div class="text-sm text-gray-600">Note 5/5 reçue aujourd'hui</div>
                    </div>
                </div>
            </div>
            <!-- Progression -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold mb-6">Progression</h3>
                
                <div class="mb-6">
                    <div class="flex justify-between text-sm mb-2">
                        <span>Billets vendus</span>
                        <span><?= number_format($salesPercentage, 1) ?>%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full transition-all duration-300" 
                             style="width: <?= $salesPercentage ?>%"></div>
                    </div>
                </div>
                
                <div class="pt-6 border-t border-gray-200 flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600 mb-2">Objectif de vente</p>
                        <div class="text-2xl font-bold"><?= round($salesPercentage) ?>%</div>
                        <div class="text-sm text-gray-400">Objectif: 80%</div>
                    </div>
                    <div class="w-16 h-16 relative">
                        <svg class="w-16 h-16 transform -rotate-90" viewBox="0 0 36 36">
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  fill="none" stroke="#e5e7eb" stroke-width="2"/>
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  fill="none" stroke="#3b82f6" stroke-width="2" 
                                  stroke-dasharray="<?= $salesPercentage ?>, 100"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <?php endforeach; ?>

    <?php
    if(isset($_GET['action'])) {
        switch($_GET['action']) {
            case 'export':
                if(isset($_GET['event'])) {
                    $event = $events[$_GET['event']] ?? null;
                    if($event) {
                        header('Content-Type: text/csv');
                        header('Content-Disposition: attachment; filename="donnees-event.csv"');
                        echo "Evenement,Billets vendus,Billets restants,Revenus,Note moyenne\n";
                        echo $eventData['name'] . "," . $eventData['soldTickets'] . "," . $remainingTickets . "," . $eventData['revenue'] . "MGA," . $eventData['rating'];
                        exit;
                    }
                }
                break;
        }
    }
    ?>
</body>
</html>