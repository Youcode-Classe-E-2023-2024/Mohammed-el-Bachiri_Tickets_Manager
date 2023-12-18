const displayTicketsDiv = document.querySelector('#displayTickets');

function displayTickets(){
    displayTicketsDiv.innerHTML = '';
    fetch("../controllers/Ticket/TicketSelectAll.php")
        .then(response => response.json())
        .then(data => {
            data.forEach(ticket => {
                displayTicketsDiv.innerHTML += `
                <div class="bg-white max-w-4xl px-10 py-6 mx-auto rounded-lg shadow-sm border mb-4">
                    <div class="flex items-center justify-between">
                        <span class="hover:underline text-sm text-gray-700 flex justify-end">#${ticket.tag}</span>
                        <div class="flex flex-col items-end">
                            <p rel="noopener noreferrer" class="bg-gradient-to-l from-purple-700  p-2 font-bold rounded bg-blue-700 text-white">${ticket.priority}</p>
                            <p rel="noopener noreferrer" class="mt-2 opacity-70 text-center text-sm bg-gradient-to-l text-black p-2 from-gray-400 font-medium rounded bg-white">${ticket.status}</p>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a rel="noopener noreferrer" href="#" class="text-black text-2xl font-bold hover:underline">${ticket.title}</a>
                        <p class="text-black mt-2">${ticket.description}</p>
                    </div>
                    <div class="flex items-center justify-between m-4">
                        <a rel="noopener noreferrer" href="#" class="hover:underline text-blue-400">Read more</a>
                        <div>
                            <a rel="noopener noreferrer" href="#" class="flex items-center">
                                <p class="text-sm opacity-40">Created By</p>
                                <img src="../img/${ticket.imagePath}" alt="avatar" class="object-cover w-10 h-10 mx-4 rounded-full bg-gray-500">
                                <p class="text-black">${ticket.username}</p>
                            </a>
                        </div>
                    </div>
                </div>
                `;
            });
        })
        .catch(Error => console.log(Error));
}
displayTickets()
setInterval(() => { displayTickets() }, 5000);