<?php

require_Once("Models/DoctorantManager.php");
require_Once("Models/ProfesseurManager.php");
require_Once("Models/AdministrationManager.php");
require_Once("Models/OrganisationManager.php");
require_Once("Models/PublicationManager.php");
require_Once("Models/ActiviteManager.php");
require_Once("Models/MessageManager.php");
require_Once("Models/NotificationManager.php");
require_Once("Models/AnnonceManager.php");

function renderDoct($view, array $variabls = []) {
	
	if (!file_exists($view))
		throw new Exception ("Cette vue n'existe pas");
	
	extract($variabls);	
	ob_start();	
	require($view);
	$view = ob_get_clean();	
	
	require("Views/templates/templateDoct.php");
}

function renderProf($view, array $variabls = []) {
	
	if (!file_exists($view))
		throw new Exception ("Cette vue n'existe pas");
	
	extract($variabls);	
	ob_start();	
	require($view);
	$view = ob_get_clean();	
	
	require("Views/templates/templateProf.php");
}

function renderAdm($view, array $variabls = []) {
	
	if (!file_exists($view))
		throw new Exception ("Cette vue n'existe pas");
	
	extract($variabls);	
	ob_start();	
	require($view);
	$view = ob_get_clean();	
	
	require("Views/templates/templateAdm.php");
}

function renderIndex($view, array $variabls = []) {
	
	
	if (!file_exists($view))
		throw new Exception ("Cette vue n'existe pas");
	
	extract($variabls);	
	ob_start();	
	require($view);
	$view = ob_get_clean();	
	
	require("Views/templates/templateIndex.php");
}
