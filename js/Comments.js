document.addEventListener('DOMContentLoaded', function () {
    displayComment();
});

const comment = document.querySelector('#comment');
const ticketID = document.querySelector('#tkID');
const commentBtn = document.querySelector('#commentBtn');

commentBtn.addEventListener('click', ()=>{
    if (comment.value !== '') {
        fetch('../controllers/Comment/Add.php', {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({
                comment: comment.value,
                ticketId: ticketID.value,
            }),
        })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                comment.value = '';
                displayComment();
            })
            .catch(error => console.log(error));
    } else {
        comment.placeholder = "You Must Write a Comment !";
        setTimeout(()=>{comment.placeholder = 'Comment ...'}, 2000);
    }
})

function displayComment() {
    fetch('../controllers/Comment/SelectAll.php', {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({
            ticketId: ticketID.value,
        }),
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let html = '';
            for (let i = 0; i < data.length; i++) {
                html += `
                <div class="comment my-6 bg-gray-100 p-6 rounded flex">
                    <img src="../img/${data[i].imagePath}" alt="User Avatar" class="w-10 h-10 rounded-full mr-4">
                    <div>
                        <p class="text-black text-sm font-bold">${data[i].username}</p>
                        <p class="text-gray-700">${data[i].comment}</p>
                    </div>
                </div>
                `;
            }
            document.querySelector('#comments').innerHTML = html;
        })
        .catch(error => console.error(error));
}
setInterval(() => {
    displayComment();
}, 2000);
