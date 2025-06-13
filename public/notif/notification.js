function toast(type = 'info', message = '', duration = 3000) {
    // Vérifie si le conteneur existe déjà, sinon le créer
    let container = document.getElementById('toast-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toast-container';
        container.style.position = 'fixed';
        container.style.top = '20px';
        container.style.right = '20px';
        container.style.zIndex = '9999';
        container.style.display = 'flex';
        container.style.flexDirection = 'column';
        container.style.gap = '10px';
        document.body.appendChild(container);
    }

    // Crée la notification
    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;

    // Style de base du toast
    Object.assign(toast.style, {
        minWidth: '250px',
        padding: '15px 20px',
        borderRadius: '8px',
        color: type === 'warning' ? '#000' : '#fff',
        fontWeight: 'bold',
        boxShadow: '0 4px 8px rgba(0, 0, 0, 0.1)',
        backgroundColor: {
            success: '#28a745',
            error: '#dc3545',
            info: '#007bff',
            warning: '#ffc107'
        }[type] || '#007bff',
        animation: 'slideIn 0.4s ease, fadeOut 0.5s ease forwards',
        position: 'relative'
    });

    // Ajout dans le conteneur
    container.appendChild(toast);

    // Suppression après durée
    setTimeout(() => {
        toast.style.animation = 'fadeOut 0.5s ease forwards';
        setTimeout(() => container.removeChild(toast), 500);
    }, duration);
}

// Ajoute les animations au document si absentes
if (!document.getElementById('toast-style')) {
    const style = document.createElement('style');
    style.id = 'toast-style';
    style.innerHTML = `
    @keyframes slideIn {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes fadeOut {
        to { opacity: 0; transform: translateX(100%); }
    }`;
    document.head.appendChild(style);
}
