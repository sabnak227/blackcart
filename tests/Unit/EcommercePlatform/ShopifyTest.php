<?php

namespace Tests\Unit;

use App\Lib\EcommercePlatform\Adapters\Shopify;
use App\Lib\EcommercePlatform\MockedSdk\ShopifySdk;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ShopifyTest extends TestCase
{
    protected $json;

    public function setUp(): void
    {
        parent::setUp();
        $json = Storage::disk('local')->get('shopify.json');
        $this->json = json_decode($json, true);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testListProduct()
    {
        $this->mock(ShopifySdk::class, function ($mock) {
            $mock->shouldReceive('listProducts')
                ->andReturn($this->json);
        });
        $instance = app(Shopify::class);
        $res = $instance->listProducts();

        $this->assertCount(2, $res);

        $this->assertEquals(632910392, $res[0]['id']);
        $this->assertEquals('IPod Nano - 8GB', $res[0]['name']);
        $this->assertEquals('USD', $res[0]['price'][0]['currency']);
        $this->assertEquals(199, $res[0]['price'][0]['price']);
        $this->assertEquals(40, $res[0]['inventory']);
        $this->assertEquals('Color', $res[0]['option'][0]['option']);
        $this->assertCount(4, $res[0]['option'][0]['values']);
        $this->assertEquals('Pink', $res[0]['option'][0]['values'][0]);
        $this->assertEquals('Red', $res[0]['option'][0]['values'][1]);
        $this->assertEquals('Green', $res[0]['option'][0]['values'][2]);
        $this->assertEquals('Black', $res[0]['option'][0]['values'][3]);
        $this->assertEquals(1.25, $res[0]['weight']);


        $this->assertEquals(921728736, $res[1]['id']);
        $this->assertEquals('IPod Touch 8GB', $res[1]['name']);
        $this->assertEquals('USD', $res[1]['price'][0]['currency']);
        $this->assertEquals(199, $res[1]['price'][0]['price']);
        $this->assertEquals(13, $res[1]['inventory']);
        $this->assertEquals('Title', $res[1]['option'][0]['option']);
        $this->assertCount(1, $res[1]['option'][0]['values']);
        $this->assertEquals('Black', $res[1]['option'][0]['values'][0]);
        $this->assertEquals(1.25, $res[1]['weight']);
    }
}
