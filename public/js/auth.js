// Check if user is authenticated
function isAuthenticated() {
  return localStorage.getItem("ticketapp_session") !== null;
}

// Logout function
function logout() {
  fetch("/logout", {
    method: "POST",
    headers: {
      Authorization: localStorage.getItem("ticketapp_session"),
    },
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        localStorage.removeItem("ticketapp_session");
        window.location.href = "/";
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

// Add token to all fetch requests
const originalFetch = window.fetch;
window.fetch = function () {
  let [resource, config] = arguments;
  const token = localStorage.getItem("ticketapp_session");

  if (token) {
    config = config || {};
    config.headers = config.headers || {};
    config.headers["Authorization"] = token;
  }

  return originalFetch(resource, config);
};
