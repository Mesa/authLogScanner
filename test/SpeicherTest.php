<?php

require_once dirname(__FILE__) . '/../Speicher.php';

/**
 * Test class for Speicher.
 * Generated by PHPUnit on 2012-06-27 at 05:58:29.
 */
class SpeicherTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Speicher
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp ()
    {
        $this->object = new Speicher;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown ()
    {

    }

    public function testAdd ()
    {
        $this->assertSame($this->object->add("192.168.0.1"), true);
        $this->assertSame($this->object->add("192.168.0.0.1"), false, "Falsche Ip nicht erkannt");

    }

    public function testGetCount ()
    {
        $this->object->add("192.168.0.1");
        $this->object->add("192.168.0.1");
        $this->object->add("192.168.0.1");
        $this->assertSame($this->object->getCount("192.168.0.1"),3, "Der Zähler hat eine falsche Zahl zurückgegeben.");
        $this->assertSame($this->object->getCount("192.168.0.0.1"),false);
        $this->assertSame($this->object->getCount("192.168.0.2"),0);
    }

    public function testGetAll()
    {
        $this->object->add("192.168.0.3");
        $this->object->add("192.168.0.2");
        $this->object->add("252.177.0.5");
        $this->object->add("252.177.0.1");
        $this->object->add("192.168.0.1");
        $this->object->add("192.168.0.1");
        $array = array(
            "192.168.0.1" => 2,
            "252.177.0.1" => 1,
            "252.177.0.5" => 1,
            "192.168.0.2" => 1,
            "192.168.0.3" => 1
        );
        ksort($array);
        $this->assertSame($array, $this->object->getAll(), "Die Ipadressen sind nicht vollständig zurückgeben worden");
    }

}

?>
