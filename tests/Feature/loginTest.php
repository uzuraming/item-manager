<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


// ログイン機能を見るテスト


class loginTest extends TestCase
{
     use RefreshDatabase;


    /**
     * A basic feature test example.
     *
     * @return void
     */
     
    // データのセットアップ
    public function setUp(): void
    {
        parent::setUp();

        // テストユーザ作成
        $this->admin_user = factory(\App\User::class)->create(); // 管理者ユーザー
        
        $this->user = factory(\App\User::class)->create(['admin' => 1]); //一般ユーザー
    }
    
    
    //  ログインページに行けるか
    public function testAccsesLogin(): void{

        $response = $this->get('/login');
        $response->assertStatus(200);

    }
    
    //  未ログインのとき、ログイン画面にちゃんとリダイレクトされるのか
    public function testGuest(): void{

        $response = $this->get('/');
        $response->assertStatus(302)
                 ->assertRedirect('/login');;

    }
    

    // 作成した管理者ユーザーでログインしたときホーム画面に行けるか
    public function testAdminLogin() :void
    {   
    
        $response = $this->actingAs($this->admin_user)
                         ->get('/');
        $response->assertStatus(200);
        $this->assertAuthenticatedAs($this->admin_user);
    }
   
   
   
   // 作成した管理者ユーザーでログインしたときホーム画面に行けるか
    public function testAdmin() :void
    {   
    
        $response = $this->actingAs($this->admin_user)
                         ->get('/');
        $response->assertStatus(200);
        $this->assertAuthenticatedAs($this->admin_user);
    }
   
   
  
   
   
   
    // 管理者ユーザーの機能チェック
    public function testAdminFunction() :void
    {   
        
        //---------------------------------------------------------------   
        //  管理者ユーザーのチェック
        //--------------------------------------------------------------- 
        
        
        
        // --------------------------------------
        // 部屋作成のテスト
        // --------------------------------------
        
        // 部屋作成画面に行けるかチェック
        $create_room_res = $this->actingAs($this->admin_user)
                         ->get('/rooms/create');
        $create_room_res->assertStatus(200);
        
        
        
        // 部屋を作成し、部屋一覧画面にリダイレクトすることを検証
        $store_room_res = $this->actingAs($this->admin_user)
                         ->post('/rooms',[
                                'room_name' => 'test'
        ]);
        
        $store_room_res->assertRedirect('/rooms');
        $store_room_res->assertStatus(302);
        
        // 投稿した内容が表示されているかチェック
        $room_data = $this->actingAs($this->user)
                         ->get('/rooms/1');
                         
        $room_data->assertStatus(200);
        $room_data ->assertSee('test');
        
        // 投稿した内容以外の場所にアクセスしたら、404が返ってくるかチェック
        $invaild_room_data = $this->actingAs($this->user)
                         ->get('/rooms/2');
                         
        $invaild_room_data->assertStatus(404);
        
        
        // 部屋編集画面に行けるかチェック
        $edit_room_res = $this->actingAs($this->admin_user)
                         ->get('/rooms/1/edit');
        $edit_room_res->assertStatus(200);
        
        $update_room_res = $this->actingAs($this->admin_user)
                         ->put('/rooms/1',[
                                'room_name' => 'changed'
        ]);
        $update_room_res->assertRedirect('/rooms');
        $update_room_res->assertStatus(302);
        
        // 投稿した内容が表示されているかチェック
        $changed_room_data = $this->actingAs($this->user)
                         ->get('/rooms/1');
                         
        $changed_room_data->assertStatus(200);
        $changed_room_data ->assertSee('changed');
        
        
        // --------------------------------------
        // 場所作成のテスト
        // --------------------------------------
        
        // 場所作成画面に行けるかチェック
        $create_place_res = $this->actingAs($this->admin_user)
                         ->get('/rooms/1/create');
        $create_place_res->assertStatus(200);
        
        
        
        // 部屋を作成し、部屋一覧画面にリダイレクトすることを検証
        $store_place_res = $this->actingAs($this->admin_user)
                         ->post('/rooms/1',[
                                'place_name' => 'test_place'
        ]);
        
        $store_place_res->assertRedirect('/rooms/1', '部屋作成失敗');
        $store_place_res->assertStatus(302);
        
        // 投稿した内容が表示されているかチェック
        $place_data = $this->actingAs($this->user)
                         ->get('/rooms/1/1');
                         
        $place_data->assertStatus(200);
        $place_data->assertSee('test_place');
        
        // 投稿した内容以外の場所にアクセスしたら、404が返ってくるかチェック
        $invaild_place_data = $this->actingAs($this->user)
                         ->get('/rooms/2/1');
                         
        $invaild_place_data->assertStatus(404);
        
        
        // 編集画面に行けるかチェック
        $edit_place_res = $this->actingAs($this->admin_user)
                         ->get('/rooms/1/1/edit');
        $edit_place_res->assertStatus(200);
        
        $update_place_res = $this->actingAs($this->admin_user)
                         ->put('/rooms/1/1',[
                                'place_name' => 'changed_place'
        ]);
        $update_place_res->assertRedirect('/rooms/1', '失敗');
        $update_place_res->assertStatus(302);
        
        // 投稿した内容が表示されているかチェック
        $chaned_place_data = $this->actingAs($this->user)
                         ->get('/rooms/1/1');
                         
        $chaned_place_data->assertStatus(200);
        $chaned_place_data ->assertSee('changed_place');
        
        
        
        
         
        // --------------------------------------
        // 場所詳細作成のテスト
        // --------------------------------------
        
        // 作成画面に行けるかチェック
        $create_place_detail_res = $this->actingAs($this->admin_user)
                         ->get('/rooms/1/1/create');
        $create_place_detail_res->assertStatus(200);
        
        
        
        // 一覧画面にリダイレクトすることを検証
        $store_place_detail_res = $this->actingAs($this->admin_user)
                         ->post('/rooms/1/1',[
                                'place_detail_name' => 'test_detail_place'
        ]);
        
        $store_place_detail_res->assertRedirect('/rooms/1/1');
        $store_place_detail_res->assertStatus(302);
        
        // 投稿した内容が表示されているかチェック
        $place_detail_data = $this->actingAs($this->user)
                         ->get('/rooms/1/1/1');
                         
        $place_detail_data->assertStatus(200);
        $place_detail_data->assertSee('test_detail_place');
        
        // 投稿した内容以外の場所に適当にアクセスしたら、404が返ってくるかチェック
        $invaild_place_detail_data = $this->actingAs($this->user)
                         ->get('/rooms/2/1/2');
                         
        $invaild_place_detail_data->assertStatus(404);
        
        
        // 編集画面に行けるかチェック
        $edit_place_detail_res = $this->actingAs($this->admin_user)
                         ->get('/rooms/1/1/1/edit');
        $edit_place_detail_res->assertStatus(200);
        
        $update_place_detail_res = $this->actingAs($this->admin_user)
                         ->put('/rooms/1/1/1',[
                                'place_detail_name' => 'changed_place_detail'
        ]);
        $update_place_detail_res->assertRedirect('/rooms/1/1', '失敗');
        $update_place_detail_res->assertStatus(302);
        
        // 投稿した内容が表示されているかチェック
        $changed_place_detail_data = $this->actingAs($this->user)
                         ->get('/rooms/1/1/1');
                         
        $changed_place_detail_data->assertStatus(200);
        $changed_place_detail_data->assertSee('changed_place_detail');
        
        
        
        
        // --------------------------------------
        // 物品作成のテスト
        // --------------------------------------
        
        // 作成画面に行けるかチェック
        $create_item_res = $this->actingAs($this->admin_user)
                         ->get('/rooms/1/1/1/create');
        $create_item_res->assertStatus(200);
        
        
        
        // 一覧画面にリダイレクトすることを検証
        $store_item_res = $this->actingAs($this->admin_user)
                         ->post('/rooms/1/1/1',[
                                'item_name' => 'test_item',
                                'remaining_amount' => 5,
                                'alert_amount' => 10,
         
        ]);
        
        $store_item_res->assertRedirect('/rooms/1/1/1');
        $store_item_res->assertStatus(302);
        
        // 投稿した内容が表示されているかチェック
        $item_data = $this->actingAs($this->user)
                         ->get('/rooms/1/1/1/1');
                         
        $item_data->assertStatus(200);
        $item_data->assertSee('test_item');
        
        // 投稿した内容以外の場所に適当にアクセスしたら、404が返ってくるかチェック
        $invaild_item_data = $this->actingAs($this->user)
                         ->get('/rooms/2/1/2/1');
                         
        $invaild_item_data->assertStatus(404);
        
        
        // 編集画面に行けるかチェック
        $edit_item_res = $this->actingAs($this->admin_user)
                         ->get('/rooms/1/1/1/1/edit');
        $edit_item_res->assertStatus(200);
        
        $update_item_res = $this->actingAs($this->admin_user)
                         ->put('/rooms/1/1/1/1',[
                                'item_name' => 'changed_item',
                                'remaining_amount' => 5,
                                'alert_amount' => 10,
        ]);
        $update_item_res->assertRedirect('/rooms/1/1/1', '失敗');
        $update_item_res->assertStatus(302);
        
        // 投稿した内容が表示されているかチェック
        $changed_item_data = $this->actingAs($this->user)
                         ->get('/rooms/1/1/1/1');
                         
        $changed_item_data->assertStatus(200);
        $changed_item_data->assertSee('changed_item');
        
        
        
        // 物品リクエストに表示されていないことをチェック
        $cant_request_data = $this->actingAs($this->user)
                         ->get('/item_request');
        
        $cant_request_data->assertDontSee('changed_item');
        
        
        
        
        //---------------------------------------------------------------   
        //  一般ユーザーのチェック
        //--------------------------------------------------------------- 
        
        // --------------------------------------
        // 部屋作成のテスト
        // --------------------------------------
        
        // 部屋作成画面に行けないことをチェック
        $cant_create_room_res = $this->actingAs($this->user)
                         ->get('/rooms/create');
        $cant_create_room_res->assertRedirect('/rooms');
        

        
        // 部屋編集画面に行けないことをチェック
        $cant_edit_room_res = $this->actingAs($this->user)
                         ->get('/rooms/1/edit');
        $cant_edit_room_res->assertRedirect('/rooms');
        

        
        
        // --------------------------------------
        // 場所作成のテスト
        // --------------------------------------
        
        // 場所作成画面に行けないことをチェック
        $cant_create_place_res = $this->actingAs($this->user)
                         ->get('/rooms/1/create');
        $cant_create_place_res->assertRedirect('/rooms/1');
        
    
        
        
        // 編集画面に行けないことをチェック
        $cant_edit_place_res = $this->actingAs($this->user)
                         ->get('/rooms/1/1/edit');
        $cant_edit_place_res->assertRedirect('/rooms/1');
        

        
         
        // --------------------------------------
        // 場所詳細作成のテスト
        // --------------------------------------
        
        // 作成画面に行けるないことをチェック
        $cant_create_place_detail_res = $this->actingAs($this->user)
                         ->get('/rooms/1/1/create');
        $cant_create_place_detail_res->assertRedirect('/rooms/1/1');
        
        
        
        // 編集画面に行けるないことをチェック
        $cant_edit_place_detail_res = $this->actingAs($this->user)
                         ->get('/rooms/1/1/1/edit');
        $cant_edit_place_detail_res->assertRedirect('/rooms/1/1');
        

 
        
        // --------------------------------------
        // 物品作成のテスト
        // --------------------------------------
        
        // 作成画面に行けるかチェック
        $can_create_item_res = $this->actingAs($this->user)
                         ->get('/rooms/1/1/1/create');
        $can_create_item_res->assertStatus(200);
        
        
        
        // 一覧画面にリダイレクトすることを検証
        $can_store_item_res = $this->actingAs($this->user)
                         ->post('/rooms/1/1/1',[
                                'item_name' => 'test2_item',
                                'remaining_amount' => 5,
                                'alert_amount' => 10,
         
        ]);
        
        $can_store_item_res->assertRedirect('/rooms/1/1/1');
        $can_store_item_res->assertStatus(302);
        
        // 投稿した内容が表示されていないかチェック(承認済みしか表示されないはず)
        $can_item_data = $this->actingAs($this->user)
                         ->get('/rooms/1/1/1');
                         
        $can_item_data->assertStatus(200);
        $can_item_data->assertDontSee('test2_item');
        
        
        // 物品リクエストに表示されていることをチェック
        $request_data = $this->actingAs($this->user)
                         ->get('/item_request');
        
        $request_data->assertSee('test2_item');
        
        
        
        // 編集画面に行けないことをチェック
        $cant_edit_item_res = $this->actingAs($this->user)
                         ->get('/rooms/1/1/1/1/edit');
        $cant_edit_item_res->assertRedirect('/rooms/1/1/1');
        
        
        

    }
   

    
    
    
        //---------------------------------------------------------------   
        //  一般ユーザーのチェック
        //---------------------------------------------------------------  
       
}
