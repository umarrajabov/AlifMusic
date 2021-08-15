window.addEventListener('DOMContentLoaded', () => {
  const state = {
    whiteList: []
  };

  document.getElementById('file').addEventListener('change', evt => {
    evt.preventDefault();

    const fileName = evt.target.name;
    switch (fileName) {
      case 'image':
        state.whiteList = ['png', 'jpg', 'jpeg']
        break;

      case 'music':
        state.whiteList = ['mp3', 'ogg', 'wav'];
        break;
    }

    const val = evt.target.value.split('\\').pop();
    const valid = val.split('.').pop().toLowerCase();
    if (!state.whiteList.includes(valid)) {
      document.querySelector('.desc').textContent = 'неверный формат :(';
      return;
    }
    document.querySelector('.desc').textContent = `Файл выбран: ${val}`;
  });
});