const btn = document.querySelector('#fetchTickets');
const displayTickets = document.querySelector('#displayTickets');

    fetch("../controllers/TicketSelectAll.php")
    .then(response => response.json())
    .then(data => {
        data.forEach(ticket => {
            displayTickets.innerHTML += `
            <div class="container bg-white max-w-4xl px-10 py-6 mx-auto rounded-lg shadow-sm bg-gray-900">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-400">Jun 1, 2020</span>
                <p rel="noopener noreferrer" class="bg-gradient-to-l from-purple-700 px-2 py-1 font-bold rounded bg-blue-700 text-gray-900">${ticket.status}</p>
            </div>
            <div class="mt-3">
                <a rel="noopener noreferrer" href="#" class="text-2xl font-bold hover:underline">${ticket.title}</a>
                <p class="mt-2">${ticket.description}</p>
            </div>
            <div class="flex items-center justify-between mt-4">
                <a rel="noopener noreferrer" href="#" class="hover:underline text-blue-400">Read more</a>
                <div>
                    <a rel="noopener noreferrer" href="#" class="flex items-center">
                        <p class="text-sm opacity-40">Created By</p>
                        <img src="../img/${ticket.imagePath}" alt="avatar" class="object-cover w-10 h-10 mx-4 rounded-full bg-gray-500">
                        <span class="hover:underline text-gray-400"></span>
                        <p>${ticket.username}</p>
                    </a>
                </div>
            </div>
            </div>
            `;
        });
    })
    .catch(Error => console.log(Error))