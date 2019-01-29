<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TaskTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TaskTable Test Case
 */
class TaskTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TaskTable
     */
    public $Task;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Task',
        'app.Users',
        'app.Priorities'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Task') ? [] : ['className' => TaskTable::class];
        $this->Task = TableRegistry::getTableLocator()->get('Task', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Task);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
