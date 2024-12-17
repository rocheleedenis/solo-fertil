<?php
    
    interface Iprodutor{
        public static function selectAll($id);
        public function selectOne($id);
        public function insert();
        public function update();
        public static function delete($id);
    }