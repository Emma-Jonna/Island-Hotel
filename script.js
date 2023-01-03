/* const body = document.querySelector('body');
const tableHead = document.querySelectorAll('thead');
const tableBody = document.querySelectorAll('tbody');
const tableRow = document.querySelectorAll('tr');
const tableHeader = document.querySelectorAll('th');
const days = document.querySelectorAll('td'); */
const arrival = document.getElementById('arrival');
const departure = document.getElementById('departure');
const totalCostContainer = document.querySelector('.total-cost');
const h3 = document.querySelector('h3');
const total = document.querySelector('.total-cost p');
const room = document.querySelector('.choose-room');
const features = document.querySelectorAll('.features input');

const budget = 1;
const standard = 2;
const luxury = 4;

const breakfast = 2;
const tour = 1;
const snacks = 3;

let roomName = room.value;
// console.log(roomName);

let featureCost = 0;

features.forEach((feature) => {
  feature.addEventListener('change', () => {
    console.log(feature.checked);
    console.log(feature.value);

    if (feature.value === 4) {
      featureCost = featureCost + breakfast;
    }
    if (feature.value === 5) {
      featureCost = featureCost + tour;
    }
    if (feature.value === 6) {
      featureCost = featureCost + snacks;
    }
    console.log(featureCost);
  });
});

room.addEventListener('change', () => {
  roomName = room.value;
  console.log(roomName);
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

const calculateDays = (room) => {
  const arrivalDay = parseInt(arrival.value.slice(-2));
  const departureDay = parseInt(departure.value.slice(-2));

  const totalDays = departureDay - arrivalDay + 1;
  let costPerDay = 0;
  let totalCost = 0;

  if (room === '1') {
    costPerDay = budget;
  } else if (room === '2') {
    costPerDay = standard;
  } else if (room === '3') {
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
