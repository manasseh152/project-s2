

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

function showPassword() {
  var x = document.getElementById("wachtwoord");
  if (x.type === "password") {
    x.type = "text";
    document.getElementById("showButton").innerHTML = "Hide";
  } else {
    x.type = "password";
    document.getElementById("showButton").innerHTML = "Show";
  }
}

function showConfirmPassword() {
  var x = document.getElementById("wachtwoord2");
  if (x.type === "password") {
    x.type = "text";
    document.getElementById("showButton2").innerHTML = "Hide";
  } else {
    x.type = "password";
    document.getElementById("showButton2").innerHTML = "Show";
  }
}