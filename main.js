(function(){
  
  var slider = document.querySelectorAll("movieGallery");
  
  
  
  
  setInterval(function(){
    for ( var i=0; i < slider.length; i++){
      slider[i].style.opacity = 0;
  }, 3000);

})();
