


    const banner = document.querySelector('#logo');
    const logo = document.querySelectorAll('#logo path');

    
        for (i = 0; i < logo.length; i++){
            //console.log(`A letra ${i} tem um tamanho de ${logo[i].getTotalLength()}`)
            logo[i].style.strokeDasharray = `${logo[i].getTotalLength()}`;
            logo[i].style.strokeDashoffset= `${logo[i].getTotalLength()}`;
            var calc_delay = (2 / logo.length) * i;
            logo[i].style.animation = `line-anim 2s ease forwards ${calc_delay}s `;
            banner.style.animation = "fill 0.5s ease forwards 2s"
        }


//código para a animação só acontecer quando o objeto estiver aparecendo na tela
//class="not-yet"


    var elements; //como estou usando na classe not-yet display:none vou usar de referencia o div que pintei o background para pegar o boundingClientRect
    var windowHeight;
  
    function init() {
        elements =  document.getElementsByClassName("cambio-valores");
        windowHeight = window.innerHeight;
    }
  
    function checkPosition() {
      for (var i = 0; i < elements.length; i++) {
        var positionFromTop = elements[i].getBoundingClientRect().top;
  
        if (positionFromTop - windowHeight <= 0) {
            banner.style.display = "block";
        } else {
            banner.style.display = "none";
        }
      }

    }
  
    window.addEventListener('scroll', checkPosition);
    window.addEventListener('resize', init);

    init();
    checkPosition();


    deletaAnchorTagBugada();


    function deletaAnchorTagBugada(){

        var anchorBugada = document.querySelector("body > a");
        anchorBugada.parentNode.removeChild(anchorBugada);
        var anchorBugada = document.querySelector("body > footer > a");
        anchorBugada.parentNode.removeChild(anchorBugada);
        var anchorBugada = document.querySelector("body > footer > div > a");
        anchorBugada.parentNode.removeChild(anchorBugada);
        var anchorBugada = document.querySelector("body > footer > div > div.footer-wrapper-top > a:nth-child(1)")
        anchorBugada.parentNode.removeChild(anchorBugada);

    }