<?php
/*
 * This file is part of the Sonata package.
 *
 * (c) Thomas Rabaix <thomas.rabaix@sonata-project.org>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sonata\SeoBundle\Tests\Seo;

use Sonata\SeoBundle\Seo\SeoPage;

class SeoPageTest extends \PHPUnit_Framework_TestCase
{
    public function testAddMeta()
    {
        $page = new SeoPage;
        $page->addMeta('property', 'foo', 'bar');

        $expected = array(
            'http-equiv' => array(),
            'name'       => array(),
            'schema'     => array(),
            'charset'    => array(),
            'property'   => array('foo' => array('bar', array())),
        );

        $this->assertEquals($expected, $page->getMetas());
    }

    public function testOverrideMetas()
    {
        $page = new SeoPage;
        $page->setMetas(array('property' => array('foo' => 'bar', 'foo2' => array('bar2', array()))));

        $expected = array(
            'property'   => array('foo' => array('bar', array()), 'foo2' => array('bar2', array())),
        );

        $this->assertEquals($expected, $page->getMetas());
    }

    /**
     * @expectedException RuntimeException
     */
    public function testInvalidMetas()
    {
        $page = new SeoPage();
        $page->setMetas(array(
            'type' => 'not an array'
        ));
    }

    public function testHtmlAttributes() {
        $page = new SeoPage;
        $page->setHtmlAttributes(array('key1' => 'value1'));
        $page->addHtmlAttributes('key2', 'value2');

        $expected = array(
            'key1' => 'value1',
            'key2' => 'value2'
        );

        $this->assertEquals($expected, $page->getHtmlAttributes());
    }

    public function testTitle() {
        $page = new SeoPage;
        $page->setTitle('My title');

        $this->assertEquals('My title', $page->getTitle());
    }

    public function testLinkCanonical() {
        $page = new SeoPage();
        $page->setLinkCanonical('http://example.com');

        $this->assertEquals('http://example.com', $page->getLinkCanonical());
    }
}