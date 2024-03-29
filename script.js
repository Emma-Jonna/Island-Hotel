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
const adminFeatures = document.querySelectorAll('.admin-feature input');

// rooms
const budget = 3;
const standard = 5;
const luxury = 7;

//features
const breakfast = 4;
const tour = 5;
const snacks = 3;

let roomName = room.value;
let featureCost = 0;
let roomCost = 0;
let totalCost = 0;

// eventlistener for every feature that either adds or removes from the total cost
features.forEach((feature) => {
  feature.addEventListener('click', () => {
    let isChecked = feature.checked;
    let featureId = parseInt(feature.value);

    if (featureId === 4) {
      if (isChecked === true) {
        featureCost = featureCost + breakfast;
      } else {
        featureCost = featureCost - breakfast;
      }
    }

    if (featureId === 5) {
      if (isChecked === true) {
        featureCost = featureCost + tour;
      } else {
        featureCost = featureCost - tour;
      }
    }

    if (featureId === 6) {
      if (isChecked === true) {
        featureCost = featureCost + snacks;
      } else {
        featureCost = featureCost - snacks;
      }
    }

    adminFeatures.forEach((admin) => {
      if (featureId === parseInt(admin.value)) {
        if (isChecked === true) {
          featureCost = featureCost + parseInt(admin.dataset.price);
        } else {
          featureCost = featureCost - parseInt(admin.dataset.price);
        }
      }
    });
  });
});

// calculates the total cost of the room
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

  if (totalDays >= 4) {
    totalCost = costPerDay * totalDays - costPerDay;
  } else {
    totalCost = costPerDay * totalDays;
  }

  if (totalDays < 0) {
    return 0;
  } else {
    return totalCost;
  }
};

// eventlistener that listen to if anything changes and updates the total cost in real time
form.addEventListener('change', () => {
  roomName = room.value;

  if (arrival.value != '' && departure.value != '') {
    roomCost = calculateDays(roomName);
  }

  if (arrival.value != '' && departure.value != '') {
    roomCost = calculateDays(roomName);
  }

  if (arrival.value != '' && departure.value != '') {
    roomCost = calculateDays(roomName);
  }

  totalCost = featureCost + roomCost;

  total.textContent = `${totalCost} $`;
});
