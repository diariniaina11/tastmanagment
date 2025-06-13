<?php
  $userData['nom']." ".$userData['prenom'];
  function acronyme($chaine) {
    // Séparer la chaîne en mots
    $mots = explode(' ', $chaine);
    $acronyme = '';
    // Parcourir chaque mot et prendre la première lettre
    foreach ($mots as $mot) {
        if (!empty($mot)) {
            $acronyme .= strtoupper($mot[0]);
        }
    }
    return $acronyme;
}
function formatDateForDisplay($dateString) {
  $date = new DateTime($dateString);

  $formatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::LONG, IntlDateFormatter::NONE, null, null, 'MMMM yyyy');
  $formattedDate = $formatter->format($date);

  $formattedDate = ucfirst($formattedDate);

  return $formattedDate;
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profil Utilisateur - Sarah Martin</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      padding: 20px;
    }

    .profile-container {
      max-width: 900px;
      margin: 0 auto;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(10px);
      border-radius: 24px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      animation: slideIn 0.8s ease-out;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .profile-header {
      background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      padding: 40px 30px;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .profile-header::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
      animation: float 20s linear infinite;
    }

    @keyframes float {
      0% {
        transform: translateX(0) translateY(0);
      }
      100% {
        transform: translateX(-60px) translateY(-60px);
      }
    }

    .profile-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      margin: 0 auto 20px;
      border: 4px solid rgba(255, 255, 255, 0.8);
      background: linear-gradient(45deg, #ff6b6b, #ffa726);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 48px;
      color: white;
      font-weight: bold;
      position: relative;
      z-index: 1;
      transition: transform 0.3s ease;
    }

    .profile-avatar:hover {
      transform: scale(1.05);
    }

    .profile-name {
      font-size: 28px;
      font-weight: 700;
      color: white;
      margin-bottom: 8px;
      position: relative;
      z-index: 1;
    }

    .profile-title {
      font-size: 16px;
      color: rgba(255, 255, 255, 0.9);
      margin-bottom: 20px;
      position: relative;
      z-index: 1;
    }

    .profile-stats {
      display: flex;
      justify-content: center;
      gap: 30px;
      position: relative;
      z-index: 1;
    }

    .stat-item {
      text-align: center;
      color: white;
    }

    .stat-number {
      font-size: 24px;
      font-weight: 700;
      display: block;
    }

    .stat-label {
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 1px;
      opacity: 0.8;
    }

    .profile-content {
      padding: 40px 30px;
    }

    .info-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 30px;
      margin-bottom: 40px;
    }

    .info-section {
      background: #f8f9ff;
      padding: 25px;
      border-radius: 16px;
      border: 1px solid rgba(116, 75, 162, 0.1);
      transition: transform 0.3s ease;
    }

    .info-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 30px rgba(116, 75, 162, 0.15);
    }

    .info-title {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .info-title::before {
      content: '';
      width: 4px;
      height: 20px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      border-radius: 2px;
    }

    .info-item {
      display: flex;
      justify-content: space-between;
      padding: 12px 0;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .info-item:last-child {
      border-bottom: none;
    }

    .info-label {
      font-weight: 500;
      color: #666;
    }

    .info-value {
      color: #333;
      font-weight: 500;
    }

    @media (max-width: 768px) {
      .profile-container {
        margin: 10px;
        border-radius: 16px;
      }

      .profile-header {
        padding: 30px 20px;
      }

      .profile-content {
        padding: 30px 20px;
      }

      .profile-stats {
        gap: 20px;
      }

      .info-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }
    }
    #arrow-button{
      z-index: 10;
      cursor: pointer;
      padding: 6px;
      border-radius: 7px;
      height: 59px;
      transition: 0.3s;
      background: rgba(255,255,255,0.2);


    }
    #arrow-button:hover{
      background: rgba(255, 255, 255, 0.55);
      transition: 0.3s;


    }
  </style>
</head>
<body>
  <div class="profile-container">
    <header class="profile-header">
      <div style="display:flex; flex-direction:row; justify-content:flex-start;">
        <a href="<?=base_url('/organizer_dashboard_page')?>" id="arrow-button">
          <svg xmlns="http://www.w3.org/2000/svg" height="48px" viewBox="0 -960 960 960" width="48px" fill="#000000"><path d="m481.43-325.39 47.74-47.98-72.56-72.56H635.5v-68.14H456.61l72.56-72.56-47.74-47.98L326.83-480l154.6 154.61Zm-1.4 251.37q-83.46 0-157.54-31.88-74.07-31.88-129.39-87.2-55.32-55.32-87.2-129.36-31.88-74.04-31.88-157.51 0-84.46 31.88-158.54 31.88-74.07 87.16-128.9 55.28-54.84 129.34-86.82 74.06-31.99 157.55-31.99 84.48 0 158.59 31.97 74.1 31.97 128.91 86.77 54.82 54.8 86.79 128.88 31.98 74.08 31.98 158.6 0 83.5-31.99 157.57-31.98 74.07-86.82 129.36-54.83 55.29-128.87 87.17-74.04 31.88-158.51 31.88Zm-.03-68.13q141.04 0 239.45-98.75 98.4-98.76 98.4-239.1 0-141.04-98.4-239.45-98.41-98.4-239.57-98.4-140.16 0-238.95 98.4-98.78 98.41-98.78 239.57 0 140.16 98.75 238.95 98.76 98.78 239.1 98.78ZM480-480Z"/></svg>
        </a>
      </div>
      <div class="profile-avatar"><?php echo acronyme($userData['prenom'])?></div>
      <h1 class="profile-name"><?php echo $userData['nom']." ".$userData['prenom'] ?></h1>
      <p class="profile-title">Développeur Frontend & Designer UI/UX</p>
      <div class="profile-stats">
        <div class="stat-item">
          <span class="stat-number">127</span>
          <span class="stat-label">Projets</span>
        </div>
        <div class="stat-item">
          <span class="stat-number">2.4k</span>
          <span class="stat-label">Followers</span>
        </div>
        <div class="stat-item">
          <span class="stat-number">89</span>
          <span class="stat-label">Reviews</span>
        </div>
      </div>
    </header>

    <main class="profile-content">
      <div class="info-grid">
        <section class="info-section">
          <h2 class="info-title">Informations Personnelles</h2>
          <div class="info-item">
            <span class="info-label">Email</span>
            <span class="info-value"><?php echo $userData['email']?></span>
          </div>
          <div class="info-item">
            <span class="info-label">Téléphone</span>
            <span class="info-value"><?php echo $userData['tel']?></span>
          </div>
          <div class="info-item">
            <span class="info-label">Localisation</span>
            <span class="info-value">NULL</span>
          </div>
          <div class="info-item">
            <span class="info-label">Membre depuis</span>
            <span class="info-value"><?php echo formatDateForDisplay($userData['created_at'])?></span>
          </div>
        </section>
      </div>
    </main>
  </div>

  <!-- pub -->
   

</body>
</html>
