

function GetSWE() {
  const Test = fetch("https://mboutrecht.osiris-student.nl/student/osiris/token", {
    method: "POST",
    headers: {
        "Remote Address": "213.207.94.181:443",
        // Referrer Policy allow origin
        "Referrer Policy": "no-referrer-when-downgrade",
    },
    body: {
      "code": "n7MNx3"
    }
}).then(response => response.json())
.then(data => console.log(data));
}

// Show Password buttons with data attribute: data-show-password
const showPassword = document.querySelectorAll('[data-show-password]');
showPassword.forEach((el) => {
  // get the child button element
  const button = el.querySelector('button');
  // get the child input element
  const input = el.querySelector('input');

  // add event listener to the button
  button.addEventListener('click', (e) => {
    // prevent default behaviour
    e.preventDefault();

    // toggle the input type
    if (input.getAttribute('type') === 'password') {
      input.setAttribute('type', 'text');
    } else {
      input.setAttribute('type', 'password');
    }
  }
  );
});
