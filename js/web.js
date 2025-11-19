// DRAG & DROP en jQuery
jQuery(document).ready(function () {

    var dropZone = jQuery("#dropZone");
    var fileInput = jQuery("#file");

    // Sécurité : si éléments absents → stop
    if (dropZone.length === 0 || fileInput.length === 0) return;

    // Liste des événements à bloquer
    var events = "dragenter dragover dragleave drop";

    // Empêcher le comportement navigateur
    jQuery("body").on(events, function (e) {
        e.preventDefault();
        e.stopPropagation();
    });

    // Effet visuel : quand un fichier entre dans la zone
    jQuery("body").on("dragenter dragover", "#dropZone", function () {
        dropZone.addClass("drag-over");
    });

    // Effet visuel : quand il sort ou qu'on lâche
    jQuery("body").on("dragleave drop", "#dropZone", function () {
        dropZone.removeClass("drag-over");
    });

    // Quand on dépose le fichier
    jQuery("body").on("drop", "#dropZone", function (e) {
        var files = e.originalEvent.dataTransfer.files;

        if (files && files.length > 0) {

            // Ajouter le fichier au input[type=file]
            var data = new DataTransfer();
            data.items.add(files[0]);
            fileInput[0].files = data.files;

            // Mettre à jour le texte dans la zone
            dropZone.find("span").text("Fichier: " + files[0].name);
        }
    });

    // Quand on choisit via clic
    fileInput.on("change", function () {
        if (this.files.length > 0) {
            dropZone.find("span").text("Fichier: " + this.files[0].name);
        }
    });

});
