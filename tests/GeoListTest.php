<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sk\Geo\GeoList;

class GeoGeoListTest extends TestCase
{
    public function test_it_load_countries()
    {
        $locale = 'fr_FR';
        $countries = GeoList::countries($locale);

        $this->assertNotCount(0, $countries);

        $countries = GeoList::countries('will_fallback', 'en_US');

        $this->assertNotCount(0, $countries);

        $this->expectException(\LogicException::class);

        $countries = GeoList::countries('big', 'badaboom');
    }

    public function test_it_does_not_contains_pseudo_locales()
    {
        $locale = 'fr_FR';
        $countries = GeoList::countries($locale);

        $this->assertNotEmpty($countries);

        // Issue introduced in umpirsky/country-list version 2.0.5
        $this->assertArrayNotHasKey('XA', $countries);
        $this->assertArrayNotHasKey('XB', $countries);
    }

    public function test_it_load_currencies()
    {
        $locale = 'fr_FR';
        $currencies = GeoList::currencies($locale);

        $this->assertNotCount(0, $currencies);

        $currencies = GeoList::currencies('will_fallback', 'ru_RU');

        $this->assertNotCount(0, $currencies);

        $this->expectException(\LogicException::class);

        $currencies = GeoList::currencies('big', 'badaboom');
    }

    public function test_it_load_languages()
    {
        $locale = 'fr_FR';
        $languages = GeoList::languages($locale);

        $this->assertNotCount(0, $languages);

        $languages = GeoList::languages('will_fallback', 'zh_CN');

        $this->assertNotCount(0, $languages);

        $this->expectException(\LogicException::class);

        $languages = GeoList::languages('big', 'badaboom');
    }
}
