const genreEl = document.getElementById('genres');
const contentEl = document.getElementById('content');
genreEl.addEventListener('input', fetchGenre)

function fetchGenre(evt) {
    const {value, name} = evt.target;
    const url = `/app/views/getByGenres.php?genres=${value}`;
    fetch(url)
    .then(res => res.text())
    .then(res => contentEl.innerHTML = res)
}