const data = document.querySelectorAll('#title, #description, #priority, #status, #tags');
const submitTicketBtn = document.querySelector('#submitTicket');
const succAdd = document.querySelector('#succAdd');
const failAdd = document.querySelector('#failAdd');
const usersToAssign = document.querySelector('#usersToAssign');

clear();
let x = 0;
submitTicketBtn.addEventListener('click', () => {
    const selectedUsers = []; // will -> store the IDs of the selected users
    const options = usersToAssign.selectedOptions;
    for (let i = 0; i < options.length; i++) {
        selectedUsers.push(options[i].value);
    }

    if(data[0].value !== '' && data[1].value !== '' && data[2].value !== '' && data[3].value !== ''&& data[4].value !== ''){
        fetch("../controllers/Ticket/TicketAdd.php", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({
                userId: submitTicketBtn.value,
                title: data[0].value,
                desc: data[1].value,
                status: data[2].value,
                priority: data[3].value,
                tag: data[4].value,
                users: selectedUsers
            })
        })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.log(error));
        clear();
        popUpSucc();
    } else {
        popUpFail();
    }
})

function clear(){ data.forEach(elm => elm.value = '')}; 
function popUpSucc(){ succAdd.style.opacity = 1; setTimeout(() => { succAdd.style.opacity = 0 }, 3000)};
function popUpFail(){ failAdd.style.opacity = 1; setTimeout(() => { failAdd.style.opacity = 0 }, 3000)};