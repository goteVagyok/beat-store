const card = document.querySelector('.log_reg-card');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');

loginLink.addEventListener('click', ()=>{
    card.classList.add('active');         //hozzáadja a .log_reg-card-hoz az active class-t rányomásra
});
registerLink.addEventListener('click', ()=>{
    card.classList.remove('active');      //itt meg elveszi
});