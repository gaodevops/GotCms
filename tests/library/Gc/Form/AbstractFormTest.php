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

namespace Gc\Form;

use Zend\Form\Element,
    Zend\InputFilter\Factory as InputFilterFactory,
    Gc\User\Model;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:11.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class AbstractFormTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var AbstractForm
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @covers Gc\Form\AbstractForm::__construct
     */
    protected function setUp()
    {
        $this->object = $this->getMockForAbstractClass('Gc\Form\AbstractForm');
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
     * @covers Gc\Form\AbstractForm::init
     */
    public function testInit()
    {
        $this->assertNull($this->object->init());
    }

    /**
     * @covers Gc\Form\AbstractForm::getAdapter
     */
    public function testGetAdapter()
    {
        $this->assertInstanceOf('Zend\Db\Adapter\Adapter', $this->object->getAdapter());
    }

    /**
     * @covers Gc\Form\AbstractForm::loadValues
     */
    public function testLoadValues()
    {
        $model = Model::fromArray(array(
            'name' => 'Name',
        ));

        $input_filter_factory = new InputFilterFactory();
        $input_filter = $input_filter_factory->createInputFilter(array(
            'name' => array(
                'required' => TRUE,
                'validators' => array(
                    array('name' => 'not_empty'),
                    array(
                        'name' => 'db\\no_record_exists',
                        'options' => array(
                            'table' => 'datatype',
                            'field' => 'name',
                            'adapter' => $this->object->getAdapter(),
                        ),
                    ),
                ),
            ),
        ));

        $this->object->setInputFilter($input_filter);
        $this->object->add(new Element\Text('name'));

        $this->assertInstanceOf('Gc\Form\AbstractForm', $this->object->loadValues($model));
    }

    /**
     * @covers Gc\Form\AbstractForm::addContent
     */
    public function testAddContent()
    {
        $this->assertNull($this->object->addContent($this->object, array()));
        $this->assertNull($this->object->addContent($this->object, array(new Element\Text('text'))));
        $this->assertNull($this->object->addContent($this->object, '<input type="text" name="text">', 'prefix'));
        $this->assertNull($this->object->addContent($this->object, new Element\Text('text-element'), 'prefix'));
    }

    /**
     * @covers Gc\Form\AbstractForm::addContent
     */
    public function testAddContentWithWrongParameters()
    {
        $this->setExpectedException('\Gc\Exception');
        $this->assertNull($this->object->addContent($this->object, $this->object->getAdapter()));
    }

    /**
     * @covers Gc\Form\AbstractForm::getValue
     */
    public function testGetValue()
    {
        $this->assertNull($this->object->getValue('undefined'));
        $element = new Element\Text('text');
        $element->setValue('string');
        $this->object->add($element);

        $this->assertEquals('string', $this->object->getValue('text'));
    }
}
