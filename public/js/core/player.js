const durationEl = document.querySelector('.music_duration');
const curTimeEl = document.querySelector('.current_time');
const musics = document.querySelectorAll('.play_button');
const player = document.querySelector('#music');
const trackSrc = player.getAttribute('data-src');
const download = document.querySelector('[data-id="download"]');

const loop = document.querySelector('[data-id="loop"]');
const volSeek = document.querySelector('.volumeSeeker');

const pDiv = document.querySelector('.player');

loop.onclick = function () {
  track.loop = !track.loop;
  loop.style.color = track.loop ? '#02b875' : '#fff';
};

const track = new Audio();
track.src = trackSrc;

let playing = false;

play.onclick = function (evt) {
  playing ? track.pause() : track.play();

  play.classList.toggle('fa-play-circle');
  play.classList.toggle('fa-pause-circle');

  playing = !playing;
};

track.onplay = async function () {
  const p = new Promise((res) => {
    setInterval(() => {
      res(parseTime(track.duration));
    }, 400);
  });

  const time = await p;
  durationEl.textContent = `${time.mins}:${time.seconds}`;

  const t = setInterval(() => {
    const curTime = parseTime(track.currentTime);
    curTimeEl.textContent = `${curTime.mins}:${curTime.seconds}`;

    prog.style.width = (track.currentTime * 100) / track.duration + '%';

    if (track.currentTime === track.duration) {
      clearInterval(t);
    }
  }, 1000);
};

function parseTime(time) {
  const mins = parseInt(time / 60);
  const seconds = parseInt(time % 60);
  return {
    mins: mins < 10 ? '0' + mins : mins,
    seconds: seconds < 10 ? '0' + seconds : seconds,
  };
}

for (let i = 0; i < musics.length; i++) {
  musics[i].onclick = function () {
    authorName.textContent = this.getAttribute('data-artist');
    musicStatus.textContent = this.getAttribute('data-music');
    musicImage.src = this.getAttribute('data-image');
    track.src = this.getAttribute('data-id');

    download.href = this.getAttribute('data-id');

    track.load();
    track.play();

    if (playing) {
      track.play();
    } else {
      track.pause();
    }
  };
}

proc.onclick = (e) => {
  prog.style.width = e.pageX + 'px';
  const per = (e.pageX * 100) / proc.offsetWidth;

  track.currentTime = (per * track.duration) / 100;
};

volSeek.style.top = pDiv.offsetTop - volSeek.offsetHeight + 'px';

volicon.onclick = () => {
  volSeek.classList.toggle('active');
}

volSeek.onchange = function() {
  track.volume = +this.childNodes[1].value/100;  
}