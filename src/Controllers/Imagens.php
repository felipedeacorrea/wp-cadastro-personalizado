<?php

namespace WPCADASTROPERSONALIZADO\Controllers;

use \WPCADASTROPERSONALIZADO\Helpers\TwigViewer;
use \WPCADASTROPERSONALIZADO\Providers\Imagens as ImagensProvider;

class Imagens extends BaseController
{
    public function __construct()
    {
        add_shortcode('imagens-list', [$this, 'getImagens']);
    }

    public function getImagens()
    {
        ob_start();

        $term = get_terms([
            'taxonomy'   => 'categoria-imagem',
            'hide_empty' => false,
            'parent' => 0
        ]);

        $arrDados = [];

        foreach ($term as $key => $value) {
            $arrDados[$key] = [
                'term_id' => $value->term_id,
                'name' => $value->name,
                'slug' => $value->slug
            ];

            $childTerms = get_term_children($value->term_id, 'categoria-imagem');

            foreach ($childTerms as $k => $termId) {
                $arrDados[$key]['childTerms'][$k] = [
                    'term' => get_term($termId, 'categoria-imagem'),

                ];

                if (isset($arrDados[$key]['childTerms'][$k]['term'])) {
                    $listPosts = ImagensProvider::getPostByIdTermTaxonomie($termId);

                    $posts = [];

                    foreach ($listPosts as $kl => $post) {
                        if (!empty($post->tipo)) {
                            $posts[$post->tipo][$kl] = $listPosts[$kl];
                        } else {
                            $posts['vazio'][$kl] = $listPosts[$kl];
                        }
                    }

                    $arrDados[$key]['childTerms'][$k]['term']->posts = $posts;
                }
            }
        }

        $args = [
            'lista' => $arrDados
        ];

        echo TwigViewer::render("imagens.html", $args);

        return ob_get_clean();
    }
}
