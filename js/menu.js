const btnMenu = document.querySelector('#btnMenu');
const menu = document.querySelector('#menu');
let i = 0;
let x;
btnMenu.addEventListener('click', () => {
    x = setInterval(() => {
        menu.style.transform = `translateY(${i}px)`;
        i +=2;

        if (i === 100) {
            clearInterval(x);
        }
    }, 1);
    menu.style.zIndex = '1';
});