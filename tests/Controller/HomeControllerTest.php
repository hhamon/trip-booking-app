<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class HomeControllerTest extends PantherTestCase
{
    public function testBrowseHomepageAsGuest(): void
    {
        $client = self::createPantherClient();
        $client->request('GET', '/');

        // Check title & subtitle
        $this->assertPageTitleContains('Dream Holiday');
        $this->assertSelectorTextContains('h1', 'TRAVEL THE WORLD');
        $this->assertSelectorTextContains('h2#subtitle', 'Book Today with Dream Holiday');

        // Check destinations cards
        $this->assertSelectorCount(3, '#featured-offers-presentation .f-offer-card-link');
        $this->assertSelectorTextContains('#featured-offers-presentation .f-offer-card-link:first-child', 'R- AKASAKA ONSEN RESORT');
        $this->assertSelectorTextContains('#featured-offers-presentation .f-offer-card-link:nth-child(2)', 'H- BEI-JING');
        $this->assertSelectorTextContains('#featured-offers-presentation .f-offer-card-link:last-child', 'H- PATAGONIA');

        // Check offer types links
        $this->assertSelectorTextContains('#offer-types-presentation h3', 'Follow Your Dreams');
        $this->assertSelectorTextContains('#offer-types-presentation p', 'Make them come True');
        $this->assertSelectorTextContains('#offer-types-presentation .offer-type-btn:first-child', 'First Minute');
        $this->assertSelectorTextContains('#offer-types-presentation .offer-type-btn:nth-child(2)', 'Last Minute');
        $this->assertSelectorTextContains('#offer-types-presentation .offer-type-btn:nth-child(3)', 'All Inclusive');

        // Check footer links
        $this->assertSelectorTextContains('footer .col-md-3:nth-child(3) .footer-link:first-child', 'First Minute');
        $this->assertSelectorTextContains('footer .col-md-3:nth-child(3) .footer-link:nth-child(2)', 'Last Minute');
        $this->assertSelectorTextContains('footer .col-md-3:nth-child(3) .footer-link:last-child', 'Bargain Zone');
    }
}
