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
const form = document.querySelector('form');
const featureBreakfast = document.getElementById('breakfast');
const featureTour = document.getElementById('tour');
const featureSnacks = document.getElementById('snacks');

// console.log(featureBreakfast.value);
// console.log(featureTour.value);
// console.log(featureSnacks.value);

const budget = 1;
const standard = 2;
const luxury = 4;

const breakfast = 2;
const tour = 1;
const snacks = 3;

let roomName = room.value;
let featureCost = 0;
let roomCost = 0;
let totalCost = 0;

let breakfastIsChecked = false;
let tourIsChecked = false;
let snacksIsChecked = false;
// console.log(form);
// console.log(roomName);

features.forEach((feature) => {
  feature.addEventListener('click', () => {
    let isChecked = feature.checked;
    let featureId = parseInt(feature.value);

    console.log(isChecked, featureId);

    if (featureId === 4) {
      if (isChecked === true) {
        console.log('breakfast');
        featureCost = featureCost + breakfast;
      } else {
        console.log('no breakfast');
        featureCost = featureCost - breakfast;
      }
    }
    if (featureId === 5) {
      if (isChecked === true) {
        console.log('tour');
        featureCost = featureCost + tour;
      } else {
        console.log('no tour');
        featureCost = featureCost - tour;
      }
    }
    if (featureId === 6) {
      if (isChecked === true) {
        console.log('snacks');
        featureCost = featureCost + snacks;
      } else {
        console.log('no snacks');
        featureCost = featureCost - snacks;
      }
    }
    // console.log(featureCost);
    // totalCost = totalCost + featureCost;

    // total.textContent = `${totalCost} $`;
  });
});

/* const calculateFeatures = (feature) => {
  let isChecked = feature.checked;
  let featureId = parseInt(feature.value);

  if (featureId === 4) {
    if (isChecked === true) {
      console.log('breakfast');
      featureCost = featureCost + breakfast;
    } else {
      console.log('no breakfast');
      featureCost = featureCost - breakfast;
    }
  }
  if (featureId === 5) {
    if (isChecked === true) {
      console.log('tour');
      featureCost = featureCost + tour;
    } else {
      console.log('no tour');
      featureCost = featureCost - tour;
    }
  }
  if (featureId === 6) {
    if (isChecked === true) {
      console.log('snacks');
      featureCost = featureCost + snacks;
    } else {
      console.log('no snacks');
      featureCost = featureCost - snacks;
    }
  }
  // console.log(featureCost);
  // totalCost = totalCost + featureCost;

  // total.textContent = `${totalCost} $`;
}; */

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

  // console.log(totalDays, room, costPerDay);

  if (totalDays >= 5) {
    totalCost = costPerDay * totalDays - costPerDay;
  } else {
    totalCost = costPerDay * totalDays;
  }

  // console.log(totalCost);

  if (totalDays < 0) {
    // total.textContent = `0`;
    return 0;
  } else {
    // total.textContent = `${totalCost} $`;
    return totalCost;
  }
};

form.addEventListener('change', () => {
  roomName = room.value;
  // console.log(roomName);

  if (arrival.value != '' && departure.value != '') {
    roomCost = calculateDays(roomName);
  }

  if (arrival.value != '' && departure.value != '') {
    roomCost = calculateDays(roomName);
  }

  if (arrival.value != '' && departure.value != '') {
    roomCost = calculateDays(roomName);
  }

  console.log(featureCost);
  console.log(roomCost);

  totalCost = featureCost + roomCost;

  console.log(totalCost);

  total.textContent = `${totalCost} $`;
});
