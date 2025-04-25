/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

import "@fortawesome/fontawesome-free/css/all.min.css";

import "./styles/app.css";

// Pour ralentir la vidéo à 0.2x (5 fois plus lent)
document.addEventListener("DOMContentLoaded", function () {
	var video = document.getElementById("background-video");
	if (video) {
		video.playbackRate = 0.2;
	}
});
// Sélection des videoss par vignettes
document.addEventListener("DOMContentLoaded", function () {
	const vignettes = document.querySelectorAll(".video-vignette");
	const input = document.getElementById("{{ form.selectedvideo.vars.id }}");

	vignettes.forEach(function (vignette) {
		vignette.addEventListener("click", function () {
			vignettes.forEach((v) =>
				v.classList.remove("border-primary", "border", "shadow")
			);
			this.classList.add("border-primary", "border", "shadow");
			input.value = this.dataset.videoId;
		});
	});
});

// Pour la sélection de l'instrument
const instrumentVignettes = document.querySelectorAll('.instrument-vignette');
const instrumentInput = document.getElementById('{{ form.instrument.vars.id }}');
instrumentVignettes.forEach(function(vignette) {
	vignette.addEventListener('click', function() {
		instrumentVignettes.forEach(v => v.classList.remove('border-primary', 'border', 'shadow'));
		this.classList.add('border-primary', 'border', 'shadow');
		instrumentInput.value = this.dataset.instrumentId;
	});
});
// proxy
// fetch('/proxy-googleads')
//   .then(response => response.text())
//   .then(text => {
// 	console.log ('script chargé')
//     console.log('Réponse brute:', JSON.stringify(text));

//     // Nettoie tout ce qui précède le premier { ou [
//     let cleaned = text.trim().replace(/^[^\[{]+/, '');
//     console.log('Après nettoyage:', JSON.stringify(cleaned));

//     try {
//       let data = JSON.parse(cleaned);
//       console.log('Données JSON:', data);
//     } catch (e) {
//       console.error('Erreur de parsing:', e, 'Chaîne nettoyée:', cleaned);
//     }
//   })
//   .catch(error => console.error('Erreur fetch:', error));
fetch('http://localhost:8000/proxy-googleads')
  .then(response => response.json())
  .then(data => {
    console.log('Données JSON:', data);
  })
  .catch(error => console.error('Erreur:', error));


