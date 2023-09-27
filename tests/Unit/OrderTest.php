<?php

namespace Tests\Unit;


class OrderTest extends MyTestCase
{

    public function testCreateOrder()
    {
        $response=$this->callApi('POST','order/create',['user_id'=>'65143a48a3644db9e00c8cf2',
            'product_id'=>['65143e263ddbef26f40327a2','65143eeb6a003b4dd60bbaf2'],'count'=>[10,10]]);

        $response->assertCreated();
    }

    public function testUpdateOrder()
    {
        $response=$this->callApi('PUT','order',['order_id'=>'651441eb68150b1bac0e28c2',
            'product_id'=>['65143e263ddbef26f40327a2','65143eeb6a003b4dd60bbaf2'],'count'=>[3,4]]);

        $response->assertCreated();
    }

    public function testGetOrders()
    {
        $response=$this->callApi('GET','orders',[]);

        $response->assertOk();
    }

    public function testShowOrder()
    {
        $response=$this->callApi('GET','order/651441d479ccb5904f061242',[]);

        $response->assertOk();
    }

    public function testDeleteOrder()
    {
        $response=$this->callApi('DELETE','order/651441d479ccb5904f061242',[]);

        $response->assertOk();
    }

}
