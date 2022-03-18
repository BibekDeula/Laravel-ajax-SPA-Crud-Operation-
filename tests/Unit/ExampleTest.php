<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;


class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_new()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_user_duplication(){
        $data1=User::find(1);
        $data2=User::find(2);
        $this->assertTrue($data1 != $data2);

    }
    public function test_database(){
        $this->assertDatabaseMissing('users',[
            'name'=>'java'
        ]);
    }
    public function test_portfolio(){
        $response=$this->get('portfolio');
        $response->assertStatus(200);
    
    }

}
