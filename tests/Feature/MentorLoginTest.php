<?php
 
 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\UserMentor;
 
 
 
test('mentor dapat login melalui halaman login', function () {
 
 $response = $this->post('/login', [
'email' => 'mentor@telkom.co.id',
'password' => 'password123',]);
 
 

//  $response->assertRedirect('/mentor/lowongan');
 
//  $this->assertAuthenticated();
//  $this->assertEquals('mentor@telkom.co.id', Auth::user()->email);
});
 