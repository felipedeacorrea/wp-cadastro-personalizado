<?php
namespace WPCADASTROPERSONALIZADO\Helpers;

use \Twig\Environment;
use \Twig\Loader\FilesystemLoader;

class TwigViewer
{
    /**
     * @param string $view      Arquivo HTML será renderizado
     * @param array $content    Conteúdo a ser renderizado no HTML especificado
     * @return string           HTML tratado com as variaveis previamente substituidas
     */
    public static function render($view, $content)
    {
        $loader = new FilesystemLoader(VIEWS_PATH);
        $twig = new Environment($loader);

        return $twig->render($view, $content);
    }
}
