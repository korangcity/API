<?php

namespace Tests\Unit;


class AuthTest extends MyTestCase
{

//    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
//    public function testUserRegister()
//    {
//        $response =$this->post('api/register',
//            ['name' => 'Mahdi', 'email' => 'm.fH@gmail.com', 'password' => '12345678', 'password_confirmation' => '12345678']
//        );
//        $response->assertCreated();
//
//    }
//
    public function testUserLogin()
    {
        $response = $this->callApi('POST','login',['email' => 'm.fH@gmail.com', 'password' => '12345678']);
//        $this->post('api/login', ['email' => 'm.fH@gmail.com', 'password' => '12345678']);

        $this->assertNotEmpty($response);
    }

    public function testUserLogout()
    {
        $response=$this->callApi('POST','logout',[]);
        $response->assertOk();
    }

    public function testRefresh()
    {
        $response =$this->callApi('POST','refresh',[]);
        $this->assertNotEmpty($response);
    }



}
