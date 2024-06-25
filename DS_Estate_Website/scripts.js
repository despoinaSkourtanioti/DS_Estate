document.getElementById('create-listing-form').addEventListener('submit', function(event) {
  // Prevent form submission
  event.preventDefault();

  // Validate the form
  const isValid = validateForm();

  // If the form is valid, submit it
  if (isValid) {
      this.submit();
  }
});

document.getElementById('create-listing-form').addEventListener('submit', function(event) {
  // Prevent form submission
  event.preventDefault();

  // Validate the form
  const isValid = validateForm();

  // If the form is valid, submit it
  if (isValid) {
      this.submit();
  }
});

function validateForm() {
  const title = document.getElementById('title');
  const area = document.getElementById('area');
  const rooms = document.getElementById('rooms');
  const pricePerNight = document.getElementById('price_per_night');

  // Patterns
  const titlePattern = /^[A-Za-z0-9\s]+$/;
  const areaPattern = /^[A-Za-z\s]+$/;
  const roomsPattern = /^[1-9][0-9]*$/;
  const pricePattern = /^[1-9][0-9]*$/;

  // Clear old error messages
  clearErrors();

  // Validate each field
  let isValid = true;

  if (!titlePattern.test(title.value)) {
      showError('title-error', 'Title must contain only letters, numbers, and spaces.');
      isValid = false;
  }

  if (!areaPattern.test(area.value)) {
      showError('area-error', 'Area must contain only letters and spaces.');
      isValid = false;
  }

  if (!roomsPattern.test(rooms.value)) {
      showError('rooms-error', 'Rooms must be a positive integer.');
      isValid = false;
  }

  if (!pricePattern.test(pricePerNight.value)) {
      showError('price_per_night-error', 'Price per night must be a positive number.');
      isValid = false;
  }

  return isValid;
}

function clearErrors() {
  document.getElementById('title-error').innerText = '';
  document.getElementById('area-error').innerText = '';
  document.getElementById('rooms-error').innerText = '';
  document.getElementById('price_per_night-error').innerText = '';
}

function showError(elementId, message) {
  document.getElementById(elementId).innerText = message;
}