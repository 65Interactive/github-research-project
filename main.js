(function(){
  
  var slider = document.querySelectorAll("movieGallery"),
      current = 0;
  
  
  
  
  setInterval(function(){
    for ( var i=0; i < slider.length; i++){
      slider[i].style.opacity = 0;
    }
    current = (current != slider.length - 1) ? currnt + 1 : 0;
    slider[i].style.opacity = 1;
  }, 3000);

})();
