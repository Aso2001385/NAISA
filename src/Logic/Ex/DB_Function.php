<?php

class DB_function{

    private $sql = "";
    private $pdo;
    private $mainTableName;
    private $stats = 0;
    private $checks=[];
    private $bindArray;
    private $subQueryMode;

    function __construct($tableName)
    {
        $this->mainTableName = "{$tableName}";
    }

    public static function create ($tableName){

        return new DB_function($tableName);

    }

    function connect($dbName = 0,$dbHost = "localhost",$dbUser = "root",$dbPwd = ""){

        if($dbName != 0){
            $dbn = "mysql:dbname={$dbName};charset=utf8;port=3306;host={$dbHost}";
            $user = $dbUser;
            $pwd = $dbPwd;
            try {
                $this->pdo = new PDO($dbn, $user, $pwd);
                return $this;
            } catch (PDOException $e) {
                echo json_encode(["db error" => "{$e->getMessage()}"]);
                exit();
            }
        }else{
        
            try {

                $this->pdo = new PDO('mysql:host=mysql152.phy.lolipop.lan;
                dbname=LAA1291142-mydb;charset=utf8','LAA1291142','mydb');
                return $this;

            } catch (PDOException $e) {

                echo json_encode(["db error" => "{$e->getMessage()}"]);
                exit();

            }
        }

    }

    public function toSELECT ( $columnName=[], $tableName = []) {

        $this->sql .= "SELECT ";

        if(count($tableName)>0){

            if(count($columnName)>0){
                for ($i=0; $i<count($columnName); $i++) {
    
                    if(preg_match('/[A-Z]/',$columnName[$i])){
                        $this->sql .= $columnName[$i];
                    }else{
                        $this->sql .= "`{$tableName[$i]}`.`" . $columnName[$i] . "`";
                    }
                   
                    if (!($columnName[$i] === end($columnName))) {
                        $this->sql .= ",";
                    }
                }
            }else{
                $this->sql .= "*";
            }

        }else{

            if(count($columnName)>0){
                foreach ($columnName as $column) {
    
                    if(preg_match('/[A-Z]/',$column)){
                        $this->sql .= $column;
                    }else{
                        $this->sql .= "`" . $column . "`";
                    }
                   
                    if (!($column === end($columnName))) {
                        $this->sql .= ",";
                    }
                }
            }else{
                $this->sql .= "*";
            }

        }




        $this->sql .= " FROM `".$this->mainTableName."`";

        return $this;
    }

    public function toDISTINCT ( $columnName=[], $tableName=0) {

        $this->sql .= "SELECT DISTINCT";

        if(count($columnName)>0){
            foreach ($columnName as $column) {
                $this->sql .= "`" . $column . "`";
                if (!($column === end($columns))) {
                    $this->sql .= ","; 
                }
            }
        }else{ 
            $this->sql .= "*";
        }
        
        if($tableName == 0){ 
            $this->sql .= " FROM `".$this->mainTableName."`"; 
        }else{
            $this->sql .= " FROM `".$tableName."`";
        }
      
        return $this;
    }

    public function toJOIN($tableName,$mainColumnName,$subColumnName){

        $this->sql .= " JOIN `{$tableName}` ON ";
        $this->sql .= "`{$this->mainTableName}`.`{$mainColumnName}` = ";
        $this->sql .= "`{$tableName}`.`{$subColumnName}` ";

        return $this;

    }

    public function toINSERT($columnName = [], $insertData = []){

        $this->stats = 1;
        $this->sql .= "INSERT INTO `{$this->mainTableName}` (";
        $values = ") VALUE (";

        if(count($insertData)>0){
  
            for($i=0; $i<count($columnName); $i++){

                $this->sql .= "`{$columnName[$i]}`";
                $values .= ":{$columnName[$i]}";
         
                if($insertData[$i] !== end($insertData)){
                    $this->sql .= ",";
                    $values .= ",";
                }else{
                    $values .= ")";
                }

                $this->bindArray[$columnName[$i]] = $insertData[$i];  

            }

        }else{

            $i=0;
            $names = array_keys($columnName);

            foreach ($columnName as $row){

                $key = $names[$i++];
                $this->sql .= "`{$key}`";
                $values .= ":{$key}";
         
                if($row !== end($columnName)){
                    $this->sql .= ",";
                    $values .= ",";
                }else{
                    $values .= ")";
                }
                $this->bindArray[$key] = $row;   

            }

        }

        $this->sql .= $values;
        return $this;
        
    }

    public function toUPDATE ($columnName,$updateData = []){

        $this->stats = 1;
        $this->sql .= "UPDATE `{$this->mainTableName}` SET";

        if(count($updateData)>0){

            $updateData = array_values($updateData);

            for($i=0; $i<count($columnName); $i++){

                $this->sql .= " `{$columnName[$i]}` = :{$columnName[$i]}";

                if($columnName[$i] !== end($columnName)){

                    $this->sql .= " ,";
                
                }

                $this->bindArray[$columnName[$i]] = $updateData[$i];
            }

        }else{

            $updateData = array_values($columnName);
            $columnName = array_keys($columnName);

            for($i=0; $i<count($columnName); $i++){

                $this->sql .= " `{$columnName[$i]}` = :{$columnName[$i]}";

                if($columnName[$i] !== end($columnName)){
                    $this->sql .= " ,";
                }

                $this->bindArray[$columnName[$i]] = $updateData[$i];

            }

        }

        return $this;

    }

    public function toWHERE ($columnName,$cond,$checkVariable,$tableName=0){

        if($tableName == 0 ){
            if(strpos($cond,':') !== false){

                $checkVariable = str_replace(":",$checkVariable,$cond);
                $this->sql .= " WHERE `{$columnName}` LIKE :{$columnName}";
                $this->checks[$columnName] = $checkVariable;

            }else if(is_array($checkVariable)){

                if(strpos($cond,'BETWEEN') !== false){

                    $this->sql .= " WHERE `{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND :{$checkVariable[1]}";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[0];
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[1];

                }else{

                    $this->sql .= " WHERE `{$columnName}` {$cond} ( ";

                    foreach($checkVariable as $rows){
                        $columnName.= "x";
                        $this->sql .= ":{$columnName}";    
                        $this->checks[$columnName] = $rows;            
                        if($rows !== end($checkVariable)){
                            $this->sql .= " ,";
                        }
                        $this->checks[$columnName] = $rows;
                    }

                    $this->sql .= ' )';
                }


            }else{

                $this->sql .= " WHERE `{$columnName}` {$cond} :{$columnName}";
                $this->checks[$columnName] = $checkVariable;
            
            }

        }else{

            if(strpos($cond,':') !== false){

                $checkVariable = str_replace(":",$checkVariable,$cond);
                $this->sql .= " WHERE `{$tableName}`.`{$columnName}` LIKE :{$columnName}";
                $this->checks[$columnName] = $checkVariable;

            }else if(is_array($checkVariable)){

                if(strpos($cond,'BETWEEN') !== false){

                    $this->sql .= " WHERE `{$tableName}`.`{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND :{$checkVariable[1]}";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[0];
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[1];

                }else{

                    $this->sql .= " WHERE `{$tableName}`.`{$columnName}` {$cond} ( ";

                    foreach($checkVariable as $rows){
                        $columnName.= "x";
                        $this->sql .= ":{$columnName}";    
                        $this->checks[$columnName] = $rows;            
                        if($rows !== end($checkVariable)){
                            $this->sql .= " ,";
                        }
                        $this->checks[$columnName] = $rows;
                    }
                    $this->sql .= ' )';
                }

            }else{

                $this->sql .= " WHERE `{$tableName}`.`{$columnName}` {$cond} :{$columnName}";
                $this->checks[$columnName] = $checkVariable;

            }
        }
        return $this;

    }

    public function toAND ($columnName,$cond,$checkVariable,$tableName=0){

        if($tableName == 0 ){
            if(strpos($cond,':') !== false){

                $checkVariable = str_replace(":",$checkVariable,$cond);
                $this->sql .= " AND `{$columnName}` LIKE :{$columnName}";
                $this->checks[$columnName] = $checkVariable;

            }else if(is_array($checkVariable)){

                if(strpos($cond,'BETWEEN') !== false){

                    $this->sql .= " AND `{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND :{$checkVariable[1]}";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[0];
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[1];

                }else{
                    
                    $this->sql .= " AND `{$columnName}` {$cond} ( ";

                    foreach($checkVariable as $rows){
                        $columnName.= "x";
                        $this->sql .= ":{$columnName}";    
                        $this->checks[$columnName] = $rows;            
                        if($rows !== end($checkVariable)){
                            $this->sql .= " ,";
                        }
                        $this->checks[$columnName] = $rows;
                    }
                    $this->sql .= ' )';
                }


            }else{
                $this->sql .= " AND `{$columnName}` {$cond} :{$columnName}";
                $this->checks[$columnName] = $checkVariable;
            }
        }else{
            if(strpos($cond,':') !== false){

                $checkVariable = str_replace(":",$checkVariable,$cond);
                $this->sql .= " AND `{$tableName}`.`{$columnName}` LIKE :{$columnName}";
                $this->checks[$columnName] = $checkVariable;

            }else if(is_array($checkVariable)){

                if(strpos($cond,'BETWEEN') !== false){

                    $this->sql .= " AND `{$tableName}`.`{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND :{$checkVariable[1]}";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[0];
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[1];

                }else{

                    $this->sql .= " AND `{$tableName}`.`{$columnName}` {$cond} ( ";

                    foreach($checkVariable as $rows){
                        $columnName.= "x";
                        $this->sql .= ":{$columnName}";    
                        $this->checks[$columnName] = $rows;            
                        if($rows !== end($checkVariable)){
                            $this->sql .= " ,";
                        }
                        $this->checks[$columnName] = $rows;
                    }
                    $this->sql .= ' )';
                }

            }else{

                $this->sql .= " AND `{$tableName}`.`{$columnName}` {$cond} :{$columnName}";
                $this->checks[$columnName] = $checkVariable;

            }
        }
        return $this;

    }


    public function toOR ($columnName,$cond,$checkVariable,$tableName=0){

        if($tableName == 0 ){
            if(strpos($cond,':') !== false){

                $checkVariable = str_replace(":",$checkVariable,$cond);
                $this->sql .= " OR `{$columnName}` LIKE :{$columnName}";
                $this->checks[$columnName] = $checkVariable;

            }else if(is_array($checkVariable)){

                if(strpos($cond,'BETWEEN') !== false){

                    $this->sql .= " OR `{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND :{$checkVariable[1]}";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[0];
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[1];

                }else{
                    
                    $this->sql .= " OR `{$columnName}` {$cond} ( ";

                    foreach($checkVariable as $rows){
                        $columnName.= "x";
                        $this->sql .= ":{$columnName}";    
                        $this->checks[$columnName] = $rows;            
                        if($rows !== end($checkVariable)){
                            $this->sql .= " ,";
                        }
                        $this->checks[$columnName] = $rows;
                    }
                    $this->sql .= ' )';
                }


            }else{
                $this->sql .= " OR `{$columnName}` {$cond} :{$columnName}";
                $this->checks[$columnName] = $checkVariable;
            }
        }else{
            if(strpos($cond,':') !== false){

                $checkVariable = str_replace(":",$checkVariable,$cond);
                $this->sql .= " OR `{$tableName}`.`{$columnName}` LIKE :{$columnName}";
                $this->checks[$columnName] = $checkVariable;

            }else if(is_array($checkVariable)){

                if(strpos($cond,'BETWEEN') !== false){

                    $this->sql .= " OR `{$tableName}`.`{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND :{$checkVariable[1]}";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[0];
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable[1];

                }else{

                    $this->sql .= " OR `{$tableName}`.`{$columnName}` {$cond} ( ";

                    foreach($checkVariable as $rows){
                        $columnName.= "x";
                        $this->sql .= ":{$columnName}";    
                        $this->checks[$columnName] = $rows;            
                        if($rows !== end($checkVariable)){
                            $this->sql .= " ,";
                        }
                        $this->checks[$columnName] = $rows;
                    }
                    $this->sql .= ' )';
                }

            }else{

                $this->sql .= " OR `{$tableName}`.`{$columnName}` {$cond} :{$columnName}";
                $this->checks[$columnName] = $checkVariable;

            }
        }
        return $this;

    }

    public function subSELECT ( $columnName=[],) {
        
        $this->subQueryMode = 0;
        $this->sql .= "SELECT ";

        if(count($columnName)>0){
            foreach ($columnName as $column) {
                $this->sql .= "`" . $column . "`";
                if (!($column === end($columns))) {
                    $this->sql .= ",";
                }
            }
        }else{
            $this->sql .= "*";
        }

        $this->sql .= "( ";
        
        return $this;
    }

    public function subWHERE ($columnName,$cond=0,$checkVariable=0,$tableName=0){

        $this->subQueryMode = 1;
                
        if(strpos($columnName,'EXISTS') !== false || $cond==0){

            $this->sql .= " WHERE EXISTS (";
            
        }else{
            if($tableName == 0 ){

                if(strpos($cond,'BETWEEN') !== false){
    
                    $this->sql .= " WHERE `{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND ( ";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable;
    
                }else{
    
                    $this->sql .= " WHERE `{$columnName}` {$cond} ( ";
                
                }
    
            }else{
    
                if(strpos($cond,'BETWEEN') !== false){
    
                    $this->sql .= " WHERE `{$tableName}`.`{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND ( ";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable;
    
                }else{
    
                    $this->sql .= " WHERE `{$tableName}`.`{$columnName}` {$cond} ( ";
                    
                }
    
            }
        }


        return $this;

    }

    public function subAND ($columnName,$cond=0,$checkVariable=0,$tableName=0){

        $this->subQueryMode = 1;

        if(strpos($columnName,'EXISTS') !== false || $cond==0){

            $this->sql .= " AND EXISTS (";
            
        }else{

            if($tableName == 0 ){

                if(strpos($cond,'BETWEEN') !== false){

                    $this->sql .= " AND `{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND ( ";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable;

                }else{

                    $this->sql .= " AND `{$columnName}` {$cond} (";
                
                }

            }else{

                if(strpos($cond,'BETWEEN') !== false){

                    $this->sql .= " AND `{$tableName}`.`{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND ( ";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable;

                }else{

                    $this->sql .= " AND `{$tableName}`.`{$columnName}` {$cond} (";
            
                }

            }
        }

        return $this;

    }

    

    public function subOR ($columnName,$cond=0,$checkVariable=0,$tableName=0){

        $this->subQueryMode = 1;

        if(strpos($columnName,'EXISTS') !== false || $cond==0){

            $this->sql .= " OR EXISTS (";
            
        }else{

            if($tableName == 0 ){

                if(strpos($cond,'BETWEEN') !== false){

                    $this->sql .= " OR `{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND ( ";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable;

                }else{

                    $this->sql .= " OR `{$columnName}` {$cond} :{$columnName}";
                    $this->checks[$columnName] = $checkVariable;
                
                }

            }else{

                if(strpos($cond,'BETWEEN') !== false){

                    $this->sql .= " OR `{$tableName}`.`{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND ( ";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable;

                }else{

                    $this->sql .= " OR `{$tableName}`.`{$columnName}` {$cond} :{$columnName}";
                    $this->checks[$columnName] = $checkVariable;
                
                }

            }
        }

        return $this;

    }

    
    public function subEND ( $as = 0 ) {

        if($this->subQueryMode == 0){

            if($as != 0){
                $this->sql .= " ) AS {$as} FROM {$this->mainTableName}";
            }else{
                $this->sql .= " ) FROM `".$this->mainTableName."`";
            }

        }else if($this->subQueryMode == 1){
            
            $this->sql .= " ) ";

        }
        return $this;
    }




    public function toGROUP($columnName,$cu=0,$cond=0,$ch=0){
        
        $this->sql .= " GROUP BY {$columnName} ";

    }

    public function toHAVING ($columnName,$cond=0,$checkVariable=0,$tableName=0){

        $this->subQueryMode = 1;
                
        if(strpos($columnName,'EXISTS') !== false || $cond==0){

            $this->sql .= " HAVING EXISTS (";
            
        }else{
            if($tableName == 0 ){

                if(strpos($cond,'BETWEEN') !== false){
    
                    $this->sql .= " HAVING `{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND ( ";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable;
    
                }else{
    
                    $this->sql .= " HAVING `{$columnName}` {$cond} ( ";
                
                }
    
            }else{
    
                if(strpos($cond,'BETWEEN') !== false){
    
                    $this->sql .= " HAVING `{$tableName}`.`{$columnName}` {$cond} ";
                    $this->sql .= ":{$checkVariable[0]} AND ( ";
                    $columnName .= "x";
                    $this->checks[$columnName] = $checkVariable;
    
                }else{
    
                    $this->sql .= " HAVING `{$tableName}`.`{$columnName}` {$cond} ( ";
                    
                }
    
            }
        }

        return $this;

    }

    public function toASC($columnName){
        
        $this->sql .= " ORDER BY {$columnName} ASC ";

        return $this;

    }

    public function toDESC($columnName){

        $this->sql .= " ORDER BY {$columnName} DESC ";
        return $this;

    }

    public function toLIMIT($limit){

        $this->sql .= " LIMIT {$limit}";

        return $this;

    }
    

    public function toEXECUTE($mode = 0){
        try{

            $stmt = $this->pdo->prepare($this->sql);
            if(isset($this->bindArray)){
                $names = array_keys($this->bindArray);
                $i=0;
                foreach ($this->bindArray as $record){
                    $stmt->bindValue(':'.$names[$i++],$record);
                    // echo ':'.$names[$i-1].':'.$record.'<br>';
                }
            }
    
            if(count($this->checks)>0){
                $names = array_keys($this->checks);
                $i=0;
                foreach($this->checks as $check){
                    $stmt->bindValue($names[$i++],$check);
                }
            }
    
            // // var_dump();
            // exit();
    
            $stmt->execute();
            $this->sql = "";
       
            if($this->stats == 0){
                if($mode == 0){
                    $mode_commit = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    for($i=0; $i<count($mode_commit); $i++){
                        $mode_commit[$i] = array_values($mode_commit[$i]);
                    }
                    return ['check' => true,'data' => $mode_commit];
                }else{
                    if($stmt->rowCount() > 1){
                        return [
                            'check' => true,
                            'data' => $stmt->fetchAll($mode)
                        ];
                    }else{
                        return [
                            'check' => true,
                            'data' => $stmt->fetch($mode)
                        ];
                    }
                }
            }else{
                return ['check'=>true,'message'=>'処理が正常に完了しました'];
            }

        }catch(PDOException $ex){
            return ['check'=>false,'message'=> $ex->getMessage()];
        }
        

    }

    public function toSHOW(){

        echo $this->sql."<br>";
        var_dump($this->bindArray);
        echo'<br>';
        var_dump($this->checks);

    }

    public function toSQL(){

        return $this->sql;
    }
}
?>