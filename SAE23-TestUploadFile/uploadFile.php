<?php

	// Data from client (upload)
	$msg = "";
	if (isset($_FILES["file"]["name"])) {
		$allowedExts = array("txt", "jpg", "png", "pdf", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "ods", "tex");
		$initialFilename = $_FILES["file"]["name"];
		$temp = explode(".", $_FILES["file"]["name"]);
		$extension = strtolower(end($temp));

		// Check allowed extensions
		if (in_array($extension, $allowedExts)) {

			// Check file size
			if ($_FILES["file"]["size"] < 20 * 1024 * 1024) {

				// Check errors
				if ($_FILES["file"]["error"] == 0) {
					// Generate random filename
					do {
						$randomFilename = generateRandomFilename();
					} while (file_exists("uploads/{$randomFilename}.{$extension}"));

					// Save uploaded file to disk
					move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/{$randomFilename}.{$extension}");
					$msg = "File saved in 'uploads/{$randomFilename}.{$extension}'.";
				} else {
					$msg = "Impossible d'envoyer le fichier (" . $_FILES["file"]["error"] . ").";
				}
			} else {
				$msg = "La taille du fichier doit être inférieure à 20 Mo.";
			}
		} else {
			$msg = "L'extension '.{$extension}' n'est pas autorisée. Les seules extensions autorisées sont 'txt', 'jpg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'ods', 'tex'.";
		}
	}


	echo "$msg";









	// Function : generate random filename
	function generateRandomFilename($length=20) {
		$characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomFilename = '';
		for ($i = 0 ; $i < $length ; $i++) {
			$randomFilename .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomFilename;
	}



?>
