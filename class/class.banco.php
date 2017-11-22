<?php 

trait Banco{

	public $link;

	public function conectaBanco(){
		return new mysqli("","","",""); 
	}

    public function executaSelect($sql, $numResult = 0){

    	$mysqli = $this->conectaBanco();

		$query = $mysqli->query($sql);

		if($numResult ==  0)
		{
			while ($dados = $query->fetch_assoc()){
				$result[] = $dados;
			}
		}else{
			$result	= $query->num_rows;
		}

    	return $result;
    }

    public function executaInsert($sql, $retornaId = 0){

    	$mysqli = $this->conectaBanco();
		$query = $mysqli->query($sql);

		if($query)
		{
			if($retornaId == 0){
				return true;
			}
			else{
				return $mysqli->insert_id;	
			}
		}
		else
		{
			// echo $mysqli->error;
			return false;
		}

    }

}