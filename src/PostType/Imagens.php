<?php

namespace WPCADASTROPERSONALIZADO\PostType;

class Imagens
{

    public function getPrefixoPostMeta()
    {
        return 'wpcp_cp';
    }

    public function registrar()
    {
        $text_domain = 'template_name';

        register_post_type('imagens', [
            'labels' => [
                'name' => __('Imagens', $text_domain),
                'singular_name' => __('Imagem', $text_domain),
                'add_new' => _x('Adicionar nova', $text_domain),
                'all_items' => _x('Todas as Imagens', $text_domain),
                'add_new_item' => _x('Adicionar novo', $text_domain),
                'edit_item' => _x('Editar', $text_domain),
                'new_item' => _x('Novo', $text_domain),
                'view_item' => _x('Ver', $text_domain),
                'search_items' => _x('Procurar', $text_domain),
                'not_found' => _x('Nada encontrado', $text_domain),
                'not_found_in_trash' => _x('Nada encontrado na lixeira', $text_domain),
                'parent_item_colon' => null,
                'menu_name' => _x('Imagens', $text_domain),
            ],
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'exclude_from_search' => true,
            'show_in_nav_menus' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 20,
            'menu_icon' => 'dashicons-format-image',
            'capability_type' => 'post',
            'supports' => ['title'],
            'rewrite' => ['slug' => 'imagens', 'with_front' => false],
            'has_archive' => true
        ]);

        add_action('cmb2_admin_init', function () {
            $this->registrarPostMeta();
            $this->registrarPostMetaTaxonomy();
        });
    }

    public function registrarTaxonomies()
    {
        register_taxonomy( 'categoria-imagem', ['imagens'], [
            'hierarchical'      => true, // Set this to 'false' for non-hierarchical taxonomy (like tags)
            'labels'            => [
                'name'              => _x( 'Categoria das imagens', 'taxonomy general name' ),
                'singular_name'     => _x( 'Categoria das imagens', 'taxonomy singular name' ),
                'search_items'      => __( 'Pesquisar categorias' ),
                'all_items'         => __( 'Todas as Categorias' ),
                'parent_item'       => __( 'Categoria Pai' ),
                'parent_item_colon' => __( 'Categoria Pai:' ),
                'edit_item'         => __( 'Editar Categoria' ),
                'update_item'       => __( 'Atualizar Categoria' ),
                'add_new_item'      => __( 'Adicionar Categoria' ),
                'new_item_name'     => __( 'Nova Categoria Name' ),
                'menu_name'         => __( 'Categoria de Imagens' ),
            ],
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'categoria-imagem'],
        ] );
    }

    private function registrarPostMeta()
    {
        $prefixo = $this->getPrefixoPostMeta();

        $cmb = new_cmb2_box([
            'id' => $prefixo . '_metabox',
            'title' => 'Detalhes da imagem',
            'object_types' => ['imagens']
        ]);

        $cmb->add_field([
            'name' => 'Tipo',
            'desc' => 'Segmentação por tipo',
            'id' => $prefixo . '_tipo',
            'type' => 'text'
        ]);

        $cmb->add_field([
            'name' => 'URL Destino',
            'desc' => 'Link para redirecionamento',
            'id' => $prefixo . '_url',
            'type' => 'text_url'
        ]);

        $cmb->add_field([
            'name' => 'Imagem/Logo',
            'id' => $prefixo . '_imagem',
            'type' => 'file',
            'options' => [
                'url' => false, // Hide the text input for the url
            ],
            'text' => [
                'add_upload_file_text' => 'Carregar arquivo' // Change upload button text. Default: 'Add or Upload File'
            ],
            'query_args' => [
                'type' => [
                    'image/jpeg',
                    'image/png',
                ]
            ]
        ]);
    }

    private function registrarPostMetaTaxonomy() { 
        $prefixo = $this->getPrefixoPostMeta(); 
     
        $cmb_term = new_cmb2_box( array( 
            'id'               => $prefixo . 'edit', 
            'object_types'     => array( 'term' ),
            'taxonomies'       => array( 'categoria-imagem'),
        ) ); 
     
        $cmb_term->add_field([
            'name' => 'Imagem/Logo',
            'id' => $prefixo . 'tax_imagem',
            'type' => 'file',
            'options' => [
                'url' => false, // Hide the text input for the url
            ],
            'text' => [
                'add_upload_file_text' => 'Carregar arquivo' // Change upload button text. Default: 'Add or Upload File'
            ],
            'query_args' => [
                'type' => [
                    'image/jpeg',
                    'image/png',
                    'image/svg',
                ]
            ]
        ]);
     
    } 
}
