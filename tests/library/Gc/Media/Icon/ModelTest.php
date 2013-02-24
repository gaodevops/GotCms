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

namespace Gc\Media\Icon;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:09.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class ModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Model
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Model;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Gc\Media\Icon\Model::fromArray
     */
    public function testFromArray()
    {
        $this->assertInstanceOf('Gc\Media\Icon\Model', Model::fromArray(array()));
    }

    /**
     * @covers Gc\Media\Icon\Model::fromId
     */
    public function testFromId()
    {
        $this->assertInstanceOf('Gc\Media\Icon\Model', Model::fromId(1));
    }

    /**
     * @covers Gc\Media\Icon\Model::fromId
     */
    public function testFromWithWrongId()
    {
        $this->assertFalse(Model::fromId('undefined'));
    }

    /**
     * @covers Gc\Media\Icon\Model::save
     */
    public function testSave()
    {
        $this->object->setData(array(
            'name' => 'IconTest',
            'url' => 'IconTest'
        ));
        $this->assertInternalType('integer', $this->object->save());
        //Code coverage
        $this->assertInternalType('integer', $this->object->save());
    }

    /**
     * @covers Gc\Media\Icon\Model::save
     */
    public function testSaveWithWrongValues()
    {
        $this->setExpectedException('Gc\Exception');
        $this->assertFalse($this->object->save());
    }

    /**
     * @covers Gc\Media\Icon\Model::delete
     */
    public function testDelete()
    {
        $this->object->setData(array(
            'name' => 'IconTest',
            'url' => 'IconTest'
        ));
        $this->object->save();

        $this->assertTrue($this->object->delete());
    }

    /**
     * @covers Gc\Media\Icon\Model::delete
     */
    public function testDeleteWithNoData()
    {
        $this->assertFalse($this->object->delete());
    }

    /**
     * @covers Gc\Media\Icon\Model::delete
     */
    public function testDeleteWithWrongValues()
    {
        $this->setExpectedException('Gc\Exception');
        $this->object->setId('undefined');
        $this->assertFalse($this->object->delete());
    }
}
