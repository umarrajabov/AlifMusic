const divs = document.querySelectorAll('.hover_div');
const playBtns = document.querySelectorAll('.play_button');
const likeBtns = document.querySelectorAll('.like_button');

playBtns.forEach(i => {
    i.onmouseover = function() {
        this.childNodes[1].classList.remove('far');
        this.childNodes[1].classList.add('fa');
    }

    i.onmouseleave = function() {
        this.childNodes[1].classList.remove('fa');
        this.childNodes[1].classList.add('far');
    }
})

likeBtns.forEach(likeBtn => {
    let liked = false;
    likeBtn.onclick = function () {
        liked = !liked;

        this.childNodes[1].classList.remove(liked ? 'far' : 'fa')
        this.childNodes[1].classList.add(liked ? 'fa' : 'far')
    }
})
