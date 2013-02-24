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

namespace Gc\Mvc\Controller;

use Gc\Registry,
    Gc\User\Model as UserModel,
    Zend\Http\Request,
    Zend\Mvc\Router\RouteMatch;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-10-17 at 20:40:11.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Gc
 * @category Gc_Tests
 * @package  Library
 */
class ActionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Action
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Action;
        $this->object->setEvent(Registry::get('Application')->getMvcEvent());
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Gc\Mvc\Controller\Action::onDispatch
     * @covers Gc\Mvc\Controller\Action::init
     * @covers Gc\Mvc\Controller\Action::_construct
     */
    public function testOnDispatchWithoutIdentity()
    {
        $this->object->getEvent()->setRouteMatch(new RouteMatch(array('controller' => 'controller')));
        $this->object->dispatch(Registry::get('Application')->getRequest(), NULL);

        $route_match = new RouteMatch(array());
        $route_match->setMatchedRouteName('content');
        $this->object->getEvent()->setRouteMatch($route_match);
        $this->object->onDispatch(Registry::get('Application')->getMvcEvent());

    }

    /**
     * @covers Gc\Mvc\Controller\Action::onDispatch
     * @covers Gc\Mvc\Controller\Action::init
     * @covers Gc\Mvc\Controller\Action::_construct
     */
    public function testOnDispatchWithIdentity()
    {
        $user_model = UserModel::fromArray(array(
            'lastname' => 'Test',
            'firstname' => 'Test',
            'email' => 'test@test.com',
            'login' => 'login-test',
            'user_acl_role_id' => 1,
        ));

        $user_model->setPassword('password-test');
        $user_model->save();
        $user_model->authenticate('login-test', 'password-test');


        $route_match = new RouteMatch(array());
        $route_match->setMatchedRouteName('renderWebsite');
        $this->object->getEvent()->setRouteMatch($route_match);
        $this->object->dispatch(Registry::get('Application')->getRequest(), NULL);
        $this->object->onDispatch(Registry::get('Application')->getMvcEvent());

        $user_model->delete();
    }

    /**
     * @covers Gc\Mvc\Controller\Action::getRouteMatch
     */
    public function testGetRouteMatch()
    {
        $this->object->getEvent()->setRouteMatch(new RouteMatch(array('controller' => 'controller')));
        $this->assertInstanceOf('Zend\Mvc\Router\RouteMatch', $this->object->getRouteMatch());
    }

    /**
     * @covers Gc\Mvc\Controller\Action::getSession
     */
    public function testGetSession()
    {
        $this->assertInstanceOf('Zend\Session\Container', $this->object->getSession());
    }

    /**
     * @covers Gc\Mvc\Controller\Action::getAuth
     */
    public function testGetAuth()
    {
        $this->assertInstanceOf('Zend\Authentication\AuthenticationService', $this->object->getAuth());
    }

    /**
     * @covers Gc\Mvc\Controller\Action::returnJson
     */
    public function testReturnJson()
    {
        $this->assertInstanceOf('Zend\View\Model\JsonModel', $this->object->returnJson(array()));
    }

    /**
     * @covers Gc\Mvc\Controller\Action::events
     */
    public function testEvents()
    {
        $this->assertInstanceOf('Gc\Event\StaticEventManager', $this->object->events());
    }

    /**
     * @covers Gc\Mvc\Controller\Action::useFlashMessenger
     */
    public function testUseflashMessenger()
    {
        $this->object->flashMessenger()->addInfoMessage('Test');
        $this->assertNull($this->object->useFlashMessenger(FALSE));
        $this->assertNull($this->object->useFlashMessenger(TRUE));
    }
}
