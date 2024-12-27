// Function to close an alert element
function closeAlert(el) {
  const element = el;
  let selector = element.dataset.dismissTarget;

  if (!selector) {
    selector = element.href && element.href.split("#")[1]; // strip for older browsers
  }

  const target = document.querySelector(selector);

  if (event) {
    event.preventDefault();
  }

  if (!target) {
    target = element.classList.contains("alert") ? element : element.parentNode;
  }

  const closeEvent = new Event("close.alert");
  target.dispatchEvent(closeEvent);

  if (closeEvent.defaultPrevented) return;

  target.classList.remove("in");

  function removeElement() {
    const removedEvent = new Event("closed.alert");
    target.dispatchEvent(removedEvent);
    target.remove();
  }

  if (target.classList.contains("fade") && document.body.style.transitionProperty) {
    target.addEventListener("transitionend", removeElement);
    target.style.transition = "opacity 0.15s ease-out"; // Simulate transition
  } else {
    removeElement();
  }
}

// Function to initialize and handle clicks on alert elements
function alertPlugin(element, option) {
  const alertElement = element;
  let data = alertElement.dataset.alert;

  if (!data) {
    alertElement.dataset.alert = (data = {}); // Empty object for data
    data.close = closeAlert.bind(null, alertElement); // Bind closeAlert to element
  }

  if (typeof option === "string" && data[option]) {
    data[option](); // Call the appropriate method
  }
}

// Restore previous $.fn.alert if it existed
const oldAlert = window.alert; // Store previous function

window.alertPlugin = alertPlugin; // Assign the plugin function

// Attach click event listener for closing alerts
document.addEventListener("click", (event) => {
  if (event.target.matches('[data-dismiss="alert"]')) {
    closeAlert(event.target);
  }
});

// Your existing code to prepend and show the admin bar
document.getElementById("bavotasan-admin-bar").prependTo(document.getElementById("wpwrap")).style.display = "block";

// Your existing code to handle close button click with AJAX request
document.querySelector(".close").addEventListener("click", (event) => {
  event.preventDefault();

  fetch(ajaxurl, {
    method: "POST",
    body: JSON.stringify({ action: "bavotasan_hide_adminbar" }),
    headers: { "Content-Type": "application/json" },
  })
    .then((response) => response.json())
    .then((data) => {
      if (data === "1") return true;
    });
}); 
