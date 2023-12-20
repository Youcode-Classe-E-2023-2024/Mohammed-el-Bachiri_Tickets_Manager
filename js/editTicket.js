const editTicket = document.querySelector('#editTicket');
const body = document.querySelector('#bodyy');
const idTicket = document.querySelector('#ticketiD');
const description = document.querySelector('#description');
const ticketTitle = document.querySelector('#ticketTitle');

editTicket.addEventListener('click', ()=>
{
    fetch('../controllers/Ticket/TicketSelect.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ticketId: idTicket.getAttribute('value')}),
    })
        .then(response => response.json())
        .then(data => {
            let input = document.createElement('textarea');
            input.value = data.description;
            input.style.width = '100%';
            description.textContent = '';
            description.appendChild(input);

            let title = document.createElement('input');
            title.value = data.title;
            title.style.width = '100%';
            ticketTitle.textContent = '';
            ticketTitle.appendChild(title);

            let btn = document.createElement('button');
            btn.textContent = 'Update';
            btn.style.width = '100%';
            btn.style.backgroundColor = 'green'
            body.appendChild(btn);
            btn.addEventListener('click', ()=>{
                fetch('../controllers/Ticket/TicketEdit.php', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({
                        ticketId: idTicket.getAttribute('value'),
                        title: title.value,
                        description: input.value,
                    }),
                })
                   .then(response => response.json())
                   .then(data => console.log(data))
                   .catch(err => console.log(err))
            })
        })
        .catch(error => console.log(error))
})