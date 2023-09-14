<?php

/**
 * Plugin Name: WP Cadastro Personalizado
 * Plugin URI: https://ousedigital.com.br
 * Description: Plugin responsável por criar o CTP Imagens
 * Author: FelipeCorrea
 * version: 1.0.0
 */

namespace WPCADASTROPERSONALIZADO;

require_once dirname(__FILE__) . '/class-tgm-plugin-activation.php';
require __DIR__ . '/vendor/autoload.php';

define('WP_PLUGIN_URL_BASE', WP_PLUGIN_URL . '/wp-cadastro-personalizado');
define('WP_PLUGIN_URL_BASE_ASSETS', WP_PLUGIN_URL . '/wp-cadastro-personalizado/views/assets');
define('VIEWS_PATH', WP_PLUGIN_DIR . '/wp-cadastro-personalizado/views');

add_action('tgmpa_register', function () {
    $plugins = array(
        array(
            'name' => 'CMB2',
            'slug' => 'cmb2',
            'required' => true,
        )
    );

    $config = array(
        'id' => 'cmb2',
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'parent_slug' => 'plugins.php',
        'capability' => 'manage_options',
        'has_notices' => true,
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => false,
        'message' => '',
        'strings'      => array(
            'page_title'                      => __( 'Instalar plugin obrigatório', 'wp-cadastro-personalizado' ),
            'menu_title'                      => __( 'Instalar plugins', 'wp-cadastro-personalizado' ),
            'installing'                      => __( 'Instalar plugin: %s', 'wp-cadastro-personalizado' ),
            'updating'                        => __( 'Atualizar Plugin: %s', 'wp-cadastro-personalizado' ),
            'oops'                            => __( 'Something went wrong with the plugin API.', 'wp-cadastro-personalizado' ),
            'notice_can_install_required'     => _n_noop(
                'Este tema requer o seguinte plugin: %1$s.',
                'Este tema requer os seguintes plugins: %1$s.',
                'wp-cadastro-personalizado'
            ),
            'notice_can_install_recommended'  => _n_noop(
                'This theme recommends the following plugin: %1$s.',
                'This theme recommends the following plugins: %1$s.',
                'wp-cadastro-personalizado'
            ),
            'notice_ask_to_update'            => _n_noop(
                'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
                'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
                'wp-cadastro-personalizado'
            ),
            'notice_ask_to_update_maybe'      => _n_noop(
                'There is an update available for: %1$s.',
                'There are updates available for the following plugins: %1$s.',
                'wp-cadastro-personalizado'
            ),
            'notice_can_activate_required'    => _n_noop(
                'O seguinte plug-in obrigatório está atualmente inativo: %1$s.',
                'Os seguintes plugins obrigatórios estão atualmente inativo: %1$s.',
                'wp-cadastro-personalizado'
            ),
            'notice_can_activate_recommended' => _n_noop(
                'The following recommended plugin is currently inactive: %1$s.',
                'The following recommended plugins are currently inactive: %1$s.',
                'wp-cadastro-personalizado'
            ),
            'install_link'                    => _n_noop(
                'Instalar Plugin',
                'Instalar Plugins',
                'wp-cadastro-personalizado'
            ),
            'update_link' 					  => _n_noop(
                'Atualizar Plugin',
                'Atualizar Plugins',
                'wp-cadastro-personalizado'
            ),
            'activate_link'                   => _n_noop(
                'Ativar Plugin',
                'Ativar Plugins',
                'wp-cadastro-personalizado'
            ),
            'return'                          => __( 'Return to Required Plugins Installer', 'wp-cadastro-personalizado' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'wp-cadastro-personalizado' ),
            'activated_successfully'          => __( 'The following plugin was activated successfully:', 'wp-cadastro-personalizado' ),
            'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'wp-cadastro-personalizado' ),
            'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'wp-cadastro-personalizado' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'wp-cadastro-personalizado' ),
            'dismiss'                         => __( 'Dismiss this notice', 'wp-cadastro-personalizado' ),
            'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'wp-cadastro-personalizado' ),
            'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'wp-cadastro-personalizado' ),
            'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
        ),
    );

    tgmpa($plugins, $config);
});

add_action('init', function () {
    $imagens = new PostType\Imagens();

    $imagens->registrar();
    $imagens->registrarTaxonomies();

    new \WPCADASTROPERSONALIZADO\Controllers\Imagens();
});