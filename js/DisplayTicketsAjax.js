const displayTicketsDiv = document.querySelector('#displayTickets');
const all = document.querySelector('#all');
const mine = document.querySelector('#mine');
const assignedTo = document.querySelector('#assignedTo');

function displayTickets(url, urlAssignment, type = null) {
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
                    <div id="testallah"></div>
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
                if (type === 'assign'){
                    document.querySelector('#testallah').innerHTML = `<p class="text-red-400">hello</p>`;
                }
            });
            fetchUsers(urlAssignment); // display assigned users after displaying each ticket
        })
        .catch(error => console.log(error));
}

function fetchUsers(url) {
    const ticketDivs = document.querySelectorAll('.ticketDiv');
    const usersAndProfilesDivs = document.querySelectorAll('.usersAndProfiles');

    ticketDivs.forEach((elm, index) => {
        fetch(url, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ ticketId: elm.getAttribute('value')}),
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);  // Log the data to the console
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
    mine.style = "box-shadow: 0 0px 0px blue";
    assignedTo.style = "box-shadow: 0 0px 0px blue";
    all.style = "box-shadow: 0 5px 5px blue";
    displayTickets("controllers/Ticket/TicketSelectAll.php", 'controllers/Assignment/AssignmentSelectAll.php');
});

mine.addEventListener('click', () => {
    all.style = "box-shadow: 0 0px 0px blue";
    assignedTo.style = "box-shadow: 0 0px 0px blue";
    mine.style = "box-shadow: 0 5px 5px blue";
    displayTickets("controllers/Ticket/TicketSelectMine.php", 'controllers/Assignment/AssignmentSelectAll.php');
});

assignedTo.addEventListener('click', () => {
    all.style = "box-shadow: 0 0px 0px blue";
    mine.style = "box-shadow: 0 0px 0px blue";
    assignedTo.style = "box-shadow: 0 5px 5px blue";
    displayTickets("controllers/Ticket/TicketSelectAssignedTo.php", 'controllers/Assignment/AssignmentSelectAll.php', 'assign');
});

