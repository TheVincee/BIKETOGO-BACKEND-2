document.getElementById('productForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting normally

  // Get the alert placeholder
  var alertPlaceholder = document.getElementById('liveAlertPlaceholder');

  // Create the alert div
  var alertDiv = document.createElement('div');
  alertDiv.className = 'alert alert-success alert-dismissible fade show';
  alertDiv.role = 'alert';
  alertDiv.innerHTML = 'Product Updated successfully!';

  // Add close button to the alert
  var closeButton = document.createElement('button');
  closeButton.type = 'button';
  closeButton.className = 'close';
  closeButton.setAttribute('data-dismiss', 'alert');
  closeButton.setAttribute('aria-label', 'Close');
  closeButton.innerHTML = '<span aria-hidden="true">&times;</span>';

  alertDiv.appendChild(closeButton);

  // Add the alert div to the alert placeholder
  alertPlaceholder.appendChild(alertDiv);

  // Simulate form submission delay
  setTimeout(function() {
    document.getElementById('productForm').submit();
  }, 2000);
});