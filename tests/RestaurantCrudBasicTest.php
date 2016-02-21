<?php

use \Core\DAO\Transaction;
use \Application\Restaurant\Model\Restaurant;
use \Application\Restaurant\Model\Place;

class RestaurantCrudBasicTest extends PHPUnit_Framework_TestCase {
    public function testRestaurantCrudAdd() {
        // load transaction object
        $transaction = new Transaction();

        // load model with Transaction instance
        $restaurant = new Restaurant($transaction);
        $place = new Place($transaction);

        // open connection
        $transaction->connect();

        // save
        $restaurant->save([
            'place_id' => null,
            'name' => 'restaurant name test',
            'serves_hot_dogs' => 1,
            'serves_pizza' => 1,]);

        // create restaurant test object
        $restaurant_test = new Restaurant();
        $place_test = new Place();

        // set data
        $restaurant_test->id = $restaurant->id;
        $restaurant_test->place_id = $place_test;
        $restaurant_test->name = 'restaurant name test';
        $restaurant_test->serves_hot_dogs = 1;
        $restaurant_test->serves_pizza = 1;

        // test
        $this->assertEquals(print_r($restaurant_test,true),print_r($restaurant,true));
    }

    public function testRestaurantCrudUpdate() {
        // load transaction object
        $transaction = new Transaction();

        // load model with Transaction instance
        $restaurant = new Restaurant($transaction);

        // open connection
        $transaction->connect();

        // save
        $restaurant->save([
            'place_id' => null,
            'name' => 'restaurant name test',
            'serves_hot_dogs' => 1,
            'serves_pizza' => 1,]);

        // update
        $restaurant->name = 'bla etc bla';
        $restaurant->serves_hot_dogs = 0;
        $restaurant->serves_pizza = 0;
        $restaurant->save();

        // create restaurant test object
        $restaurant_test = new Restaurant();
        $place_test = new Place();

        // set data
        $restaurant_test->id = $restaurant->id;
        $restaurant_test->place_id = $place_test;
        $restaurant_test->name = 'bla etc bla';
        $restaurant_test->serves_hot_dogs = 0;
        $restaurant_test->serves_pizza = 0;

        // test
        $this->assertEquals(print_r($restaurant_test,true),print_r($restaurant,true));
    }

    public function testRestaurantCrudDelete() {
        // load transaction object
        $transaction = new Transaction();

        // load model with Transaction instance
        $restaurant = new Restaurant($transaction);

        // open connection
        $transaction->connect();

        // save
        $restaurant->save([
            'place_id' => null,
            'name' => 'restaurant name test',
            'serves_hot_dogs' => 1,
            'serves_pizza' => 1,]);

        // delete register
        $restaurant->delete();

        // test
        $this->assertNull($restaurant->id);
        $this->assertNull($restaurant->place_id);
        $this->assertNull($restaurant->name);
        $this->assertNull($restaurant->serves_hot_dogs);
        $this->assertNull($restaurant->serves_pizza);
    }

    public function testRestaurantCrudGet() {
        // load transaction object
        $transaction = new Transaction();

        // load model with Transaction instance
        $restaurant = new Restaurant($transaction);

        // open connection
        $transaction->connect();

        // delete if exists
        $restaurant->delete([
            'name' => 'place_of_test_unique']);

        // save
        $restaurant->save([
            'place_id' => null,
            'name' => 'place_of_test_unique',
            'serves_hot_dogs' => 1,
            'serves_pizza' => 1,]);

        // get unique register
        $restaurant->get([
            'restaurant.name' => 'place_of_test_unique']);

        // create restaurant test object
        $restaurant_test = new Restaurant();
        $place_test = new Place();

        // set data
        $restaurant_test->id = $restaurant->id;
        $restaurant_test->place_id = $place_test;
        $restaurant_test->name = 'place_of_test_unique';
        $restaurant_test->serves_hot_dogs = 1;
        $restaurant_test->serves_pizza = 1;

        // test
        $this->assertEquals(print_r($restaurant_test,true),print_r($restaurant,true));
    }

    public function testRestaurantCrudSelect() {
        // load transaction object
        $transaction = new Transaction();

        // load model with Transaction instance
        $restaurant = new Restaurant($transaction);

        // open connection
        $transaction->connect();

        // delete if exists
        $restaurant->delete();

        // save
        $restaurant->save([
            'place_id' => null,
            'name' => 'restaurant name test',
            'serves_hot_dogs' => 1,
            'serves_pizza' => 1,]);

        // select with where, order by and limit(pagination)
        $restaurant_list = $restaurant
            ->where([
                'restaurant.serves_hot_dogs' => [0,1],
                'restaurant.serves_pizza' => [0,1],])
            ->orderBy([
                'restaurant.name' => 'desc'])
            ->limit(1,5)
            ->execute();

        // compare
        $this->assertNotEmpty($restaurant_list['data']);
        $this->assertCount(1,$restaurant_list['data']);
        $this->assertEquals(1,$restaurant_list['register_total']);
        $this->assertEquals(5,$restaurant_list['register_perpage']);
        $this->assertEquals(1,$restaurant_list['page_total']);
        $this->assertEquals(1,$restaurant_list['page_current']);
        $this->assertEquals(1,$restaurant_list['page_next']);
        $this->assertEquals(1,$restaurant_list['page_previous']);
    }

    // public function testRestaurantCrudSelectWithLike() {
    //     // load transaction object
    //     $transaction = new Transaction();

    //     // load model with Transaction instance
    //     $restaurant = new Restaurant($transaction);

    //     // open connection
    //     $transaction->connect();

    //     // delete if exists
    //     $restaurant->delete();

    //     // save
    //     $restaurant->save([
    //         'place_id' => null,
    //         'name' => 'restaurant name test',
    //         'serves_hot_dogs' => 1,
    //         'serves_pizza' => 1,]);

    //     // select with where, order by and limit(pagination)
    //     $restaurant_list = $restaurant
    //         ->where([
    //             'restaurant.serves_hot_dogs' => [0,1],
    //             'restaurant.serves_pizza' => [0,1],])
    //         ->like([
    //             'restaurant.name' => 'name',
    //             'restaurant.name' => '%restaurant',
    //             'restaurant.name' => '%name%',
    //             'restaurant.name' => 'test%',])
    //         ->orderBy([
    //             'restaurant.name' => 'desc'])
    //         ->limit(1,5)
    //         ->execute();

    //     // compare
    //     // $this->assertNotEmpty($restaurant_list['data']);
    //     // $this->assertCount(1,$restaurant_list['data']);
    //     // $this->assertEquals(1,$restaurant_list['register_total']);
    //     // $this->assertEquals(5,$restaurant_list['register_perpage']);
    //     // $this->assertEquals(1,$restaurant_list['page_total']);
    //     // $this->assertEquals(1,$restaurant_list['page_current']);
    //     // $this->assertEquals(1,$restaurant_list['page_next']);
    //     // $this->assertEquals(1,$restaurant_list['page_previous']);
    // }
}

?>