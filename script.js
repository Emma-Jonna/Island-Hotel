const body = document.querySelector('body');
const tableHead = document.querySelectorAll('thead');
const tableBody = document.querySelectorAll('tbody');
const tableRow = document.querySelectorAll('tr');
const tableHeader = document.querySelectorAll('th');
const days = document.querySelectorAll('td');

const colorCalendar = (calendar) => {
  for (let i = 0; i < calendar.length; i++) {
    // console.log(calendar[i].textContent);
    if (calendar[i].textContent === '') {
      calendar[i].style.backgroundColor = '#5a3e62';
    }
  }
};
/* const budgetDays = document.querySelectorAll('.budget td');
const standardDays = document.querySelectorAll('.standard td');
const luxuryDays = document.querySelectorAll('.luxury td'); */

/* days.forEach((day) => {
  if (day.textContent === '') {
    day.style.backgroundColor = '#5a3e62';
  } else {
    day.style.backgroundColor = '#7b5c75';
  }
}); */

/* for (let i = 0; i < calendar.length; i++) {
  if (calendar[i].textContent === '') {
    calendar[i].style.backgroundColor = '#5a3e62';
  }
} */
