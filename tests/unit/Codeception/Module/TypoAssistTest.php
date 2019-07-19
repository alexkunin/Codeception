<?php

use Codeception\Module\TypoAssist;
use Codeception\Test\Unit;

class TypoAssistTest extends Unit
{
    /**
     * @var TypoAssist
     */
    private $module;

    protected function _setUp()
    {
        $this->module = new TypoAssist(make_container());
    }

    public function testExactMethodMatch()
    {
        try {
            $this->module->haveInRepository(SomeClass::class, []);
            $this->assertTrue(false, 'Expected exception was not raised');
        } catch (Exception $e) {
//            $this->deb
//            print_r($e->getMessage());
//            exit;
        }
    }
}
