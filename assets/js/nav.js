const sidebar = document.querySelector('.sidebar');
const mainContent = document.querySelector('.main-content');
document.querySelector('button').onclick = function () {
  sidebar.classList.toggle('sidebar_closed');
  mainContent.classList.toggle('main-content_large')
}