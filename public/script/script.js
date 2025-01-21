document.querySelectorAll(".fetchAttack").forEach((button) => {
  button.addEventListener("click", (event) => {
    handleAttack(event);
  });
});

async function handleAttack(event) {
  await fetch("../process/processAttack.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: new URLSearchParams({
      action: event.target.dataset.skill,
    }),
  })
    .then((body) => {
      console.log(body);
      document.getElementById("monster-hp").innerHTML = body.monsterHp;
      document.getElementById("partner-hp").innerHTML = body.partnerHp;
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
