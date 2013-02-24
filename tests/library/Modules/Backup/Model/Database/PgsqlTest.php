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
namespace Modules\Backup\Model\Database;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-01-30 at 08:29:27.
 *
 * @backupGlobals disabled
 * @backupStaticAttributes disabled
 * @group Modules
 * @category Gc_Tests
 * @package  Modules
 */
class PgsqlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Pgsql
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new Pgsql;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Modules\Backup\Model\Database\Pgsql::export
     */
    public function testExport()
    {
        $connection = $this->object->getAdapter()->getDriver()->getConnection();
        $parameters = $connection->getConnectionParameters();
        if($parameters['driver'] != 'pdo_pgsql')
        {
            return;
        }

        $parameters['port'] = 5432;
        $connection->setConnectionParameters($parameters);

        $this->assertInternalType('string', $this->object->export());
    }

    /**
     * @covers Modules\Backup\Model\Database\Pgsql::export
     */
    public function testExportDataOnly()
    {
        $connection = $this->object->getAdapter()->getDriver()->getConnection();
        $parameters = $connection->getConnectionParameters();
        if($parameters['driver'] != 'pdo_pgsql')
        {
            return;
        }

        $this->assertInternalType('string', $this->object->export('dataonly'));
    }

    /**
     * @covers Modules\Backup\Model\Database\Pgsql::export
     */
    public function testExportStructureOnly()
    {
        $connection = $this->object->getAdapter()->getDriver()->getConnection();
        $parameters = $connection->getConnectionParameters();
        if($parameters['driver'] != 'pdo_pgsql')
        {
            return;
        }

        $this->assertInternalType('string', $this->object->export('structureonly'));
    }
}
