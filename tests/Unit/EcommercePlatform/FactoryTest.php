<?php

namespace Tests\Unit;

use App\Lib\EcommercePlatform\Adapters\EcommerceFactory;
use App\Lib\EcommercePlatform\Adapters\Shopify;
use App\Lib\EcommercePlatform\Adapters\WooCommerce;
use App\Models\Store;
use Tests\TestCase;

class FactoryTest extends TestCase
{
    protected $shopifyStore;
    protected $woocommerceStore;

    public function setUp(): void
    {
        parent::setUp();
        $this->shopifyStore = new Store(['platform' => 'shopify']);
        $this->woocommerceStore = new Store(['platform' => 'woocommerce']);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetInstanceByStore()
    {
        $instance = EcommerceFactory::getInstance($this->shopifyStore);
        $this->assertEquals(Shopify::class, get_class($instance));

        $instance = EcommerceFactory::getInstance($this->woocommerceStore);
        $this->assertEquals(WooCommerce::class, get_class($instance));
    }
}
