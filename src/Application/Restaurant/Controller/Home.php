<?php

namespace Application\Restaurant\Controller {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Restaurant\Model\Restaurant;

    class Home extends Controller {
        private $db_transaction;

        public function __construct($request_method = null) {
            parent::__construct($request_method);

            // load transaction object
            $this->db_transaction = new Transaction();
        }

        public function testPhpInfo() {
            phpinfo();
        }

        public function requestMethodGetTest() {
            print 'ok';
        }

        public function restaurantAdd() {
            // load model with Transaction instance
            $restaurant = new Restaurant($this->db_transaction);

            // open connection
            $this->db_transaction->connect();

            // save
            $restaurant->save([
                'name' => 'place of test',
                'serves_hot_dogs' => 1,
                'serves_pizza' => 1,]);

            Util::renderToJson($restaurant);
        }

        public function restaurantUpdate() {
            // load model with Transaction instance
            $restaurant = new Restaurant($this->db_transaction);

            // open connection
            $this->db_transaction->connect();

            // save
            $restaurant->save([
                'name' => 'place of test',
                'serves_hot_dogs' => 1,
                'serves_pizza' => 1,]);

            // update
            $restaurant->place = 'bla e bla';
            $restaurant->serves_hot_dogs = 0;
            $restaurant->save();

            Util::renderToJson($restaurant);
        }

        public function restaurantDelete() {
            // load model with Transaction instance
            $restaurant = new Restaurant($this->db_transaction);

            // open connection
            $this->db_transaction->connect();

            // delete all register without filter
            // $restaurant->delete();

            // save
            $restaurant->save([
                'name' => 'place of test',
                'serves_hot_dogs' => 1,
                'serves_pizza' => 1,]);

            // delete current instance
            $restaurant->delete();

            Util::renderToJson($restaurant);
        }

        public function restaurantGet() {
            // load model with Transaction instance
            $restaurant = new Restaurant($this->db_transaction);

            // open connection
            $this->db_transaction->connect();

            // get(unique)
            $restaurant->get([
                'name' => 'place of test']);

            // delete current instance
            // $restaurant->delete();

            // update
            // $restaurant->name = 'bla e bla';
            // $restaurant->serves_hot_dogs = 0;
            // $restaurant->save();

            Util::renderToJson($restaurant);
        }

        public function restaurantSelect() {
            // load model with Transaction instance
            $restaurant = new Restaurant($this->db_transaction);

            // open connection
            $this->db_transaction->connect();

            // select with where, order by, limit(pagination) and join left
            // $restaurant_list = $restaurant
            //     ->where([
            //         'restaurant.id' => [15,16],])
            //     ->orderBy([
            //         'restaurant.serves_pizza' => 'desc'])
            //     ->limit(1,5)
            //     ->execute([
            //         'join' => 'left']);

            // select with update and return changes
            $restaurant_list = $restaurant
                ->where([
                    'restaurant.serves_hot_dogs' => [1,0],]) // id in(1,2)
                ->orderBy([
                    'restaurant.serves_pizza' => 'desc'])
                ->limit(1,5) // page 1 limit 5
                ->update([
                    'name' => 'place update yea!']) // update in current select
                ->execute([
                    'join' => 'left']); // join left|right optional

            // list of query's
            // Util::renderToJson($restaurant->dumpQuery());

            // render to json result
            Util::renderToJson($restaurant_list);
        }

        public function otherView() {
            print 'test other view';
        }
    }
}
