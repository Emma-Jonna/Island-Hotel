const body = document.querySelector('body');
const tableHead = document.querySelectorAll('thead');
const tableBody = document.querySelectorAll('tbody');
const tableRow = document.querySelectorAll('tr');
const tableHeader = document.querySelectorAll('th');
const days = document.querySelectorAll('td');

days.forEach((day) => {
  if (day.textContent === '') {
    day.style.backgroundColor = '#5a3e62';
  } else {
    day.style.backgroundColor = '#7b5c75';
  }
});
