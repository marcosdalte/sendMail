<?php

use \Core\DAO\Transaction;
use \Application\Restaurant\Model\Restaurant;
use \Application\Restaurant\Model\Waiter;
use \Application\Restaurant\Model\Place;

class RestaurantCrudRelationTest extends PHPUnit_Framework_TestCase {
    public function testRestaurantCrudRelationAdd() {
        // load transaction object
        $transaction = new Transaction();

        // load model with Transaction instance
        $restaurant = new Restaurant($transaction);
        $place = new Place($transaction);
        $waiter = new Waiter($transaction);

        // open connection
        $transaction->connect();

        // save place
        $place->save([
            'name' => 'place name test',
            'address' => 'place address test',]);

        // save restaurant
        $restaurant->save([
            'place_id' => $place,
            'name' => 'restaurant name test',
            'serves_hot_dogs' => 1,
            'serves_pizza' => 1,]);

        // save waiter
        $waiter->save([
            'restaurant_id' => $restaurant,
            'name' => 'waiter name test']);

        // create test object
        $place_test = new Place();
        $restaurant_test = new Restaurant();
        $waiter_test = new Waiter();

        // set data in place_test
        $place_test->id = $place->id;
        $place_test->name = 'place name test';
        $place_test->address = 'place address test';

        // set data in restaurant_test
        $restaurant_test->id = $restaurant->id;
        $restaurant_test->place_id = $place_test;
        $restaurant_test->name = 'restaurant name test';
        $restaurant_test->serves_hot_dogs = 1;
        $restaurant_test->serves_pizza = 1;

        // set data in waiter test
        $waiter_test->id = $waiter->id;
        $waiter_test->restaurant_id = $restaurant_test;
        $waiter_test->name = 'waiter name test';

        // test
        $this->assertEquals(print_r($restaurant_test,true),print_r($restaurant,true));
        $this->assertEquals(print_r($place_test,true),print_r($place,true));
        $this->assertEquals(print_r($waiter_test,true),print_r($waiter,true));
    }

    public function testRestaurantCrudRelationUpdate() {
        // load transaction object
        $transaction = new Transaction();

        // load model with Transaction instance
        $restaurant = new Restaurant($transaction);
        $place = new Place($transaction);
        $waiter = new Waiter($transaction);

        // open connection
        $transaction->connect();

        // save place
        $place->save([
            'name' => 'place name test',
            'address' => 'place address test',]);

        // update place
        $place->name = 'place name update test';
        $place->address = 'place address update test';
        $place->save();

        // save restaurant
        $restaurant->save([
            'place_id' => $place,
            'name' => 'restaurant name test',
            'serves_hot_dogs' => 1,
            'serves_pizza' => 1,]);

        // update restaurant
        $restaurant->name = 'restaurant name update test';
        $restaurant->serves_hot_dogs = 0;
        $restaurant->serves_pizza = 0;
        $restaurant->save();

        // save waiter
        $waiter->save([
            'restaurant_id' => $restaurant,
            'name' => 'waiter name test']);

        // update waiter
        $waiter->name = 'waiter name update test';
        $waiter->save();

        // create test object
        $place_test = new Place();
        $restaurant_test = new Restaurant();
        $waiter_test = new Waiter();

        // set data in place_test
        $place_test->id = $place->id;
        $place_test->name = 'place name update test';
        $place_test->address = 'place address update test';

        // set data in restaurant_test
        $restaurant_test->id = $restaurant->id;
        $restaurant_test->place_id = $place_test;
        $restaurant_test->name = 'restaurant name update test';
        $restaurant_test->serves_hot_dogs = 0;
        $restaurant_test->serves_pizza = 0;

        // set data in waiter test
        $waiter_test->id = $waiter->id;
        $waiter_test->restaurant_id = $restaurant_test;
        $waiter_test->name = 'waiter name update test';

        // test
        $this->assertEquals(print_r($restaurant_test,true),print_r($restaurant,true));
        $this->assertEquals(print_r($place_test,true),print_r($place,true));
        $this->assertEquals(print_r($waiter_test,true),print_r($waiter,true));
    }

    public function testRestaurantCrudRelationDelete() {
        // load transaction object
        $transaction = new Transaction();

        // load model with Transaction instance
        $restaurant = new Restaurant($transaction);
        $place = new Place($transaction);
        $waiter = new Waiter($transaction);

        // open connection
        $transaction->connect();

        // save place
        $place->save([
            'name' => 'place name test',
            'address' => 'place address test',]);

        // save restaurant
        $restaurant->save([
            'place_id' => $place,
            'name' => 'restaurant name test',
            'serves_hot_dogs' => 1,
            'serves_pizza' => 1,]);

        // save waiter
        $waiter->save([
            'restaurant_id' => $restaurant,
            'name' => 'waiter name test']);

        // delete register
        $place->delete();
        $restaurant->delete();
        $waiter->delete();

        // test
        $this->assertNull($restaurant->id);
        $this->assertNull($restaurant->place_id);
        $this->assertNull($restaurant->name);
        $this->assertNull($restaurant->serves_hot_dogs);
        $this->assertNull($restaurant->serves_pizza);
        // test
        $this->assertNull($place->id);
        $this->assertNull($place->name);
        $this->assertNull($place->address);
        // test
        $this->assertNull($waiter->id);
        $this->assertNull($waiter->restaurant_id);
        $this->assertNull($waiter->name);
    }

