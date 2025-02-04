let buttons = document.querySelectorAll(".fetchAttack")
buttons.forEach(function(button) {
  button.addEventListener("click", function(event) {
    const action = event.target.dataset.skill;
// console.log(event.target);

    // Désactive les boutons pendant que les sons sont joués
    buttons.forEach(function(btn) {
      btn.disabled = true;
    });

    // Joue les sons d'attaque en séquence
    playAttackSound(action);

    // Effectue l'attaque après que les sons soient terminés
    beepAudio.onended = function() {
      handleAttack(event);

      // Réactive les boutons une fois l'attaque terminée
      buttons.forEach(function(btn) {
        btn.disabled = false;
      });
    };
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
      if (data.partnerHp <= 0) {
        handleHeader(data.battleLogs);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function handleHeader(battleLogs) {
  console.log("hello");
  // Vérifier si le dernier log contient "Game Over"
  if (battleLogs.some((log) => log.includes("Game Over!"))) {
    setTimeout(() => {
      window.location.href = "./home.php";
    }, 2000); // Redirection après 2 secondes
    return; // Stoppe le traitement pour éviter d'ajouter des éléments inutiles
  }
}
  // Sélection des éléments audio et boutons
  const playButton = document.getElementById("playButton");
  const muteButton = document.getElementById("muteButton");
  const audio = document.getElementById("myAudio");



  // Fonction pour lancer la musique au clic sur le bouton Play
  playButton.addEventListener("click", () => {
    audio.muted = false; // Unmute audio avant de jouer
    const playPromise = audio.play();

    if (playPromise !== undefined) {
      playPromise.then(_ => {
        // Lecture automatique démarrée avec succès !
        console.log('Audio played successfully');
      })
      .catch(error => {
        // La lecture automatique a échoué
        console.log('Audio playing failed', error);
      });
    }
  });

  // Fonction pour basculer entre mute et unmute
  muteButton.addEventListener("click", () => {
    audio.muted = !audio.muted; // Si l'audio est muet, on l'active, et vice versa

    if (audio.muted) {
      console.log('Audio is muted');
    } else {
      console.log('Audio is unmuted');
    }
  });

  // Écoute de la fin de l'audio
  audio.addEventListener('ended', () => {
    console.log('Audio finished playing');
  });



let boutonPlays = document.querySelectorAll(".beep");
let boutonFuite =document.querySelector(".fuite")


// Sélectionner les éléments audio
let beepAudio = document.getElementById("beepAudio");
let fuiteAudio = document.getElementById("fuiteAudio");
let soinAudio = document.getElementById("soinAudio");
let fightAudio = document.getElementById("fightAudio");

console.log(soinAudio,fightAudio);

// Jouer beep.mp3 quand un bouton avec la classe .beep est cliqué
boutonPlays.forEach(bouton => {
  bouton.addEventListener("click", () => {
    beepAudio.currentTime = 0; // Rewind to the start
    beepAudio.play(); // Joue le son beep.mp3
  });
});

// Jouer fuite.mp3 quand le bouton avec la classe .fuite est cliqué
boutonFuite.addEventListener("click", () => {
  event.preventDefault(); // Empêche la redirection ou le comportement par défaut
  fuiteAudio.currentTime = 0; // Rewind to the start
  fuiteAudio.play(); // Joue le son fuite.mp3
    // Redirige après un court délai pour permettre à l'audio de démarrer
    setTimeout(() => {
      window.location.href = './home.php'; // Remplace par ta redirection
    }, 1100); // Délai de 500ms (ajuste en fonction de la longueur du son)
});

// Fonction qui gère le son de l'attaque, sans interférer avec le beep
function playAttackSound(action) {
  if (action == "Soin"){
   var soundToPlay = soinAudio.play();
  } else {
    var soundToPlay =  fightAudio.play();
  }
  // Joue le son beep d'abord
  beepAudio.currentTime = 0;
  beepAudio.play();
 // Après la durée du beep, joue le son de l'attaque
 beepAudio.onended = function() {
  setTimeout(() => {
    soundToPlay.currentTime = 0;  // Rewind du son d'attaque
    soundToPlay.play();  // Joue le son d'attaque
  }, beepAudio.duration);  // Attends la durée du beep avant de jouer l'attaque
};
}

audio.volume = 0.3; 
beepAudio.volume = 0.5; 
fuiteAudio.volume = 0.5; 
soinAudio.volume = 0.5; 
fightAudio.volume = 0.5;