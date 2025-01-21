document.querySelectorAll(".fetchAttack").forEach((button) => {
  button.addEventListener("click", (event) => {
    handleAttack(event);
  });
});




async function handleAttack(event) {
  console.log(JSON.stringify(event.target.dataset.skill));
  await fetch("../process/processAttack.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      DataType: "json",
    },
    body: JSON.stringify({
      action: event.target.dataset.skill,
    }),
  })
    .then((response) => 
       response.json())
    .then((data) => {
      console.log(data.json);
      document.getElementById("monster-hp").textContent = data.monsterHp;
      document.getElementById("partner-hp").textContent = data.partnerHp;
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
