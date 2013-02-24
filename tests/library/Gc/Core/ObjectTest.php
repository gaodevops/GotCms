<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category Gc_Tests
 * @package  Library
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Gc\Core;

use Gc\Registry,
    ReflectionClass;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:10.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class ObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Object
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @covers Gc\Core\Object::__construct
     */
    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass('Gc\Core\Object');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        unset($this->object);
    }

    /**
     * @covers Gc\Core\Object::init
     */
    public function testInit()
    {
        $this->assertNull($this->object->init());
    }


    /**
     * @covers Gc\Core\Object::setId
     */
    public function testSetId()
    {
        $configuration = Registry::get('Configuration');
        $class = $this->_getMethod('setId');
        $class->invokeArgs($this->object, array('id' => 1));
        $this->assertEquals(1, $this->object->getId());
    }

    /**
     * @covers Gc\Core\Object::addData
     */
    public function testAddData()
    {
        $this->object->addData(array('k' => 'v'));
        $this->assertEquals('v', $this->object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::setData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::underscore
     */
    public function testSetData()
    {
        $this->object->setK('v');
        $this->assertEquals('v', $this->object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::setData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::underscore
     */
    public function testSetAllData()
    {
        $this->object->setData(array('k' => 'v', 'k2' => 'v2'));
        $this->assertEquals('v', $this->object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::unsetData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::underscore
     */
    public function testUnsetData()
    {
        $this->object->setData('k', 'v');
        $this->object->unsK();
        $this->assertNull($this->object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::unsetData
     */
    public function testUnsetAllData()
    {
        $this->object->setData('k', 'v');
        $this->object->unsetData();
        $this->assertNull($this->object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::getData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::underscore
     */
    public function testGetData()
    {
        $this->object->setData('k', 'v');
        $this->assertEquals('v', $this->object->getK());
    }

    /**
     * @covers Gc\Core\Object::__call
     */
    public function testFakeMethod()
    {
        $this->setExpectedException('Gc\Exception');
        $this->object->fakeMethodToLaunchException();
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithIndex()
    {
        $this->object->setData('a', array('b', 'c'));
        $this->assertEquals('b', $this->object->getData('a', 0));
        $this->assertNull($this->object->getData('a', 3));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithFakeIndex()
    {
        $this->object->setData('a', array('b', 'c'));
        $this->assertNull($this->object->getData('a', 3));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithIndexAndStringValue()
    {
        $this->object->setData('a', 'b');
        $this->assertEquals('b', $this->object->getData('a', 0));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithIndexAndObjectValue()
    {
        $new_object = $this->getMockForAbstractClass('Gc\Core\Object');
        $new_object->setData('b', 'c');
        $this->object->setData('a', $new_object);
        $this->assertEquals('c', $this->object->getData('a', 'b'));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithIndexAndDifferentObjectValue()
    {
        $new_object = new \stdClass();
        $new_object->b = 'c';
        $this->object->setData('a', $new_object);
        $this->assertNull($this->object->getData('a', 'b'));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetDataWithUndefinedKeyAndIndex()
    {
        $this->assertNull($this->object->getData('a', 'b'));
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetAllData()
    {
        $this->object->setData('k', 'v');
        $this->assertEquals(array('k' => 'v'), $this->object->getData());
    }

    /**
     * @covers Gc\Core\Object::getData
     */
    public function testGetArrayData()
    {
        $this->object->setData(array('a' => array('b' => '1', 'c' => '2')));
        $this->assertEquals('1', $this->object->getData('a/b'));
        $this->assertNull($this->object->getData('b/c'));
        $this->assertNull($this->object->getData('a/b/'));
    }

    /**
     * @covers Gc\Core\Object::hasData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::underscore
     */
    public function testHasData()
    {
        $this->object->setData('k', 'v');
        $this->assertTrue($this->object->hasData('k'));
        $this->assertTrue($this->object->hasK());
    }

    /**
     * @covers Gc\Core\Object::hasData
     */
    public function testHasFakeData()
    {
        $this->assertFalse($this->object->hasData(''));
    }

    /**
     * @covers Gc\Core\Object::toArray
     * @covers Gc\Core\Object::__toArray
     */
    public function test__toArray()
    {
        $this->object->setData('k', 'v');
        $this->assertArrayHasKey('k', $this->object->toArray());
    }

    /**
     * @covers Gc\Core\Object::toArray
     * @covers Gc\Core\Object::__toArray
     */
    public function test__toArrayWithParameters()
    {
        $this->object->setData('k', 'v');
        $this->assertArrayHasKey('k2', $this->object->toArray(array('k', 'k2')));
    }

    /**
     * @covers Gc\Core\Object::toXml
     */
    public function testToXml()
    {
        $this->object->setData(array('k' => 'v'));
        $xml = '<?xml version="1.0" encoding="UTF-8"?><items><k><![CDATA[v]]></k></items>';
        $this->assertXmlStringEqualsXmlString($xml, $this->object->toXml(array(), 'items', TRUE, TRUE));
    }

    /**
     * @covers Gc\Core\Object::toXml
     * @covers Gc\Core\Object::__toXml
     */
    public function testToXmlWithoutParameters()
    {
        $this->object->setData(array('k' => 'v'));
        $this->object->toXml(array(), 'items', TRUE, TRUE);
        $this->object->toXml(array(), 'items', FALSE, FALSE);
        $xml = '<item><k><![CDATA[v]]></k></item>';
        $this->assertXmlStringEqualsXmlString($xml, $this->object->toXml());
    }

    /**
     * @covers Gc\Core\Object::toJson
     * @covers Gc\Core\Object::__toJson
     */
    public function testToJson()
    {
        $this->object->setData(array('k' => 'v'));
        $this->assertEquals(json_encode(array('k' => 'v')), $this->object->toJson());
    }

    /**
     * @covers Gc\Core\Object::toString
     */
    public function testToString()
    {
        $this->object->setData(array('k' => 'v'));
        $this->assertEquals('v', $this->object->toString());
    }

    /**
     * @covers Gc\Core\Object::toString
     */
    public function testToStringWithFormat()
    {
        $this->object->setData(array('a' => 'b', 'c' => 'd'));
        $this->assertEquals('b d', $this->object->toString('{{a}} {{c}}'));
    }

    /**
     * @covers Gc\Core\Object::offsetSet
     */
    public function testOffsetSet()
    {
        $this->object->offsetSet('k', 'v');
        $this->assertEquals('v', $this->object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::offsetExists
     */
    public function testOffsetExists()
    {
        $this->object->setData('k', 'v');
        $this->assertTrue($this->object->OffsetExists('k'));
    }

    /**
     * @covers Gc\Core\Object::offsetUnset
     */
    public function testOffsetUnset()
    {
        $this->object->setData('k', 'v');
        $this->object->offsetUnset('k');
        $this->assertNull($this->object->getData('k'));
    }

    /**
     * @covers Gc\Core\Object::getOrigData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::underscore
     */
    public function testGetOrigData()
    {
        $this->object->setOrigData('k', 'v');
        $this->assertEquals('v', $this->object->getOrigData('k'));
    }

    /**
     * @covers Gc\Core\Object::getOrigData
     */
    public function testGetAllOrigData()
    {
        $this->object->setOrigData('k', 'v');
        $this->assertEquals(array('k' => 'v'), $this->object->getOrigData());
    }

    /**
     * @covers Gc\Core\Object::hasDataChangedFor
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::underscore
     */
    public function testHasDataChangedFor()
    {
        $this->object->setData('k', 'v');
        $this->object->setOrigData();
        $this->assertFalse($this->object->hasDataChangedFor('k'));
    }

    /**
     * @covers Gc\Core\Object::setOrigData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::underscore
     */
    public function testSetOrigData()
    {
        $this->object->setOrigData('k', 'v');
        $this->assertEquals('v', $this->object->getOrigData('k'));
    }

    /**
     * @covers Gc\Core\Object::setOrigData
     * @covers Gc\Core\Object::__call
     * @covers Gc\Core\Object::underscore
     */
    public function testSetAllOrigData()
    {
        $this->object->setData(array('k' => 'v', 'k2' => 'v2'));
        $this->object->setOrigData();
        $this->assertEquals('v', $this->object->getOrigData('k'));
    }


    /**
     * @covers Gc\Core\Object::offsetGet
     */
    public function testOffsetGet()
    {
        $this->object->setData('k', 'v');
        $this->assertEquals('v', $this->object->offsetGet('k'));
    }

    protected function _getMethod($name)
    {
        $class = new ReflectionClass('Gc\Core\Object');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }
}
