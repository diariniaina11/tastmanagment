<?php
$session = session();
$session->set(['events'=>$events]);

$eventsLenght = count($events);


?>

<?php foreach ($events as $eventKey => $event): ?>
    <?php
        $info = json_decode($event['info'], true); // convertit la chaîne JSON en tableau associatif
        if (is_array($info) && isset($info['title'])) {
            echo htmlspecialchars($info['title']); // toujours mieux d’échapper pour la sécurité XSS
        } else {
            echo "<!-- Données JSON invalides à la clé $eventKey -->";
        }
    ?>
<?php endforeach; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Organisateur</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lucide/0.263.1/umd/lucide.js"></script>

  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f9fafb;
            color: #111827;
            line-height: 1.6;
        }

        .header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .header-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .header-title p {
            color: #6b7280;
            font-size: 0.875rem;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn-icon {
            padding: 0.5rem;
            border: none;
            background: none;
            border-radius: 0.5rem;
            cursor: pointer;
            color: #9ca3af;
            transition: all 0.2s ease;
        }

        .btn-icon:hover {
            color: #6b7280;
            background-color: #f3f4f6;
        }

        .avatar {
            width: 2rem;
            height: 2rem;
            background: #3b82f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 500;
            font-size: 0.875rem;
        }

        .containeR {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1.5rem 1rem;
        }

        .event-selector {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            padding: 1rem;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: between;
            align-items: center;
        }

        .event-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .event-select {
            font-size: 1.125rem;
            font-weight: 600;
            border: none;
            background: transparent;
            cursor: pointer;
            outline: none;
        }

        .event-meta {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6b7280;
            font-size: 0.875rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            padding: 1.5rem;
            transition: box-shadow 0.2s ease;
        }

        .stat-card:hover {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-icon {
            padding: 0.75rem;
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon.green { background-color: #dcfce7; color: #16a34a; }
        .stat-icon.blue { background-color: #dbeafe; color: #2563eb; }
        .stat-icon.purple { background-color: #f3e8ff; color: #9333ea; }
        .stat-icon.yellow { background-color: #fef3c7; color: #d97706; }

        .trend {
            display: flex;
            align-items: center;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .trend.positive { color: #16a34a; }
        .trend.negative { color: #dc2626; }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.25rem;
        }

        .stat-title {
            color: #6b7280;
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }

        .stat-subtitle {
            color: #9ca3af;
            font-size: 0.75rem;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .chart-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            padding: 1.5rem;
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .chart-title {
            font-size: 1.125rem;
            font-weight: 600;
        }

        .export-btn {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            color: #6b7280;
            font-size: 0.875rem;
            border: none;
            background: none;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .export-btn:hover {
            color: #111827;
        }

        .mini-chart {
            display: flex;
            align-items: end;
            gap: 0.25rem;
            height: 4rem;
            margin-bottom: 1rem;
        }

        .chart-bar {
            flex: 1;
            background: #3b82f6;
            border-radius: 2px 2px 0 0;
            transition: background-color 0.2s ease;
            cursor: pointer;
            min-height: 8px;
        }

        .chart-bar:hover {
            background: #2563eb;
        }

        .chart-labels {
            display: flex;
            justify-content: space-between;
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .chart-summary {
            display: flex;
            justify-content: space-between;
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 1rem;
        }

        .progress-section {
            margin-bottom: 1rem;
        }

        .progress-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .progress-bar {
            width: 100%;
            height: 0.5rem;
            background: #e5e7eb;
            border-radius: 0.25rem;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #3b82f6;
            border-radius: 0.25rem;
            transition: width 0.3s ease;
        }

        .circular-progress {
            position: relative;
            width: 4rem;
            height: 4rem;
        }

        .circular-progress svg {
            width: 100%;
            height: 100%;
            transform: rotate(-90deg);
        }

        .actions-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
        }

        .actions-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border: 1px solid #e5e7eb;
            padding: 1.5rem;
        }

        .actions-title {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .action-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            margin-bottom: 0.75rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .action-item:hover {
            background-color: #f9fafb;
        }

        .action-content {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .alert-dot {
            width: 0.5rem;
            height: 0.5rem;
            border-radius: 50%;
            margin-top: 0.375rem;
            flex-shrink: 0;
        }

        .alert-dot.green { background: #16a34a; }
        .alert-dot.yellow { background: #d97706; }
        .alert-dot.blue { background: #2563eb; }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .event-selector {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .charts-grid {
                grid-template-columns: 1fr;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
        .detail-button-container {
            width: 55%;
            display: flex;
            flex-direction: row;
            justify-content: flex-end; 
        }
        .detail-button{
            background: #E6E6E6FF;
            padding: 2px;
            border-radius: 9px;
            transition: 0.4s;
        }
        .detail-button:hover{
            background: #CFCFCFFF;
            cursor: pointer;
            transition: 0.4s;
        }
    </style>
</head>
<body>
    <div class="header">
        <nav class="header-content">
            <!-- Logo ou titre -->
            <div class="text-xl font-bold text-gray-800">MonApp</div>

            <!-- Liens de navigation -->
            <div class="flex items-center space-x-6">
            <!-- Dashboard -->
            <a href="#" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>

            <!-- Créer un nouvel événement (icône +) -->
            <a href="<?=base_url('/event-creation')?>">
                <button class="text-gray-700 hover:text-green-600 text-2xl">
                    <i class="fas fa-plus-circle"></i>
                </button>
            </a>

            <!-- Photo de profil en cercle -->
            <a href="<?=base_url('/profile')?>">
                <div class="w-10 h-10">
                    <img
                    src="https://randomuser.me/api/portraits/men/75.jpg"
                    alt="Profil"
                    class="w-full h-full object-cover rounded-full border-2 border-blue-500"
                    />
                </div>
            </a>
            </div>
        </nav>
    </div>

    <div class="containeR">
        <!-- Sélecteur d'événement -->
         <div>

         <div class="event-selector">
            <div class="event-info">
                <i data-lucide="calendar"></i>
                <select id="eventSelect" class="event-select" onchange="changeEvent()">
                <?php foreach ($events as $eventKey => $event): ?>
                    <?php 
                        $info = json_decode($event['info'], true);
                    ?>
                    <?php if (is_array($info) && isset($info['title'])): ?>
                        <option value="<?= htmlspecialchars($eventKey) ?>">
                            <?= htmlspecialchars($info['title']) ?>
                        </option>
                    <?php endif; ?>
                <?php endforeach; ?>

                </select>
            </div>
            <div class="event-meta">
                <i data-lucide="map-pin"></i>
                <span id="eventLocation">Centre Culturel, Paris</span>
                <span>•</span>
                <i data-lucide="clock"></i>
                <span id="eventDate">15 juillet 2025</span>
            </div>
            
            <div class="detail-button-container">
                <a href="<?=base_url('/event-ending-creation')?>">
                    <svg class="detail-button" xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#000000"><path d="M627.33-427.67H132v-104.66h495.33l-222-222L480-828.67 828.67-480 480-132l-74.67-73.67 222-222Z"/></svg>
                </a>
            </div>
        </div>

        <!-- Statistiques principales -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon green">
                        <i data-lucide="ticket"></i>
                    </div>
                    <div class="trend positive">
                        <i data-lucide="trending-up"></i>
                        +12%
                    </div>
                </div>
                <div class="stat-value" id="soldTickets">347</div>
                <div class="stat-title">Billets Vendus</div>
                <div class="stat-subtitle" id="soldSubtitle">sur 500 disponibles</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon blue">
                        <i data-lucide="users"></i>
                    </div>
                </div>
                <div class="stat-value" id="remainingTickets">153</div>
                <div class="stat-title">Billets Restants</div>
                <div class="stat-subtitle" id="remainingSubtitle">69.4% vendus</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon purple">
                        <i data-lucide="dollar-sign"></i>
                    </div>
                    <div class="trend positive">
                        <i data-lucide="trending-up"></i>
                        +8%
                    </div>
                </div>
                <div class="stat-value" id="revenue">17 350 €</div>
                <div class="stat-title">Revenus</div>
                <div class="stat-subtitle" id="revenueSubtitle">Prix moyen: 50€</div>
            </div>

            <div class="stat-card">
                <div class="stat-header">
                    <div class="stat-icon yellow">
                        <i data-lucide="star"></i>
                    </div>
                </div>
                <div class="stat-value" id="rating">4.8</div>
                <div class="stat-title">Note Moyenne</div>
                <div class="stat-subtitle" id="reviewsCount">23 avis</div>
            </div>
        </div>

        <!-- Graphiques -->
        <div class="charts-grid">
            <div class="chart-card">
                <div class="chart-header">
                    <h3 class="chart-title">Ventes de la Semaine</h3>
                    <button class="export-btn" onclick="exportData()">
                        <i data-lucide="download"></i>
                        Exporter
                    </button>
                </div>
                <div class="mini-chart" id="salesChart"></div>
                <div class="chart-labels">
                    <span>Lun</span>
                    <span>Mar</span>
                    <span>Mer</span>
                    <span>Jeu</span>
                    <span>Ven</span>
                    <span>Sam</span>
                    <span>Dim</span>
                </div>
                <div class="chart-summary">
                    <span>Total cette semaine: 142 billets</span>
                    <span>+15% vs semaine précédente</span>
                </div>
            </div>

            <div class="chart-card">
                <h3 class="chart-title">Progression</h3>
                <div class="progress-section">
                    <div class="progress-header">
                        <span>Billets vendus</span>
                        <span id="progressPercent">69.4%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill" style="width: 69.4%"></div>
                    </div>
                </div>
                <div style="padding-top: 1rem; border-top: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <p style="font-size: 0.875rem; color: #6b7280; margin-bottom: 0.5rem;">Objectif de vente</p>
                        <div style="font-size: 1.5rem; font-weight: 700;" id="objectivePercent">69%</div>
                        <div style="font-size: 0.875rem; color: #9ca3af;">Objectif: 80%</div>
                    </div>
                    <div class="circular-progress">
                        <svg viewBox="0 0 36 36">
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  fill="none" stroke="#e5e7eb" stroke-width="2"/>
                            <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                                  fill="none" stroke="#3b82f6" stroke-width="2" 
                                  stroke-dasharray="69.4, 100" id="circularProgress"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions et alertes -->
        <div class="actions-grid">
            <div class="actions-card">
                <h3 class="actions-title">Actions Rapides</h3>
                <div class="action-item" onclick="viewEventPage()">
                    <div class="action-content">
                        <i data-lucide="eye"></i>
                        <span>Voir la page événement</span>
                    </div>
                    <i data-lucide="chevron-right"></i>
                </div>
                <div class="action-item" onclick="manageReviews()">
                    <div class="action-content">
                        <i data-lucide="message-square"></i>
                        <span>Gérer les avis</span>
                    </div>
                    <i data-lucide="chevron-right"></i>
                </div>
                <div class="action-item" onclick="exportData()">
                    <div class="action-content">
                        <i data-lucide="download"></i>
                        <span>Exporter les données</span>
                    </div>
                    <i data-lucide="chevron-right"></i>
                </div>
            </div>

            
        </div>

         </div>
        
    </div>
    

    <script>
        <?php foreach ($events as $eventKey => $event){
        echo 'event'." ".$eventKey.'<br>';
        echo $event['info'];
        echo '<br>'.'//'.'<br>';
        echo $event['localisation']; 
        echo '<br>'.'//'.'<br>';
        echo $event['date_event'];
        echo '<br>'.'//'.'<br>';
        echo $event['heure']; 
        echo '<br>'.'//'.'<br>';
        echo $event['tarif'];
        echo '<br>'.'//'.'<br>';
        echo $event['programme'];
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
} ?>
        
        const events = {
            <?php foreach ($events as $key => $event): ?>
                <?php 
                $info = json_decode($event['info'], true);
                $localisation = json_decode($event['localisation'], true); 
                $date_event = json_decode($event['date_event'], true); 
                $heure = json_decode($event['heure'], true); 
                $tarif = json_decode($event['tarif'], true); 
                $programme = json_decode($event['programme'], true); 
                ?>
                <?php if (is_array($info)): ?>
                    "<?= addslashes($key) ?>": {
                        name: "<?= addslashes($info['title'] ?? 'Inconnu') ?>",
                        date: "<?= addslashes($date_event['date'] ?? '') ?>",
                        location: "<?= addslashes($info['location'] ?? '') ?>",
                        totalTickets: <?= (int)($info['totalTickets'] ?? 0) ?>,
                        soldTickets: <?= (int)($info['soldTickets'] ?? 0) ?>,
                        revenue: <?= (int)($info['revenue'] ?? 0) ?>,
                        price: <?= (int)($info['price'] ?? 0) ?>,
                        rating: <?= (float)($info['rating'] ?? 0) ?>,
                        reviews: <?= (int)($info['reviews'] ?? 0) ?>
                    },
                <?php endif; ?>
            <?php endforeach; ?>
        };


        // Données des ventes hebdomadaires
        const salesData = [12, 19, 8, 25, 18, 32, 28];

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
            updateDashboard();
            createSalesChart();
        });

        // Changement d'événement
        function changeEvent() {
            updateDashboard();
        }

        // Mise à jour du tableau de bord
        function updateDashboard() {
            const selectedEvent = document.getElementById('eventSelect').value;
            const event = events[selectedEvent];
            
            if (!event) return;

            const remainingTickets = event.totalTickets - event.soldTickets;
            const salesPercentage = (event.soldTickets / event.totalTickets) * 100;

            // Mise à jour des informations de l'événement
            document.getElementById('eventLocation').textContent = event.location;
            document.getElementById('eventDate').textContent = new Date(event.date).toLocaleDateString('fr-FR', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            // Mise à jour des statistiques
            document.getElementById('soldTickets').textContent = event.soldTickets;
            document.getElementById('soldSubtitle').textContent = 'sur ' + event.totalTickets + ' disponibles';
            
            document.getElementById('remainingTickets').textContent = remainingTickets;
            document.getElementById('remainingSubtitle').textContent = salesPercentage.toFixed(1) + '% vendus';
            
            document.getElementById('revenue').textContent = event.revenue.toLocaleString() + ' €';
            document.getElementById('revenueSubtitle').textContent = 'Prix moyen: ' + event.price + '€';
            
            document.getElementById('rating').textContent = event.rating;
            document.getElementById('reviewsCount').textContent = event.reviews + ' avis';

            // Mise à jour de la progression
            document.getElementById('progressPercent').textContent = salesPercentage.toFixed(1) + '%';
            document.getElementById('progressFill').style.width = salesPercentage + '%';
            document.getElementById('objectivePercent').textContent = Math.round(salesPercentage) + '%';
            document.getElementById('circularProgress').setAttribute('stroke-dasharray', salesPercentage + ', 100');
        }

        // Création du graphique des ventes
        function createSalesChart() {
            const chartContainer = document.getElementById('salesChart');
            const maxValue = Math.max(...salesData);
            
            chartContainer.innerHTML = '';
            
            salesData.forEach(value => {
                const bar = document.createElement('div');
                bar.className = 'chart-bar';
                const percentage = (value / maxValue) * 100;
                bar.style.height = percentage + '%';
                bar.title = value + ' billets';
                chartContainer.appendChild(bar);
            });
        }

        // Fonctions d'action
        function showNotifications() {
            alert('Notifications - Fonctionnalité à implémenter');
        }

        function showSettings() {
            alert('Paramètres - Fonctionnalité à implémenter');
        }

        function viewEventPage() {
            alert('Redirection vers la page événement - Fonctionnalité à implémenter');
        }

        function manageReviews() {
            alert('Gestion des avis - Fonctionnalité à implémenter');
        }

        function exportData() {
            const selectedEvent = document.getElementById('eventSelect').value;
            const event = events[selectedEvent];
            
            // Simulation d'export CSV
            const csvContent = "Evenement,Billets vendus,Billets restants,Revenus,Note moyenne\n" +
                event.name + "," + event.soldTickets + "," + (event.totalTickets - event.soldTickets) + "," + event.revenue + "€," + event.rating;
            
            const blob = new Blob([csvContent], { type: 'text/csv' });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'donnees-' + selectedEvent + '.csv';
            a.click();
            window.URL.revokeObjectURL(url);
        }

        // Animation des barres au survol
        document.addEventListener('mouseover', function(e) {
            if (e.target.classList.contains('chart-bar')) {
                e.target.style.transform = 'scaleY(1.1)';
                e.target.style.transformOrigin = 'bottom';
            }
        });

        document.addEventListener('mouseout', function(e) {
            if (e.target.classList.contains('chart-bar')) {
                e.target.style.transform = 'scaleY(1)';
            }
        });
    </script>
</body>
</html>