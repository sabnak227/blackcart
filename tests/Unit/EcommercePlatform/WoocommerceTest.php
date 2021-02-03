<?php

namespace Tests\Unit;

use App\Lib\EcommercePlatform\Adapters\WooCommerce;
use App\Lib\EcommercePlatform\MockedSdk\WooCommerceSdk;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class WoocommerceTest extends TestCase
{
    protected $json;

    public function setUp(): void
    {
        parent::setUp();
        $json = Storage::disk('local')->get('woocommerce.json');
        $this->json = json_decode($json, true);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListProduct()
    {
        $this->mock(WooCommerceSdk::class, function ($mock) {
            $mock->shouldReceive('listProducts')
                ->andReturn($this->json);
        });
        $instance = app(WooCommerce::class);
        $res = $instance->listProducts();

        $this->assertCount(2, $res);

        $this->assertEquals(799, $res[0]['id']);
        $this->assertEquals('Ship Your Idea', $res[0]['name']);
        $this->assertEquals('USD', $res[0]['price'][0]['currency']);
        $this->assertEquals(0, $res[0]['price'][0]['price']);
        $this->assertEquals(-1, $res[0]['inventory']);
        $this->assertEquals('Size', $res[0]['option'][0]['option']);
        $this->assertCount(2, $res[0]['option'][0]['values']);
        $this->assertEquals('S', $res[0]['option'][0]['values'][0]);
        $this->assertEquals('M', $res[0]['option'][0]['values'][1]);
        $this->assertEquals(0, $res[0]['weight']);


        $this->assertEquals(794, $res[1]['id']);
        $this->assertEquals('Premium Quality', $res[1]['name']);
        $this->assertEquals('USD', $res[1]['price'][0]['currency']);
        $this->assertEquals(21.99, $res[1]['price'][0]['price']);
        $this->assertEquals(-1, $res[1]['inventory']);
        $this->assertCount(0, $res[1]['option']);
        $this->assertEquals(0, $res[1]['weight']);
    }
}
