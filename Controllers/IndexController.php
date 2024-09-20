<?php

require_Once("Controllers/BaseController.php");


function indexAction(){	
	$view = "Views/vIndex.php";
	$variabls = ["Doct" => count(getAll("doctorants")) ,"Prof" => count(getAll("professeurs")) ,"Pub" => count(getAll("publication")) ,"getDernNews" => get5DernNews(),"AllAnnonce"=>findAllAnnonce()] ;	
	renderIndex($view, $variabls);	
}

function ContacterAction(){
	$view = "Views/vContacter.php";	
	renderIndex($view);
}

function NonRejoindreAction(){
	$view = "Views/vNonRejoindre.php";	
	renderIndex($view);
}