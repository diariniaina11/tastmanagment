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
    <title>EventApp - Gestion d'événements</title>

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="<?= base_url('assets/bootstrap/css/bootstrap.min.css')?>">
    <script src="<?= base_url('assets/bootstrap/js/jquery-3.5.1.slim.min.js')?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/popper.min.js')?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>

    <link rel="stylesheet"  href="<?= base_url('css/accueil.css')?>">
</head>
<body>
<nav class="navbar">
    <div class="navbar-left">
      <a href="#" class="navbar-link"><h3 style="background-color:white;border:solid ;border-radius:25px;padding:19px;padding-right:0"><i class='logo'>Event</i><b class="logo" style="color:white;background-color:black;border-radius:20px;padding:20px;">Place</b></h3></a>
      
    </div>
    
    
    <div id="userEtcreationPub">

        <a href="<?= base_url('/profile/diary')?>" class="avatar-icon">
            <i class="fas fa-user"></i>
        </a>

    </div>
  
  </nav>

    <!-- En-tête -->
    <header class="text-center">
        <div class="header-content">
            <div class="logo">
            <ul class="sub-navbar">
                <li class="sub-navbar-item cursor">Tous</li>

                <li class="sub-navbar-item dropdown">
                    Filtrer
                    <ul class="dropdown-content">
                        <li>Par date</li>
                        <li>Par catégorie</li>
                        <li>Par popularité</li>
                    </ul>
                </li>
            </ul>

            </div>
            <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="Rechercher un événement...">
                <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            
        </div>
    </header>

    <!-- Contenu principal -->
    <main>
        <h2 class="page-title">Événements à venir</h2>
        
        <!-- Grille d'événements -->
        <?php foreach ($events as $key => $event) {?>
            
        

        <div class="events-grid" id="eventsContainer">
        
            <div class="event-card" data-id="6">
                <img src="assets/img/accueil/Conférence Tech.webp" alt="Conférence Tech" class="event-image">
                <div class="event-content">
                    <h3 class="event-title"><?=json_decode($event['info'],true)['title']?></h3>
            
                    <div class="event-details visible" id="details-6">
                        <div class="detail-item">
                            <svg class="detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                            
                            <span><?=traduireDateFrancais($event['date_event']). ' '?></span>
                        </div>
                        <div class="detail-item">
                            <svg class="detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            <span><?=json_decode($event['localisation'],true)['venue']. ' '.json_decode($event['localisation'],true)['city'] ?></span>
                        </div>
                        <div class="detail-item">
                            <svg class="detail-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                            <span><?=json_decode($event['heure'],true)['start_time'].' - '.json_decode($event['heure'],true)['end_time']?></span>
                        </div>
                    </div>
                    
                    <div class="event-actions">
                        <button class="btn btn-primary">
                            Participer
                        </button>
                        <a href="<?=base_url('/event-ending-creation')?>">
                            <button class="btn btn-warning">
                                Voir Détails
                            </button>
                        </a>
                    </div>
                </div>
            </div>

        </div>
        <?php
    }
    ?>

        
    </main>
     <script>

// exemple d'event

     </script>
    <script src="<?= base_url('js/accueil.js')?>"></script>
    <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js')?>" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>