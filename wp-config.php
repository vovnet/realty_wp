<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wp' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

define('SAVEQUERIES', true);

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '7Jm6`2t!>.)A7Nq+}vb*x|f;?D/O?Qsbu[:6Bxz,4Ac<OmfXLk=@;c{kL)Tv=2DB' );
define( 'SECURE_AUTH_KEY',  'm&- b?CfZ$e/C3kgH3VAB_DByrGI8:7r-j#d8xxLg:Pd&CKyG@C,*L[UO{0b%HsS' );
define( 'LOGGED_IN_KEY',    '?+R@dbY]yx!CSLFp)[(v$4B4-cSx.nBW=`_{C^0zj3M7e#FLL.~l]LF:t:d^Bs*<' );
define( 'NONCE_KEY',        'gD?T97{,D9k%byA591VY-u@_ ,v!95~u*fs)u}8GB!{0Sp+5l6+P@MuvdqD0yvS/' );
define( 'AUTH_SALT',        'nSfy0j(N6#%hmSj)YwYL&!ild)x%x([v{IM+Q]u]+=h&8.,HJ>aF:y}$r=NbAq~9' );
define( 'SECURE_AUTH_SALT', '(g|dpr/w)44QxWK0^l.3[}VM(@s9:W|bk35rlTguB9@0jiO7|15p7JS)lOu^NuNU' );
define( 'LOGGED_IN_SALT',   '>}0-vM VKlqo>ys6r6ofJ%#.Ir,[-RF:1w|(XwBw^L_hi/m{NY*AaF7O+&Zk:-r%' );
define( 'NONCE_SALT',       '0Pz.YyCyn_1##hh6O^a6NW.*SZ$W$.BuP7~*+F-GvB~=LV#GrUTy`v@l[p.rdrg$' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
