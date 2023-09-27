<?php
namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class MyTestCase extends TestCase
{

    protected function callApi($method,$endpoint, $params = [], $asUser = 'm.fH@gmail.com')
    {
        $headers = [];

        if (!is_null($asUser)) {
            $token = auth()->guard('api')
                ->login(User::where('email',$asUser)->first());

            $headers['Authorization'] = 'Bearer ' . $token;
        }

        return $this->json(
            $method,
            'http://127.0.0.1/api/' . $endpoint,
            $params,
            $headers
        );
    }
}
