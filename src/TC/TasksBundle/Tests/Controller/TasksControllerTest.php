<?php

namespace TC\TasksBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TasksControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'tasks/index');
    }

    public function testNew()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'tasks/new');
    }

}
