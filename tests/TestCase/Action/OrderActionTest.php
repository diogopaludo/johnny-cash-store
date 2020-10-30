<?php

namespace App\Test\TestCase\Action;

use App\Domain\Order\Data\OrderData;
use App\Domain\Order\Repository\OrderRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class OrderActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test a successful Order request.
     *
     * @dataProvider provideOrderGetInfo
     *
     * @param OrderData $order The Order
     * @param array $expected The expected result
     *
     * @return void
     */
    public function testOrderGet(OrderData $order, array $expected): void
    {
        $this->mock(OrderRepository::class)->method('getOrder')->willReturn($order);
        $request = $this->createRequest('GET', '/order/100');
        $response = $this->app->handle($request);
        $this->assertSame(201, $response->getStatusCode());
        $this->assertJsonData($response, $expected);
    }

    /**
     * Provider for the Order request.
     *
     * @return array The data
     */
    public function provideOrderGetInfo(): array
    {
        $order = new OrderData();
        $order->id = 100;
        $order->timeCreated = '2019-09-01 10:30:00';
        $order->employeeId = 2;
        $order->skuId = 30;
        $order->quantity = 1;
        $order->totalPrice = 125;
        $order->paidInBox = null;
        return [
            'Order' => [
                $order,
                [
                    "id" => 100,
                    "timeCreated" => "2019-09-01 10:30:00",
                    "employeeId" => 2,
                    "skuId" => 30,
                    "quantity" => 1,
                    "totalPrice" => 125,
                    "paidInBox" => null
                ]
            ]
        ];
    }
    
    /**
     * Test a invalid ID for a Order.
     *
     * @param array $error The Order
     * @param array $expected The expected result
     *
     * @return void
     */
    public function testOrderGetFailure(): void
    {
        $request = $this->createRequest('GET', '/order/0');
        $response = $this->app->handle($request);
        $this->assertSame(422, $response->getStatusCode());
        
        $request = $this->createRequest('GET', '/order/11111111111111111111111111111111111');
        $response = $this->app->handle($request);
        $this->assertSame(422, $response->getStatusCode());
    }
    
    /**
     * Test.
     *
     * @dataProvider provideEmployeeActionUnpaidBills
     *
     * @param EmployeeData $employee The Employee
     * @param array $expected The expected result
     *
     * @return void
     */
    public function testEmployeeActionUnpaidBills(array $bills, array $expected): void
    {
        $this->mock(OrderRepository::class)->method('getUnpaidBills')->willReturn($bills);
        
        // Create request with method and url
        $request = $this->createRequest('GET', '/order/unpaid');

        // Make request and fetch response
        $response = $this->app->handle($request);
        // Asserts
        $this->assertSame(201, $response->getStatusCode());
        $this->assertJsonData($response, $expected);
    }

    /**
     * Provider.
     *
     * @return array The data
     */
    public function provideEmployeeActionUnpaidBills(): array
    {
        //add data
        return [
            'Order' =>
            [
                [],
                []
            ]
        ];
    }
}
