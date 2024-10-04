<?php

declare (strict_types=1);
namespace Org\Wplake\Advanced_Views\Optional_Vendors\Doctrine\Inflector\Rules\Portuguese;

use Org\Wplake\Advanced_Views\Optional_Vendors\Doctrine\Inflector\Rules\Pattern;
final class Uninflected
{
    /** @return Pattern[] */
    public static function getSingular() : iterable
    {
        yield from self::getDefault();
    }
    /** @return Pattern[] */
    public static function getPlural() : iterable
    {
        yield from self::getDefault();
    }
    /** @return Pattern[] */
    private static function getDefault() : iterable
    {
        (yield new Pattern('tórax'));
        (yield new Pattern('tênis'));
        (yield new Pattern('ônibus'));
        (yield new Pattern('lápis'));
        (yield new Pattern('fênix'));
    }
}
