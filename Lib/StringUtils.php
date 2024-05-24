<?php


namespace AcMarche\Theme\Lib;


use HTMLPurifier;
use HTMLPurifier_Config;

class StringUtils
{
    public static function pureHtml(?string $html): ?string
    {
        if ( ! $html) {
            return $html;
        }
        $config = HTMLPurifier_Config::createDefault();
        $config->set('Attr.EnableID', true);
        $config->set('Cache.SerializerPath', '/tmp');
        $purifier = new HTMLPurifier($config);

        return $purifier->purify($html);
    }
}
