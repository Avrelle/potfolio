let link = document.querySelector("#link");
let burger = document.querySelector('#burger');
let menu = document.querySelector('.navbar-links-mobile ul');
link.onclick = function(){
    burger.classList.toggle('open')
    menu.classList.toggle('open')
}