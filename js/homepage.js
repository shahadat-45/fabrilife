$(document).ready(function(){
    $("#banner").owlCarousel({
      items: 1,               
      loop: true,            
      autoplay: false,       
      autoplayTimeout: 3000, 
      autoplayHoverPause: true
    });
  });


$(document).ready(function(){
    $("#cat_mobile").owlCarousel({
      items: 2,               
      loop: true,            
      autoplay: false,       
      autoplayTimeout: 3000, 
      autoplayHoverPause: true
    });
  });

function toggleCatMobile() {
    const catMobile = document.getElementById('cat_mobile');
    
    if (window.innerWidth > 599) {
        catMobile.style.display = 'none'; 
    } else {
        catMobile.style.display = 'block'; 
    }
}

window.addEventListener('load', toggleCatMobile);
window.addEventListener('resize', toggleCatMobile);

// Select all elements with the target class
function toggleResponsiveCols() {
  const elements = document.querySelectorAll('.col-xl-2.col-lg-3.col-md-4.col-sm-6.col-xs-6');
  const poster_pro01 = document.getElementById('poster_prd01');
  const poster_pro02 = document.getElementById('poster_prd02');
  const poster_pro03 = document.getElementById('poster_prd03');
  
  elements.forEach(element => {
      if (window.innerWidth > 599) {
          element.style.display = 'block';
          poster_pro01.classList.remove('owl-carousel');
          poster_pro02.classList.remove('owl-carousel');
          poster_pro03.classList.remove('owl-carousel');
        } else {
          element.style.display = 'none';
          poster_pro01.classList.add('owl-carousel');
          poster_pro02.classList.add('owl-carousel');
          poster_pro03.classList.add('owl-carousel');
          $("#poster_prd01").owlCarousel({
            items: 2,               
            loop: true,            
            autoplay: false,       
            autoplayTimeout: 3000, 
            autoplayHoverPause: true
          });
          $("#poster_prd02").owlCarousel({
            items: 2,               
            loop: true,            
            autoplay: false,       
            autoplayTimeout: 3000, 
            autoplayHoverPause: true
          });
          $("#poster_prd03 ").owlCarousel({
            items: 2,               
            loop: true,            
            autoplay: false,       
            autoplayTimeout: 3000, 
            autoplayHoverPause: true
          });
      }
  });
}

// Run the function on page load and on window resize
window.addEventListener('load', toggleResponsiveCols);
window.addEventListener('resize', toggleResponsiveCols);

function toggleForm() {
  document.getElementById("searchForm").classList.toggle("active");
}

