const data = document.querySelectorAll('#title, #description, #priorety, #status');
const btn = document.querySelector('#btn');
const succAdd = document.querySelector('#succAdd');
const failAdd = document.querySelector('#failAdd');

clear();
let x = 0;
btn.addEventListener('click', () => {

    if(data[0].value !== '' && data[1].value !== '' && data[2].value !== '' && data[3].value !== ''){
        fetch("../controllers/TicketAdd.php",{
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({userId: btn.value, t: data[0].value, d: data[1].value, s: data[2].value, p: data[3].value}),
        })
        .catch(error => console.log(error))
        clear();
        popUpSucc();
    } else {
        popUpFail();
    }
})

function clear(){ data.forEach(elm => elm.value = '')}; 
function popUpSucc(){ succAdd.style.opacity = 1; setTimeout(() => { succAdd.style.opacity = 0 }, 3000)};
function popUpFail(){ failAdd.style.opacity = 1; setTimeout(() => { failAdd.style.opacity = 0 }, 3000)};