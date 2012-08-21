<?php
    Class Gallery extends Core {
        public function __construct(){
            parent::__construct();

            $this->template = 'main.tpl';

            $this->init(array(
                'name'  => 'gallery',
                'title' => 'Галерея'
            ));

            if($this->ajax_mode){
                switch($_GET['action']){
                    case 'get_image_data' : {
                        header('Content-type: application/json');
                        print json_encode($this->getImageData($_GET['id']));
                    }; break;

                    case 'set_image_data' : {
                        header('Content-type: application/json');
                        print json_encode($this->setImageData());
                    }; break;

                    case 'move_image_to_album' : {
                        header('Content-type: application/json');
                        print json_encode($this->moveImageToAlbum());
                    }; break;

                    case 'upload' : {
                        $this->doUpload();
                    }; break;

                    case 'delete_image' : {
                        $this->deleteImage($_GET['id']);
                    }; break;

                    case 'delete_all_images' : {
                        $this->deleteAllImages($_GET['album_id']);
                    }; break;

                    case 'eject_album_item' : {
                        $this->ejectAlbumItem($_GET['id']);
                    }; break;
                };

                exit;
            };
        }

        public function __destruct(){
            $this->deInit();
        }

        private function getExtension($file_name){
            $ext = explode('.', $file_name);
            $ext = array_pop($ext);
            return strtolower($ext);
        }

        private function deleteAllImages($album_id){
            $images = $this->getImages($album_id);

            foreach($images as $item){
                $this->deleteImage($item['id']);
            };
        }

        private function deleteImage($id){
            if($id > 0){
                $query = "
                    SELECT
                        `id`,
                        `extension`
                    FROM
                        `gallery_images`
                    WHERE
                        `id` = ".intval($id)."
                ";

                $result = $this->db->assocItem($query);

                if(!empty($result)){
                    $file = $_SERVER['DOCUMENT_ROOT'].'/content/gallery/images/'.$result['id'].'.'.$result['extension'];
                    $thumbnail = $_SERVER['DOCUMENT_ROOT'].'/content/gallery/thumbnails/'.$result['id'].'.'.$result['extension'];

                    if(file_exists($file)){
                        unlink($file);
                    };

                    if(file_exists($thumbnail)){
                        unlink($thumbnail);
                    };

                    $query = "
                        DELETE FROM
                            `gallery_images`
                        WHERE
                            `id` = ".intval($id)."
                    ";

                    $this->db->query($query);
                };
            };
        }

        private function doUpload(){
            header('Pragma: no-cache');
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Content-Disposition: inline; filename="files.json"');
            header('X-Content-Type-Options: nosniff');
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
            header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'OPTIONS':
                    break;
                case 'HEAD':
                case 'GET':
                    $this->upload->get();
                    break;
                case 'POST':
                    if(isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE'){
                        $this->upload->delete();
                    }else{
                        $this->upload->post();
                    };
                    break;
                case 'DELETE':
                    $this->upload->delete();
                    break;
                default:
                    header('HTTP/1.1 405 Method Not Allowed');
            };
        }

        public function getAlbumsCount(){
            $query = "
                SELECT
                    count(*) AS `count`
                FROM
                    `gallery_albums`
            ";

            $result = $this->db->assocItem($query);

            return $result['count'];
        }

        public function getAlbums(){
            $query = "
                SELECT
                    `id`,
                    `name`,
                    `publish`
                FROM
                    `gallery_albums`
                ORDER BY
                    `sort`
                DESC
            ";

            return $this->db->assocMulti($query);
        }

        public function getImagesCount($album_id = 0){
            $where = "";

            if($album_id > 0){
                $where = " `album_id` = '".intval($album_id)."'";
            };

            if($where != ''){
                $where = " WHERE ".$where;
            };

            $query = "
                SELECT
                    count(*) AS `count`
                FROM
                    `gallery_images`
                ".$where."
            ";

            $result = $this->db->assocItem($query);

            return $result['count'];
        }

        public function getImages($album_id = 0, $limit = false){
            if($album_id > 0){
                $where = " WHERE `album_id` = ".intval($album_id);
            }else{
                $where = " WHERE `album_id` < 1";
            };

            if($limit > 0){
                $limit = " LIMIT ".intval($limit);
            };

            $query = "
                SELECT
                    `id`,
                    `publish`,
                    `extension`
                FROM
                    `gallery_images`
                ".$where."
                ORDER BY
                    `sort`
                ASC
                ".$limit."
            ";

            return $this->db->assocMulti($query);
        }

        public function getImageData($id){
            $query = "
                SELECT
                    *
                FROM
                    `gallery_images`
                WHERE
                    `id` = ".intval($id)."
            ";

            return $this->db->assocItem($query);
        }

        public function setImageData(){
            $query = "
                UPDATE
                    `gallery_images`
                SET
                    `name` = '".$this->db->quote($_POST['name'])."',
                    `description` = '".$this->db->quote($_POST['description'])."'
                WHERE
                    `id` = ".intval($_POST['id'])."
            ";

            $this->db->query($query);
        }

        public function getAlbumData($id){
            $query = "
                SELECT
                    *
                FROM
                    `gallery_albums`
                WHERE
                    `id` = ".intval($id)."
            ";

            return $this->db->assocItem($query);
        }

        public function moveImageToAlbum(){
            $query = "
                UPDATE
                    `gallery_images`
                SET
                    `album_id` = ".intval($_POST['album_id'])."
                WHERE
                    `id` = ".intval($_POST['image_id'])."
            ";

            $this->db->query($query);
        }

        private function ejectAlbumItem($id){
            if($id > 0){
                $query = "
                    UPDATE
                        `gallery_images`
                    SET
                        `album_id` = 0
                    WHERE
                        `id` = ".intval($id)."
                ";

                $this->db->query($query);
            };
        }
    };
?>