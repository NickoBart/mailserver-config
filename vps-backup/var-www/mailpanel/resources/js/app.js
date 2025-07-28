import './bootstrap';                       // bootstrap.js de Laravel/Vite
import Alpine from 'alpinejs';              // Alpine.js
import Splide from '@splidejs/splide';      // Splide para carruseles
import '@splidejs/splide/dist/css/splide.min.css'; // CSS de Splide
import collapse from '@alpinejs/collapse'
Alpine.plugin(collapse)


// Iniciar Alpine
window.Alpine = Alpine;
Alpine.start();

// Iniciar Splide cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', () => {
  // Carousel de testimonios
  if (document.getElementById('testimonials')) {
    new Splide('#testimonials', {
      type       : 'loop',
      perPage    : 1,
      arrows: true,
      pagination : true,
      autoplay   : true,
      interval   : 5000,
      pauseOnHover: true,
    }).mount();
  }

  // Carousel de logos de clientes
  if (document.getElementById('client-logos-carousel')) {
    new Splide('#client-logos-carousel', {
      type       : 'loop',
      perPage    : 3,
      arrows     : true,
      pagination : false,
      gap        : '1rem',
      breakpoints: {
        640 : { perPage: 1 },
        1024: { perPage: 2 },
      },
    }).mount();
  }
});
