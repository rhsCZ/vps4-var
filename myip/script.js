/*async function getipv4()
{
try {
    await fetch("https://ipv4.rhscz.eu/")
    .then(function(response) {
        return response.text();
    })
    .then(function(html) {
        var parser = new DOMParser();
        var doc = parser.parseFromString(html, "text/html");
        document.getElementById('ipv4').innerHTML = doc.querySelector('body').innerHTML;
    })
} catch (err)
{
  console.log("error is: ",err);
  document.getElementById('ipv4').innerHTML = "ipv4";
}
}*/
async function getData() {
    const url = "https://ipv4.rhscz.eu/?format=json&extended=1";
    try {
      const response = await fetch(url);
      if (!response.ok) {
        throw new Error(`Response status: ${response.status}`);
      }
  
      const json = await response.json();
      document.getElementById('ipv4').innerHTML = json.ip;
      document.getElementById('ipv4host').innerHTML = json.host;
    } catch (error) {
      console.error(error.message);
    }
}
getData();
/*async function loadpage()
{
    await getData();
    document.body.style.display='initial';
}
loadpage();*/
//getipv4();