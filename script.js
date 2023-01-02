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

let roomName = room.value;

room.addEventListener('change', () => {
  console.log(room.value);
  roomName = room.value;
  if (arrival.value != '' && departure.value != '') {
    calculateDays(roomName);
  }
});

arrival.addEventListener('change', () => {
  if (arrival.value != '' && departure.value != '') {
    calculateDays(roomName);
  }
});

departure.addEventListener('change', () => {
  if (arrival.value != '' && departure.value != '') {
    calculateDays(roomName);
  }
});

console.log(roomName);

const calculateDays = (room) => {
  console.log('Hello');
  const arrivalDay = parseInt(arrival.value.slice(-2));
  const departureDay = parseInt(departure.value.slice(-2));

  const totalDays = departureDay - arrivalDay + 1;
  let costPerDay = 0;
  let totalCost = 0;

  if (room === 'budget') {
    costPerDay = budget;
  } else if (room === 'standard') {
    costPerDay = standard;
  } else if (room === 'luxury') {
    costPerDay = luxury;
  }

  console.log(totalDays, room, costPerDay);

  if (totalDays >= 5) {
    totalCost = costPerDay * totalDays - costPerDay;
  } else {
    totalCost = costPerDay * totalDays;
  }

  console.log(totalCost);

  if (totalDays < 0) {
    total.textContent = `0`;
  } else {
    total.textContent = `${totalCost} $`;
  }
};
