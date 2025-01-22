document.querySelectorAll(".fetchAttack").forEach((button) => {
  button.addEventListener("click", (event) => {
    handleAttack(event);
  });
});

let battleLog = document.querySelector("#battleLog");
let combatHeader = document.querySelector("#combat-header");


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
      combatHeader.textContent = data.heroStats.level;

      // Mise à jour des barres de PV
      document.querySelector(
        "#barrePvMonster"
      ).style.width = `${data.monsterHp}%`;
      document.querySelector(
        "#barrePvPartner"
      ).style.width = `${data.partnerHp}%`;

      // Mise à jour des logs de bataille
      battleLog.innerHTML = data.battleLogs
        .map((log) => `<p>${log}</p>`)
        .join("");

      // Mettre à jour le nom et l'image du monstre après chaque attaque
      if (data.monsterName) {
        document.getElementById("monster-name").textContent = data.monsterName;
        document.querySelector(".enemy-info img").src = data.monsterImageUrl;
      }
      data.monsterSkills.forEach((skill) => {
        const skillButton = document.createElement("button");
        skillButton.classList.add("fetchAttack");
        skillButton.dataset.skill = skill;
        skillButton.textContent = skill;
        // skillsContainer.appendChild(skillButton);
      });
      if (data.partnerHp <= 0){
        handleHeader(data.battleLogs)
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function handleHeader(battleLogs){
  console.log('hello')
   // Vérifier si le dernier log contient "Game Over"
   if (battleLogs.some((log) => log.includes("Game Over!"))) {
    setTimeout(() => {
      window.location.href = "./home.php";
    }, 2000); // Redirection après 2 secondes
    return; // Stoppe le traitement pour éviter d'ajouter des éléments inutiles
  }
}
