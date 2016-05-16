<?php

namespace Application\Backend\Business\Template {
    use Core\Controller;
    use Core\DAO\Transaction;
    use Core\Util;
    use Application\Backend\Model\Template as ModelTemplate;
    use \Exception as Exception;

    class Template extends Controller {
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
                $template = new ModelTemplate($this->db_transaction);
            
                // open connection with begin transaction
                $this->db_transaction->beginTransaction();

                $receiver->save([
                        'description' => $data['description'],
                        'cd_template' => $data['cd_template'],
                        'path' => $data['path'],
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
                $template_id = substr($kwargs[0], 1, 20);
                
                $data = json_decode(file_get_contents("php://input"), true);
                if (json_last_error() !== 0) {
                    throw new Exception('Mandatory field not sent ');
                }
                // @TODO validation
                $this->db_transaction->connect();
                $template = new ModelTemplate($this->db_transaction);
                
                // open connection with begin transaction
                $this->db_transaction->beginTransaction();
                
                $template->get(['template_id'=> $template_id]);
                
                if(!empty($data['description']))
                    $template->description = $data['description'];
                
                if(!empty($data['cd_template']))
                    $template->cd_template = $data['cd_template'];
                
                if(!empty($data['path']))
                    $template->path = $data['path'];

                if(!empty($data['bl_active']))
                    $template->bl_active = $data['bl_active'];
                
                $template->save();
                
                $this->db_transaction->commit();

            } catch (Exception $error) {
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
            $template = new ModelTemplate($this->db_transaction);
            
            $page = Util::get($_GET,'page',$this->page);
            $limit = Util::get($_GET,'limit',$this->limit);
            
            $this->db_transaction->connect();
            $template_list = $template
                ->where()
                ->orderBy()
                ->limit($page,$limit)
                ->execute([
                    'join' => 'left']);

            return Util::renderToJson($template_list);
        }
    }
}
