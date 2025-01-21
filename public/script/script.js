const attackButtons = document.querySelectorAll(".fetchAttack");

attackButtons.forEach((button) => {
  button.addEventListener("click", (event) => {
    handleAttack(event);
  });
});

function handleAttack(event) {
    return new Promise ((event) => {  
        console.log("hello")
    });
}

fetch(
  "../process/processAttack.php",
  {
    method: "POST",
  },
  {
    headers: {
      "content-type": "json",
      accept: "json",
    },
  },
  {
    body: JSON.stringify({}),
  }
).then((Response) => {
    return Response.json;
})
.then((body) => {

})
.catch((event) => {
button.innerHtmml = "L'attaque n'a pas pu etre lancé!";
});
