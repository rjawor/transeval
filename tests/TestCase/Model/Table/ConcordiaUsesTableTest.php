<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConcordiaUsesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConcordiaUsesTable Test Case
 */
class ConcordiaUsesTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.concordia_uses',
        'app.targets',
        'app.inputs',
        'app.assignments',
        'app.languages',
        'app.users',
        'app.roles',
        'app.users_assignments'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ConcordiaUses') ? [] : ['className' => 'App\Model\Table\ConcordiaUsesTable'];
        $this->ConcordiaUses = TableRegistry::get('ConcordiaUses', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConcordiaUses);

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
