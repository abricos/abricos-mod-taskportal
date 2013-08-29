<?php
/**
 * Схема таблиц данного модуля
 * 
 * @package Abricos
 * @subpackage TaskPortal
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @author Alexander Kuzmin <roosit@abricos.org>
 */

$charset = "CHARACTER SET 'utf8' COLLATE 'utf8_general_ci'";
$updateManager = Ab_UpdateManager::$current; 
$db = Abricos::$db;
$pfx = $db->prefix;

$m->ord = 10;

$PH = array(
	'ru' => array(
		"template" => "tasktp",
		"sitename" => "Абрикос Task",
		"sitetitle" => "менеджер проектов и задач",
			
		"title" => "Проекты и задачи"
	),
	'en' => array(
		"template" => "tasktp",
		"sitename" => "Abricos Task",
		"sitetitle" => "Project Manager System",
			
		"title" => "Projects and Tasks"
	)
);

$ph = $PH[Abricos::$LNG];
// установка коробки
if (Ab_UpdateManager::$isCoreInstall){
	Abricos::$user->id = 1;
	
	// Установить шаблон tasktp
	Abricos::GetModule('sys')->GetManager();
	$sysMan = Ab_CoreSystemManager::$instance;
	$sysMan->DisableRoles();
	$sysMan->SetTemplate($ph['template']);
	$sysMan->SetSiteName($ph['sitename']);
	$sysMan->SetSiteTitle($ph['sitetitle']);
	
	// Страницы сайта
	Abricos::GetModule('sitemap')->GetManager();
	$manSitemap = SitemapManager::$instance;
	$manSitemap->DisableRoles();
	$manSitemap->MenuRemove(2);
	

	if (Abricos::$LNG == 'ru'){
	
		// коробка "Проекты и задачи"
		$modBotask = Abricos::GetModule('botask');
		if (!empty($modBotask)){
			$manBotask = $modBotask->GetManager();
		}
		if (!empty($manBotask)){
			// элемент меню
			$manSitemap->MenuSave(array(
				'nm' => 'link',
				'tl' => 'Проекты и задачи',
				'lnk' => '/bos/#app=botask/ws/showWorkspacePanel'
			));
		}
	} else {
		// коробка "Проекты и задачи"
		$modBotask = Abricos::GetModule('botask');
		if (!empty($modBotask)){
			$manBotask = $modBotask->GetManager();
		}
		if (!empty($manBotask)){
			// элемент меню
			$manSitemap->MenuSave(array(
				'nm' => 'link',
				'tl' => 'Project Manager',
				'lnk' => '/bos/#app=botask/ws/showWorkspacePanel'
			));
		}
		
	}
	
	Abricos::$user->id = 0;
}

?>