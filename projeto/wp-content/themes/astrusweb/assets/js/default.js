var SITE = $('meta[name=host]').attr("content");
//slick início
$(document).ready(function(){
    $('#banner-primeiro-sec').slick({
      slidesToShow:1,
      slidesToScroll:1,
      autoplay:true,
      autoplaySpeed: 3000,
      arrows:false,
      pauseOnFocus:false,
      pauseOnHover: false,
    });
});

$(document).ready(function(){
    $('#banner-segundo-sec').slick({
      slidesToShow:1,
      slidesToScroll:1,
      autoplay:true,
      autoplaySpeed: 3000,
      arrows:false,
    });
});
//slick fim

//SMOOTH SCROLL
function smoothScroll(target, duration){
  var target = document.querySelector(target);
  //console.log(target);
  var targetPosition = target.getBoundingClientRect().top;
  //console.log(targetPosition);
  var startPosition = window.pageYOffset;
  // console.log(startPosition); 
  var distance = targetPosition; //- startPosition; subtrair a start position causa um glitch quando as divs sáo > vh;
  var startTime = null;


  function animation(currentTime){
      if(startTime === null) startTime = currentTime;
      var timeElapsed = currentTime - startTime;
      var run = ease(timeElapsed, startPosition, distance, duration);
      window.scrollTo(0,run);
      if(timeElapsed < duration) requestAnimationFrame(animation);
  }

  function ease (t, b, c, d) {
      t /= d/2;
      if (t < 1) return c/2*t*t + b;
      t--;
      return -c/2 * (t*(t-2) - 1) + b;
  };

  requestAnimationFrame(animation); //request animation frame joga pra dentro da função entre parenteses um argumento do tipo
  //DOMHighResTimeStamp
}
var cliqueEmMim = document.getElementsByClassName('scroll-down-box');
for (let i=0; i < cliqueEmMim.length; i++){
    cliqueEmMim[i].addEventListener('click',function(){
        smoothScroll('#banner-segundo-sec',2000);
      });
}

//SMOOTH SCROLL FIM


//CÓDIGO REFERENTE AOS MODAIS
if(document.getElementById("myModal")){
    var modal = document.getElementById("myModal");
    var modal_content = document.getElementsByClassName("modal-content")[0];
    var span = document.getElementsByClassName("close")[0]; // Get the <span> element that closes the modal
}

if (document.getElementsByClassName("close")[0]){
    span.onclick = function() {
        modal.style.display = "none";
      
        if (window.location.href == 'http://localhost/projetoguilherme/index.php/belapedra/'){
            var imagem_remove = modal_content.childNodes[3].remove();
        }
        var titulo_remove = modal_content.childNodes[3].remove();
        var descricao_remove = modal_content.childNodes[3].remove();
        var descricao1_remove = modal_content.childNodes[3].remove();
    }
}
    

function displayModal(id_do_elemento) {
    modal.style.display = "block";
    var elementoID = document.getElementById(id_do_elemento);
    var titulo_clone = elementoID.childNodes[1].cloneNode(true);
    // if (window.location.href == 'http://localhost/projetoguilherme/index.php/tecnologia/'){ //ajuste pois umas páginas geram 2 p tags, outras apenas 1
    //     var descricao_clone = elementoID.childNodes[2].cloneNode(true);
    // } else {
        var descricao_clone = elementoID.childNodes[3].cloneNode(true);
        var descricao_clone1 = elementoID.childNodes[5].cloneNode(true);
    //}
    if (window.location.href == 'http://localhost/projetoguilherme/index.php/belapedra/'){
        var imagem_clone = elementoID.childNodes[0].cloneNode(true);
        imagem_clone.style.filter = 'saturate(3)';
        modal_content.appendChild(imagem_clone);
    }
    modal_content.appendChild(titulo_clone);
    modal_content.appendChild(descricao_clone); 
    modal_content.appendChild(descricao_clone1);
}
//CÓDIGO REFERENTE AOS MODAIS FIM





//SCRIPT PARA O MENU DA VERSÃO TABLET 

