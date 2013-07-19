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
 * @package  Modules
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Modules\ActivityLog\Controller;

use Modules\ActivityLog\Bootstrap;
use Modules\ActivityLog\Model\Event\Model;
use Gc\Registry;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-06 at 14:00:49.
 *
 * @group Modules
 * @category Gc_Tests
 * @package  Modules
 */
class IndexControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var IndexController
     */
    protected $object;

    /**
     * @var Bootstrap
     */
    protected $boostrap;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->boostrap = new Bootstrap();
        $this->boostrap->install();
        $this->object = new IndexController(
            Registry::get('Application')->getRequest(),
            Registry::get('Application')->getResponse()
        );
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    protected function tearDown()
    {
        $this->boostrap->uninstall();
        unset($this->boostrap);
    }

    /**
     * Test
     *
     * @return void
     */
    public function testIndexAction()
    {
        $this->assertInternalType('array', $this->object->indexAction());
    }

    /**
     * Test
     *
     * @return void
     */
    public function testRemoveEventAction()
    {
        $model = Model::fromArray(
            array(
                'content' => '',
                'template_id' => 1,
            )
        );

        $model->save();
        Registry::get('Application')->getRequest()->getQuery()->set('id', $model->getId());
        $this->assertInstanceOf('Zend\View\Model\JsonModel', $this->object->removeEventAction());
    }
}
