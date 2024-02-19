<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

final class AppBrowsingTest extends PantherTestCase
{
    public function testBrowseApplication(): void
    {
        $client = static::createPantherClient();
        $client->request('GET', '/');

        $this->assertSelectorTextContains('h1', 'TRAVEL THE WORLD');
        $this->assertSelectorTextContains('#offer-types-presentation', 'First Minute');

        $client->clickLink('Destinations');

        $this->assertPageTitleContains('Destinations - Dream Holiday');
        $this->assertSelectorTextContains('body', 'JAPAN');

        $client->clickLink('Italy');

        $this->assertSelectorTextContains('body', 'Sorry, nothing was found...');
    }
}
