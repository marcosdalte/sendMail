<?php

namespace Application\Backend\Business\Events {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Backend\Model\Events as ModelEvents;
    use Application\Backend\Model\Template as ModelTemplate;
    use \Exception as Exception;

    class Events extends Controller {
        private $db_transaction;
        private $limit = 20;
        private $page = 1;
        
        public function __construct($request_method = null) {
            parent::__construct($request_method);
            
            // load transaction object
            $this->db_transaction = new Transaction();
        }

        public function add($kwargs) {
            try {
                $data = json_decode(file_get_contents("php://input"), true);
                if (json_last_error() !== 0) {
                    throw new Exception('Mandatory field not sent ');
                }

                // @TODO validation
                $this->db_transaction->connect();
                $events = new ModelEvents($this->db_transaction);
                $template = new ModelTemplate($this->db_transaction);
                
                // open connection with begin transaction
                $this->db_transaction->beginTransaction();

                $template->get([
                    'template_id' => $data['template_id']]);

                $events->save([
                    'event' => $data['event'],
                    'dt_event' => $data['dt_event'],
                    'template_id' => $template,
                ]);

                $this->db_transaction->commit();

            } catch (Exception $e) {
                $this->db_transaction->rollBack();
                Util::renderToJson([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
                exit;
            }
            Util::renderToJson(['success' => true]);
        }

        public function edit($kwargs) {
            try {
                echo $events_id = substr($kwargs[0], 1, 20);
                
                $data = json_decode(file_get_contents("php://input"), true);
                if (json_last_error() !== 0) {
                    throw new Exception('Mandatory field not sent ');
                }
                
                // @TODO validation
                $this->db_transaction->connect();
                $events = new ModelEvents($this->db_transaction);
                $template = new ModelTemplate($this->db_transaction);
                
                // open connection with begin transaction
                $this->db_transaction->beginTransaction();

                $template->get(['template_id' => $data['template_id']]);
                echo $data['template_id'] . "\n";
                
                if(!empty($data['description'])){
                    $template->description = $data['description'];
                    echo $data['description'] . "\n";
                }
                
                if(!empty($data['cd_template'])){
                    $template->cd_template = $data['cd_template'];
                    echo $data['cd_template'] . "\n";      
                }
                
                if(!empty($data['path'])){
                    $template->path = $data['path'];
                    echo $data['path'] . "\n";
                }
                
                if(!empty($data['template_bl_active']))
                    $template->template_bl_active = $data['template_bl_active'];
                    
                $template->save();
                
                $events->get(['events_id' => $events_id]);
                
                if(!empty($data['event'])){
                    $events->event = $data['event'];
                    echo $data['event'] . "\n";
                }
                    
                if(!empty($data['dt_event'])){
                    $events->dt_event = $data['dt_event'];
                    echo $data['dt_event'] . "\n";
                }
                
                if(!empty($data['bl_active'])){
                    $events->bl_active = $data['bl_active'];
                    echo $data['bl_active'] . "\n";
                }
                
                if(!empty($data['template_id'])){
                    $template->get(['template_id' => $data['template_id']]);
                    
                    $events->template_id = $template;
                }
                
                $events->save();
                
                $this->db_transaction->commit();
                
            } catch (Exception $e) {
                $this->db_transaction->rollBack();
                Util::renderToJson([
                    'success' => false,
                    'message' => $e->getMessage()
                ]);
                exit;
            }
            Util::renderToJson(['success' => true]);
        }

        public function listing($kwargs) {
            $events = new ModelEvents($this->db_transaction);
            
            $page = Util::get($_GET,'page',$this->page);
            $limit = Util::get($_GET,'limit',$this->limit);
            $this->db_transaction->connect();
            $events_list = $events
                ->where()
                ->orderBy()
                ->limit($page,$limit)
                ->execute([
                    'join' => 'left']);
            return Util::renderToJson($events_list);
        }
    }
}
