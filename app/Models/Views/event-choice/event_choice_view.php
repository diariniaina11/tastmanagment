<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Navbar Exemple</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome pour les icônes -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8f9fa;
      padding: 20px;
    }
    
    /* Styles de la navbar */
    .navbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #fff;
      padding: 20px 40px;
      border-bottom: 1px solid #eaeaea;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .navbar-left {
      display: flex;
      gap: 40px;
      align-items: center;
    }
    .navbar-link {
      color: #222;
      text-decoration: none;
      font-weight: 500;
      position: relative;
      padding: 5px 0;
      transition: color 0.2s ease;
    }
    .navbar-link:hover {
      color: #0047ff;
    }
    .navbar-link::after {
      content: "▼";
      font-size: 10px;
      margin-left: 5px;
      vertical-align: middle;
    }
    .navbar-link:not([data-dropdown])::after {
      content: "";
    }
    .navbar-right {
      display: flex;
      gap: 15px;
      align-items: center;
    }
    .btn-blue {
      background: #0047ff;
      color: #fff;
      border: none;
      border-radius: 12px;
      padding: 12px 32px;
      font-size: 16px;
      cursor: pointer;
      font-weight: 500;
      transition: background 0.2s;
    }
    .btn-blue:hover {
      background: #0033cc;
    }
    .btn-outline {
      background: #fff;
      color: #222;
      border: 2px solid #eaeaea;
      border-radius: 12px;
      padding: 12px 32px;
      font-size: 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 7px;
      transition: border 0.2s;
    }
    .btn-outline:hover {
      border: 2px solid #0047ff;
    }
    .icon-user {
      width: 16px;
      height: 16px;
      display: inline-block;
      background: url('data:image/svg+xml;utf8,<svg fill="black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><circle cx="8" cy="6" r="3"/><path d="M2 14c0-2.2 3.6-3.5 6-3.5s6 1.3 6 3.5v1H2v-1z"/></svg>') no-repeat center center;
      background-size: contain;
    }
    
    /* Styles des cartes d'événements - CORRIGÉS */
    .card {
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 6px 10px rgba(0,0,0,0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      margin-bottom: 30px;
      border: none;
      height: 100%;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 20px rgba(0,0,0,0.12);
    }
    
    .card-header {
      padding: 20px;
      border-bottom: none;
      text-align: center;
    }
    
    .card-icon {
      font-size: 2.5rem;
      margin-bottom: 15px;
    }
    
    .card-body {
      padding: 0;
    }
    
    .event-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }
    
    .event-item {
      padding: 12px 20px;
      border-top: 1px solid rgba(0,0,0,0.05);
      display: block;
      text-decoration: none;
      color: #495057;
      transition: all 0.2s ease;
    }
    
    .event-item:hover {
      background-color: rgba(0,123,255,0.05);
      color: #0047ff;
      padding-left: 25px;
    }
    
    .event-item i {
      margin-right: 10px;
      font-size: 0.9rem;
      width: 20px;
      text-align: center;
      color: #6c757d;
    }
    
    .event-item:hover i {
      color: #0047ff;
    }
    
    .card-header h3 {
      font-weight: 600;
      margin-bottom: 0;
      font-size: 1.3rem;
    }
    
    /* Couleurs des cartes avec meilleur contraste */
    .social-cultural { 
      background-color: #e94989; 
      color: white; 
    }
    
    .educational { 
      background-color: #00b8c4; 
      color: white; 
    }
    
    .sports { 
      background-color: #e6b800; 
      color: #333; 
    }
    
    .tech { 
      background-color: #0097b2; 
      color: white; 
    }
    
    .commercial { 
      background-color: #f7c948; 
      color: #333; 
    }
    
    .religious { 
      background-color: #9d6eff; 
      color: white; 
    }
    
    .title-container {
      text-align: center;
      margin-bottom: 40px;
    }
    
    .title-container h1 {
      font-weight: 700;
      color: #343a40;
      margin-bottom: 15px;
    }
    
    .title-container p {
      color: #6c757d;
      font-size: 1.2rem;
      max-width: 800px;
      margin: 0 auto;
    }
    
    /* Logo style */
    .logo-container {
      background-color: white;
      border: solid 1px #e5e5e5;
      border-radius: 25px;
      padding: 12px;
      padding-right: 0;
      display: inline-flex;
      align-items: center;
      text-decoration: none;
    }
    
    .logo {
      font-style: normal;
      margin-right: 5px;
    }
    
    .logo-accent {
      color: white;
      background-color: black;
      border-radius: 20px;
      padding: 12px 18px;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <nav class="navbar">
    <div class="navbar-left">
      <a href="#" class="navbar-link">
        <div class="logo-container">
          <span class="logo">Event</span>
          <span class="logo-accent">Place</span>
        </div>
      </a>
      <a href="#" class="navbar-link">Évènements</a>
      <a href="#" class="navbar-link">Mes évènements</a>
      <a href="#" class="navbar-link">Tarifs</a>
      <a href="#" class="navbar-link">Entreprise</a>
      <a href="#" class="navbar-link" data-dropdown>Ressources</a>
    </div>
  </nav>

  <div class="container">
    <div class="title-container">
      <h1>Événements par Catégorie</h1>
      <p>Explorez notre sélection d'événements classés par thématique pour trouver l'inspiration</p>
    </div>
    
    <div class="row g-4">
      <!-- Événements sociaux et culturels -->
      <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-header social-cultural">
            <div class="card-icon">
              <i class="fas fa-glass-cheers"></i>
            </div>
            <h3>Événements sociaux et culturels</h3>
          </div>
          <div class="card-body">
            <ul class="event-list">
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-ring"></i> Mariage</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-birthday-cake"></i> Anniversaire</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-music"></i> Concert de musique</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-theater-masks"></i> Festival culturel</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-hand-holding-heart"></i> Soirée caritative</a>
            </ul>
          </div>
        </div>
      </div>
      
      <!-- Événements éducatifs et professionnels -->
      <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-header educational">
            <div class="card-icon">
              <i class="fas fa-graduation-cap"></i>
            </div>
            <h3>Événements éducatifs et professionnels</h3>
          </div>
          <div class="card-body">
            <ul class="event-list">
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-microphone"></i> Conférence</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-chalkboard-teacher"></i> Séminaire</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-hands-helping"></i> Atelier de formation</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-laptop"></i> Webinaire</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-briefcase"></i> Salon professionnel</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-university"></i> Journée d'orientation</a>
            </ul>
          </div>
        </div>
      </div>
      
      <!-- Événements sportifs -->
      <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-header sports">
            <div class="card-icon">
              <i class="fas fa-trophy"></i>
            </div>
            <h3>Événements sportifs</h3>
          </div>
          <div class="card-body">
            <ul class="event-list">
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-futbol"></i> Match de football</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-running"></i> Course marathon</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-gamepad"></i> Tournoi e-sport</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-drum"></i> Compétition de danse</a>
            </ul>
          </div>
        </div>
      </div>
      
      <!-- Événements tech / numériques -->
      <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-header tech">
            <div class="card-icon">
              <i class="fas fa-laptop-code"></i>
            </div>
            <h3>Événements tech / numériques</h3>
          </div>
          <div class="card-body">
            <ul class="event-list">
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-code"></i> Hackathon</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-rocket"></i> Lancement de produit</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-users"></i> Meetup de développeurs</a>
            </ul>
          </div>
        </div>
      </div>
      
      <!-- Événements commerciaux -->
      <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-header commercial">
            <div class="card-icon">
              <i class="fas fa-store"></i>
            </div>
            <h3>Événements commerciaux</h3>
          </div>
          <div class="card-body">
            <ul class="event-list">
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-shopping-bag"></i> Foire / expo-vente</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-tag"></i> Vente privée</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-bullhorn"></i> Lancement de marque</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-door-open"></i> Portes ouvertes</a>
            </ul>
          </div>
        </div>
      </div>
      
      <!-- Événements religieux ou spirituels -->
      <div class="col-lg-4 col-md-6">
        <div class="card h-100">
          <div class="card-header religious">
            <div class="card-icon">
              <i class="fas fa-pray"></i>
            </div>
            <h3>Événements religieux ou spirituels</h3>
          </div>
          <div class="card-body">
            <ul class="event-list">
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-church"></i> Messe ou prière collective</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-walking"></i> Pèlerinage</a>
              <a href="<?= base_url('event-creation')?>" class="event-item"><i class="fas fa-star-and-crescent"></i> Célébration religieuse</a>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JS -->
  <script src="<?= base_url('assets/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
</body>
</html>