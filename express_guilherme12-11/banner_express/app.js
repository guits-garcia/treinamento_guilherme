const banner = document.querySelector('#logo');
const logo = document.querySelectorAll('#logo path');

for (i = 0; i < logo.length; i++){
    console.log(`A letra ${i} tem um tamanho de ${logo[i].getTotalLength()}`)
    logo[i].style.strokeDasharray = `${logo[i].getTotalLength()}`;
    logo[i].style.strokeDashoffset= `${logo[i].getTotalLength()}`;
    var calc_delay = (2 / logo.length) * i;
    logo[i].style.animation = `line-anim 2s ease forwards ${calc_delay}s `;
    banner.style.animation = "fill 0.5s ease forwards 2s"
}