function hamburgerClick(){
    var hamb = document.getElementById('burger');
    var navigationLinks = document.getElementsByClassName('nav-links')[0];
    var corpo = document.getElementsByTagName("BODY")[0];

    if (hamb.classList.length !== 0){
        hamb.classList.remove('active');
        corpo.style.overflowY = 'scroll';
        navigationLinks.classList.remove('active');
    } else{
        hamb.classList.add('active');
        corpo.style.overflowY = 'hidden';
        navigationLinks.classList.add('active');
    }
}
if (document.getElementById('burger')){
    document.getElementById('burger').addEventListener('click',hamburgerClick);
}

//SCRIPT PARA O MENU DA VERSÃO TABLET FIM //


//SCRIPT PARA MOSTRAR DESCRIÇÃO DOS PRODUTOS NA VERSÃO MOBILE //

$(function(){
    $(".trigger").click(function(){
       // console.log($(this)); //estou selecionando um elemento de classe trigger ao qual eu dei um valor de data-modal = ao id do post do wp durante o qual ele foi gerado
       // console.log($(this).data('modal')); //aqui eu acesso o valor que eu assignei ao tipo de data modal, que é o mesmo valor que eu dei de ID pra div à qual eu quero adicionar uma classe active

        

        var elem = $('#' + $(this).data('modal')); // o seletor $ com um hashtag se refere, no jquery, à um id
        elem.toggleClass('active');
        // console.log($('#' + $(this).data('modal')));
    });
    $('.onclick-mobile').click(function(){
        $(this).toggleClass('active');
    })
});
//SCRIPT PARA MOSTRAR DESCRIÇÃO DOS PRODUTOS NA VERSÃO MOBILE FIM//


//SCRIPT PARA AJUSTAR O LOCAL DOS BOTÕES DE PAGINAÇÃO NA PÁGINA BLOG //

function ajustaPaginacao(){
  if(window.innerWidth > 979){
    if (document.getElementsByClassName('wp-pagenavi')[0]){
      var wp_pagenavi = document.getElementsByClassName('wp-pagenavi')[0];
      if (document.getElementsByClassName('nextpostslink')[0]){
          wp_pagenavi.style.justifyContent = "flex-end";
      } else if (document.getElementsByClassName('previouspostslink')[0]){
          wp_pagenavi.style.justifyContent = "flex-start";
      } else {
          wp_pagenavi.style.justifyContent = "space-between";
      }
    }
  }
}
ajustaPaginacao();

//SCRIPT PARA AJUSTAR O LOCAL DOS BOTÕES DE PAGINAÇÃO NA PÁGINA BLOG FIM//

//FUNÇÃO PARA DESTACAR A PÁGINA ATUAL NO HEADER //
function currentLocation(){
    var currentLocation = window.location.href;
    var cLsplit = currentLocation.split("/");
    if (cLsplit[5] !== undefined){
      var cLsplitNomePagina = cLsplit[5].toUpperCase();
      var elementsOfHeader = document.getElementsByClassName('header-main')[0].childNodes;
      var divs = [];
      for (let i = 0; i < elementsOfHeader.length; i++){
          if (elementsOfHeader[i].nodeName == 'DIV'){
              divs.push(elementsOfHeader[i]);
          }
      }
      for (let i = 0; i < divs.length; i++){
          for (let j = 0; j < divs[i].childNodes.length; j++){
            if(divs[i].childNodes[j].innerText){
              var nomeNoHeaderComEspaco = divs[i].childNodes[j].innerText;
              var nomeNoHeaderSemEspaco = nomeNoHeaderComEspaco.split(" ");
              var nomeCerto = nomeNoHeaderSemEspaco[nomeNoHeaderSemEspaco.length - 1];
              if (cLsplitNomePagina == nomeCerto) {//divs[i].childNodes[j].innerText){
                if (divs[i].childNodes[j].innerText == 'PRODUTOS'){
                  divs[i].childNodes[j].childNodes[1].classList.add('destacado');
                } else {
                  divs[i].childNodes[j].classList.add('destacado');
                }
                
              }
            }
            
          }
      }
    }

}
currentLocation();
//FUNÇÃO PARA DESTACAR A PÁGINA ATUAL NO HEADER FIM//


