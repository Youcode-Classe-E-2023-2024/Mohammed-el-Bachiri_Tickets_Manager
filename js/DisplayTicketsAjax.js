const displayTicketsDiv = document.querySelector('#displayTickets');
const all = document.querySelector('#all');
const mine = document.querySelector('#mine');

function displayTickets(url) {
    displayTicketsDiv.innerHTML = '';
    fetch(url) // the url from the index page not from here !!!
        .then(response => response.json())
        .then(data => {
            data.forEach(ticket => {
                displayTicketsDiv.innerHTML += `
                <div value="${ticket.ticketId}" class="ticketDiv bg-white max-w-4xl px-10 py-6 mx-auto rounded-lg shadow-sm border mb-4">
                    <div class="flex justify-between">
                        <div class="usersAndProfiles flex bg-gray-100 rounded-xl p-2">
                            <!-- User names and profiles will be displayed here -->
                        </div>
                        <div class="flex items-end">
                            <p rel="noopener noreferrer" class="mt-2 mr-4 opacity-70 text-center  bg-gradient-to-l text-black p-2 from-gray-400 font-medium rounded bg-white">${ticket.status}</p>
                            <p rel="noopener noreferrer" class="bg-gradient-to-l from-purple-700  p-2 font-bold rounded bg-blue-700 text-white">${ticket.priority}</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <p class="hover:underline text-green-500 text-sm text-gray-700 my-2">#${ticket.tag}</p>
                    </div>
                    <div class="mt-3">
                        <a rel="noopener noreferrer" href="#" class="text-black text-2xl font-bold hover:underline">${ticket.title}</a>
                        <p class="text-black mt-2">${ticket.description}</p>
                    </div>
                    <div class="flex items-center justify-between m-4">
                    <form action="pages/ticketDetail.php" method="post">
                        <button rel="readMreBtn noopener noreferrer" class="hover:underline text-blue-400">Read more</button>
                        <input name="ticketId" type="hidden" value="${ticket.ticketId}">
                    </form>
                        <div>
                            <a rel="noopener noreferrer" href="#" class="flex items-center">
                                <p class="text-sm text-gray-600">Created By</p>
                                <img src="img/${ticket.imagePath}" alt="avatar" class="object-cover w-10 h-10 mx-4 rounded-full bg-gray-500">
                                <p class="text-black">${ticket.username}</p>
                            </a>
                        </div>
                    </div>
                </div>
                `;
            });
            fetchUsers(); // display assigned users after displaying each ticket
        })
        .catch(error => console.log(error));
}

function fetchUsers() {
    const ticketDivs = document.querySelectorAll('.ticketDiv');
    const usersAndProfilesDivs = document.querySelectorAll('.usersAndProfiles');

    ticketDivs.forEach((elm, index) => {
        fetch('controllers/Assignment/AssignmentSelectAll.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ticketId: elm.getAttribute('value') }),
        })
            .then(response => response.json())
            .then(data => {
                usersAndProfilesDivs[index].innerHTML = ''; // Clear existing content
                data.forEach(user => {
                    usersAndProfilesDivs[index].innerHTML += `
                        <div class="flex items-center mx-2">
                            <img src="img/defaultProfile.png" alt="user avatar" class="object-cover w-8 h-8 rounded-full bg-gray-500">
                            <p class="mx-2 text-black">${user.username}</p>
                        </div>
                    `;
                });
            })
            .catch(error => console.log(error));
    });
}
all.addEventListener('click', () =>{
    displayTickets("controllers/Ticket/TicketSelectAll.php");
});

mine.addEventListener('click', () =>{
    displayTickets("controllers/Ticket/TicketSelectMine.php");
})

