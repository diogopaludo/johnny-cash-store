<?php

namespace App\Test\TestCase\Action;

use App\Domain\Sku\Data\SkuData;
use App\Domain\Sku\Repository\SkuRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class SkuActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test a successful SKU request.
     *
     * @dataProvider provideSkuGetInfo
     *
     * @param SkuData $sku The SKU
     * @param array $expected The expected result
     *
     * @return void
     */
    public function testSkuGet(SkuData $sku, array $expected): void
    {
        $this->mock(SkuRepository::class)->method('getSku')->willReturn($sku);
        $request = $this->createRequest('GET', '/sku/1');
        $response = $this->app->handle($request);
        $this->assertSame(201, $response->getStatusCode());
        $this->assertJsonData($response, $expected);
    }

    /**
     * Provider for the SKU request.
     *
     * @return array The data
     */
    public function provideSkuGetInfo(): array
    {
        $sku = new SkuData();
        $sku->id = 1;
        $sku->name = 'Fromage';
        $sku->price = 50;
        return [
            'Sku' => [
                $sku,
                [
                    'id' => 1,
                    'name' => 'Fromage',
                    'price' => 50
                ]
            ]
        ];
    }
    
    /**
     * Test a invalid ID for a SKU.
     *
     * @param array $error The SKU
     * @param array $expected The expected result
     *
     * @return void
     */
    public function testSkuGetFailure(): void
    {
        $request = $this->createRequest('GET', '/sku/0');
        $response = $this->app->handle($request);
        $this->assertSame(422, $response->getStatusCode());
        
        $request = $this->createRequest('GET', '/sku/11111111111111111111111111111111111');
        $response = $this->app->handle($request);
        $this->assertSame(422, $response->getStatusCode());
    }
    
    /**
     * Test.
     *
     * @dataProvider provideSkuTopSellingInfo
     *
     * @param array $topSeller The top seller information
     * @param array $expected The expected result
     *
     * @return void
     */
    public function testSkuTopSelling(array $topSelling, array $expected): void
    {
        $this->mock(SkuRepository::class)->method('getTopSelling')->willReturn($topSelling);
        $request = $this->createRequest('GET', '/sku/top-selling/2019-09-30/2019-10-01');
        $response = $this->app->handle($request);
        $this->assertSame(201, $response->getStatusCode());
        $this->assertJsonData($response, $expected);
    }

    /**
     * Provider.
     *
     * @return array The data
     */
    public function provideSkuTopSellingInfo(): array
    {
        return [
            'Sku' => [
                [
                    [
                        ["skuId" => "41","skuName" => "Pattes d'Ours","quantity" => "2"],
                        ["skuId" => "6","skuName" => "Perrier","quantity" => "1"],
                        ["skuId" => "31","skuName" => "Coffee Crisp","quantity" => "1"],
                        ["skuId" => "4","skuName" => "Jus Oasis","quantity" => "1"],
                        ["skuId" => "20","skuName" => "Chips - Doritos","quantity" => "1"]
                    ]
                ],
                [
                    [
                        ["skuId" => "41","skuName" => "Pattes d'Ours","quantity" => "2"],
                        ["skuId" => "6","skuName" => "Perrier","quantity" => "1"],
                        ["skuId" => "31","skuName" => "Coffee Crisp","quantity" => "1"],
                        ["skuId" => "4","skuName" => "Jus Oasis","quantity" => "1"],
                        ["skuId" => "20","skuName" => "Chips - Doritos","quantity" => "1"]
                    ]
                ]
            ]
        ];
    }
    
    /**
     * Testing an invalid initial date for the Top Selling SKU.
     *
     * @return void
     */
    public function testSkuTopSellingInvalidInitialDate(): void
    {
        $request = $this->createRequest('GET', '/sku/top-selling/2019-09-33/2019-10-01');
        $response = $this->app->handle($request);
        $this->assertSame(422, $response->getStatusCode());
    }
    
    /**
     * Testing an invalid final date for the Top Selling SKU.
     *
     * @return void
     */
    public function testSkuTopSellingInvalidFinalDate(): void
    {
        $request = $this->createRequest('GET', '/sku/top-selling/2019-09-31/2019-10-00');
        $response = $this->app->handle($request);
        $this->assertSame(422, $response->getStatusCode());
    }
    
    /**
     * Testing an initial date greater than the final date.
     *
     * @return void
     */
    public function testSkuTopSellingInitialDateGreater(): void
    {
        $request = $this->createRequest('GET', '/sku/top-selling/2019-12-31/2019-10-00');
        $response = $this->app->handle($request);
        $this->assertSame(422, $response->getStatusCode());
    }
}
