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

namespace Modules\Sitemap\Model;

use Gc\Document\Model as DocumentModel,
    Gc\DocumentType\Model as DocumentTypeModel,
    Gc\Layout\Model as LayoutModel,
    Gc\User\Model as UserModel,
    Gc\View\Model as ViewModel;
/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-12 at 13:33:24.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Modules
 * @category Gc_Tests
 * @package  Modules
 */
class SitemapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Sitemap
     */
    protected $object;

    /**
     * @var Model
     */
    protected $_document;

    /**
     * @var ViewModel
     */
    protected $view;

    /**
     * @var LayoutModel
     */
    protected $layout;

    /**
     * @var UserModel
     */
    protected $user;

    /**
     * @var DocumentTypeModel
     */
    protected $documentType;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->view = ViewModel::fromArray(array(
            'name' => 'View Name',
            'identifier' => 'View identifier',
            'description' => 'View Description',
            'content' => 'View Content'
        ));
        $this->view->save();

        $this->layout = LayoutModel::fromArray(array(
            'name' => 'Layout Name',
            'identifier' => 'Layout identifier',
            'description' => 'Layout Description',
            'content' => 'Layout Content'
        ));
        $this->layout->save();

        $this->user = UserModel::fromArray(array(
            'lastname' => 'User test',
            'firstname' => 'User test',
            'email' => 'test@test.com',
            'login' => 'test',
            'user_acl_role_id' => 1,
        ));

        $this->user->setPassword('test');
        $this->user->save();

        $this->documentType = DocumentTypeModel::fromArray(array(
            'name' => 'Document Type Name',
            'description' => 'Document Type description',
            'icon_id' => 1,
            'defaultview_id' => $this->view->getId(),
            'user_id' => $this->user->getId(),
        ));

        $this->documentType->save();

        $this->_document = DocumentModel::fromArray(array(
            'name' => 'Document name',
            'url_key' => 'url-key',
            'status' => DocumentModel::STATUS_ENABLE,
            'show_in_nav' => TRUE,
            'user_id' => $this->user->getId(),
            'document_type_id' => $this->documentType->getId(),
            'view_id' => $this->view->getId(),
            'layout_id' => $this->layout->getId(),
            'parent_id' => NULL
        ));

        $this->_document->save();

        $this->object = new Sitemap;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->_document->delete();
        $this->view->delete();
        $this->layout->delete();
        $this->documentType->delete();
        $this->user->delete();
        unset($this->_document);
        unset($this->view);
        unset($this->layout);
        unset($this->documentType);
        unset($this->user);
        unset($this->object);
    }

    /**
     * @covers Modules\Sitemap\Model\Sitemap::init
     */
    public function testInit()
    {
        $this->assertNull($this->object->init());
    }

    /**
     * @covers Modules\Sitemap\Model\Sitemap::generate
     * @covers Modules\Sitemap\Model\Sitemap::generateXml
     */
    public function testGenerate()
    {
        $this->assertInternalType('string', $this->object->generate());
    }
}
