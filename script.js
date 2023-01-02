const body = document.querySelector('body');
const tableHead = document.querySelectorAll('thead');
const tableBody = document.querySelectorAll('tbody');
const tableRow = document.querySelectorAll('tr');
const tableHeader = document.querySelectorAll('th');
const days = document.querySelectorAll('td');
const arrival = document.getElementById('arrival');
const departure = document.getElementById('departure');
const totalCostContainer = document.querySelector('.total-cost');
const h3 = document.querySelector('h3');
const total = document.querySelector('.total-cost p');
const room = document.querySelector('.choose-room');

const budget = 1;
const standard = 2;
const luxury = 4;

console.log(room.value);

room.addEventListener('change', () => {
  console.log(room.value);
});

arrival.addEventListener('change', () => {
  if (arrival.value != '' && departure.value != '') {
    calculateDays();
  }
});

departure.addEventListener('change', () => {
  if (arrival.value != '' && departure.value != '') {
    calculateDays();
  }
});

const calculateDays = () => {
  console.log('Hello');
  const arrivalDay = parseInt(arrival.value.slice(-2));
  const departureDay = parseInt(departure.value.slice(-2));

  const totalDays = departureDay - arrivalDay;

  if (totalDays < 0) {
    total.textContent = `0`;
  } else {
    total.textContent = `${totalDays} $`;
  }

  console.log(totalDays);
};
