<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\User;
use App\Services\Notification\Notification;
use App\Mail\TopicCreated;

Route::get('/', function () {
    //return view('welcome');
    Mail::to('s.aghabazaz@gmail.com')->send(new \App\Mail\TopicCreated());

});

/*Route::get('/email', function () {
    //return view('welcome');
    Mail::to('s.aghabazaz@gmail.com')->send(new \App\Mail\UserRegistered());
});
Route::get('/notification', function () {
    //return view('welcome');
    $notification=resolve(Notification::class);
    $notification->sendEmail(User::find(1),new TopicCreated);
});
Route::get('/notification/sms', function () {
    //return view('welcome');
    $notification=resolve(Notification::class);
    $notification->sendSms(User::find(1),'sms');
});*/
Route::get('/home', function () {
    return view('home');
});
Route::get('/notification/send-email', 'NotificationsController@email')->name('notification.form.email');
Route::post('/notification/send-email', 'NotificationsController@sendEmail')->name('notification.send.email');
Route::get('/notification/send-sms', 'NotificationsController@sms')->name('notification.form.sms');
Route::post('/notification/send-sms', 'NotificationsController@sendSms')->name('notification.send.sms');
