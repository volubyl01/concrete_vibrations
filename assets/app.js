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
document.addEventListener('DOMContentLoaded', () => {
    // Sélection des vidéos
    document.querySelectorAll('.video-vignette').forEach(img => {
        img.addEventListener('click', () => {
            // Retirer la sélection précédente
            document.querySelectorAll('.video-vignette.selected').forEach(el => el.classList.remove('selected'));
            // Ajouter la sélection actuelle
            img.classList.add('selected');
            // Mettre à jour le champ caché selectedvideo
            const inputSelectedVideo = document.querySelector('input[name="video_instrument[selectedvideo]"]');
            if (inputSelectedVideo) {
                inputSelectedVideo.value = img.dataset.videoId;
            }
        });
    });


// Sélection instrument
document.querySelectorAll('.instrument-vignette').forEach(img => {
    img.addEventListener('click', () => {
        // Retirer la sélection précédente
        document.querySelectorAll('.instrument-vignette.selected').forEach(el => el.classList.remove('selected'));
        // Ajouter la sélection actuelle
        img.classList.add('selected');
        // Mettre à jour le champ caché instrument
        const inputInstrument = document.querySelector('input[name="video_instrument[instrument]"]');
        if (inputInstrument) {
            inputInstrument.value = img.dataset.instrumentId;
        }
    });
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
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Données JSON:', data);
    })
    .catch(error => console.error('Erreur:', error));