    public function testRestaurantCrudRelationGet() {
        // load transaction object
        $transaction = new Transaction();

        // load model with Transaction instance
        $restaurant = new Restaurant($transaction);
        $place = new Place($transaction);
        $waiter = new Waiter($transaction);

        // open connection
        $transaction->connect();

        // delete if exists
        $place->delete([
            'name' => 'place_name_unique',
            'address' => 'place_address_unique']);

        $restaurant->delete([
            'name' => 'restaurant_name_unique']);

        $waiter->delete([
            'name' => 'waiter_name_unique']);

        // save place
        $place->save([
            'name' => 'place_name_unique',
            'address' => 'place_address_unique',]);

        // save restaurant
        $restaurant->save([
            'place_id' => $place,
            'name' => 'restaurant_name_unique',
            'serves_hot_dogs' => 1,
            'serves_pizza' => 1,]);

        // save waiter
        $waiter->save([
            'restaurant_id' => $restaurant,
            'name' => 'waiter_name_unique']);

        // get place unique register
        $place->get([
            'place.name' => 'place_name_unique',
            'place.address' => 'place_address_unique']);

        // get restaurant unique register
        $restaurant->get([
            'restaurant.name' => 'restaurant_name_unique']);

        // get waiter unique register
        $waiter->get([
            'waiter.name' => 'waiter_name_unique']);

        // test place
        $this->assertEquals($place->name,'place_name_unique');
        $this->assertEquals($place->address,'place_address_unique');

        // test restaurant
        $this->assertEquals($restaurant->name,'restaurant_name_unique');
        $this->assertEquals($restaurant->place_id->name,'place_name_unique');
        $this->assertEquals($restaurant->place_id->address,'place_address_unique');
        $this->assertEquals($restaurant->serves_hot_dogs,1);
        $this->assertEquals($restaurant->serves_pizza,1);

        // test waiter
        $this->assertEquals($waiter->name,'waiter_name_unique');
        $this->assertEquals($waiter->restaurant_id->name,'restaurant_name_unique');
        $this->assertEquals($waiter->restaurant_id->place_id->name,'place_name_unique');
        $this->assertEquals($waiter->restaurant_id->place_id->address,'place_address_unique');
        $this->assertEquals($waiter->restaurant_id->serves_hot_dogs,1);
        $this->assertEquals($waiter->restaurant_id->serves_pizza,1);
    }

    public function testRestaurantCrudRelationSelect() {
        // load transaction object
        $transaction = new Transaction();

        // load model with Transaction instance
        $restaurant = new Restaurant($transaction);
        $place = new Place($transaction);
        $waiter = new Waiter($transaction);

        // open connection
        $transaction->connect();

        // delete if exists
        $restaurant->delete();
        $place->delete();
        $waiter->delete();

        // save place
        $place->save([
            'name' => 'place name test',
            'address' => 'place address test',]);

        // save restaurant
        $restaurant->save([
            'place_id' => $place,
            'name' => 'restaurant name test',
            'serves_hot_dogs' => 1,
            'serves_pizza' => 1,]);

        // save waiter
        $waiter->save([
            'restaurant_id' => $restaurant,
            'name' => 'waiter name test']);

        // select with where, order by and limit(pagination)
        $restaurant_list = $restaurant
            ->where([
                'restaurant.name' => 'restaurant name test',
                'restaurant.serves_hot_dogs' => [0,1],
                'restaurant.serves_pizza' => [0,1],
                'place.name' => 'place name test',
                'place.address' => 'place address test',])
            ->orderBy([
                'restaurant.name' => 'desc',
                'place.name' => 'desc',
                'place.address' => 'desc',])
            ->limit(1,5)
            ->execute();

        // select with where, order by and limit(pagination)
        $place_list = $place
            ->where([
                'place.name' => 'place name test',
                'place.address' => 'place address test',])
            ->orderBy([
                'place.name' => 'desc',
                'place.address' => 'desc',])
            ->limit(1,5)
            ->execute();

        // select with where, order by and limit(pagination)
        $waiter_list = $waiter
            ->where([
                'waiter.name' => 'waiter name test',
                'restaurant.name' => 'restaurant name test',
                'restaurant.serves_hot_dogs' => [0,1],
                'restaurant.serves_pizza' => [0,1],])
            ->orderBy([
                'restaurant.name' => 'desc',
                'waiter.name' => 'desc',])
            ->limit(1,5)
            ->execute();

        // test restaurant
        $this->assertNotEmpty($restaurant_list['data']);
        $this->assertCount(1,$restaurant_list['data']);
        $this->assertEquals(1,$restaurant_list['register_total']);
        $this->assertEquals(5,$restaurant_list['register_perpage']);
        $this->assertEquals(1,$restaurant_list['page_total']);
        $this->assertEquals(1,$restaurant_list['page_current']);
        $this->assertEquals(1,$restaurant_list['page_next']);
        $this->assertEquals(1,$restaurant_list['page_previous']);

        // test place
        $this->assertNotEmpty($place_list['data']);
        $this->assertCount(1,$place_list['data']);
        $this->assertEquals(1,$place_list['register_total']);
        $this->assertEquals(5,$place_list['register_perpage']);
        $this->assertEquals(1,$place_list['page_total']);
        $this->assertEquals(1,$place_list['page_current']);
        $this->assertEquals(1,$place_list['page_next']);
        $this->assertEquals(1,$place_list['page_previous']);

        // test waiter
        $this->assertNotEmpty($waiter_list['data']);
        $this->assertCount(1,$waiter_list['data']);
        $this->assertEquals(1,$waiter_list['register_total']);
        $this->assertEquals(5,$waiter_list['register_perpage']);
        $this->assertEquals(1,$waiter_list['page_total']);
        $this->assertEquals(1,$waiter_list['page_current']);
        $this->assertEquals(1,$waiter_list['page_next']);
        $this->assertEquals(1,$waiter_list['page_previous']);
    }
}

?>