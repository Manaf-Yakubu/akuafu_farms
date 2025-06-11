// File: script.js
document.addEventListener("DOMContentLoaded", () => {
  console.log("Akuafo Farms Workshops page loaded with slider and animation.");

  const heroCarousel = document.querySelector('#heroCarousel');
  if (heroCarousel) {
    new bootstrap.Carousel(heroCarousel, {
      interval: 3000,
      ride: 'carousel',
      pause: false
    });
  }
});
