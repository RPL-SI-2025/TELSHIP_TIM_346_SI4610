<?php

use Tests\DuskTestCase;
use Tests\TestCase;
// use Illuminate\Foundation\Testing\DatabaseMigrations;
// use Illuminate\Foundation\Testing\RefreshDatabase;

/*
|--------------------------------------------------------------------------
| Dusk Test Case Binding
|--------------------------------------------------------------------------
|
| Bind DuskTestCase ke direktori "Browser" hanya sekali, tidak perlu diulang.
|
*/
pest()->extend(DuskTestCase::class)
    ->in('Browser');

/*
|--------------------------------------------------------------------------
| Feature Test Case Binding
|--------------------------------------------------------------------------
|
| Bind TestCase ke direktori "Feature".
|
*/
pest()->extend(TestCase::class)
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| Menambahkan metode custom untuk `expect()`.
|
*/
expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Global Functions
|--------------------------------------------------------------------------
|
| Tempat mendefinisikan helper global jika diperlukan.
|
*/
function something()
{
    // Helper function di sini jika dibutuhkan
}