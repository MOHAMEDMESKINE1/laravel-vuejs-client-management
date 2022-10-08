<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerTestController extends TestCase
{
    use RefreshDatabase;
    /*
        @test
     */
    public function itListCustomers()
    {
        $this->seed();
        $response = $this->get('/api/customers');

        $response->assertOk();

        $this->assertCount(15,$response->json('data'));
        $this->assertNotNull($response->json('data')[0])['tel'];
    }
     /*
        @test
     */
    // create
    public function itCreatesCustomer(){
        $response = $this->post("api/customers",[
            "name "=>"mon premier client",
            "tel" =>"07xxxx",
            "is_favourite"=>true
        ]);

        $customers = Customer::all();
        $customer = Customer::first();

        $response->assertOk();
        $this->assertEquals(15,$customers->count());
        $this->assertEquals('mon premier client ',$customer->name);
    }
    /*
        @test
     */   
     // validate fields
    public function itValidatesFields(){

        $response = $this->post("api/customers",[
            "name "=>"",
            "tel" =>"",
            "is_favourite"=>""
        ]);

        $response->assertOk();

        $response->assertSessionHasErrors('name','tel','is_favourite');
    }
     /*
        @test
     */
    // update customer
    public function itUpdateCustomer(){
        
        $this->seed();
        
        $customer = Customer::first();

        $response =  $this->put("api/customers".$customer->id,[
            "name"=>"Nom Edité",
            "tel"=>"06xx",
            "is_favourite"=>true,
        ]);

        $updatedtCustomer = Customer::find($customer->id);

        $response->assertOk();

        $this->assertEquals("Non Edité",$updatedtCustomer);
    }
}