//FUNÇÃO PARA DESTACAR A CATEGORIA ATUAL NO HEADER DO BLOG//




//FUNÇÃO PARA DESTACAR A CATEGORIA ATUAL NO HEADER DO BLOG FIM//

//BARRA DE PESQUISA NAS PÁGINAS DE BLOG//
$(function(){
    $('.s').keyup(function(){
      var val = $(this).val().toLowerCase();
      $(".post").hide();
      $(".post").each(function(){
        var text = $(this).text().toLowerCase();
        if(text.indexOf(val) != -1)
        {
          $(this).show();
        }
      });
    });
  });
//BARRA DE PESQUISA NAS PÁGINAS DE BLOG FIM//

//VALIDAÇÀO DE FORMULÁRIO DA PÁGINA CONTATO INÍCIO //
var Soma;
var Resto;

$.validator.addMethod("cpf_val", function (value, element) {
    Soma = 0; //se não der um valor numérico aqui, não é computado como um número. fucking javascript
    value = value.replace(".","");
    value = value.replace("-","");
    if (value == '00000000000') return (this.optional(element) || false);

    for (let i=1; i<=9; i++){
      Soma = Soma + parseInt(value.substring(i-1, i)) * (11 - i);
    } 
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(value.substring(9, 10)) ){
      return (this.optional(element) || false);
    } 
    Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(value.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
  
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(value.substring(10, 11) ) ) return (this.optional(element) || false);
    return (this.optional(element) || true);
}, 'Informe um número de CPF válido!');

$.validator.addMethod("celular", function (value, element) {
    value = value.replace("(","");
    value = value.replace(")","");
    value = value.replace("-","");
    value = value.replace(" ","").trim();
    if (value == '0000000000') {
        return (this.optional(element) || false);
    } else if (value == '00000000000') {
        return (this.optional(element) || false);
    }
    if (["00", "01", "02", "03", "04", "05", "06", "07", "08", "09", "10"].indexOf(value.substring(0, 2)) != -1){
        return (this.optional(element) || false);
        
    }

    if (value.length < 10 || value.length > 11) {
        return (this.optional(element) || false);
    }

    if (["6", "7", "8", "9"].indexOf(value.substring(3,4)) == -1) { //indexOf retorna -1 caso o valor procurado não tenha ocorrência
        //celulares começam sempre com 96, 97, 98 ou 99, entáo devo verificar se o dígito após o 9 é 6,7,8ou9 para que seja um número válido
        return (this.optional(element) || false);
    }
    return (this.optional(element) || true);

}, 'Informe um número de telefone celular válido!');


$("#sendMailForm").validate({
    rules: {
        nome: {
            required: true,
            minlength:2
        },
        cpf_campo:{
            required: true,
            cpf_val:true,
            maxlength:14
        },
        email:{
            email:true,
            required:true
        },
        telefone:{
            required:true,
            celular:true,
            minlength:10,
            maxlength:11
        },
        mensagem:{
            required: true
        },
        uf:{
          required:true
        },
        pais:{
          required:true
        },
        cidade:{
          required:true
        }

    },
    messages: {
        nome: {
           required: "Favor digitar seu nome completo.",
           minlength: "Seu nome deve conter, no mínimo, dois caracteres." 
        } ,
        mensagem:
        {
            required: "Favor inserir seu comentário."
        } ,
        cpf_campo: "Digite um CPF válido.",
        email: "Digite um e-mail ativo.",
        telefone: "Inclua o código de área!",
        pais: "Favor selecionar o seu país de residência atual.",
        uf: "Escolha sua unidade federativa.",
        cidade: "Informe sua cidade."
    }
});

//VALIDAÇÀO DE FORMULÁRIO DA PÁGINA CONTATO FIM //


