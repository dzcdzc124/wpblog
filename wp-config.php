<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */

//如果域名不带dantis或服务器IP地址，则为开发模式
$develop = !(strpos(strtolower($_SERVER["HTTP_HOST"]),"dantis")!==false);
define('DEVELOP', $develop);

define('DB_NAME', DEVELOP?'wordpress':'wordpress');

/** MySQL数据库用户名 */
define('DB_USER', DEVELOP?'root':'wordpress');

/** MySQL数据库密码 */
define('DB_PASSWORD', DEVELOP?'123456':'st4n8Enb8BuNRWdB');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'L2Wk(CMW](]yY!yJi37}>mz2jo=R(mf=k]%qk9_y+1.K Ix|+gQV[WAq5Mds!Ze[');
define('SECURE_AUTH_KEY',  'KVX)BE%()tHciSL3|SCh>1qrEbu%#{27VW&V-{%JHiki|;8VA3z0-s<7Z|Z5LH(l');
define('LOGGED_IN_KEY',    'DlHk.WM<0{W+~x7LJn2WgvkO!wnp[vh5!95~o0|ictfCAA:Ecl6a{.}NR1CGX`==');
define('NONCE_KEY',        'qGxK+xQ6I(X+.o(%Fu3j,6!g+(IC2-A?dHe7j C@nj=03Uvq+pm/}cxWHZ[&4_;{');
define('AUTH_SALT',        'XR~Hk~ WA5E57Y0,YaqN|n%2/w3-j|Z(Q[(-!;:>:r.G(21$n(E$|3+w8&Q3ZmyD');
define('SECURE_AUTH_SALT', 'A,b=e5d-U%EYgfA)YDv#UOh2R0r90cwAlIl%1^=-yk5;=m)P9PTsp/59: ]VmC7X');
define('LOGGED_IN_SALT',   'tERVL#tt3f[.:S_hnT{P 1`HP1OuSenGPFr9(|;{ld1~`uaxG!<#0r}?j&+N+(Ni');
define('NONCE_SALT',       'Qv:nB:Z7++d4`;z:|iAash|h[sSx))/|c:5V)]i1nvrIG$Kb)Ddxp-YIGP)Bws+c');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
