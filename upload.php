<?php
	
	$DestinationDirectory	= 'comunicados/'; //Qual pasta os arquivos deverão ir
	
	$categoria  = $_POST['categoria'];

        //Verifica se existe arquivo
	if($_FILES['file']['tmp_name'])
	{
		//Tipo da imagem
		$ImageType    = $_FILES['file']['type'];
		//Nome do arquivo
		$ImageName 	  = "comunicado_".date('dmyy')."_".$_FILES['file']['name'];
		
        //Verificar tipo do arquivo
		$ImageType = ($ImageType == 'image/jpeg' ? 'jpg' : ($ImageType == 'image/gif' ? 'pdf' : 'png'));
	}
	
	//=============================================
	$postagem = $_POST['postagem']; //Recebe o post do campo postagem
	//=============================================

	if($postagem == "" || $categoria == "")
	{
		echo '<script>alert("Fórum não selecionado")</script>';
		exit;
	}else{
		if (isset($_FILES['file']) && !empty($_FILES['file']['name'])) {
	  
		  if(move_uploaded_file($_FILES['file']['tmp_name'], $DestinationDirectory . $ImageName)){
		  	//Um Json com status ok, você poderá retornar qualquer coisa
            $ret = array('status' => 'ok', 'postagem' => $postagem, 'categoria' => $categoria, 'foto' => $ImageName);
		  }else{
		  	$ret = array('error' => 'no_file'); //Nenhum arquivo
		  } 
		}
	}
	header('Content-Type: application/json');
	echo json_encode($ret);
 ?>