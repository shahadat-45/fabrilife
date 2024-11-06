$(document).ready(function(){
    $("#banner").owlCarousel({
      items: 1,               // Show one item at a time
      loop: true,             // Loop through the items
      autoplay: false,         // Enable auto-play
      autoplayTimeout: 3000,  // Set auto-play speed (3 seconds)
      autoplayHoverPause: true // Pause on hover
    });
  });
  