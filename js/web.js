$(document).ready(function(){
//==============================================================================





/*==============================================================================
	jQuery events
==============================================================================*/

	// Change wrapper and <li> color on wrapper dblclick
	jQuery("body").on("dblclick", ".wrapper", function() {
		jQuery(this).css("background-color", "white");
		jQuery("li").css("background-color", "yellow");
	});

//==============================================================================
});
// Drag & Drop pour la zone de fichier
document.addEventListener("DOMContentLoaded", function () {
    const dropZone = document.getElementById("dropZone");
    const fileInput = document.getElementById("file");

    if (!dropZone || !fileInput) return;

    // Empêche le comportement par défaut (ouvrir le fichier dans le navigateur)
    ["dragenter", "dragover", "dragleave", "drop"].forEach(eventName => {
        dropZone.addEventListener(eventName, function (e) {
            e.preventDefault();
            e.stopPropagation();
        });
    });

    // Quand on survole avec un fichier
    ["dragenter", "dragover"].forEach(eventName => {
        dropZone.addEventListener(eventName, function () {
            dropZone.classList.add("drag-over");
        });
    });

    // Quand on sort ou qu'on lâche
    ["dragleave", "drop"].forEach(eventName => {
        dropZone.addEventListener(eventName, function () {
            dropZone.classList.remove("drag-over");
        });
    });

    // Quand on dépose le fichier
    dropZone.addEventListener("drop", function (e) {
        const files = e.dataTransfer.files;
        if (files && files.length > 0) {
            // Met le fichier dans l'input file
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(files[0]); // on prend le premier fichier
            fileInput.files = dataTransfer.files;

            // Optionnel : changer le texte pour montrer le nom du fichier
            const span = dropZone.querySelector("span");
            if (span) {
                span.textContent = "Fichier sélectionné : " + files[0].name;
            }
        }
    });

    // Quand l'utilisateur choisit via le clic classique
    fileInput.addEventListener("change", function () {
        if (fileInput.files.length > 0) {
            const span = dropZone.querySelector("span");
            if (span) {
                span.textContent = "Fichier sélectionné : " + fileInput.files[0].name;
            }
        }
    });
});
