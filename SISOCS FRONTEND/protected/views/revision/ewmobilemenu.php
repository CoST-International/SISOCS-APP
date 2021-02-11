<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(41, "mmi_cs_entes", $Language->MenuPhrase("41", "MenuText"), "cs_enteslist.php", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(60, "mmi_cs_programa", $Language->MenuPhrase("60", "MenuText"), "cs_programalist.php", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(65, "mmi_cs_proyecto", $Language->MenuPhrase("65", "MenuText"), "cs_proyectolist.php?cmd=resetall", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(20, "mmi_cs_calificacion", $Language->MenuPhrase("20", "MenuText"), "cs_calificacionlist.php?cmd=resetall", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(16, "mmi_cs_adjudicacion", $Language->MenuPhrase("16", "MenuText"), "cs_adjudicacionlist.php?cmd=resetall", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(32, "mmi_cs_contratacion", $Language->MenuPhrase("32", "MenuText"), "cs_contratacionlist.php?cmd=resetall", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(34, "mmi_cs_contratos", $Language->MenuPhrase("34", "MenuText"), "cs_contratoslist.php", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(54, "mmi_cs_inicio_ejecucion", $Language->MenuPhrase("54", "MenuText"), "cs_inicio_ejecucionlist.php?cmd=resetall", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(18, "mmi_cs_avances", $Language->MenuPhrase("18", "MenuText"), "cs_avanceslist.php?cmd=resetall", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(134, "mmi_vidpaths", $Language->MenuPhrase("134", "MenuText"), "vidpathslist.php", -1, "", IsLoggedIn(), FALSE);
$RootMenu->AddMenuItem(-1, "mmi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mmi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
