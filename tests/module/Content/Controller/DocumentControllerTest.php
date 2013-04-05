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
 * @package  ZfModules
 * @author   Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license  GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link     http://www.got-cms.com
 */

namespace Content\Controller;

use Gc\Datatype\Model as DatatypeModel;
use Gc\Document\Model as DocumentModel;
use Gc\DocumentType\Model as DocumentTypeModel;
use Gc\Layout\Model as LayoutModel;
use Gc\Property\Model as PropertyModel;
use Gc\Tab\Model as TabModel;
use Gc\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Gc\User\Model as UserModel;
use Gc\View\Model as ViewModel;
use Zend\Session\Container as SessionContainer;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-03-15 at 23:50:12.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group    ZfModules
 * @category Gc_Tests
 * @package  ZfModules
 */
class DocumentControllerTest extends AbstractHttpControllerTestCase
{
    /**
     * @var ViewModel
     */
    protected $view;

    /**
     * @var DocumentTypeModel
     */
    protected $documentType;

    /**
     * @var DatatypeModel
     */
    protected $datatype;

    /**
     * @var TabModel
     */
    protected $tabModel;

    /**
     * @var PropertyModel
     */
    protected $property;

    /**
     * @var DocumentModel
     */
    protected $document;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @return void
     */
    public function setUp()
    {
        $this->init();

        $this->view = ViewModel::fromArray(
            array(
                'name' => 'View',
                'identifier' => 'ViewIdentifier',
                'description' => 'Description',
                'content' => '',
            )
        );
        $this->view->save();

        $this->layout = LayoutModel::fromArray(
            array(
                'name' => 'View',
                'identifier' => 'ViewIdentifier',
                'description' => 'Description',
                'content' => '',
            )
        );
        $this->layout->save();

        $this->documentType = DocumentTypeModel::fromArray(
            array(
                'name' => 'DocumentType',
                'description' => 'description',
                'icon_id' => 1,
                'default_view_id' => $this->view->getId(),
                'user_id' => $this->user->getId(),
            )
        );
        $this->documentType->save();
        $this->documentType->setDependencies(array($this->documentType->getId()));
        $this->documentType->save();

        $this->datatype = DatatypeModel::fromArray(
            array(
                'name' => 'DatatypeTest',
                'model' => 'Textstring'
            )
        );
        $this->datatype->save();

        $this->tabModel = TabModel::fromArray(
            array(
                'name' => 'test',
                'description' => 'test',
                'document_type_id' => $this->documentType->getId(),
            )
        );
        $this->tabModel->save();

        $this->property = PropertyModel::fromArray(
            array(
                'name' => 'test',
                'identifier' => 'test',
                'description'=> 'test',
                'tab_id' => $this->tabModel->getId(),
                'datatype_id' => $this->datatype->getId(),
                'is_required' => true
            )
        );
        $this->property->save();

        $this->document = DocumentModel::fromArray(
            array(
                'name' => 'test',
                'url_key' => '',
                'status' => DocumentModel::STATUS_ENABLE,
                'user_id' => $this->user->getId(),
                'document_type_id' => $this->documentType->getId(),
                'view_id' => $this->view->getId(),
                'layout_id' => $this->layout->getId(),
                'parent_id' => null,
            )
        );
        $this->document->save();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     *
     * @return void
     */
    public function tearDown()
    {
        $this->document->delete();
        $this->documentType->delete();
        $this->property->delete();
        $this->tabModel->delete();
        $this->view->delete();
        $this->layout->delete();
        $this->user->delete();
        $this->datatype->delete();
        unset($this->documentType);
        unset($this->document);
        unset($this->property);
        unset($this->tabModel);
        unset($this->view);
        unset($this->layout);
        unset($this->user);
        unset($this->datatype);
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::checkUrlKey
     * @covers Content\Controller\DocumentController::createAction
     *
     * @return void
     */
    public function testCreateAction()
    {
        $this->dispatch('/admin/content/document/create');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentCreate');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::checkUrlKey
     * @covers Content\Controller\DocumentController::createAction
     *
     * @return void
     */
    public function testCreateActionWithPostData()
    {
        $this->dispatch(
            '/admin/content/document/create',
            'POST',
            array(
                'document-name' => 'test',
                'document-url_key' => 'test',
                'document_type' => $this->documentType->getId(),
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentCreate');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::checkUrlKey
     * @covers Content\Controller\DocumentController::createAction
     *
     * @return void
     */
    public function testCreateActionWithInvalidPostData()
    {
        $this->dispatch(
            '/admin/content/document/create',
            'POST',
            array(
            )
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentCreate');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::checkUrlKey
     * @covers Content\Controller\DocumentController::createAction
     *
     * @return void
     */
    public function testCreateActionWithParent()
    {
        $document = DocumentModel::fromArray(
            array(
                'name' => 'test',
                'url_key' => 'about',
                'status' => DocumentModel::STATUS_ENABLE,
                'user_id' => $this->user->getId(),
                'document_type_id' => $this->documentType->getId(),
                'view_id' => $this->view->getId(),
                'layout_id' => $this->layout->getId(),
                'parent_id' => null,
            )
        );
        $document->save();

        $this->dispatch('/admin/content/document/create/parent/' . $document->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentCreateWParent');

        $document->delete();
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::deleteAction
     *
     * @return void
     */
    public function testDeleteAction()
    {
        $this->dispatch('/admin/content/document/delete/' . $this->document->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentDelete');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::deleteAction
     *
     * @return void
     */
    public function testDeleteActionWithWrongId()
    {
        $this->dispatch('/admin/content/document/delete/999');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentDelete');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::loadTabs
     * @covers Content\Controller\DocumentController::loadProperties
     * @covers Content\Controller\DocumentController::editAction
     *
     * @return void
     */
    public function testEditAction()
    {
        $this->dispatch('/admin/content/document/edit/' . $this->document->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentEdit');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::loadTabs
     * @covers Content\Controller\DocumentController::loadProperties
     * @covers Content\Controller\DocumentController::editAction
     *
     * @return void
     */
    public function testEditActionWithPostData()
    {
        $this->dispatch(
            '/admin/content/document/edit/' . $this->document->getId(),
            'POST',
            array(
                'document-name' => 'test',
                'document-show_in_nav' => true,
                'document-url_key' => 'test',
                'document-view' => $this->view->getId(),
                'document-layout' => $this->layout->getId(),
            )
        );
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentEdit');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::loadTabs
     * @covers Content\Controller\DocumentController::loadProperties
     * @covers Content\Controller\DocumentController::editAction
     *
     * @return void
     */
    public function testEditActionWithInvalidPostData()
    {
        $this->dispatch(
            '/admin/content/document/edit/' . $this->document->getId(),
            'POST',
            array(
            )
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentEdit');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::loadTabs
     * @covers Content\Controller\DocumentController::loadProperties
     * @covers Content\Controller\DocumentController::editAction
     *
     * @return void
     */
    public function testEditActionWithWrongId()
    {
        $this->dispatch('/admin/content/document/edit/999');
        $this->assertResponseStatusCode(302);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentEdit');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::copyAction
     *
     * @return void
     */
    public function testCopyAction()
    {
        $session = new SessionContainer();
        $session->offsetSet(
            'document-cut',
            999
        );

        $this->dispatch('/admin/content/document/copy/' . $this->document->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentCopy');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::copyAction
     *
     * @return void
     */
    public function testCopyActionWithWrongId()
    {
        $this->dispatch('/admin/content/document/copy/0');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentCopy');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::cutAction
     *
     * @return void
     */
    public function testCutAction()
    {
        $session = new SessionContainer();
        $session->offsetSet(
            'document-copy',
            999
        );

        $this->dispatch('/admin/content/document/cut/' . $this->document->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentCut');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::cutAction
     *
     * @return void
     */
    public function testCutActionWithWrongId()
    {
        $this->dispatch('/admin/content/document/cut/0');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentCut');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::pasteAction
     *
     * @return void
     */
    public function testPasteAction()
    {
        $this->dispatch('/admin/content/document/paste/' . $this->document->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentPaste');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::pasteAction
     *
     * @return void
     */
    public function testPasteActionWithWrongId()
    {
        $this->dispatch('/admin/content/document/paste/999');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentPaste');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::pasteAction
     *
     * @return void
     */
    public function testPasteActionWithWrongSessionId()
    {
        $session = new SessionContainer();
        $session->offsetSet(
            'document-cut',
            999
        );

        $this->dispatch('/admin/content/document/paste/' . $this->document->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentPaste');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::pasteAction
     *
     * @return void
     */
    public function testPasteActionWithCopySession()
    {
        $document = DocumentModel::fromArray(
            array(
                'name' => 'test',
                'url_key' => 'about',
                'status' => DocumentModel::STATUS_ENABLE,
                'user_id' => $this->user->getId(),
                'document_type_id' => $this->documentType->getId(),
                'view_id' => $this->view->getId(),
                'layout_id' => $this->layout->getId(),
                'parent_id' => null,
            )
        );
        $document->save();

        $session = new SessionContainer();
        $session->offsetSet(
            'document-copy',
            $this->document->getId()
        );

        $this->dispatch('/admin/content/document/paste/' . $document->getId() . '?name=new-name&url_key=testing');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentPaste');
        $document->delete();
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::pasteAction
     *
     * @return void
     */
    public function testPasteActionWithCutSession()
    {
        $document = DocumentModel::fromArray(
            array(
                'name' => 'test',
                'url_key' => 'about',
                'status' => DocumentModel::STATUS_ENABLE,
                'user_id' => $this->user->getId(),
                'document_type_id' => $this->documentType->getId(),
                'view_id' => $this->view->getId(),
                'layout_id' => $this->layout->getId(),
                'parent_id' => null,
            )
        );
        $document->save();

        $session = new SessionContainer();
        $session->offsetSet(
            'document-cut',
            $this->document->getId()
        );

        $this->dispatch('/admin/content/document/paste/' . $document->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentPaste');
        $document->delete();
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::pasteAction
     *
     * @return void
     */
    public function testPasteActionWithEmptyParent()
    {
        $this->dispatch('/admin/content/document/paste/0');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentPaste');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::refreshTreeviewAction
     *
     * @return void
     */
    public function testRefreshTreeviewAction()
    {
        $this->dispatch('/admin/content/document/refresh-treeview/' . $this->document->getId());
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentRefreshTreeview');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::refreshTreeviewAction
     *
     * @return void
     */
    public function testRefreshTreeviewActionWithEmptyDocument()
    {
        $this->dispatch('/admin/content/document/refresh-treeview/0');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentRefreshTreeview');
    }

    /**
     * Test
     *
     * @covers Content\Controller\DocumentController::init
     * @covers Content\Controller\DocumentController::sortOrderAction
     *
     * @return void
     */
    public function testSortOrderAction()
    {
        $this->dispatch(
            '/admin/content/document/sort',
            'POST',
            array(
                'order' => 'document_' . $this->document->getId()
            )
        );
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Content');
        $this->assertControllerName('DocumentController');
        $this->assertControllerClass('DocumentController');
        $this->assertMatchedRouteName('documentSortOrder');
    }
}
