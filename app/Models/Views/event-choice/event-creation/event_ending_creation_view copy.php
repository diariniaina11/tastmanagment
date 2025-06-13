<?php
$session = session();
var_dump($session->get("events"));
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
        }
        
        .header-actions {
            display: flex;
            gap: 0.5rem;
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
                <a href="/organizer_dashboard_page">
                    <button class="btn btn-secondary hover-orange pl-10">
                        <span class="icon">⬅️</span> Retour
                    </button>
                </a>
                <button class="btn btn-primary">
                    <span class="icon">✏️</span> Modifier
                </button>
            </div>
        </div>
        
        <img src="https://via.placeholder.com/800x250" alt="Image de couverture de l'événement" class="event-image">
        
        <div class="event-container">
            <div class="event-main">
                <div class="card">
                    <h1>Festival de Musique Électronique</h1>
                    <div class="event-meta">
                        <span class="meta-item">
                            <span class="icon">📅</span> Samedi 24 juin 2023
                        </span>
                        <span class="meta-item">
                            <span class="icon">🕒</span> 14:00 - 23:30
                        </span>
                        <span class="meta-item">
                            <span class="icon">📍</span> Parc des Expositions, Paris
                        </span>
                        <span class="status-badge">
                            <span class="icon">✓</span> Ouvert aux inscriptions
                        </span>
                    </div>
                    
                    <div class="price-info">
                        <span class="price-from">À partir de</span>
                        <span class="price-value">29,99 €</span>
                    </div>
                    
                    <!-- Onglet Détails (affiché par défaut sans JS) -->
                    <div>
                        <h3 style="margin: 2rem 0 1rem 0; font-size: 1.3rem; font-weight: 600;">📋 Détails</h3>
                        <div class="event-description">
                            <p>Un grand festival de musique électronique avec les meilleurs artistes de la scène internationale. Venez vivre une expérience unique dans un lieu exceptionnel avec une programmation de qualité et des installations sonores et visuelles de dernière génération.</p>
                            <p>Au programme : sets électro, techno, house, trance, et bien plus encore, répartis sur 3 scènes distinctes. Une expérience immersive avec des jeux de lumières spectaculaires et des performances visuelles époustouflantes.</p>
                            <br>
                            <p>Le festival propose également :</p>
                            <ul style="margin-left: 1.5rem; margin-top: 0.5rem;">
                                <li>Un espace restauration avec food trucks variés</li>
                                <li>Des bars et espaces lounge pour se détendre</li>
                                <li>Des animations et activités interactives</li>
                                <li>Un village d'artisans et de créateurs</li>
                            </ul>
                        </div>
                        
                        <div class="tag-list">
                            <span class="badge badge-primary">Festival</span>
                            <span class="badge badge-primary">Musique Électronique</span>
                            <span class="badge badge-primary">DJ Sets</span>
                            <span class="badge badge-primary">Concert</span>
                        </div>
                        
                        <div class="organizer-info">
                            <div class="organizer-avatar"></div>
                            <div>
                                <div class="organizer-name">Electro Events Productions</div>
                                <div class="organizer-contact">contact@electroevents.fr</div>
                            </div>
                        </div>
                        
                        <div class="share-buttons">
                            <a href="#" class="share-button">📱</a>
                            <a href="#" class="share-button">📧</a>
                            <a href="#" class="share-button">🔗</a>
                            <a href="#" class="share-button">📄</a>
                        </div>
                    </div>
                    
                    <!-- Section Programme -->
                    <div style="margin-top: 2rem;">
                        <h3 style="margin-bottom: 1rem; font-size: 1.3rem; font-weight: 600;">🎵 Programme du festival</h3>
                        <ul class="session-list">
                            <li class="session-item">
                                <div class="session-name">Session d'ouverture - Scène principale</div>
                                <div class="session-time">
                                    <span class="icon">🕒</span> 14:00 - 16:00
                                </div>
                                <p>Dj sets d'ouverture avec artistes émergents de la scène locale</p>
                            </li>
                            <li class="session-item">
                                <div class="session-name">Set spécial Deep House - Scène Oasis</div>
                                <div class="session-time">
                                    <span class="icon">🕒</span> 16:00 - 18:30
                                </div>
                                <p>Ambiance deep house et progressive par les meilleurs artistes du genre</p>
                            </li>
                            <li class="session-item">
                                <div class="session-name">Performances Live - Scène Expérimentale</div>
                                <div class="session-time">
                                    <span class="icon">🕒</span> 17:00 - 19:00
                                </div>
                                <p>Live performances avec instruments électroniques et visualisations</p>
                            </li>
                            <li class="session-item">
                                <div class="session-name">DJ Sets Internationaux - Scène principale</div>
                                <div class="session-time">
                                    <span class="icon">🕒</span> 19:00 - 23:30
                                </div>
                                <p>Têtes d'affiche internationales pour clôturer l'événement en beauté</p>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Section Lieu -->
                    <div style="margin-top: 2rem;">
                        <h3 style="margin-bottom: 1rem; font-size: 1.3rem; font-weight: 600;">📍 Lieu</h3>
                        <ul class="event-info-list">
                            <li class="event-info-item">
                                <div class="event-info-icon">📍</div>
                                <div class="event-info-content">
                                    <div class="event-info-label">Adresse</div>
                                    <div class="event-info-value">Parc des Expositions, 1 Avenue de la Porte de Versailles, 75015 Paris, France</div>
                                </div>
                            </li>
                            <li class="event-info-item">
                                <div class="event-info-icon">🚇</div>
                                <div class="event-info-content">
                                    <div class="event-info-label">Transports</div>
                                    <div class="event-info-value">
                                        <p>Metro : Ligne 12 (Station Porte de Versailles)</p>
                                        <p>Tramway : T2, T3a (Arrêt Porte de Versailles)</p>
                                        <p>Bus : Lignes 39, 80 (Arrêt Porte de Versailles)</p>
                                    </div>
                                </div>
                            </li>
                            <li class="event-info-item">
                                <div class="event-info-icon">🅿️</div>
                                <div class="event-info-content">
                                    <div class="event-info-label">Parking</div>
                                    <div class="event-info-value">Parking payant disponible sur place (1 500 places)</div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Section Billetterie -->
                    <div style="margin-top: 2rem;">
                        <h3 style="margin-bottom: 1rem; font-size: 1.3rem; font-weight: 600;">🎟️ Types de billets disponibles</h3>
                        <ul class="ticket-list">
                            <li class="ticket-item">
                                <div class="ticket-header">
                                    <div class="ticket-name">Billet Standard</div>
                                    <div class="ticket-price">29,99 €</div>
                                </div>
                                <div class="ticket-description">Accès à toutes les scènes du festival</div>
                                <div class="ticket-availability">Disponible : 245 / 500</div>
                            </li>
                            <li class="ticket-item">
                                <div class="ticket-header">
                                    <div class="ticket-name">Billet VIP</div>
                                    <div class="ticket-price">69,99 €</div>
                                </div>
                                <div class="ticket-description">Accès VIP avec espace lounge privé, boissons incluses et accès prioritaire</div>
                                <div class="ticket-availability">Disponible : 45 / 100</div>
                            </li>
                            <li class="ticket-item">
                                <div class="ticket-header">
                                    <div class="ticket-name">Pass 2 personnes</div>
                                    <div class="ticket-price">49,99 €</div>
                                </div>
                                <div class="ticket-description">Entrée pour 2 personnes à prix réduit</div>
                                <div class="ticket-availability">Disponible : 78 / 150</div>
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
                        <div class="countdown-container">
                            <div class="countdown-item">
                                <div class="countdown-value">38</div>
                                <div class="countdown-label">jours</div>
                            </div>
                            <div class="countdown-item">
                                <div class="countdown-value">15</div>
                                <div class="countdown-label">heures</div>
                            </div>
                            <div class="countdown-item">
                                <div class="countdown-value">42</div>
                                <div class="countdown-label">min</div>
                            </div>
                        </div>
                    </div>
                    
                    <a href="#" class="btn btn-success btn-register">
                        <span class="icon">🎟️</span> S'inscrire maintenant
                    </a>
                </div>
                
                <div class="card">
                    <h3 class="card-title">
                        <span class="icon">📍</span> Lieu
                    </h3>
                    <ul class="event-info-list">
                        <li class="event-info-item">
                            <div class="event-info-icon">🏢</div>
                            <div class="event-info-content">
                                <div class="event-info-value">Parc des Expositions</div>
                            </div>
                        </li>
                        <li class="event-info-item">
                            <div class="event-info-icon">📍</div>
                            <div class="event-info-content">
                                <div class="event-info-value">1 Avenue de la Porte de Versailles, 75015 Paris, France</div>
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
                                <div class="event-info-value">Samedi 24 juin 2023</div>
                            </div>
                        </li>
                        <li class="event-info-item">
                            <div class="event-info-icon">🕒</div>
                            <div class="event-info-content">
                                <div class="event-info-value">14:00 - 23:30</div>
                            </div>
                        </li>
                        <li class="event-info-item">
                            <div class="event-info-icon">🌐</div>
                            <div class="event-info-content">
                                <div class="event-info-value">Europe/Paris (UTC+01:00)</div>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <div class="card">
                    <h3 class="card-title">
                        <span class="icon">ℹ️</span> Informations
                    </h3>
                    <ul class="event-info-list">
                        <li class="event-info-item">
                            <div class="event-info-icon">👥</div>
                            <div class="event-info-content">
                                <div class="event-info-label">Organisateur</div>
                                <div class="event-info-value">Electro Events Productions</div>
                            </div>
                        </li>
                        <li class="event-info-item">
                            <div class="event-info-icon">🏷️</div>
                            <div class="event-info-content">
                                <div class="event-info-label">Catégorie</div>
                                <div class="event-info-value">Festival</div>
                            </div>
                        </li>
                        <li class="event-info-item">
                            <div class="event-info-icon">👤</div>
                            <div class="event-info-content">
                                <div class="event-info-label">Capacité</div>
                                <div class="event-info-value">750 participants</div>
                            </div>
                        </li>
                        <li class="event-info-item">
                            <div class="event-info-icon">📊</div>
                            <div class="event-info-content">
                                <div class="event-info-label">Inscrits</div>
                                <div class="event-info-value">368 / 750</div>
                            </div>
                        </li>
                        <li class="event-info-item">
                            <div class="event-info-icon">🎯</div>
                            <div class="event-info-content">
                                <div class="event-info-label">Âge minimum</div>
                                <div class="event-info-value">18 ans</div>
                            </div>
                        </li>
                        <li class="event-info-item">
                            <div class="event-info-icon">📞</div>
                            <div class="event-info-content">
                                <div class="event-info-label">Contact</div>
                                <div class="event-info-value">+33 1 23 45 67 89</div>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="card">
                    <h3 class="card-title">
                        <span class="icon">⚠️</span> Informations importantes
                    </h3>
                    <div style="font-size: 0.9rem; line-height: 1.6;">
                        <p style="margin-bottom: 1rem;"><strong>Conditions d'accès :</strong></p>
                        <ul style="margin-left: 1.2rem; margin-bottom: 1rem;">
                            <li>Pièce d'identité obligatoire</li>
                            <li>Contrôle de sécurité à l'entrée</li>
                            <li>Interdiction d'apporter nourriture et boissons</li>
                            <li>Tenue correcte exigée</li>
                        </ul>
                        
                        <p style="margin-bottom: 1rem;"><strong>Services sur place :</strong></p>
                        <ul style="margin-left: 1.2rem; margin-bottom: 1rem;">
                            <li>Vestiaire payant disponible</li>
                            <li>Point d'eau gratuit</li>
                            <li>Service de premiers secours</li>
                            <li>Espaces de repos</li>
                        </ul>

                        <p style="margin-bottom: 0.5rem;"><strong>Annulation :</strong></p>
                        <p style="font-size: 0.8rem; color: var(--text-muted);">
                            Remboursement possible jusqu'à 48h avant l'événement (frais de service non remboursables)
                        </p>
                    </div>
                </div>

                <div class="card">
                    <h3 class="card-title">
                        <span class="icon">🌦️</span> Météo prévue
                    </h3>
                    <div style="text-align: center; padding: 1rem 0;">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">☀️</div>
                        <div style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Ensoleillé</div>
                        <div style="color: var(--text-muted);">
                            <div>Max: 28°C | Min: 18°C</div>
                            <div>Précipitations: 10%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Commentaires et Avis -->
        <div class="card" style="margin-top: 2rem;">
            <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">💬 Avis et commentaires</h3>
            
            <div style="display: flex; align-items: center; margin-bottom: 1.5rem; padding: 1rem; background-color: #f8f9fa; border-radius: 8px;">
                <div style="margin-right: 2rem;">
                    <div style="font-size: 2rem; font-weight: 600; color: var(--primary-color);">4.7</div>
                    <div style="color: #ffc107; font-size: 1.2rem;">★★★★★</div>
                    <div style="font-size: 0.9rem; color: var(--text-muted);">42 avis</div>
                </div>
                <div style="flex: 1;">
                    <div style="display: flex; align-items: center; margin-bottom: 0.3rem;">
                        <span style="width: 60px; font-size: 0.9rem;">5 ★</span>
                        <div style="flex: 1; background-color: #e9ecef; height: 8px; border-radius: 4px; margin-right: 1rem;">
                            <div style="width: 78%; height: 100%; background-color: #ffc107; border-radius: 4px;"></div>
                        </div>
                        <span style="font-size: 0.9rem; color: var(--text-muted);">33</span>
                    </div>
                    <div style="display: flex; align-items: center; margin-bottom: 0.3rem;">
                        <span style="width: 60px; font-size: 0.9rem;">4 ★</span>
                        <div style="flex: 1; background-color: #e9ecef; height: 8px; border-radius: 4px; margin-right: 1rem;">
                            <div style="width: 15%; height: 100%; background-color: #ffc107; border-radius: 4px;"></div>
                        </div>
                        <span style="font-size: 0.9rem; color: var(--text-muted);">6</span>
                    </div>
                    <div style="display: flex; align-items: center; margin-bottom: 0.3rem;">
                        <span style="width: 60px; font-size: 0.9rem;">3 ★</span>
                        <div style="flex: 1; background-color: #e9ecef; height: 8px; border-radius: 4px; margin-right: 1rem;">
                            <div style="width: 5%; height: 100%; background-color: #ffc107; border-radius: 4px;"></div>
                        </div>
                        <span style="font-size: 0.9rem; color: var(--text-muted);">2</span>
                    </div>
                    <div style="display: flex; align-items: center; margin-bottom: 0.3rem;">
                        <span style="width: 60px; font-size: 0.9rem;">2 ★</span>
                        <div style="flex: 1; background-color: #e9ecef; height: 8px; border-radius: 4px; margin-right: 1rem;">
                            <div style="width: 2%; height: 100%; background-color: #dc3545; border-radius: 4px;"></div>
                        </div>
                        <span style="font-size: 0.9rem; color: var(--text-muted);">1</span>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <span style="width: 60px; font-size: 0.9rem;">1 ★</span>
                        <div style="flex: 1; background-color: #e9ecef; height: 8px; border-radius: 4px; margin-right: 1rem;">
                            <div style="width: 0%; height: 100%; background-color: #dc3545; border-radius: 4px;"></div>
                        </div>
                        <span style="font-size: 0.9rem; color: var(--text-muted);">0</span>
                    </div>
                </div>
            </div>

            <!-- Commentaires -->
            <div style="space-y: 1rem;">
                <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1rem;">
                    <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                        <div style="width: 40px; height: 40px; background-color: #4a6de5; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; margin-right: 1rem;">M</div>
                        <div>
                            <div style="font-weight: 600;">Marie Dubois</div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div style="color: #ffc107;">★★★★★</div>
                                <span style="font-size: 0.9rem; color: var(--text-muted);">Il y a 2 jours</span>
                            </div>
                        </div>
                    </div>
                    <p style="color: var(--text-color); line-height: 1.6;">
                        Événement fantastique ! L'organisation était parfaite, les artistes au top et l'ambiance exceptionnelle. 
                        Je recommande vivement, j'ai hâte de participer au prochain festival !
                    </p>
                </div>

                <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1rem;">
                    <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                        <div style="width: 40px; height: 40px; background-color: #28a745; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; margin-right: 1rem;">J</div>
                        <div>
                            <div style="font-weight: 600;">Jean Martin</div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div style="color: #ffc107;">★★★★★</div>
                                <span style="font-size: 0.9rem; color: var(--text-muted);">Il y a 5 jours</span>
                            </div>
                        </div>
                    </div>
                    <p style="color: var(--text-color); line-height: 1.6;">
                        Super expérience ! Le son était excellent, les installations impressionnantes. 
                        Seul petit bémol : les files d'attente aux bars un peu longues, mais ça n'a pas gâché la soirée.
                    </p>
                </div>

                <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem; margin-bottom: 1rem;">
                    <div style="display: flex; align-items: center; margin-bottom: 0.5rem;">
                        <div style="width: 40px; height: 40px; background-color: #dc3545; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; margin-right: 1rem;">A</div>
                        <div>
                            <div style="font-weight: 600;">Alex Moreau</div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <div style="color: #ffc107;">★★★★☆</div>
                                <span style="font-size: 0.9rem; color: var(--text-muted);">Il y a 1 semaine</span>
                            </div>
                        </div>
                    </div>
                    <p style="color: var(--text-color); line-height: 1.6;">
                        Bon festival dans l'ensemble. La programmation était variée et de qualité. 
                        L'accès en transport en commun est vraiment pratique. À refaire !
                    </p>
                </div>
            </div>

            <button class="btn btn-outline" style="margin-top: 1rem;">
                Voir tous les avis
            </button>
        </div>

        <!-- Section Événements similaires -->
        <div class="card" style="margin-top: 2rem;">
            <h3 style="font-size: 1.3rem; font-weight: 600; margin-bottom: 1rem;">🎪 Événements similaires</h3>
            
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1rem;">
                <div style="border: 1px solid var(--border-color); border-radius: 8px; overflow: hidden;">
                    <div style="height: 120px; background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);"></div>
                    <div style="padding: 1rem;">
                        <h4 style="font-weight: 600; margin-bottom: 0.5rem;">Summer Tech Festival</h4>
                        <div style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                            <span>📅 15 juillet 2023</span> • <span>📍 Stade de France</span>
                        </div>
                        <div style="color: var(--primary-color); font-weight: 600;">À partir de 35€</div>
                    </div>
                </div>

                <div style="border: 1px solid var(--border-color); border-radius: 8px; overflow: hidden;">
                    <div style="height: 120px; background: linear-gradient(45deg, #f093fb 0%, #f5576c 100%);"></div>
                    <div style="padding: 1rem;">
                        <h4 style="font-weight: 600; margin-bottom: 0.5rem;">Nuits Électroniques</h4>
                        <div style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                            <span>📅 8 août 2023</span> • <span>📍 Bercy Arena</span>
                        </div>
                        <div style="color: var(--primary-color); font-weight: 600;">À partir de 42€</div>
                    </div>
                </div>

                <div style="border: 1px solid var(--border-color); border-radius: 8px; overflow: hidden;">
                    <div style="height: 120px; background: linear-gradient(45deg, #4facfe 0%, #00f2fe 100%);"></div>
                    <div style="padding: 1rem;">
                        <h4 style="font-weight: 600; margin-bottom: 0.5rem;">Underground Session</h4>
                        <div style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                            <span>📅 22 septembre 2023</span> • <span>📍 La Villette</span>
                        </div>
                        <div style="color: var(--primary-color); font-weight: 600;">À partir de 28€</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer style="background-color: #2c3e50; color: white; padding: 2rem 0; margin-top: 3rem;">
        <div style="max-width: 1100px; margin: 0 auto; padding: 0 2rem;">
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 2rem;">
                <div>
                    <h4 style="margin-bottom: 1rem;">MonApp</h4>
                    <p style="color: #bdc3c7; line-height: 1.6;">
                        Plateforme de gestion d'événements pour organiser et participer aux meilleurs événements près de chez vous.
                    </p>
                </div>
                <div>
                    <h4 style="margin-bottom: 1rem;">Liens utiles</h4>
                    <ul style="list-style: none;">
                        <li style="margin-bottom: 0.5rem;"><a href="#" style="color: #bdc3c7; text-decoration: none;">À propos</a></li>
                        <li style="margin-bottom: 0.5rem;"><a href="#" style="color: #bdc3c7; text-decoration: none;">Contact</a></li>
                        <li style="margin-bottom: 0.5rem;"><a href="#" style="color: #bdc3c7; text-decoration: none;">Aide</a></li>
                        <li style="margin-bottom: 0.5rem;"><a href="#" style="color: #bdc3c7; text-decoration: none;">CGU</a></li>
                    </ul>
                </div>
                <div>
                    <h4 style="margin-bottom: 1rem;">Contact</h4>
                    <div style="color: #bdc3c7;">
                        <p style="margin-bottom: 0.5rem;">📧 contact@monapp.fr</p>
                        <p style="margin-bottom: 0.5rem;">📞 +33 1 23 45 67 89</p>
                        <p>📍 123 Rue Example, 75001 Paris</p>
                    </div>
                </div>
            </div>
            <div style="text-align: center; padding-top: 2rem; border-top: 1px solid #34495e; color: #bdc3c7;">
                <p>&copy; 2023 MonApp. Tous droits réservés.</p>
            </div>
        </div>
    </footer>
</body>
</html>