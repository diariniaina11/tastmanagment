<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire de Tâches</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, white 0%, #8D8A91FF 100%);
            min-height: 100vh;
        }

        /* Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-logo {
            font-size: 1.8rem;
            font-weight: bold;
            color: #4f46e5;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-logo::before {
            content: "✓";
            background: #4f46e5;
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 50%;
            font-size: 1rem;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            text-decoration: none;
            color: #374151;
            font-weight: 500;
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: #4f46e5;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            right: 0;
            height: 2px;
            background: #4f46e5;
        }

        .nav-stats {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .nav-stat {
            background: #f3f4f6;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .nav-stat.pending {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .nav-stat.completed {
            background: #dcfce7;
            color: #166534;
        }

        .nav-stat.overdue {
            background: #fee2e2;
            color: #dc2626;
        }

        /* Container principal */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Section des contrôles */
        .controls {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .controls-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .controls-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #1f2937;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
        }

        .filters {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-input, .filter-select {
            padding: 0.8rem 1rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus, .filter-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .search-input {
            flex: 1;
            min-width: 250px;
        }

        /* Notification des tâches en retard */
        .overdue-notification {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            border: 2px solid #f87171;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            animation: pulse 2s infinite;
        }

        .overdue-notification h4 {
            color: #dc2626;
            font-weight: bold;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .overdue-notification h4::before {
            content: "⚠️";
        }

        .overdue-task {
            color: #7f1d1d;
            font-size: 0.9rem;
            margin-left: 1.5rem;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        /* Grille des tâches */
        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 1.5rem;
        }

        .task-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .task-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .task-card.overdue {
            border-left: 4px solid #ef4444;
        }

        .task-card.completed {
            opacity: 0.7;
        }

        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .task-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: #1f2937;
            margin: 0;
            flex: 1;
        }

        .task-title.completed {
            text-decoration: line-through;
            color: #6b7280;
        }

        .task-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            background: none;
            border: none;
            padding: 0.5rem;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 1rem;
        }

        .btn-complete {
            color: #10b981;
        }

        .btn-complete:hover {
            background: #d1fae5;
        }

        .btn-edit {
            color: #3b82f6;
        }

        .btn-edit:hover {
            background: #dbeafe;
        }

        .btn-delete {
            color: #ef4444;
        }

        .btn-delete:hover {
            background: #fee2e2;
        }

        .task-description {
            color: #6b7280;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .task-meta {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .task-priority, .task-category {
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .priority-high {
            background: #fee2e2;
            color: #dc2626;
        }

        .priority-medium {
            background: #fef3c7;
            color: #d97706;
        }

        .priority-low {
            background: #d1fae5;
            color: #059669;
        }

        .task-category {
            background: #f3f4f6;
            color: #374151;
        }

        .task-date {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            color: #6b7280;
            font-size: 0.8rem;
        }

        .task-date::before {
            content: "🕒";
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 2000;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .modal.show {
            display: flex;
        }

        .modal-content {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        .modal-header {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #1f2937;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
        }

        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus, .form-textarea:focus, .form-select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-textarea {
            resize: vertical;
            min-height: 80px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: #374151;
            border: none;
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            flex: 1;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background: #e5e7eb;
        }

        /* Message vide */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #6b7280;
            grid-column: 1 / -1;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .empty-state::before {
            content: "📝";
            font-size: 4rem;
            display: block;
            margin-bottom: 1rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 1rem;
            }

            .nav-container {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-menu {
                flex-wrap: wrap;
                gap: 1rem;
                justify-content: center;
            }

            .container {
                padding: 1rem;
            }

            .controls-header {
                flex-direction: column;
                align-items: stretch;
            }

            .filters {
                flex-direction: column;
            }

            .search-input {
                min-width: unset;
            }

            .tasks-grid {
                grid-template-columns: 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                TaskMaster
            </div>
            <ul class="nav-menu">
            </ul>
            <div class="nav-stats">
                <span class="nav-stat pending" id="nav-pending">0 En cours</span>
                <span class="nav-stat completed" id="nav-completed">0 Terminées</span>
                <span class="nav-stat overdue" id="nav-overdue">0 Retard</span>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Section des contrôles -->
        <div class="controls">
            <div class="controls-header">
                <h1 class="controls-title">Gestionnaire de Tâches</h1>
                <button class="btn-primary" onclick="openModal()">
                    ➕ Nouvelle tâche
                </button>
            </div>

            <!-- Notification des tâches en retard -->
            <div id="overdue-notification" class="overdue-notification" style="display: none;">
                <h4 id="overdue-title"></h4>
                <div id="overdue-list"></div>
            </div>

            <div class="filters">
                <input type="text" class="search-input" id="search-input" placeholder="Rechercher des tâches...">
                <select class="filter-select" id="filter-select">
                    <option value="all">Toutes les tâches</option>
                    <option value="pending">En cours</option>
                    <option value="completed">Terminées</option>
                    <option value="overdue">En retard</option>
                </select>
            </div>
        </div>

        <!-- Grille des tâches -->
        <div class="tasks-grid" id="tasks-grid">
            <div class="empty-state">
                <h3>Aucune tâche trouvée</h3>
                <p>Commencez par créer votre première tâche !</p>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="task-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header" id="modal-title">Nouvelle tâche</div>
            <div class="form-group">
                <label class="form-label">Titre *</label>
                <input type="text" class="form-input" id="task-title" placeholder="Titre de la tâche" required>
            </div>
            <div class="form-group">
                <label class="form-label">Description</label>
                <textarea class="form-textarea" id="task-description" placeholder="Description de la tâche"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Catégorie</label>
                    <select class="form-select" id="task-category">
                        <option value="Personnel">Personnel</option>
                        <option value="Travail">Travail</option>
                        <option value="Études">Études</option>
                        <option value="Santé">Santé</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Priorité</label>
                    <select class="form-select" id="task-priority">
                        <option value="low">Faible</option>
                        <option value="medium">Moyenne</option>
                        <option value="high">Élevée</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Date d'échéance</label>
                <input type="date" class="form-input" id="task-due-date">
            </div>
            <div class="modal-actions">
                <button class="btn-secondary" onclick="closeModal()">Annuler</button>
                <button class="btn-primary" onclick="saveTask()">
                    <span id="save-btn-text">Créer</span>
                </button>
            </div>
        </div>
    </div>

    <script>
        let tasks = [];
        let editingTaskId = null;

        // Initialiser avec des tâches d'exemple
        function initializeApp() {
            tasks = [
                {
                    id: 1,
                    title: 'Finir le rapport mensuel',
                    description: 'Compiler les données et rédiger le rapport final',
                    category: 'Travail',
                    priority: 'high',
                    status: 'pending',
                    dueDate: '2025-06-15',
                    createdAt: new Date().toISOString()
                },
                {
                    id: 2,
                    title: 'Faire les courses',
                    description: 'Acheter les produits pour la semaine',
                    category: 'Personnel',
                    priority: 'medium',
                    status: 'pending',
                    dueDate: '2025-06-14',
                    createdAt: new Date().toISOString()
                },
                {
                    id: 3,
                    title: 'Rendez-vous médecin',
                    description: 'Consultation de routine',
                    category: 'Santé',
                    priority: 'high',
                    status: 'completed',
                    dueDate: '2025-06-12',
                    createdAt: new Date().toISOString()
                }
            ];
            renderTasks();
            updateStats();
        }

        // Fonctions de gestion des tâches
        function createTask(taskData) {
            const newTask = {
                id: Date.now(),
                ...taskData,
                status: 'pending',
                createdAt: new Date().toISOString()
            };
            tasks.push(newTask);
            renderTasks();
            updateStats();
        }

        function updateTask(id, taskData) {
            const index = tasks.findIndex(task => task.id === id);
            if (index !== -1) {
                tasks[index] = { ...tasks[index], ...taskData };
                renderTasks();
                updateStats();
            }
        }

        function deleteTask(id) {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')) {
                tasks = tasks.filter(task => task.id !== id);
                renderTasks();
                updateStats();
            }
        }

        function toggleTaskStatus(id) {
            const task = tasks.find(task => task.id === id);
            if (task) {
                task.status = task.status === 'completed' ? 'pending' : 'completed';
                renderTasks();
                updateStats();
            }
        }

        // Fonctions de filtrage
        function getFilteredTasks() {
            const searchTerm = document.getElementById('search-input').value.toLowerCase();
            const filter = document.getElementById('filter-select').value;
            const today = new Date().toISOString().split('T')[0];

            return tasks.filter(task => {
                const matchesSearch = task.title.toLowerCase().includes(searchTerm) ||
                                    task.description.toLowerCase().includes(searchTerm) ||
                                    task.category.toLowerCase().includes(searchTerm);

                let matchesFilter = true;
                switch (filter) {
                    case 'pending':
                        matchesFilter = task.status === 'pending';
                        break;
                    case 'completed':
                        matchesFilter = task.status === 'completed';
                        break;
                    case 'overdue':
                        matchesFilter = task.status === 'pending' && task.dueDate < today;
                        break;
                }

                return matchesSearch && matchesFilter;
            });
        }

        function getOverdueTasks() {
            const today = new Date().toISOString().split('T')[0];
            return tasks.filter(task => 
                task.status === 'pending' && 
                task.dueDate && 
                task.dueDate < today
            );
        }

        // Fonctions de rendu
        function renderTasks() {
            const filteredTasks = getFilteredTasks();
            const tasksGrid = document.getElementById('tasks-grid');
            
            if (filteredTasks.length === 0) {
                tasksGrid.innerHTML = `
                    <div class="empty-state">
                        <h3>Aucune tâche trouvée</h3>
                        <p>Essayez de modifier vos critères de recherche ou créez une nouvelle tâche !</p>
                    </div>
                `;
                return;
            }

            // Trier les tâches par priorité puis par date
            const sortedTasks = filteredTasks.sort((a, b) => {
                const priorityOrder = { high: 3, medium: 2, low: 1 };
                if (priorityOrder[a.priority] !== priorityOrder[b.priority]) {
                    return priorityOrder[b.priority] - priorityOrder[a.priority];
                }
                const dateA = new Date(a.dueDate || '9999-12-31');
                const dateB = new Date(b.dueDate || '9999-12-31');
                return dateA - dateB;
            });

            tasksGrid.innerHTML = sortedTasks.map(task => {
                const isOverdue = task.status === 'pending' && task.dueDate && task.dueDate < new Date().toISOString().split('T')[0];
                const priorityLabels = { high: 'Élevée', medium: 'Moyenne', low: 'Faible' };
                
                return `
                    <div class="task-card ${isOverdue ? 'overdue' : ''} ${task.status === 'completed' ? 'completed' : ''}">
                        <div class="task-header">
                            <h3 class="task-title ${task.status === 'completed' ? 'completed' : ''}">${task.title}</h3>
                            <div class="task-actions">
                                ${task.status === 'pending' ? `<button class="btn-action btn-complete" onclick="toggleTaskStatus(${task.id})" title="Marquer comme terminé">✓</button>` : ''}
                                <button class="btn-action btn-edit" onclick="editTask(${task.id})" title="Modifier">✏️</button>
                                <button class="btn-action btn-delete" onclick="deleteTask(${task.id})" title="Supprimer">🗑️</button>
                            </div>
                        </div>
                        ${task.description ? `<p class="task-description">${task.description}</p>` : ''}
                        <div class="task-meta">
                            <span class="task-priority priority-${task.priority}">${priorityLabels[task.priority]}</span>
                            <span class="task-category">${task.category}</span>
                            ${task.dueDate ? `<span class="task-date">${new Date(task.dueDate).toLocaleDateString('fr-FR')}</span>` : ''}
                        </div>
                    </div>
                `;
            }).join('');

            updateOverdueNotification();
        }

        function updateStats() {
            const pendingTasks = tasks.filter(t => t.status === 'pending').length;
            const completedTasks = tasks.filter(t => t.status === 'completed').length;
            const overdueTasks = getOverdueTasks().length;

            document.getElementById('nav-pending').textContent = `${pendingTasks} En cours`;
            document.getElementById('nav-completed').textContent = `${completedTasks} Terminées`;
            document.getElementById('nav-overdue').textContent = `${overdueTasks} Retard`;
        }

        function updateOverdueNotification() {
            const overdueTasks = getOverdueTasks();
            const notification = document.getElementById('overdue-notification');
            
            if (overdueTasks.length > 0) {
                document.getElementById('overdue-title').textContent = 
                    `${overdueTasks.length} tâche${overdueTasks.length > 1 ? 's' : ''} en retard`;
                
                document.getElementById('overdue-list').innerHTML = overdueTasks.map(task => 
                    `<div class="overdue-task">• ${task.title} (échéance: ${new Date(task.dueDate).toLocaleDateString('fr-FR')})</div>`
                ).join('');
                
                notification.style.display = 'block';
            } else {
                notification.style.display = 'none';
            }
        }

        // Fonctions du modal
        function openModal(task = null) {
            const modal = document.getElementById('task-modal');
            const modalTitle = document.getElementById('modal-title');
            const saveBtnText = document.getElementById('save-btn-text');

            if (task) {
                editingTaskId = task.id;
                modalTitle.textContent = 'Modifier la tâche';
                saveBtnText.textContent = 'Modifier';
                
                document.getElementById('task-title').value = task.title;
                document.getElementById('task-description').value = task.description;
                document.getElementById('task-category').value = task.category;
                document.getElementById('task-priority').value = task.priority;
                document.getElementById('task-due-date').value = task.dueDate;
            } else {
                editingTaskId = null;
                modalTitle.textContent = 'Nouvelle tâche';
                saveBtnText.textContent = 'Créer';
                
                document.getElementById('task-title').value = '';
                document.getElementById('task-description').value = '';
                document.getElementById('task-category').value = 'Personnel';
                document.getElementById('task-priority').value = 'medium';
                document.getElementById('task-due-date').value = '';
            }

            modal.classList.add('show');
        }

        function closeModal() {
            document.getElementById('task-modal').classList.remove('show');
            editingTaskId = null;
        }

        function saveTask() {
            const title = document.getElementById('task-title').value.trim();
            if (!title) return;

            const taskData = {
                title,
                description: document.getElementById('task-description').value,
                category: document.getElementById('task-category').value,
                priority: document.getElementById('task-priority').value,
                dueDate: document.getElementById('task-due-date').value
            };

            if (editingTaskId) {
                updateTask(editingTaskId, taskData);
            } else {
                createTask(taskData);
            }

            closeModal();
        }

        function editTask(id) {
            const task = tasks.find(t => t.id === id);
            if (task) {
                openModal(task);
            }
        }

        // Event listeners
        document.getElementById('search-input').addEventListener('input', renderTasks);
        document.getElementById('filter-select').addEventListener('change', renderTasks);

        // Fermer le modal en cliquant à l'extérieur
        document.getElementById('task-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Initialiser l'application
        initializeApp();
    </script>
</body>
</html>