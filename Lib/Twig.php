<?php


namespace AcMarche\Theme\Lib;

use AcMarche\Common\Mailer;
use AcMarche\Common\Router;
use AcMarche\Theme\Inc\RouterMarche;
use AcMarche\Theme\Inc\Theme;
use HTMLPurifier;
use HTMLPurifier_Config;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Extra\Intl\IntlExtension;
use Twig\Extra\String\StringExtension;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFilter;
use Twig\TwigFunction;

class Twig
{
    public static function LoadTwig(?string $path = null): Environment
    {
        //todo get instance
        if ( ! $path) {
            $path = get_template_directory().'/templates';
        }

        $loader = new FilesystemLoader($path);

        $environment = new Environment(
            $loader,
            [
                'cache'            => ABSPATH.'var/cache',
                'debug'            => WP_DEBUG,
                'strict_variables' => WP_DEBUG,
            ]
        );

        // wp_get_environment_type();
        if (WP_DEBUG) {
            $environment->addExtension(new DebugExtension());
        }

        $environment->addExtension(new StringExtension());
        $environment->addExtension(new IntlExtension());

        $environment->addGlobal('template_directory', get_template_directory_uri());
        $environment->addFilter(self::categoryLink());
        $environment->addFunction(self::showTemplate());
        $environment->addFunction(self::currentUrl());
        $environment->addFunction(self::wwwUrl());
        $environment->addFunction(self::isExternalUrl());
        $environment->addFilter(self::puriferHtml());

        return $environment;
    }

    public static function rendPage(string $templatePath, array $variables = [])
    {
        $twig = self::LoadTwig();
        try {
            echo $twig->render(
                $templatePath,
                $variables,
            );
        } catch (LoaderError | RuntimeError | SyntaxError $e) {
            echo $twig->render(
                'errors/500.html.twig',
                [
                    'message'   => $e->getMessage(),
                    'title'     => "La page n'a pas pu être chargée",
                    'tags'      => [],
                    'color'     => Theme::COLORS[1],
                    'blogName'  => Theme::COLORS[1],
                    'relations' => [],
                ]
            );
            $url = Router::getCurrentUrl();
            Mailer::sendError("Error page: ".$templatePath, $url.' \n '.$e->getMessage());
        }

    }

    protected static function categoryLink(): TwigFilter
    {
        return new TwigFilter(
            'category_link',
            function (int $categoryId): ?string {
                return get_category_link($categoryId);
            }
        );
    }

    protected static function showTemplate(): TwigFunction
    {
        return new TwigFunction(
            'showTemplate',
            function (): string {
                if (true === WP_DEBUG) {
                    global $template;

                    return 'template: '.$template;
                }

                return '';
            }
        );
    }

    protected static function isExternalUrl(): TwigFunction
    {
        return new TwigFunction(
            'isExternalUrl',
            function (string $url): bool {
                if (preg_match("#http#", $url)) {
                    if ( ! preg_match("#https://www.marche.be#", $url)) {
                        return true;
                    }

                    return false;
                }

                return false;
            }
        );
    }

    /**
     * For sharing pages
     * @return TwigFunction
     */
    public static function currentUrl(): TwigFunction
    {
        return new TwigFunction(
            'currentUrl',
            function (): string {
                return Router::getCurrentUrl();
            }
        );
    }

    /**
     * For sharing pages
     * @return TwigFunction
     */
    public static function wwwUrl(): TwigFunction
    {
        return new TwigFunction(
            'wwwUrl',
            function (): string {
                return RouterMarche::getUrlWww();
            }
        );
    }

    /**
     *
     * @return TwigFilter
     */
    public static function puriferHtml(): TwigFilter
    {
        return new TwigFilter(
            'puriferHtml',
            function (?string $content): ?string {
                return StringUtils::pureHtml($content);
            }
        );
    }
}
