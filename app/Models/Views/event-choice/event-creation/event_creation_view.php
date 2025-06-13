

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion d'Événements - Nouveau formulaire</title>
    <style>
        :root {
            --primary-color: #4a6de5;
            --secondary-color: #f8f9fa;
            --border-color: #dee2e6;
            --success-color: #28a745;
            --error-color: #dc3545;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fb;
            color: #333;
            line-height: 1.6;
        }
        
        .container {
            width: 90%;
            max-width: 900px;
            margin: 2rem auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        header {
            background-color: var(--primary-color);
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        h1 {
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }
        
        .header-subtitle {
            font-size: 1rem;
            opacity: 0.8;
        }
        
        .form-container {
            padding: 2rem;
        }
        
        .step-navigation {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 0.5rem;
        }
        
        .step-button {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 19%;
            min-width: 120px;
            padding: 0.8rem 0.5rem;
            background: var(--secondary-color);
            border: 1px solid var(--border-color);
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
        }
        
        .step-button:hover {
            background-color: #e9ecef;
        }
        
        .step-button.active {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }
        
        .step-icon {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .step-title {
            font-size: 0.85rem;
            font-weight: 500;
            text-align: center;
        }
        
        .form-step {
            display: block;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        input, textarea, select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s;
        }
        
        input:focus, textarea:focus, select:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(74, 109, 229, 0.2);
        }
        
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
        }
        
        .checkbox-group input {
            width: auto;
            margin-right: 10px;
        }
        
        .date-time-group {
            display: flex;
            gap: 1rem;
        }
        
        .date-time-group > div {
            flex: 1;
        }
        
        .session-section {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            border-left: 4px solid var(--primary-color);
        }
        
        .ticket-section {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1rem;
        }
        
        .add-session-btn, .add-ticket-btn {
            display: block;
            margin: 1rem 0;
            padding: 0.8rem 1rem;
            background-color: #f0f0f0;
            border: 1px dashed #aaa;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: #666;
            font-weight: 500;
        }
        
        .add-session-btn:hover, .add-ticket-btn:hover {
            background-color: #e9e9e9;
        }
        
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
        }
        
        .btn {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 500;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        
        .btn-prev {
            background-color: #f0f0f0;
            color: #666;
        }
        
        .btn-next, .btn-submit {
            background-color: var(--primary-color);
            color: white;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
        
        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .btn-submit {
            background-color: var(--success-color);
        }
        
        .help-text {
            font-size: 0.8rem;
            color: #666;
            margin-top: 0.3rem;
        }
        
        .error-message {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 0.3rem;
            display: none;
        }
        
        .required::after {
            content: ' *';
            color: var(--error-color);
        }
        
        .session-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .session-number {
            background-color: var(--primary-color);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }
        .session-closer{
            background-color: var(--error-color);
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
            cursor: pointer;
            transition: .3s;
        }
        #delete-session-btn{
            background-color: #f74d4d;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
            cursor: pointer;
            transition: .3s;
        }
        #create-session-btn{
            background-color: #4a6de5;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
            cursor: pointer;
            transition: .3s;
        }
        #create-session-btn:hover{
            box-shadow: 0 0 8px 3px rgba(74, 109, 229, 0.7); /* lueur bleue */
            transition: .3s;
        }
        #delete-session-btn:hover{
            background-color: #ff2c2c;
            box-shadow: 0 0 8px 3px rgba(251, 93, 93, 0.7); /* lueur rouge */
            transition: .3s;
        }  
        .session-closer:hover {
            box-shadow: 0 0 8px 3px rgba(255, 0, 0, 0.7); /* lueur rouge */
            transition: .3s;
        }
        
        .time-input-group {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }
        
        .time-input-group input {
            width: 85px;
            text-align: center;
        }
        
        .time-input-group span {
            font-weight: bold;
        }
        
        @media (max-width: 768px) {
            .step-navigation {
                flex-wrap: wrap;
            }
            
            .step-button {
                width: 48%;
                margin-bottom: 0.5rem;
            }
            
            .date-time-group {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Créer un nouvel événement</h1>
            <div class="header-subtitle">Complétez les 5 étapes pour configurer votre événement</div>
        </header>
        
        <div class="form-container">
            <!-- Navigation entre étapes -->
            <div class="step-navigation">
                <button onclick="active(this)" id="step-1" class="step-button active">
                    <div class="step-icon">📝</div>
                    <div class="step-title">Informations</div>
                </button>
                <button onclick="active(this)" id="step-2" class="step-button">
                    <div class="step-icon">📍</div>
                    <div class="step-title">Localisation</div>
                </button>
                <button onclick="active(this)" id="step-3" class="step-button">
                    <div class="step-icon">📅</div>
                    <div class="step-title">Date & Heure</div>
                </button>
                <button onclick="active(this)" id="step-4" class="step-button">
                    <div class="step-icon">📋</div>
                    <div class="step-title">Programme</div>
                </button>
                <button onclick="active(this)" id="step-5" class="step-button">
                    <div class="step-icon">🎟️</div>
                    <div class="step-title">Tarifs</div>
                </button>
            </div>
            
            <!-- Formulaire -->
            <form id="event-form" method="POST" action="/create-event">
                <!-- Étape 1: Informations de l'événement -->
                <div class="form-step step-1">
                    <h2>Informations de l'événement</h2>
                    
                    <div class="form-group">
                        <label for="event-title" class="required">Titre de l'événement</label>
                        <input type="text" id="event-title" name="event-title" >
                        <div class="error-message">Veuillez saisir un titre pour l'événement</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="event-description" class="required">Description</label>
                        <textarea id="event-description" name="event-description" ></textarea>
                        <div class="help-text">Décrivez votre événement en détail (programme, intervenants, etc.)</div>
                        <div class="error-message">Veuillez saisir une description pour l'événement</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="event-image">Image de couverture</label>
                        <input type="file" id="event-image" name="event-image" accept="image/*">
                        <div class="help-text">Format recommandé: 1200 x 630 pixels (JPG, PNG)</div>
                    </div>
                    
                    <div class="form-actions">
                        <span>
                            <a href="/organizer_dashboard_page" class='btn prev-btn'>Retour</a>
                        </span>
                        <button class="btn btn-next s2">Suivant</button>
                    </div>
                </div>
                
                <!-- Étape 2: Localisation -->
                <div class="form-step step-2">
                    <h2>Localisation</h2>
                    
                    <div class="form-group">
                        <label for="event-venue" class="required">Nom du lieu</label>
                        <input type="text" id="event-venue" name="event-venue" >
                        <div class="error-message">Veuillez saisir le nom du lieu</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="event-address" class="required">Adresse</label>
                        <input type="text" id="event-address" name="event-address" >
                        <div class="error-message">Veuillez saisir l'adresse</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="event-city" class="required">Ville</label>
                        <input type="text" id="event-city" name="event-city" >
                        <div class="error-message">Veuillez saisir la ville</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="event-postal-code">Code postal</label>
                        <input type="text" id="event-postal-code" name="event-postal-code">
                    </div>
                    
                    <div class="form-actions">
                        <button class="btn btn-prev s1">Précédent</button>
                        <button class="btn btn-next s3">Suivant</button>
                    </div>
                </div>
                
                <!-- Étape 3: Date et Heure -->
                <div class="form-step step-3">
                    <h2>Date et Heure</h2>
                    
                    <div class="form-group">
                        <label for="event-date" class="required">Date</label>
                        <input type="date" id="event-date" name="event-date" >
                        <div class="error-message">Veuillez sélectionner une date</div>
                    </div>
                    
                    <div class="date-time-group">
                        <div class="form-group">
                            <label for="event-start-time" class="required">Heure de début</label>
                            <input type="time" id="event-start-time" name="event-start-time" >
                            <div class="error-message">Veuillez sélectionner une heure de début</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="event-end-time">Heure de fin</label>
                            <input type="time" id="event-end-time" name="event-end-time">
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button class="btn btn-prev s2">Précédent</button>
                        <button class="btn btn-next s4">Suivant</button>
                    </div>
                </div>
                
                <!-- Étape 4: Programme -->
                <div class="form-step step-4">
                    <h2>Programme de l'événement</h2>
                    <div class="help-text" style="margin-bottom: 2rem;">
                        Organisez votre événement en sessions. Chaque session peut avoir un nom, une durée et une description.
                    </div>
                    
                    <div id='session-container'>
                        
                     </div>
                    
                    <div class="session-section">                    
                        <div style="display:flex;flex-direction:row;justify-content:space-between">
                            <button onclick=createSession() id="create-session-btn" class="btn">Ajouter une session</button>
                            <button onclick=supprimerSession() id="delete-session-btn" class="btn">Supprimer une session</button>

                        </div>
                        <div class="help-text" style="text-align: center; margin: 2rem 0; padding: 1rem; background-color: #e9ecef; border-radius: 5px;">
                        💡 <strong>Astuce:</strong> Vous pouvez laisser certaines sessions vides si votre événement en comporte moins de 3. Seules les sessions avec un nom seront affichées.
                        </div>
                    
                        <div class="form-actions">
                            <button class="btn btn-prev s3">Précédent</button>
                            <button class="btn btn-next s5">Suivant</button>
                        </div>
                    </div>
                </div>
                <!-- Étape 5: Tarifs et Billetterie -->
                <div class="form-step step-5">
                    <h2>Tarifs et Billetterie</h2>
                    
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="event-free" name="event-free">
                            <label for="event-free">Événement gratuit</label>
                        </div>
                    </div>
                    
                    
                    <div id="paid-options">
                        
                        
                        <h3>Types de billets</h3>
                        <div class="ticket-container">
                            <div class="ticket-section">
                                <h4>Billet standard</h4>
                                <div class="form-group">
                                    <label for="ticket-1-name">Nom du billet</label>
                                    <input type="text" id="ticket-1-name" name="ticket-1-name" value="Standard">
                                </div>
                                <div class="form-group">
                                    <label for="ticket-1-price">Prix (Ar)</label>
                                    <input type="number" id="ticket-1-price" name="ticket-1-price" min="0">
                                </div>
                                <div class="form-group">
                                    <label for="ticket-1-quantity">Quantité disponible</label>
                                    <input type="number" id="ticket-1-quantity" name="ticket-1-quantity" min="1">
                                </div>
                                <div class="form-group">
                                    <label for="ticket-1-description">Description</label>
                                    <textarea id="ticket-1-description" name="ticket-1-description"></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <h3>Options de paiement</h3>
                        <div class="form-group">
                            <label>Modes de paiement acceptés</label>
                            <div class="checkbox-group">
                                <input type="checkbox" name="payment-method" value="mvola" checked>
                                <label>MVola</label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" name="payment-method" value="orange">
                                <label>Orange Money</label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" name="payment-method" value="airtel">
                                <label>Airtel Money</label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" name="payment-method" value="onsite">
                                <label>Paiement sur place</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="max-tickets-per-order">Nombre maximum de billets par commande</label>
                        <input type="number" id="max-tickets-per-order" name="max-tickets-per-order" min="1" value="10">
                    </div>
                    
                    <div class="form-group">
                        <label for="registration-end-date">Date de fin des inscriptions</label>
                        <input type="date" id="registration-end-date" name="registration-end-date">
                        <div class="help-text">Si non spécifié, les inscriptions seront possibles jusqu'au début de l'événement</div>
                    </div>
                    
                    <div class="form-actions">
                        <button class="btn btn-prev s4">Précédent</button>
                        <button type="submit" class="btn btn-submit">Créer l'événement</button>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
    <script>
        //programme
        var sessionNumber=0;
        var sessionContainer=document.querySelector('.session-container');
        

        
        function createSession(){
            sessionNumber++;
            
            var session=`<div class="session-section session-section-${sessionNumber}" id="session-section-${sessionNumber}">
                        <div class="session-header" style="display:flex;flex-direction:row;justify-content:space-between;">
                            <div class="session-number">${sessionNumber}</div>
                            <h3>Session ${sessionNumber}</h3>
                            <div onclick=supprimerSession() class="session-closer">X</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="session-${sessionNumber}-name" class="required">Nom de la session</label>
                            <input type="text" id="session-${sessionNumber}-name" name="session-${sessionNumber}-name" placeholder="Ex: Conférence d'ouverture" required>
                        </div>
                        <div class="form-group">
                            <label for="session-${sessionNumber}-debut" class="required">Début de la session</label>
                            <input type="time" id="session-${sessionNumber}-debut" name="session-${sessionNumber}-name" placeholder="Ex: Conférence d'ouverture" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="session-${sessionNumber}-duration">Durée</label>
                            <div class="time-input-group">
                                <input type="number" id="session-${sessionNumber}-hours" name="session-${sessionNumber}-hours" min="0" max="23" value="1" placeholder="H">
                                <span>h</span>
                                <input type="number" id="session-${sessionNumber}-minutes" name="session-${sessionNumber}-minutes" min="0" max="59" value="30" placeholder="M">
                                <span>min</span>
                            </div>
                            <div class="help-text">Durée estimée de la session</div>
                        </div>
                        
                        <div class="form-group">
                            <label for="session-${sessionNumber}-description">Description</label>
                            <textarea id="session-${sessionNumber}-description" name="session-${sessionNumber}-description" placeholder="Décrivez le contenu, les intervenants, les objectifs de cette session..."></textarea>
                        </div>
                    </div>
                   `
            document.getElementById('session-container').insertAdjacentHTML('beforeend', session);
        }
        function supprimerSession(){
            if (sessionNumber > 0) {
                var lastSession = document.querySelector('.session-section:last-child');
                if (lastSession) {
                    lastSession.remove();
                    sessionNumber--;
                }
            }
        }
        

        var elAfficer=document.getElementById('step-1');
        function hideElement(el) {
            el.style.display = 'none';
        }

        function showEl(el) {
            el.style.display = 'block';
        }
        function main(el){
            var steps = document.querySelectorAll('.form-step');
            steps.forEach(function(step) {
                hideElement(step);
            });
            console.log(el);
            
            showEl(el);
        }

        active = function(el) {
            var steps = document.querySelectorAll('.step-button');
            steps.forEach(function(step) {
                step.classList.remove('active');
            });
            el.classList.add('active');

            var stepId = el.id.replace('step-', '');
            var currentStep = document.querySelector('.step-' + stepId);
            main(currentStep);
        }
        main(elAfficer);
        active(elAfficer);

        //gestion button next prev
        var nextButtons = document.querySelectorAll('.btn-next');
        nextButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var currentStep = this.closest('.form-step');
                var nextStepId = this.classList.contains('s2') ? 'step-2' :
                                 this.classList.contains('s3') ? 'step-3' :
                                 this.classList.contains('s4') ? 'step-4' : 'step-5';
                var nextStep = document.getElementById(nextStepId);
                active(nextStep);
            });
        });

        var prevButtons = document.querySelectorAll('.btn-prev');
        prevButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                var currentStep = this.closest('.form-step');
                var prevStepId = this.classList.contains('s1') ? 'step-1' :
                                 this.classList.contains('s2') ? 'step-2' :
                                 this.classList.contains('s3') ? 'step-3' : 'step-4';
                var prevStep = document.getElementById(prevStepId);
                active(prevStep);
            });
        });

        // Gestion de l'affichage des options de paiement
        function togglePaidOptions() {
            const eventFreeCheckbox = document.getElementById('event-free');
            const paidOptionsDiv = document.getElementById('paid-options');
            
            if (eventFreeCheckbox.checked) {
                // Si événement gratuit est coché, cacher les options payantes
                paidOptionsDiv.style.display = 'none';
            } else {
                // Si événement gratuit n'est pas coché, afficher les options payantes
                paidOptionsDiv.style.display = 'block';
            }
        }

        // Ajouter l'écouteur d'événement à la checkbox
        document.getElementById('event-free').addEventListener('change', togglePaidOptions);

        // Appeler la fonction au chargement de la page pour définir l'état initial
        document.addEventListener('DOMContentLoaded', togglePaidOptions);
        
    </script>
</body>
</html>