//MOSTRAR INFORMAÇÕES DOS BLOG POSTS NA INDEX PAGE INÍCIO //
function mostraDetalhes(x){ 
  var div_hoverizada = document.getElementsByClassName(x.className)[0];
  div_hoverizada.classList.add('lololo');
  var div_filhos = div_hoverizada.childNodes[0].childNodes;
  for (let i = 0; i < div_filhos.length; i++){
      div_filhos[i].style.display = "block";
  }
}

function escondeDetalhes(x){
  var div_deshoverizada = document.getElementsByClassName(x.className)[0];
  div_deshoverizada.classList.remove('lololo');
  var div_filhos = div_deshoverizada.childNodes[0].childNodes;
  for (let i = 0; i < div_filhos.length; i++){
      div_filhos[i].style.display = "none";
  }
}

function addEvent(){
  if (document.getElementById('banner-terceiro-sec')){
    for (let i = 2; i < 7; i ++){
      var div_da_vez = document.getElementsByClassName(`div${i}`)[0];
      div_da_vez.addEventListener('mouseover',function(){
          mostraDetalhes(this);
      });
      div_da_vez.addEventListener('mouseout',function(){
          escondeDetalhes(this);
      });
    }
  }
}
addEvent();
//MOSTRAR INFORMAÇÒES DOS BLOG POSTS NA INDEX PAGE FIM//



// <!--SCRIPTS REFERENTES AO MAPA API HERE-->
var platform = new H.service.Platform({
  //'apikey': '8jumL2y-t1teM-OYzQWEyvMXLkXCaic8iOlq7QizPFM',
  'app_id': 'RxENeAoARr6onVUgByC6',
  'app_code': 'lL46WKilBRUoHU-9Ta_GDw'
});

const map = new H.Map(
  document.getElementById('map'),
  platform.createDefaultLayers().normal.map,
  {
      zoom: 12,
      center: { lat: -27.5887219, lng: -52.0987296 }
  }
);
window.addEventListener('resize', () => map.getViewPort().resize());
var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
const group = new H.map.Group();

const geocoderService = platform.getGeocodingService();
const routerService = platform.getRoutingService();
const geocoder = query =>{
geocoderService.geocode(
  {
      "searchtext" : query
  },
  success => {
      const location = success.Response.View[0].Result[0].Location.DisplayPosition;
      addAoGrupo(location);
      addAoMapa();
      if (group.b >= 2){
          let groupMarkers = group.getObjects();
          var x = groupMarkers[0].b;
          var xx = groupMarkers[1].b;
          calculateRoute(x,xx);
      }
  },
  error => {
      console.error(error);
  }
);
}

function calculateRoute(start,finish){
  const params = {
      mode: "fastest;car;traffic:disabled",
      waypoint0: start.lat + "," + start.lng, //lat e lng ao inves de Latitude e Longitude pois estou pegando os valores de dentro de um grop object
      waypoint1: finish.lat + "," + finish.lng,
      representation: "display"
  };
  routerService.calculateRoute(params,
      success =>{
          outputLineString = new H.geo.LineString();
          var shape = success.response.route[0].shape;
          shape.forEach(points => {
              let parts = points.split(",");
              outputLineString.pushPoint({
                  lat: parts[0],
                  lng: parts[1]
              });
          });
          const outputPolyline = new H.map.Polyline(
              outputLineString,
              {
                  style: {
                      lineWidth: 5
                  }
              });
              map.addObject(outputPolyline);
      },
      error =>{
          console.error(error);
      }
      );
}
  
function addAoGrupo(location){
  const marker = new H.map.Marker({lat: location.Latitude, lng: location.Longitude});
  group.addObject(marker);
}
function addAoMapa(){
  map.addObject(group);
}

var x = document.getElementById("coords-user");
function getLocation() {
if (navigator.geolocation) {
 navigator.geolocation.getCurrentPosition(showPosition);
}
}

function showPosition(position) {
const marker = new H.map.Marker({lat: position.coords.latitude, lng: position.coords.longitude});
group.addObject(marker);
addAoMapa();
}


getLocation();
geocoder("gaurama");
// <!--SCRIPTS REFERENTES AO MAPA API HERE FIM-->




