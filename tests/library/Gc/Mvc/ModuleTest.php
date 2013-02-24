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

namespace Gc\Mvc;

use Gc\Registry,
    Gc\Core\Config,
    Zend\Db\TableGateway\Feature\GlobalAdapterFeature;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:11.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Module
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ModuleUnitTest;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Gc\Mvc\Module::onBootstrap
     */
    public function testOnBootstrap()
    {
        Registry::getInstance()->offsetUnset('Translator');
        $this->assertNull($this->object->onBootstrap(Registry::get('Application')->getMvcEvent()));
    }

    /**
     * @covers Gc\Mvc\Module::getAutoloaderConfig
     * @covers Gc\Mvc\Module::getDir
     * @covers Gc\Mvc\Module::getNamespace
     */
    public function testGetAutoloaderConfig()
    {
        $this->assertInternalType('array', $this->object->getAutoloaderConfig());
    }

    /**
     * @covers Gc\Mvc\Module::getConfig
     */
    public function testGetConfig()
    {
        Config::setValue('debug_is_active', 1);
        $this->assertInternalType('array', $this->object->getConfig());
    }

    /**
     * @covers Gc\Mvc\Module::init
     */
    public function testInit()
    {
        $old_database = Registry::get('Db');
        $old_configuration = Registry::get('Configuration');
        $old_adapter = GlobalAdapterFeature::getStaticAdapter();

        if(!Config::getValue('session_lifetime'))
        {
            Config::getInstance()->insert(array(
                'identifier' => 'session_lifetime',
                'value'      => 3600,
            ));
        }

        if(!Config::getValue('session_lifetime'))
        {
            Config::getInstance()->insert(array(
                'identifier' => 'cookie_domain',
                'value'      => 'got-cms.com',
            ));
        }

        Config::setValue('session_handler', Config::SESSION_DATABASE);

        Registry::getInstance()->offsetUnset('Configuration');
        $this->assertNull($this->object->init(Registry::get('Application')->getServiceManager()->get('ModuleManager')));

        Registry::set('Db', $old_database);
        Registry::set('Configuration', $old_configuration);
        GlobalAdapterFeature::setStaticAdapter($old_adapter);
    }
}

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:11.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class ModuleUnitTest extends Module
{
    /**
     * Module directory path
     *
     * @var string
     */
    protected $directory = __DIR__;

    /**
     * Module
     *
     * @var string
     */
    protected $namespace = __namespace__;
}
