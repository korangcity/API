<?php

namespace Tests\Unit;

class ProductTest extends MyTestCase
{

    public function testGetProducts()
    {
        $response=$this->callApi('GET','products',[]);
        $response->assertOk();
    }

    public function testProductCreate()
    {
        $response=$this->callApi('POST','product/create',['name'=>'Moz','price'=>'10000','inventory'=>'200']);
        $response->assertCreated();
    }

//    public function testShowProduct()
//    {
//        $response=$this->callApi('GET','product/65143d1710d3fc741401ef92',[]);
//        $response->assertOk();
//    }

//    public function testUpdateProduct()
//    {
//        $response=$this->callApi('PUT','product/65143d1710d3fc741401ef92',['name'=>'Moz','price'=>'2500','inventory'=>'10']);
//        $response->assertAccepted();
//    }
//
//    public function testDeleteProduct()
//    {
//        $response=$this->callApi('DELETE','product/65143dece816efbdc806a292',[]);
//        $response->assertOk();
//    }

}
