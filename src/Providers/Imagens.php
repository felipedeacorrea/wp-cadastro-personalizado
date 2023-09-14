<?php

namespace WPCADASTROPERSONALIZADO\Providers;

use WPCADASTROPERSONALIZADO\Models\Imagens as ImagensModel;

class Imagens
{
    public static function getTodos($number = -1)
    {
        $wp_posts = get_posts([
            'post_type' => 'imagens',
            'numberposts' => $number,
            'post_status' => 'publish'
        ]);

        $dados = array_map(function ($wp_post) {
            return new ImagensModel($wp_post);
        }, $wp_posts);

        return $dados;
    }

    public static function getPostByIdTermTaxonomie($term_id)
    {
        $wp_posts = get_posts([
            'post_type' => 'imagens',
            'tax_query' => [
                [
                    'taxonomy' => 'categoria-imagem',
                    'field' => 'term_id',
                    'terms' => $term_id
                ]
            ]
        ]);

        $dados = array_map(function ($wp_post) {
            return new ImagensModel($wp_post);
        }, $wp_posts);

        return $dados;
    }
}