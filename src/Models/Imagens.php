<?php

namespace WPCADASTROPERSONALIZADO\Models;

use \WPCADASTROPERSONALIZADO\PostType\Imagens as ImagensPostType;

class Imagens
{
    private $id;
    private $prefixo_post_meta;
    // private $post_meta;
    private $titulo;
    private $imagem;
    private $url;
    public $tipo;
    // private $term;

    public function __construct($wp_post)
    {
        $term = get_the_terms($wp_post->ID, 'categoria-imagem');

        $this->id                   = $wp_post->ID ? $wp_post->ID : null;
        $this->titulo               = $wp_post->post_title ? $wp_post->post_title : null;
        // $this->term                 = $term;
        $this->prefixo_post_meta    = ImagensPostType::getPrefixoPostMeta();
        // $this->post_meta            = get_post_meta($wp_post->ID, '', true);
        $this->imagem               = get_post_meta($wp_post->ID, $this->prefixo_post_meta . '_imagem', true);
        $this->url                  = get_post_meta($wp_post->ID, $this->prefixo_post_meta . '_url', true);
        $this->tipo                 = get_post_meta($wp_post->ID, $this->prefixo_post_meta . '_tipo', true);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPrefixoPostMeta()
    {
        return $this->prefixo_post_meta;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getImagem()
    {
        return $this->imagem;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getipo()
    {
        return $this->tipo;
    }
}
