const closeTicket = document.querySelector('#closeTicket');
const ID = document.querySelector('#ticketiD');
const status = document.querySelector('#status');

closeTicket.addEventListener('click', () => {
    fetch('../controllers/Ticket/CloseTicket.php', {
        headers: { "Content-Type": "application/json" },
        method: "POST",
        body: JSON.stringify({
            ticketId: ID.value,
        }),
    })
        .then(response => response.json())
        .then(data => {
            status.innerHTML = 'Closed';
            status.style.color = 'red';
        })
        .catch(error => console.log(error))
});
