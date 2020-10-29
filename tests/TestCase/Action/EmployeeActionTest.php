<?php

namespace App\Test\TestCase\Action;

use App\Domain\Employee\Data\EmployeeData;
use App\Domain\Employee\Repository\EmployeeRepository;
use App\Test\AppTestTrait;
use PHPUnit\Framework\TestCase;

class EmployeeActionTest extends TestCase
{
    use AppTestTrait;

    /**
     * Test.
     *
     * @dataProvider provideEmployeeAction
     *
     * @param EmployeeData $employee The Employee
     * @param array $expected The expected result
     *
     * @return void
     */
    public function testEmployeeAction(EmployeeData $employee, array $expected): void
    {
        // Mock the repository resultset
        $this->mock(EmployeeRepository::class)->method('getEmployee')->willReturn($employee);
        
        // Create request with method and url
        $request = $this->createRequest('GET', '/employee/1');

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
    public function provideEmployeeAction(): array
    {
        $employee = new EmployeeData();
        $employee->id = 1;
        $employee->name = 'Adrien';
        return [
            'Employee' => [
                $employee,
                [
                    'id' => 1,
                    'name' => 'Adrien',
                ]
            ]
        ];
    }
    
    /**
     * Test a invalid ID for a Employee.
     *
     * @param array $error The Employee
     * @param array $expected The expected result
     *
     * @return void
     */
    public function testEmployeeGetFailure(): void
    {
        $request = $this->createRequest('GET', '/employee/0');
        $response = $this->app->handle($request);
        $this->assertSame(422, $response->getStatusCode());
        
        $request = $this->createRequest('GET', '/employee/11111111111111111111111111111111111');
        $response = $this->app->handle($request);
        $this->assertSame(422, $response->getStatusCode());
    }
}
