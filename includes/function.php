<?php

    class Movie{

        private $file_path = "../json/movie.json";



        public function requiredInput($input){

            if(empty($input)){
                return true;
            }

            return false;

        }


        public function exist($input, $type){

            $result = false;

            $decoded_movie = $this->getFileContent();

            if($decoded_movie != null){
                foreach ($decoded_movie as $key) {
                    if ($key[$type] === $input) {
                        $result = true;
                    }
                }
            }

            return $result;

        }





        public function create($id, $name, $genre){
            
            $array_movie = $this->getFileContent();

            $add_movie = array(
                'id' => $id,
                'name' => $name,
                'genre' => $genre
            );

            $array_movie[] = $add_movie;
            $final_movie = $this->prettyPrintEncoded($array_movie);
            
            if (file_put_contents($this->file_path, $final_movie)) {
                $valid['success'] = true;
                $valid['messages'] = "Added successfully";
                echo json_encode($valid);
                exit();
            }

        }



        public function fetch(){

            $decoded_movie = $this->getFileContent();
            echo json_encode($decoded_movie);
            exit();

        }


        public function existInUpdate($id, $name){

            $result = false;

            $decoded_movie = $this->getFileContent();

            if($decoded_movie != null){
                foreach ($decoded_movie as $key) {
                    if ($key['name'] === $name && $key['id'] != $id) {
                        $result = true;
                    }
                }
            }

            return $result;

        }



        public function update($id, $name, $genre){

            $decoded_movie = $this->getFileContent();

            foreach ($decoded_movie as $key => $value) {
                if($value['id'] === $id){
                    $decoded_movie[$key]['name'] = $name;
                    $decoded_movie[$key]['genre'] = $genre;
                }
            }

            $final_movie = $this->prettyPrintEncoded($decoded_movie);

            if (file_put_contents($this->file_path, $final_movie)) {
                $valid['success'] = true;
                $valid['messages'] = "Updated successfully";
                echo json_encode($valid);
                exit();
            }

        }


        public function delete($id){

            $decoded_movie = $this->getFileContent();

            foreach ($decoded_movie as $key => $value) {
                if($value['id'] === $id){
                    unset($decoded_movie[$key]);
                    $final_movie = $this->prettyPrintEncoded($decoded_movie);
                }
            }

            if (file_put_contents($this->file_path, $final_movie)) {
                $valid['success'] = true;
                $valid['messages'] = "Deleted successfully";
                echo json_encode($valid);
                exit();
            }

        }


        private function getFileContent(){

            if(!file_exists($this->file_path)){
                file_put_contents($this->file_path, null);
            }

            $movie = file_get_contents($this->file_path);
            $decoded_movie = json_decode($movie, true);

            return $decoded_movie;

        }


        public function prettyPrintEncoded($movie){
            return json_encode(array_values($movie), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

    }

