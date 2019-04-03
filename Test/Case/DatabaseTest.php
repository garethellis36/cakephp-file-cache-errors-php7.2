<?php

class DatabaseTest extends CakeTestCase
{
    public $fixtures = [
        "app.user",
    ];

    /**
     * @test
     */
    public function test_a_thing()
    {
        /** @var Mysql $mysql */
        $mysql = ConnectionManager::getDataSource("test");
        $mysql->flushMethodCache();
    }
}
