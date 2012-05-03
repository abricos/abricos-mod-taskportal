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

// установка коробки
if (Ab_UpdateManager::$isCoreInstall){
	Abricos::$user->id = 1;
	
	// Установить шаблон tasktp
	Abricos::GetModule('sys')->GetManager();
	$sysMan = Ab_CoreSystemManager::$instance;
	$sysMan->DisableRoles();
	$sysMan->SetTemplate('tasktp');
	$sysMan->SetSiteName('Абрикос Task');
	$sysMan->SetSiteTitle('система управления проектами');

	// Страницы сайта
	Abricos::GetModule('sitemap')->GetManager();
	$manSitemap = SitemapManager::$instance;
	$manSitemap->DisableRoles();
	$manSitemap->MenuRemove(2);
	
	$modJob = Abricos::GetModule('job');
	if (!empty($modJob)){
		$modJob->GetManager();
		$manJob = JobManager::$instance;
	}
	
	// коробка "Биржа проектов"
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

		// разделы биржи
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


/*
if (Ab_UpdateManager::$isCoreInstall){ 
	// разворачиваем коробку при инсталляции платформы
	
	$devMode = Abricos::$config['Misc']['develop_mode'];
	
	
	
	
	$ord = 10;
	
	$modFileManager = Abricos::GetModule('filemanager');
	
	// Интернет-магазин
	$modEshop = Abricos::GetModule('eshop');
	if (!empty($modEshop) && !empty($modFileManager)){
		$m = new stdClass();
		$m->nm = 'eshop';
		$m->tl = 'Интернет-магазин';
		$m->ord = $ord++;
		$m->id = $manSitemap->MenuAppend($m);
	
		$p = new stdClass();
		$p->mid = $m->id;
		$p->nm = 'index';
		$p->bd = '';
		$manSitemap->PageAppend($p);
		
		// Создание разделов
		$modCatalog = Abricos::GetModule('catalog');
		if (!empty($modCatalog)){
			$modCatalog->GetManager();
			$manCatalog = CatalogManager::$instance;
			
			$ordwg = 100;
			
			// Телевизоры
			$pcatid = TaskPortalCatalogAppend(0, 'tv', 'Телевизоры', "
				<p>
					В магазине бытовой техники и электроники Абрикос-Show Вы можете приобрести 
					телевизор онлайн, подобрав модель телевизора на свой вкус и в зависимости от 
					потребностей.
 				</p>
			");

			$catid = TaskPortalCatalogAppend($pcatid, 'tvlcd', 'ЖК-телевизоры', "
				<p>
					ЖК (жидко-кристалические) телевизоры  - это отличная передача звука и качества. 
					Уже давно пора давно забыть об ЭЛТ телевизорах и купить телевизор жк. 
					В нашем магазине вы сможете подобрать то, что вам нужно. 
				</p>
			");
			TaskPortalElementAppend($catid, "ЖК-телевизор Philips 19PFL3606H/60", "tvlcd001-1,tvlcd001-2,tvlcd001-3,tvlcd001-4,tvlcd001-5,tvlcd001-6", "
				<p>
					С Philips вы можете наслаждаться великолепным качеством телевизора по разумной цене — сегодня и всегда. 
					Этот ЖК-телевизор модели 19PFL3606 серии 3000 обеспечивает высокое качество изображения, имеет удобные 
					разъемы для цифрового подключения и отличается прекрасным дизайном.
				</p>
			");
			TaskPortalElementAppend($catid, "ЖК-телевизор Samsung LE-19D450G1W", "tvlcd002-1", "
				<p>
					Видео:<br>- Разрешение: 1366 x 768<br>- Технология 50 Clear Motion Rate<br>
					- Процессор: DNIe+ Picture Engine (высокий контраст)<br>
					- Технология Широкоуг. Color Enhancer Plus A8123 (Улучшение цвета)<br>
					Звук:<br>- Dolby Digital Plus, Dolby Pulse<br>- Звук: SRS Theater Sound<br>
					- DTS 2.0 + цифровой выход<br>Особенности:<br>- AnyNet+ HDMI-CEC <br>
					- Автопоиск каналов<br>- Гид по программам (EPG)<br>- Телетекст (TTXT) <br>
					- Язык меню (29 европейских языков)<br>- Автоконтроль уровня громкость (AVL)<br>
					- Автовыключение питания<br>- Часы<br>- Игровой режим <br>- Режим \"Картинка-в-картинке\" (1 тюнер PIP)<br>
					Интерфейсы:<br>- HDMI<br>- USB <br>- Компонентный вход (Y/Pb/Pr)<br>
					- Компонентный вход (Y/Pb/Pr) 1 (для Component Y)<br>- Цифровой аудиовыход (оптический) x 1 (боковой)<br>
					- Вход для сигнала с ПК (D-sub)<br>- CI слот<br>- Scart<br>- Наушники<br>- РС Аудиовход (Mini Jack)<br>
					- DVI аудиовход (Mini Jack) x 1 ( для PC )					
				</p>
			");
			TaskPortalElementAppend($catid, "ЖК-телевизор LG 22LK330", "tvlcd003-1", '', array('new'=>1, 'hit'=>1));
			TaskPortalElementAppend($catid, "ЖК-телевизор Toshiba 32LV833RB", "tvlcd004-1");
			TaskPortalElementAppend($catid, "ЖК-телевизор LG 32LD320B", "tvlcd005-1");
			TaskPortalElementAppend($catid, "ЖК-телевизор Philips 56PFL9954H/12", "tvlcd006-1");
			TaskPortalElementAppend($catid, "ЖК-телевизор Samsung LE-37A686M1F", "tvlcd007-1");
			TaskPortalElementAppend($catid, "ЖК-телевизор Philips 47PFL4606H/60");
				

			$catid = TaskPortalCatalogAppend($pcatid, 'tvplz', 'Плазменные телевизоры');
			TaskPortalElementAppend($catid, "Плазменный телевизор Panasonic TX-PR42UT30");

			$catid = TaskPortalCatalogAppend($pcatid, 'tvled', 'LED телевизоры');
			TaskPortalElementAppend($catid, "LED телевизоры Toshiba 26EL833R");
				
			$catid = TaskPortalCatalogAppend($pcatid, 'tvkinescope', 'Кинескопные телевизоры', "
				<p>
					Очень большие и тяжелые телевизоры прошлого века. К тому же потребляют
					существенное кол-во электроэнергии.
				</p>
			");
			TaskPortalElementAppend($catid, "Кинескопный телевизор Supra CTV-14011");
				
			$catid = TaskPortalCatalogAppend($pcatid, 'tvsat', 'Оборудование для спутникового и цифрового TV');
			TaskPortalElementAppend($catid, "Комплект цифрового ТВ \"Vipr\" 6 месяцев");

			$catid = TaskPortalCatalogAppend($pcatid, 'tvstend', 'Кронштейны и TV стенды');
			TaskPortalElementAppend($catid, "TV стенд Holder LCDS - 5039");
				
			$catid = TaskPortalCatalogAppend($pcatid, 'tvprop', 'Аксессуары для ТВ');
			TaskPortalElementAppend($catid, "Philips SWV1431CN/10");
		
			// Крупная бытовая техника
			$pcatid = TaskPortalCatalogAppend(0, 'bbtec', 'Крупная бытовая техника', "
				<p>
					Крупная бытовая техника делает нашу жизнь проще, экономя наше время, силы. 
					Современные нновационные технологии применяемые в бытовой техники сохраняет 
					окружающую среду и наше здоровье. 
				</p>
			");

			$catid = TaskPortalCatalogAppend($pcatid, 'bbtecholod', 'Холодильники');
			$catid = TaskPortalCatalogAppend($pcatid, 'bbtecmoroz', 'Морозильные камеры');
			$catid = TaskPortalCatalogAppend($pcatid, 'bbtecstirka', 'Стиральные машины');
				

			// Компьютеры
			$pcatid = TaskPortalCatalogAppend(0, 'pctec', 'Компьютерная техника');
			$catid = TaskPortalCatalogAppend($pcatid, 'pctecpc', 'Компьютеры');
			$catid = TaskPortalCatalogAppend($pcatid, 'pctecnout', 'Ноутбуки');
			$catid = TaskPortalCatalogAppend($pcatid, 'pctecprint', 'Принтеры');
			$catid = TaskPortalCatalogAppend($pcatid, 'pctecscan', 'Сканеры');
			$catid = TaskPortalCatalogAppend($pcatid, 'pctecmonlcd', 'ЖК-мониторы');
				
			if ($devMode){
				// Режим разработчика
				// сюда можно включить специфичную инсталляцию 
			}
		}
	}
	
	// Контакты
	$m = new stdClass();
	$m->nm = 'contacts';
	$m->tl = 'Контакты';
	$m->ord = $ord++;
	$m->id = $manSitemap->MenuAppend($m);
	
	$p = new stdClass();
	$p->mid = $m->id;
	$p->nm = 'index';
	$p->bd = "
		<h2>Контакты</h2>
		
		<p>
			Компания <i>Абрикос Shop</i>
		</p>
		
		<p>101000, г.Москва, Красная площадь, дом 1</p>
		
		<p>
			Тел.: 101-00-01<br>
			Факс. 101-00-02
		</p>
	";
	$manSitemap->PageAppend($p);
	
	Abricos::$user->id = 0;
}


/**/

?>