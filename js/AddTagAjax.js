const input = document.querySelector('#addTagInput');
const btn = document.querySelector('#addTagButton');
const tags = document.querySelector('#tags');


// display tags by default
function displayTags(){
    tags.innerHTML = '';
    fetch('../controllers/Tag/TagSelectAll.php',)
        .then(response => response.json())
        .then(data => {
            data.forEach(tag => {
                tags.innerHTML += `
                <option value="${tag.tagId}">${tag.tag}</option>
                `;
            });
        })
        .catch(error => console.log(error));
}

displayTags();

btn.addEventListener('click', ()=>{
    if (input.value !== '') {
        fetch('../controllers/Tag/TagAdd.php', {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify({tag: input.value}),
        })
            .then(response => response.text())
            .then(data => {
                if (data) {
                    displayTags();
                    input.value = '';
                }
            })
            .catch(error => console.log(error));
    } else {
        input.placeholder = "You Must Fill this Input";
        setTimeout(()=>{input.placeholder = 'Now Add Tag'}, 2000);
    }
})