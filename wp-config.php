<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'pnet10_db');

/** Имя пользователя MySQL */
define('DB_USER', 'pnet10_root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'Elvne2425');

/** Имя сервера MySQL */
define('DB_HOST', 'mysql5.hosting.ua');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '^<i,)|:cnT*1}vmq-1312%?rO4m{=d_;oV(CHQ;W_.vH%$m&;e;f5?6%eBf.W7@r');
define('SECURE_AUTH_KEY',  '7S<M^l@%:L-^X|C>iImJV|cq,v5PbP|,FunU>}T-R<GTrJAx7x=nf||4-a>|Ar#q');
define('LOGGED_IN_KEY',    ':B|E.h9Shw?#EBda42oGH{([I/Fn<C46uAa{d&3bjwTo|jr>W.jgU!q~o6Z2+Dy:');
define('NONCE_KEY',        '|y1!biEf!|U@RZv-#/.1s>E||+E~o_8Q4$:qo)fP_qTzG8hssMDuN#mf@X=-R!rP');
define('AUTH_SALT',        'r;r#yN3GOZZvI46vGTB:(q1Nz2H9JKR;u,S(&P{]4%`y2@n4M^kPFbGn#R% w#Fo');
define('SECURE_AUTH_SALT', 'ZzQ$HH73k~&lxG9h8-S9Ay@a-%Z)]rm.VhpZ1LTx$ytdaARtg~LC@gNp,P_p|q-U');
define('LOGGED_IN_SALT',   'N$Niv]1?8i3m*N>uwM1:x[dV;O@XA*~kwiLAqe{>^!_o2:bA42=5^DF,yh7e=ABY');
define('NONCE_SALT',       '|X!lWW``/A|z]V/pd6tuwTEZ2tn#=S`N{F4CHz,}s,XzUbB?oSDdM^E8jgz2+&<l');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
