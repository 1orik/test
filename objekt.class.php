<?php
    require_once('classes/Db.class.php');

    class objekt
    {
        public ?int $id  = null;
        public string $name_objekt = "";
        public int $kategorie_objekt = 0;
        public string $intervall_objekt = "";
        public string $suchbegriff = "";

        public function speichern()
        {
            $db = new Db();
            if (is_numeric($this->id)) {
                $sql = "UPDATE objekt SET name_objekt='".$this->name_objekt."', kategorie_objekt=".$this->kategorie_objekt.", intervall_objekt='".$this->intervall_objekt."' WHERE id_objekt=".$this->id."";
                $db->query($sql);
            } else {
                $sql = "INSERT INTO objekt (name_objekt,kategorie_objekt,intervall_objekt) VALUES ('".$this->name_objekt."',".$this->kategorie_objekt.",'".$this->intervall_objekt."')";
                $db->query($sql);
            }
            return;
        }

        public static function laden(int $id_objekt): objekt|false
        {
            if(!is_numeric($id_objekt)) return false;
            $db = new Db();
            $sql = "SELECT * FROM objekt WHERE id_objekt=".$id_objekt."";
            $resultset = $db->query($sql);
            if ($resultset->num_rows == 1) {
                $result = $resultset->fetch_object();
                $temp = new objekt();
                $temp->name_objekt = $result->name_objekt;
                $temp->kategorie_objekt = $result->kategorie_objekt;
                $temp->intervall_objekt = $result->intervall_objekt;
                $temp->id = $result->id_objekt;
                return $temp;
            }
            return false;
        }

        public static function ladeAlle($suchbegriff): array
        {
            $db = new Db();
            $sql = "SELECT id_objekt FROM objekt";
            if($suchbegriff!="")
            {
                $sql .= " WHERE name_objekt LIKE '%".$suchbegriff."%'";
            }
            $resultset = $db->query($sql);
            $returnarray = array();
            while ($result = $resultset->fetch_object()) 
            {
                    $returnarray[] = objekt::laden($result->id_objekt);
            }
            return $returnarray;
        }

        /*public static function ladeAlle(?string $suchbegriff=""): array
        {
            /*$db = new Db();
            $sql = "SELECT id_objekt FROM objekt";
            if(!empty($suchbegriff)) 
                $sql .= " WHERE name_objekt LIKE ?";
            $resultset = $db->query($sql, $suchbegriff?["%".$suchbegriff."%"]:[]);
            $returnarray = array();
            while ($result = $resultset->fetch_object()) 
            {
                $returnarray[] = objekt::laden($result->id_objekt);
            }
            return $returnarray;
        } */
        
        public static function loeschen(int $id_objekt):void {
            $db = new Db();
            //$sql = "DELETE FROM objekt WHERE id_objekt=?";
            $sql = "DELETE FROM objekt WHERE id_objekt=".$id_objekt."";
            $resultset = $db->query($sql);
        }
    }    
?>