
    //---------------ESTE BLOCO FUNCIONA -------------

    //var elements; //como estou usando na classe not-yet display:none vou usar de referencia o div que pintei o background para pegar o boundingClientRect
    // var windowHeight;
    


    // function init() {
    //     elements =  document.getElementsByClassName("divots");
    //     windowHeight = window.innerHeight;
    // }



    // function checkPosition() { //sem salzinha, funciona, precisa que inicie a init() e checkposition()
    //   for (var i = 0; i < elements.length; i++) {
    //     var positionFromTop = elements[i].getBoundingClientRect().top;
    //     if (positionFromTop - windowHeight <= 0) {
    //         elements[i].classList.add("divots_animated_in");
    //     } else {
    //         elements[i].classList.remove("divots_animated_in");        
    //     }
    //   }
    // }

    // window.addEventListener('scroll', checkPosition);
    // window.addEventListener('resize', init);


    // init();
    // checkPosition();

    //--------------FIM DO BLOCO------------


    var elements; 
    var windowHeight;
    elements =  document.getElementsByClassName("service");
    windowHeight = window.innerHeight;

    
            window.addEventListener('scroll', function(){
 
                for (let i = 0; i < elements.length; i++)
                {
                    var distTopDiv = elements[i].getBoundingClientRect().top;
                    var diff = distTopDiv - windowHeight;
                    if (diff >= -150){
                        elements[i].classList.add("service_out");
                    } else {
                        elements[i].classList.remove("service_out");
                    }
                    if (diff <= 0){
                        elements[i].classList.add("service_in");
                    } else {
                        elements[i].classList.remove("service_in");
                    }
                }
            });