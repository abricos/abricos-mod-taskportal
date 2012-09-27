<?php
/**
 * Схема таблиц данного модуля
 * 
 * @version $Id$
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
		// коробка "Биржа проектов"
		$modJob = Abricos::GetModule('job');
		if (!empty($modJob)){
			$modJob->GetManager();
			$manJob = JobManager::$instance;
		}
		if (!empty($manJob)){
			// элемент меню
			$m = new stdClass();
			$m->nm = 'job';
			$m->tl = 'Биржа проектов';
			$m->ord = $ord++;
			$m->id = $manSitemap->MenuAppend($m);
		
			$p = new stdClass();
			$p->mid = $m->id;
			$p->nm = 'index';
			$p->bd = '';
			$manSitemap->PageAppend($p);
	
			// разделы 
			$id = JobQuery::CategoryAppend($db, 0, "Программирование");
			JobQuery::CategoryAppend($db, $id, "Веб-программирование");
			JobQuery::CategoryAppend($db, $id, "Прикладное программирование");
			JobQuery::CategoryAppend($db, $id, "Базы данных");
			JobQuery::CategoryAppend($db, $id, "Программирование для сотовых телефонов и КПК");
			JobQuery::CategoryAppend($db, $id, "Системное программирование");
			
			$id = JobQuery::CategoryAppend($db, 0, "Дизайн");
			JobQuery::CategoryAppend($db, $id, "Баннеры");
			JobQuery::CategoryAppend($db, $id, "Дизайн сайтов");
			JobQuery::CategoryAppend($db, $id, "Логотипы");
			JobQuery::CategoryAppend($db, $id, "Интерфейсы");
			JobQuery::CategoryAppend($db, $id, "Презентации");
		}
	
		// коробка "Проекты и задачи"
		$modBotask = Abricos::GetModule('botask');
		if (!empty($modBotask)){
			$manBotask = $modBotask->GetManager();
		}
		if (!empty($manBotask)){
			// элемент меню 
			$m = new stdClass();
			$m->nm = 'link';
			$m->tl = 'Проекты и задачи';
			$m->lnk = '/bos/#app=botask/ws/showWorkspacePanel';
			$m->ord = $ord++;
			$m->id = $manSitemap->MenuAppend($m);
		}
	} else {
		$modJob = Abricos::GetModule('job');
		if (!empty($modJob)){
			$modJob->GetManager();
			$manJob = JobManager::$instance;
		}
		if (!empty($manJob)){
			// элемент меню
			$m = new stdClass();
			$m->nm = 'job';
			$m->tl = 'Exchange Project';
			$m->ord = $ord++;
			$m->id = $manSitemap->MenuAppend($m);
		
			$p = new stdClass();
			$p->mid = $m->id;
			$p->nm = 'index';
			$p->bd = '';
			$manSitemap->PageAppend($p);
		
			// разделы
			$id = JobQuery::CategoryAppend($db, 0, "Programming");
			JobQuery::CategoryAppend($db, $id, "Web Programming");
			JobQuery::CategoryAppend($db, $id, "Application Programming");
			JobQuery::CategoryAppend($db, $id, "Database");
			JobQuery::CategoryAppend($db, $id, "System Programming");
				
			$id = JobQuery::CategoryAppend($db, 0, "Design");
			JobQuery::CategoryAppend($db, $id, "Banners");
			JobQuery::CategoryAppend($db, $id, "Design Site");
			JobQuery::CategoryAppend($db, $id, "Logos");
			JobQuery::CategoryAppend($db, $id, "Interfaces");
			JobQuery::CategoryAppend($db, $id, "Presentations");
		}
		
		// коробка "Проекты и задачи"
		$modBotask = Abricos::GetModule('botask');
		if (!empty($modBotask)){
			$manBotask = $modBotask->GetManager();
		}
		if (!empty($manBotask)){
			// элемент меню
			$m = new stdClass();
			$m->nm = 'link';
			$m->tl = 'Project Manager';
			$m->lnk = '/bos/#app=botask/ws/showWorkspacePanel';
			$m->ord = $ord++;
			$m->id = $manSitemap->MenuAppend($m);
		}
		
	}
	
	Abricos::$user->id = 0;
}

/*
if (Ab_UpdateManager::$isCoreInstall && Abricos::$config['Misc']['develop_mode']){
	
	// коробка для разработчика "Биржа проектов"
	if (!empty($manJob)){
		$id = JobQuery::CategoryAppend($db, 0, "Программирование");
		JobQuery::CategoryAppend($db, $id, "Веб-программирование");
		JobQuery::CategoryAppend($db, $id, "Прикладное программирование");
		JobQuery::CategoryAppend($db, $id, "Системный администратор");
		JobQuery::CategoryAppend($db, $id, "Базы данных");
		JobQuery::CategoryAppend($db, $id, "Программирование для сотовых телефонов и КПК");
		JobQuery::CategoryAppend($db, $id, "Системное программирование");
		JobQuery::CategoryAppend($db, $id, "Программирование игр");
		JobQuery::CategoryAppend($db, $id, "Защита информации");
		JobQuery::CategoryAppend($db, $id, "Проектирование");
		JobQuery::CategoryAppend($db, $id, "Встраиваемые системы");
	
		$id = JobQuery::CategoryAppend($db, 0, "Дизайн");
		JobQuery::CategoryAppend($db, $id, "Дизайн сайтов");
		JobQuery::CategoryAppend($db, $id, "Полиграфический дизайн");
		JobQuery::CategoryAppend($db, $id, "Логотипы");
		JobQuery::CategoryAppend($db, $id, "Интерьеры");
		JobQuery::CategoryAppend($db, $id, "Фирменный стиль");
		JobQuery::CategoryAppend($db, $id, "Баннеры");
		JobQuery::CategoryAppend($db, $id, "Наружная реклама");
		JobQuery::CategoryAppend($db, $id, "Дизайн упаковки");
		JobQuery::CategoryAppend($db, $id, "Технический дизайн");
		JobQuery::CategoryAppend($db, $id, "Интерфейсы");
		JobQuery::CategoryAppend($db, $id, "Презентации");
		JobQuery::CategoryAppend($db, $id, "Промышленный дизайн");
		JobQuery::CategoryAppend($db, $id, "Ландшафтный дизайн/Генплан");
		JobQuery::CategoryAppend($db, $id, "Дизайн выставочных стендов");
		JobQuery::CategoryAppend($db, $id, "Разработка шрифтов");
		JobQuery::CategoryAppend($db, $id, "Картография");
		JobQuery::CategoryAppend($db, $id, "Дизайнер машинной вышивки");
		 
		$id = JobQuery::CategoryAppend($db, 0, "Менеджемент");
		JobQuery::CategoryAppend($db, $id, "Менеджер проектов");
		JobQuery::CategoryAppend($db, $id, "Арт-директор");
		JobQuery::CategoryAppend($db, $id, "Менеджер по продажам");
		JobQuery::CategoryAppend($db, $id, "Менеджер по персоналу");
	
		$id = JobQuery::CategoryAppend($db, 0, "Разработка сайтов");
		JobQuery::CategoryAppend($db, $id, "Веб-программирование");
		JobQuery::CategoryAppend($db, $id, "Дизайн сайтов");
		JobQuery::CategoryAppend($db, $id, "Сайт \"под ключ\"");
		JobQuery::CategoryAppend($db, $id, "Копирайтинг");
		JobQuery::CategoryAppend($db, $id, "Верстка");
		JobQuery::CategoryAppend($db, $id, "Контент-менеджер");
		JobQuery::CategoryAppend($db, $id, "Системы администрирования (CMS)");
		JobQuery::CategoryAppend($db, $id, "Менеджер проектов");
		JobQuery::CategoryAppend($db, $id, "Флеш-сайты");
		JobQuery::CategoryAppend($db, $id, "QA (тестирование)");
		JobQuery::CategoryAppend($db, $id, "Wap/PDA-сайты");
	
		$id = JobQuery::CategoryAppend($db, 0, "Арт");
		JobQuery::CategoryAppend($db, $id, "Ресунки и иллюстрации");
		JobQuery::CategoryAppend($db, $id, "Векторная графика");
		JobQuery::CategoryAppend($db, $id, "2D Анимация");
		JobQuery::CategoryAppend($db, $id, "2D Персонажи");
		JobQuery::CategoryAppend($db, $id, "Иконки");
		JobQuery::CategoryAppend($db, $id, "Хенд-мейд");
		JobQuery::CategoryAppend($db, $id, "Живопись");
		JobQuery::CategoryAppend($db, $id, "3D Иллюстрации");
		JobQuery::CategoryAppend($db, $id, "3D Персонажи");
		JobQuery::CategoryAppend($db, $id, "Комиксы");
		JobQuery::CategoryAppend($db, $id, "Трикотажный и текстильный дизайн");
		JobQuery::CategoryAppend($db, $id, "Пиксел-арт");
		JobQuery::CategoryAppend($db, $id, "Аэрография");
		JobQuery::CategoryAppend($db, $id, "Граффити");
	
		$id = JobQuery::CategoryAppend($db, 0, "Оптимизация (SEO)");
		JobQuery::CategoryAppend($db, $id, "Поисковые системы");
		JobQuery::CategoryAppend($db, $id, "Контент");
		JobQuery::CategoryAppend($db, $id, "Контекстная реклама");
		JobQuery::CategoryAppend($db, $id, "SMO");
		JobQuery::CategoryAppend($db, $id, "SEM");
		JobQuery::CategoryAppend($db, $id, "Продажа ссылок");
	
		$id = JobQuery::CategoryAppend($db, 0, "Полиграфия");
		JobQuery::CategoryAppend($db, $id, "Полиграфический дизайн");
		JobQuery::CategoryAppend($db, $id, "Полиграфическая верстка");
		JobQuery::CategoryAppend($db, $id, "Дизайн упаковки");
		JobQuery::CategoryAppend($db, $id, "Допечатная подготовка");
		JobQuery::CategoryAppend($db, $id, "Разработка шрифтов");
	
		$id = JobQuery::CategoryAppend($db, 0, "Флеш");
		JobQuery::CategoryAppend($db, $id, "Баннеры");
		JobQuery::CategoryAppend($db, $id, "Flash/Flex-программирование");
		JobQuery::CategoryAppend($db, $id, "2D Анимация");
		JobQuery::CategoryAppend($db, $id, "Флеш-графика");
		JobQuery::CategoryAppend($db, $id, "Флеш-сайты");
		JobQuery::CategoryAppend($db, $id, "Виртуальные туры");
	
		$id = JobQuery::CategoryAppend($db, 0, "Тексты");
		JobQuery::CategoryAppend($db, $id, "Копирайтинг");
		JobQuery::CategoryAppend($db, $id, "Рерайтинг");
		JobQuery::CategoryAppend($db, $id, "Статьи");
		JobQuery::CategoryAppend($db, $id, "Контент-менеджер");
		JobQuery::CategoryAppend($db, $id, "Рефераты/Курсовые/Дипломы");
		JobQuery::CategoryAppend($db, $id, "Редактирование/Корректура");
		JobQuery::CategoryAppend($db, $id, "Постинг");
		JobQuery::CategoryAppend($db, $id, "Сканирование и распознование");
		JobQuery::CategoryAppend($db, $id, "Расшифровка аудио и видеозаписей");
		JobQuery::CategoryAppend($db, $id, "Стихи/Поэмы/Эссе");
		JobQuery::CategoryAppend($db, $id, "Слоганы/Нейминг");
		JobQuery::CategoryAppend($db, $id, "Новости/Пресс-релизы");
		JobQuery::CategoryAppend($db, $id, "Тексты/Речи/Рапорты");
		JobQuery::CategoryAppend($db, $id, "Сценарии");
		JobQuery::CategoryAppend($db, $id, "ТЗ/Help/Manual");
		JobQuery::CategoryAppend($db, $id, "Резюме");
		JobQuery::CategoryAppend($db, $id, "Создание субтитров");
	
		$id = JobQuery::CategoryAppend($db, 0, "Переводы");
		JobQuery::CategoryAppend($db, $id, "Технический перевод");
		JobQuery::CategoryAppend($db, $id, "Корреспонденция/Деловая переписка");
	
		$id = JobQuery::CategoryAppend($db, 0, "3D Графика");
		JobQuery::CategoryAppend($db, $id, "Интерьеры");
		JobQuery::CategoryAppend($db, $id, "3D Моделирование");
		JobQuery::CategoryAppend($db, $id, "Видеодизайн");
		JobQuery::CategoryAppend($db, $id, "3D Анимация");
		JobQuery::CategoryAppend($db, $id, "3D Персонажи");
		JobQuery::CategoryAppend($db, $id, "Предметная визуализация");
		JobQuery::CategoryAppend($db, $id, "Экстерьеры");
		JobQuery::CategoryAppend($db, $id, "3D Иллюстрация");
	
		$id = JobQuery::CategoryAppend($db, 0, "Анимация/Мультипликация");
		JobQuery::CategoryAppend($db, $id, "Баннеры");
		JobQuery::CategoryAppend($db, $id, "2D Анимация");
		JobQuery::CategoryAppend($db, $id, "Музыка/Звуки");
		JobQuery::CategoryAppend($db, $id, "2D Персонажи");
		JobQuery::CategoryAppend($db, $id, "3D Анимация");
		JobQuery::CategoryAppend($db, $id, "3D Персонажи");
		JobQuery::CategoryAppend($db, $id, "Раскадровки");
		JobQuery::CategoryAppend($db, $id, "Сценарии для анимации");
	
		$id = JobQuery::CategoryAppend($db, 0, "Фотография");
		JobQuery::CategoryAppend($db, $id, "Ретуширование/Коллажи");
		JobQuery::CategoryAppend($db, $id, "Рекламная/Постановочная");
		JobQuery::CategoryAppend($db, $id, "Художественная/Арт");
		JobQuery::CategoryAppend($db, $id, "Мероприятия/Репортажи");
		JobQuery::CategoryAppend($db, $id, "Свадебная фотография");
		JobQuery::CategoryAppend($db, $id, "Архитектура/Интерьер");
		JobQuery::CategoryAppend($db, $id, "Модели");
	
		$id = JobQuery::CategoryAppend($db, 0, "Аудио/Видео");
		JobQuery::CategoryAppend($db, $id, "Видеомонтаж");
		JobQuery::CategoryAppend($db, $id, "Видеодизайн");
		JobQuery::CategoryAppend($db, $id, "Музыка/Звуки");
		JobQuery::CategoryAppend($db, $id, "Аудиомонтаж");
		JobQuery::CategoryAppend($db, $id, "Диктор");
		JobQuery::CategoryAppend($db, $id, "Видеосъемка");
		JobQuery::CategoryAppend($db, $id, "Свадебное видео");
		JobQuery::CategoryAppend($db, $id, "Создание субтитров");
	
		$id = JobQuery::CategoryAppend($db, 0, "Реклама/Маркетинг");
		JobQuery::CategoryAppend($db, $id, "Контекстная реклама");
		JobQuery::CategoryAppend($db, $id, "SMO");
		JobQuery::CategoryAppend($db, $id, "Рекламные концепции");
		JobQuery::CategoryAppend($db, $id, "PR-менеджмент");
		JobQuery::CategoryAppend($db, $id, "Сбор и обратобка информации");
		JobQuery::CategoryAppend($db, $id, "Исследования");
		JobQuery::CategoryAppend($db, $id, "Бизнес-планы");
		JobQuery::CategoryAppend($db, $id, "Медиапланирование");
		JobQuery::CategoryAppend($db, $id, "Организация мероприятий");
	
		$id = JobQuery::CategoryAppend($db, 0, "Разработка игр");
		JobQuery::CategoryAppend($db, $id, "Рисунки и иллюстрации");
		JobQuery::CategoryAppend($db, $id, "3D Моделирование");
		JobQuery::CategoryAppend($db, $id, "Flash/Flex-программирование");
		JobQuery::CategoryAppend($db, $id, "2D Анимация");
		JobQuery::CategoryAppend($db, $id, "3D Анимация");
		JobQuery::CategoryAppend($db, $id, "Программирование игр");
		JobQuery::CategoryAppend($db, $id, "Концепт/Эскизы");
		JobQuery::CategoryAppend($db, $id, "Пиксел-арт");
	
		$id = JobQuery::CategoryAppend($db, 0, "Архитектура/Интерьер");
		JobQuery::CategoryAppend($db, $id, "Интерьеры");
		JobQuery::CategoryAppend($db, $id, "Архитектура");
		JobQuery::CategoryAppend($db, $id, "Визуализация/3D");
		JobQuery::CategoryAppend($db, $id, "Ландшафтный дизайн/Генплан");
		JobQuery::CategoryAppend($db, $id, "Маркетирование");
	
		$id = JobQuery::CategoryAppend($db, 0, "Инжиниринг");
		JobQuery::CategoryAppend($db, $id, "Чертежи/Схемы");
		JobQuery::CategoryAppend($db, $id, "Конструкции");
		JobQuery::CategoryAppend($db, $id, "Машиностроение");
		JobQuery::CategoryAppend($db, $id, "Слаботочные сети/Автоматизация");
		JobQuery::CategoryAppend($db, $id, "Электрика");
		JobQuery::CategoryAppend($db, $id, "Отопление/Вентиляция");
		JobQuery::CategoryAppend($db, $id, "Водоснабжение/Канализация");
		JobQuery::CategoryAppend($db, $id, "Технология");
	
		$id = JobQuery::CategoryAppend($db, 0, "Консалтинг");
		JobQuery::CategoryAppend($db, $id, "Юриспруденция");
		JobQuery::CategoryAppend($db, $id, "Бухгалтерия");
		JobQuery::CategoryAppend($db, $id, "Бизнес-консультирование");
		JobQuery::CategoryAppend($db, $id, "Репетиторы/Преподаватели");
		JobQuery::CategoryAppend($db, $id, "Реклама/Маркетинг");
		JobQuery::CategoryAppend($db, $id, "Оптимизация (SEO)");
		JobQuery::CategoryAppend($db, $id, "Переводы/Тексты");
		JobQuery::CategoryAppend($db, $id, "Юзабилити");
		JobQuery::CategoryAppend($db, $id, "Разработка сайтов");
		JobQuery::CategoryAppend($db, $id, "Системы управления предприятием (ERP-системы)");
		JobQuery::CategoryAppend($db, $id, "Психолог");
		JobQuery::CategoryAppend($db, $id, "Программирование");
		JobQuery::CategoryAppend($db, $id, "Дизайн/Арт");
		JobQuery::CategoryAppend($db, $id, "Финансовый консультант");
		JobQuery::CategoryAppend($db, $id, "Путешествия");
		JobQuery::CategoryAppend($db, $id, "Стилист");
	
		$id = JobQuery::CategoryAppend($db, 0, "Обучение");
		JobQuery::CategoryAppend($db, $id, "Рефераты/Курсовые/Дипломы");
		JobQuery::CategoryAppend($db, $id, "Репетиторы/Преподаватели");
	
	
		$id = JobQuery::CategoryAppend($db, 0, "Школа", "", 0, 1);
		JobQuery::CategoryAppend($db, $id, "Алгебра");
		JobQuery::CategoryAppend($db, $id, "Геометрия");
		JobQuery::CategoryAppend($db, $id, "Физика");
		JobQuery::CategoryAppend($db, $id, "Химия");
		JobQuery::CategoryAppend($db, $id, "Прочее");
	
		$id = JobQuery::CategoryAppend($db, 0, "ВУЗ", "", 0, 1);
		JobQuery::CategoryAppend($db, $id, "Высшая математика");
		JobQuery::CategoryAppend($db, $id, "Информатика");
		JobQuery::CategoryAppend($db, $id, "Русский язык");
		JobQuery::CategoryAppend($db, $id, "Иностранный язык");
		JobQuery::CategoryAppend($db, $id, "Прочее");
	}
}
/**/

?>