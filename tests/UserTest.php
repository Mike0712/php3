<?php


namespace Tests;


use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testFullName()
    {
        $user = new User();
        $user->fill(['firstName' => 'Леонид', 'lastName' => 'Голубков', 'patronymic' => 'Иванович', 'email' => 'lenyagolubcov@mmm.ru', 'password' => \Hash::make('mavrodi123')]);
        $user->save();
        $value = $user->getName();

        $this->assertEquals($value, $user->lastName . ' ' . $user->firstName . ' ' . $user->patronymic);
    }

    public function testFirstLastName()
    {
        $user = new User();
        $user->fill(['firstName' => 'Илья', 'lastName' => 'Котов', 'email' => 'kotov@gmail.com', 'password' => \Hash::make('superpassword')]);
        $user->save();
        $value = $user->getName();

        $this->assertEquals($value, $user->firstName . ' ' . $user->lastName);
    }

    public function testOnlyFirstName()
    {
        $user = new User();
        $user->fill(['firstName' => 'Анзор', 'email' => 'kotov@gmail.com', 'password' => \Hash::make('passwstring')]);
        $user->save();
        $value = $user->getName();

        $this->assertEquals($value, $user->email);
    }

    public function testOnlyLastName()
    {
        $user = new User();
        $user->fill(['lastName' => 'Федосеев', 'email' => 'fedoseev@gmail.com', 'password' => \Hash::make('mypassword')]);
        $user->save();
        $value = $user->getName();

        $this->assertEquals($value, $user->email);
    }

    public function testOnlyPatronymic()
    {
        $user = new User();
        $user->fill(['patronymic' => 'Сергеевич', 'email' => 'bezotch@gmail.com', 'password' => \Hash::make('passw321')]);
        $user->save();
        $value = $user->getName();

        $this->assertEquals($value, $user->email);
    }

    public function testNoName()
    {
        $user = new User();
        $user->fill(['email' => 'myemail@gmail.com', 'password' => \Hash::make('somepassw')]);
        $user->save();
        $value = $user->getName();

        $this->assertEquals($value, $user->email);
    }
}