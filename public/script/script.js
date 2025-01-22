document.querySelectorAll(".fetchAttack").forEach((button) => {
  button.addEventListener("click", (event) => {
    handleAttack(event);
  });
});
let battleLog = document.querySelector("#battleLog");
console.log(battleLog);

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
    .then((response) => response.json())
    .then((data) => {
      console.log(data.json);

      // Validation des PV pour s'assurer qu'ils restent entre 0 et 100
      data.monsterHp = Math.max(0, Math.min(100, data.monsterHp));
      data.partnerHp = Math.max(0, Math.min(100, data.partnerHp));

      document.getElementById("monster-hp").textContent = data.monsterHp;
      document.getElementById("partner-hp").textContent = data.partnerHp;

      // Mise à jour des barres de PV
      document.querySelector("#barrePvMonster").style.width = `${data.monsterHp}%`;
      document.querySelector("#barrePvPartner").style.width = `${data.partnerHp}%`;

      // Mise à jour des logs de bataille
      battleLog.innerHTML = data.battleLogs
        .map((log) => `<p>${log}</p>`)
        .join("");

      // Mettre à jour le nom et l'image du monstre après chaque attaque
      if (data.monsterName) {
        document.getElementById("monster-name").textContent = data.monsterName;
        document.querySelector(".enemy-info img").src = data.monsterImageUrl;
      }
      data.monsterSkills.forEach(skill => {
        const skillButton = document.createElement('button');
        skillButton.classList.add('fetchAttack');
        skillButton.dataset.skill = skill;
        skillButton.textContent = skill;
        skillsContainer.appendChild(skillButton);
      });
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}
