<?php
function traduireDateFrancais($dateString)
{
    $date = new DateTime($dateString);

    $formatter = new IntlDateFormatter(
        'fr_FR',
        IntlDateFormatter::FULL,  
        IntlDateFormatter::NONE,  
        null,
        null,
        "EEEE d MMMM yyyy"        
    );

    $dateFormatee = $formatter->format($date);

    $dateFormatee = mb_strtolower(mb_substr($dateFormatee, 0, 1)) . mb_substr($dateFormatee, 1);

    return $dateFormatee;
}


function getTimeDifference($futureDate)
{
    $now = new DateTime();
    $target = new DateTime($futureDate);

    // Calcul de la différence
    $diff = $now->diff($target);

    // Récupérer jours, heures, minutes
    $jours = (int)$diff->format('%a');  // nombre total de jours
    $heures = (int)$diff->format('%h'); // heures restantes
    $minutes = (int)$diff->format('%i'); // minutes restantes

    return [$jours, $heures, $minutes];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'Événements - Détails de l'événement</title>

    <style>
        :root {
            --primary-color: #4a6de5;
            --secondary-color: #f8f9fa;
            --border-color: #dee2e6;
            --success-color: #28a745;
            --error-color: #dc3545;
            --text-color: #333;
            --text-muted: #6c757d;
            --card-bg: #fff;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fb;
            color: var(--text-color);
            line-height: 1.6;
        }
        
        .containeR {
            width: 90%;
            max-width: 1100px;
            margin: 2rem auto;
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

        .nav-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #2563eb;
        }

        .nav-icon {
            color: #374151;
            font-size: 1.5rem;
            transition: color 0.3s;
        }

        .nav-icon:hover {
            color: #16a34a;
        }

        .profile-img {
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 50%;
            border: 2px solid #3b82f6;
            object-fit: cover;
        }

        .logo {
            font-size: 1.25rem;
            font-weight: bold;
            color: #1f2937;
        }
        
        .headeR {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            background: white;
            padding: 36px;
            border-radius: 14px;
        }
        
        .header-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .event-image-container{
            width: 100%;
            background-color: #f8f9fa;
            display: flex;
        }
        .event-image {
            width: 100%;
            height: 250px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 1.5rem;
            background-color: #ddd;
        }
        
        .event-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
        }
        
        @media (max-width: 768px) {
            .event-container {
                grid-template-columns: 1fr;
            }
        }
        
        .card {
            background-color: var(--card-bg);
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .card-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
        }
        
        .card-title .icon {
            margin-right: 0.5rem;
            font-size: 1.4rem;
        }
        
        .event-main h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }
        
        .event-meta {
            color: var(--text-muted);
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .meta-item {
            display: flex;
            align-items: center;
        }
        
        .meta-item .icon {
            margin-right: 0.3rem;
        }
        
        .event-description {
            margin-bottom: 1.5rem;
            line-height: 1.7;
        }
        
        .event-info-list {
            list-style: none;
        }
        
        .event-info-item {
            display: flex;
            margin-bottom: 1rem;
            align-items: flex-start;
        }
        
        .event-info-icon {
            width: 30px;
            margin-right: 1rem;
            color: var(--primary-color);
            font-size: 1.2rem;
        }
        
        .event-info-content {
            flex: 1;
        }
        
        .event-info-label {
            font-weight: 600;
            margin-bottom: 0.2rem;
        }
        
        .event-info-value {
            color: var(--text-color);
        }
        
        .ticket-list {
            list-style: none;
        }
        
        .ticket-item {
            border: 1px solid var(--border-color);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .ticket-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .ticket-name {
            font-weight: 600;
        }
        
        .ticket-price {
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .ticket-description {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
        }
        
        .ticket-availability {
            font-size: 0.9rem;
            color: var(--success-color);
        }
        
        .session-list {
            list-style: none;
        }
        
        .session-item {
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .session-item:last-child {
            border-bottom: none;
        }
        
        .session-name {
            font-weight: 600;
            margin-bottom: 0.2rem;
        }
        
        .session-time {
            display: flex;
            align-items: center;
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        .session-time .icon {
            margin-right: 0.3rem;
        }
        
        .btn {
            padding: 0.6rem 1.2rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
        }
        
        .btn .icon {
            margin-right: 0.5rem;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
            color: var(--text-color);
        }
        
        .btn-success {
            background-color: var(--success-color);
            color: white;
        }
        
        .btn:hover {
            opacity: 0.9;
        }

        .hover-orange:hover {
            background-color: #f97316;
            color: white;
        }
        
        .btn-register {
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            width: 100%;
            text-align: center;
            display: block;
            margin-top: 1rem;
            justify-content: center;
        }
        
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--primary-color);
            color: var(--primary-color);
        }
        
        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .location-map {
            width: 100%;
            height: 200px;
            background-color: #ddd;
            border-radius: 5px;
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #6c757d;
            font-weight: bold;
        }
        
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 15px;
            margin-right: 0.5rem;
        }
        
        .badge-primary {
            background-color: #e6f3ff;
            color: var(--primary-color);
        }
        
        .tag-list {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .share-buttons {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .share-button {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #f0f0f0;
            color: var(--text-color);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 1.2rem;
        }
        
        .share-button:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .event-time-countdown {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 1rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .countdown-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .countdown-label {
            font-size: 0.8rem;
            color: var(--text-muted);
            text-transform: uppercase;
        }
        
        .countdown-container {
            display: flex;
            justify-content: space-around;
            margin-top: 0.5rem;
        }
        
        .countdown-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        .organizer-info {
            display: flex;
            align-items: center;
            margin-top: 1rem;
        }
        
        .organizer-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ddd;
            margin-right: 1rem;
        }
        
        .organizer-name {
            font-weight: 600;
        }
        
        .organizer-contact {
            color: var(--text-muted);
            font-size: 0.9rem;
        }
        
        /* Responsive styles */
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .header-actions {
                margin-top: 1rem;
                width: 100%;
                justify-content: space-between;
            }
            
            .event-info-item {
                flex-direction: column;
            }
            
            .event-info-icon {
                margin-bottom: 0.5rem;
            }

            .nav-links {
                gap: 1rem;
            }
        }
        
        /* Additional design elements */
        .status-badge {
            background-color: #e6f7e6;
            color: var(--success-color);
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }
        
        .status-badge .icon {
            margin-right: 0.3rem;
        }
        
        .price-info {
            display: flex;
            align-items: baseline;
            margin-top: 0.5rem;
        }
        
        .price-from {
            font-size: 0.9rem;
            color: var(--text-muted);
            margin-right: 0.5rem;
        }
        
        .price-value {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .pl-10 {
            padding-left: 10px;
        }
        .btn-danger{
            color: white;
            background-color: #F75C6BFF;
        }
    </style>
</head>
<body>
    <div class="header">
        <nav class="header-content">
            <!-- Logo ou titre -->
            <div class="logo">MonApp</div>

            <!-- Liens de navigation -->
            <div class="nav-links">
                <!-- Dashboard -->
                <a href="#">Dashboard</a>

                <!-- Créer un nouvel événement (icône +) -->
                <a href="/event-creation" class="nav-icon">
                    ➕
                </a>

                <!-- Photo de profil en cercle -->
                <a href="/profile">
                    <img
                        src="https://randomuser.me/api/portraits/men/75.jpg"
                        alt="Profil"
                        class="profile-img"
                    />
                </a>
            </div>
        </nav>
    </div>
    <div class="containeR">
        <div class="headeR">
            <div>
                <h1 style="font-size: 1.875rem; font-weight: 600; margin-bottom: 0.5rem;">Détails de l'événement</h1>
                <p>Consultez toutes les informations concernant cet événement</p>
            </div>
            <div class="header-actions">
                <?php 
                if(session()->get('is_organizer')==true){
                    $link='/organizer_dashboard_page';
                
                }else{
                    $link='/accueil';
                }
                ?>

                <a href="<?=$link?>">
                    <button class="btn btn-secondary hover-orange pl-10">
                        <span class="icon">⬅️</span> Retour
                    </button>
                </a>
                <?php if(session()->get('is_organizer')==true){?>
                    <form action="/delete-event" method="POST" onsubmit="return confirmDelete()">
                        <button type="submit" name='delete_btn' value='<?=$event['id']?>' class="btn btn-danger">
                            <span class="icon">✏️</span> Supprimer
                        </button>
                    </form>
                <?php }?>

            </div>
        </div>
        
        <div class='event-image-container'>

            <img src="https://via.placeholder.com/800x250" alt="Image de couverture de l'événement" class="event-image">
        </div>
        
        <div class="event-container">
            <div class="event-main">
                <div class="card">
                    <h1><?=json_decode($event['info'],true)['title']?></h1>
                    <div class="event-meta">
                        <span class="meta-item">
                            <span class="icon">📅</span> <?=traduireDateFrancais($event['date_event']). ' '?>
                        </span>
                        <span class="meta-item">
                            <span class="icon">🕒</span> <?=json_decode($event['heure'],true)['start_time'].' - '.json_decode($event['heure'],true)['end_time']?>                        </span>
                        <span class="meta-item">
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-301q99-80 149.5-154T680-594q0-90-56-148t-144-58q-88 0-144 58t-56 148q0 65 50.5 139T480-301Zm0 101Q339-304 269.5-402T200-594q0-125 78-205.5T480-880q124 0 202 80.5T760-594q0 94-69.5 192T480-200Zm0-320q33 0 56.5-23.5T560-600q0-33-23.5-56.5T480-680q-33 0-56.5 23.5T400-600q0 33 23.5 56.5T480-520ZM200-80v-80h560v80H200Zm280-520Z"/></svg>
                            </span><?=json_decode($event['localisation'],true)['venue']. ' '.json_decode($event['localisation'],true)['city'] ?>
                        </span>
                        <span class="status-badge">
                            <span class="icon">✓</span> Ouvert aux inscriptions
                        </span>
                    </div>
                    
                    <div class="price-info">
                        <span class="price-from">À partir de</span>
                        <span class="price-value"><?=json_decode($event['tarif'],true)['price']?> Ariary</span>
                    </div>
                    
                    <div>
                        <h3 style="margin: 2rem 0 1rem 0; font-size: 1.3rem; font-weight: 600;">📋 Détails</h3>
                        <div class="event-description">
                           <?=json_decode($event['info'],true)['description']?>
                        </div>
                        
                    </div>
                    
                    <!-- Section Programme -->
                    <div style="margin-top: 2rem;">
                        <h3 style="margin-bottom: 1rem; font-size: 1.3rem; font-weight: 600;">🎵 Programme :</h3>
                        <ul class="session-list">
                            <?php foreach (json_decode($event['programme'], true) as $session): ?>
                                <li class="session-item">
                                    <div class="session-name"><?= $session['name'] ?></div>
                                    <div class="session-time">
                                        <span class="icon">🕒</span> <?= $session['duration'] ?>
                                    </div>
                                    <p><?= $session['description'] ?></p>
                                </li>
                                
                                
                            <?php endforeach; ?>
                            <li class="session-item">
                                <div class="session-name">Session d'ouverture - Scène principale</div>
                                <div class="session-time">
                                    <span class="icon">🕒</span> 14:00 - 16:00
                                </div>
                                <p>Dj sets d'ouverture avec artistes émergents de la scène locale</p>
                            </li>
                            
                        </ul>
                    </div>
                    
                    <!-- Section Lieu -->
                    <div style="margin-top: 2rem;">
                        <h3 style="margin-bottom: 1rem; font-size: 1.3rem; font-weight: 600;"> Lieu</h3>
                        <ul class="event-info-list">
                            <li class="event-info-item">
                                <div class="event-info-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-301q99-80 149.5-154T680-594q0-90-56-148t-144-58q-88 0-144 58t-56 148q0 65 50.5 139T480-301Zm0 101Q339-304 269.5-402T200-594q0-125 78-205.5T480-880q124 0 202 80.5T760-594q0 94-69.5 192T480-200Zm0-320q33 0 56.5-23.5T560-600q0-33-23.5-56.5T480-680q-33 0-56.5 23.5T400-600q0 33 23.5 56.5T480-520ZM200-80v-80h560v80H200Zm280-520Z"/></svg>

                                </div>
                                <div class="event-info-content">
                                    <div class="event-info-label">Adresse</div>
                                    <div class="event-info-value">
                                    <?=json_decode($event['localisation'],true)['venue']. ' '.json_decode($event['localisation'],true)['address'].' '.json_decode($event['localisation'],true)['postal_code'] .' '.json_decode($event['localisation'],true)['city'] ?>    
                                    </div>
                                </div>
                            </li>
                            
                        </ul>
                    </div>
                    
                    <!-- Section Billetterie -->
                    <div style="margin-top: 2rem;">
                        <h3 style="margin-bottom: 1rem; font-size: 1.3rem; font-weight: 600;">🎟️ Billets disponibles</h3>
                        <ul class="ticket-list">
                            <li class="ticket-item">
                                <div class="ticket-header">
                                    <div class="ticket-name">Billet Standard</div>
                                    <div class="ticket-price"><?=json_decode($event['tarif'],true)['price']?> Ariary</div>
                                </div>
                                <div class="ticket-description">Réduction de 15% pour l'achat de plus de 2 billets</div>
                                <?php if(session()->get('is_organizer')!=true){?>
                                
                                <div style='display:flex;flex-direction:row;justify-content:space-between'>
                                    <div class="ticket-availability">Disponible : 245 / 500</div>
                                    <div>
                                        <label for="">Nombre</label>
                                        <input type='number' min=1 max=10 width=20px></input>
                                        <button class='btn btn-success btn-register'>Valider</button>
                                    </div>
                                </div>
                                <?php }?>
                            </li>
                            
                        </ul>
                        
                        <div class="event-info-list">
                            <div class="event-info-item">
                                <div class="event-info-icon">💳</div>
                                <div class="event-info-content">
                                    <div class="event-info-label">Modes de paiement acceptés</div>
                                    <div class="event-info-value">Carte bancaire, PayPal</div>
                                </div>
                            </div>
                            <div class="event-info-item">
                                <div class="event-info-icon">📅</div>
                                <div class="event-info-content">
                                    <div class="event-info-label">Fin des inscriptions</div>
                                    <div class="event-info-value">23 juin 2023 à 23:59</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="event-sidebar">
                <div class="card">
                    <div class="event-time-countdown">
                        <div>L'événement commence dans</div>
                        <?php
                            $j_h_m = getTimeDifference($event['date_event'] );
                        
                        ?>
                        <div class="countdown-container">
                            <div class="countdown-item">
                                <div class="countdown-value"><?=$j_h_m[0]?></div>
                                <div class="countdown-label">jours</div>
                            </div>
                            <div class="countdown-item">
                                <div class="countdown-value"><?=$j_h_m[1]?></div>
                                <div class="countdown-label">heures</div>
                            </div>
                            <div class="countdown-item">
                                <div class="countdown-value"><?=$j_h_m[2]?></div>
                                <div class="countdown-label">min</div>
                            </div>
                        </div>
                    </div>
                    <?php if(session()->get('is_organizer')!=true){?>
                    
                    <a href="#" class="btn btn-success btn-register">
                        <span class="icon">🎟️</span> S'inscrire maintenant
                    </a>
                    <?php }?>

                </div>
                
                <div class="card">
                    <h3 class="card-title">
                        <span class="icon">📍</span> Lieu
                    </h3>
                    <ul class="event-info-list">
                        <li class="event-info-item">
                            <div class="event-info-icon">🏢</div>
                            <div class="event-info-content">
                                <div class="event-info-value">
                                <?=json_decode($event['localisation'],true)['venue']?>
                                </div>
                            </div>
                        </li>
                        <li class="event-info-item">
                            <div class="event-info-icon">📍</div>
                            <div class="event-info-content">
                                <div class="event-info-value"><?=json_decode($event['localisation'],true)['address'].' '.json_decode($event['localisation'],true)['postal_code'] .' '.json_decode($event['localisation'],true)['city'] ?></div>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div class="card">
                    <h3 class="card-title">
                        <span class="icon">📅</span> Date et heure
                    </h3>
                    <ul class="event-info-list">
                        <li class="event-info-item">
                            <div class="event-info-icon">📆</div>
                            <div class="event-info-content">
                                <div class="event-info-value"><?=traduireDateFrancais($event['date_event'])?></div>
                            </div>
                        </li>
                        <li class="event-info-item">
                            <div class="event-info-icon">🕒</div>
                            <div class="event-info-content">
                                <div class="event-info-value"><?=json_decode($event['heure'],true)['start_time'].' - '.json_decode($event['heure'],true)['end_time']?></div>
                            </div>
                        </li>

                        
                    </ul>
                </div>
                
               
                
            </div>
        </div>

        
    </div>
    <script>
    function confirmDelete() {
        return confirm("Es-tu sûr de vouloir supprimer cet évènement ?");
    }
</script>
    
</body>
</html>