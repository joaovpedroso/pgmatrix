<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'crevd');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** Nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Charset do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Bx4 -$j/>[l|sJ{Jef[o,aDn*#(hwj&B.TNf0EK8I^+OlvM~12t]E&:TiA]oIJAo');
define('SECURE_AUTH_KEY',  '6]5zyJD~p1>jD:+ n)L<3?Vs-C;DZhPZ6R^d=&CigZ*t9P``p6t-V]eFS?J(}YF3');
define('LOGGED_IN_KEY',    'Q7}4Yb|4@|R7HtVMW(aYLZfQ3Sy.d`@vn30`k(gQA%OGyB~u)K~I&dC]<8/e6O7^');
define('NONCE_KEY',        'YTl?Dk`9jSR*ync^!Q#%#_e)VSJ2+}vy?`$G2nK68W.war*lwo|KqaXh$}6/S~B=');
define('AUTH_SALT',        'vo4T]{Oq.&WC5jfs]<c9oUu?w^$/Ry14q4zW3q}2aj(`-WXD6Ep`N}=s W=`g0g7');
define('SECURE_AUTH_SALT', '*1#a>$9y-Ssm-y|vqvw5lMk3IX~U*;PTTxKCd>iGe-U$nf<#<phia!^hn=2pIjpz');
define('LOGGED_IN_SALT',   '6cN=AUlhh[x6}6]HBO[xOKe)l!z3I?$tk3_ADIh+k6&xOQ-0drdY4>qM[@^6|/-A');
define('NONCE_SALT',       'KEM=Dt EEaL+XG6vT{&J&~tCPh3 8>gw3%eARO^oxtJYXT!a3KFF4D0H)[oxUB#/');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix  = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
