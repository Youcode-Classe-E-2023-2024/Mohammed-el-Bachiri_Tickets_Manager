const usersDiplay = document.querySelector('.displayUsers');

fetch('../controllers/User/UserSelectAll.php')
.then(response => response.json())
.then(data => {
    data.forEach(elm => {
        usersDiplay.innerHTML += `
        <option value="${elm.userId}" class="flex rounded-sm justify-center items-center border">
            ${elm.username}
        </option>
        `;
    });
})