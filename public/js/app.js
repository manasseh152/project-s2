

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