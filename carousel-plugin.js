// carousel-plugin.js

// Define the carousel plugin function
window.CarouselPlugin = function(containerSelector, prevButtonSelector, nextButtonSelector) {
  // Get references to the carousel elements
  const carouselContainer = document.querySelector(containerSelector);
  const prevButton = document.querySelector(prevButtonSelector);
  const nextButton = document.querySelector(nextButtonSelector);

  // Initialize variables to keep track of the current slide
  let currentSlide = 0;
  const totalSlides = document.querySelectorAll(containerSelector + ' .carousel-slide').length;

  // Function to show the current slide
  function showSlide() {
    // Calculate the translateX value to move the carousel
    const translateX = -currentSlide * 100;
    carouselContainer.style.transform = `translateX(${translateX}%)`;
  }

  // Function to go to the previous slide
  function prevSlide() {
    currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
    showSlide();
  }

  // Function to go to the next slide
  function nextSlide() {
    currentSlide = (currentSlide + 1) % totalSlides;
    showSlide();
  }

  // Add click event listeners to the navigation buttons
  prevButton.addEventListener("click", prevSlide);
  nextButton.addEventListener("click", nextSlide);

  // Automatically advance to the next slide every 5 seconds (5000 milliseconds)
  setInterval(nextSlide, 5000);
}