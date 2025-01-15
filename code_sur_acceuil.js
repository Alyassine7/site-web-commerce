// Crée un élément meta pour la vue adaptative
var metaViewport = document.createElement('meta');
metaViewport.name = "viewport";
metaViewport.content = "width=device-width, initial-scale=1.0";

// Ajoute l'élément meta au <head> du document
document.getElementsByTagName('head')[0].appendChild(metaViewport);

 src="https://kit.fontawesome.com/a076d05399.js" //Pour les icônes -->
 src="https://unpkg.com/swiper/swiper-bundle.min.js"


 // les clics a coté du pupup ou conteneur pour quitter directement le pupup ou conteneur 

    // Sélection des éléments pour la section Services
    const services = document.getElementById('services');
    const servicesLink = document.getElementById('services-link');

    // Afficher ou cacher la section "Services" lorsque l'on clique sur le lien "Services"
    servicesLink.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le comportement par défaut du lien
        if (services.style.display === 'none' || services.style.display === '') {
            services.style.display = 'block'; // Affiche la section Services
        } else {
            services.style.display = 'none'; // Cache la section Services
        }
    });

    // Fermer la section "Services" en cliquant en dehors du conteneur, sans affecter les autres éléments
    document.addEventListener('click', (event) => {
        // Vérifie si le clic est à l'intérieur de la section Services ou sur le lien de la section Services
        const isClickInsideServices = services.contains(event.target) || servicesLink.contains(event.target);
        if (!isClickInsideServices) {
            services.style.display = 'none'; // Cache la section Services si le clic est en dehors
        }
    });

    // Sélection des éléments pour la boutique
    const boutique = document.getElementById('boutique');
    const boutiqueLink = document.getElementById('boutique-link');

    // Afficher ou cacher la section "Boutique" lorsque l'on clique sur le lien "Boutique"
    boutiqueLink.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le comportement par défaut du lien
        if (boutique.style.display === 'none' || boutique.style.display === '') {
            boutique.style.display = 'block'; // Affiche la boutique
        } else {
            boutique.style.display = 'none'; // Cache la boutique
        }
    });

    // Fermer la section "Boutique" en cliquant en dehors du conteneur, sans affecter les autres éléments
    document.addEventListener('click', (event) => {
        // Vérifie si le clic est à l'intérieur de la boutique ou sur le lien de la boutique
        const isClickInsideBoutique = boutique.contains(event.target) || boutiqueLink.contains(event.target);
        if (!isClickInsideBoutique) {
            boutique.style.display = 'none'; // Cache la boutique si le clic est en dehors
        }
    });

    // Sélection des éléments pour le popup
    const categoryLink = document.getElementById('category-link');
    const popup = document.getElementById('popup');
    const closePopup = document.getElementById('close-popup');

    // Ouvrir le popup en cliquant sur le lien "category-link"
    categoryLink.addEventListener('click', (e) => {
        e.preventDefault(); // Empêche le comportement par défaut du lien
        popup.classList.add('active'); // Ajoute la classe active pour afficher le popup
    });

    // Fermer le popup avec le bouton
    closePopup.addEventListener('click', () => {
        popup.classList.remove('active'); // Supprime la classe active pour cacher le popup
    });

    // Fermer le popup en cliquant en dehors
    document.addEventListener('click', (e) => {
        // Vérifie si le clic est à l'extérieur du popup et de son lien
        const isClickInsidePopup = popup.contains(e.target) || categoryLink.contains(e.target);
        if (!isClickInsidePopup && popup.classList.contains('active')) {
            popup.classList.remove('active'); // Ferme le popup si on clique en dehors
        }
    });