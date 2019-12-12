<?php
/**
 * A configuração de base do WordPress
 *
 * O script de criação do ficheiro wp-config.php usa este ficheiro durante
 * a instalação. Não precisa de usar o site pode copiar este ficheiro como
 * "wp-config.php" e preencher os valores
 *
 * Este ficheiro contém as seguintes variáveis:
 *
 * * Definições de MySQL
 * * Chaves secretas
 * * Prefixo das tabelas nas base de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Definições de MySQL - obtenha estes dados do seu serviço de alojamento** //
/** O nome da base de dados do WordPress */
define('DB_NAME', 'projetoguilherme');

/** O nome do utilizador de MySQL */
define('DB_USER', 'root');

/** A password do utilizador de MySQL  */
define('DB_PASSWORD', 'd0r1t0s1mp10');

/** O nome do serviddor de  MySQL  */
define('DB_HOST', '192.168.10.115');

/** O "Database Charset" a usar na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O "Database Collate type". Se tem dúvidas não mude. */
define('DB_COLLATE', '');

/**#@+
 * Chaves Únicas de Autenticação.
 *
 * Mude para frases únicas e diferentes!
 * Pode gerar frases automáticamente em {@link https://api.wordpress.org/secret-key/1.1/salt/ Serviço de chaves secretas de WordPress.org}
 * Pode mudar estes valores em qualquer altura para invalidar todos os cookies existentes o que terá como resultado obrigar todos os utilizadores a voltarem a fazer login
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*;N$+kN_Zijsj&IDt6u_2eWUR/}[>vt]_ifos$te6A`DBu9G`6IFl#*UySrt:+B,');
define('SECURE_AUTH_KEY',  'Tv6a>Fi(<dA.@[0eztKX^iz=3:gt[&JEN|coVS>{$g0vgmXIrO7B^<3CZ(q}iv3M');
define('LOGGED_IN_KEY',    'D!<-uO7~tm;48_~-);uh{$t0NpYHctfQs_N[u9):^CTr=GF.o8-#>1/YCPy.`~~4');
define('NONCE_KEY',        'B=&#csKMsYe>2L5NeVHgwcIIgYHnsHQ=Lf::VWe29e`e9~.1en@,1G%pPBdmWKg<');
define('AUTH_SALT',        '/M +N h$|q&BwG{82``D@_2*i1=z]q8(vhz=V~5djY8^`b4<WvM2Lqz~-[6/Ulu`');
define('SECURE_AUTH_SALT', 'F cl1|Dr6qid/{E_Io 8Qm#B( UiQZ~x[+t:+&%gI_CA/dCQ,>ZrX[rk}AsDO.;R');
define('LOGGED_IN_SALT',   '8!4@4k>;Z=~u&g@*9=A}Z&SJ:=k8%bPnYZ{@w=9lC0T0hZ76&t=-z~g3A`r*nB=S');
define('NONCE_SALT',       '^PNRT~4kV$jkb~WEQPT1A=An<U@6Gcp(N1T=x8SxK,$:e53KR:^$/C]g_sj3Z9:e');

/**#@-*/

/**
 * Prefixo das tabelas de WordPress.
 *
 * Pode suportar múltiplas instalações numa só base de dados, ao dar a cada
 * instalação um prefixo único. Só algarismos, letras e underscores, por favor!
 */
$table_prefix  = 'db_';

/**
 * Para developers: WordPress em modo debugging.
 *
 * Mude isto para true para mostrar avisos enquanto estiver a testar.
 * É vivamente recomendado aos autores de temas e plugins usarem WP_DEBUG
 * no seu ambiente de desenvolvimento.
 *
 * Para mais informações sobre outras constantes que pode usar,
 * visite o Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* E é tudo. Pare de editar! */

/** Caminho absoluto para a pasta do WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Define as variáveis do WordPress e ficheiros a incluir. */
require_once(ABSPATH . 'wp-settings.php');
