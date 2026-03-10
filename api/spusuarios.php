<?php
    require '../app/conexao.php';
    $pdo = Conexao::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //$json = $_GET['jsn'];//{"nome":"valor"}
    $json = filter_input(INPUT_GET,'json');
    $data2 = json_decode($json,true);
    $nome = $data2['nome'];
//    echo $data2['nome'];  
    //$nome=$data2;
    $sql = "select*from usuarios where usunome like '%$nome%';";
    $prp = $pdo->prepare($sql);
    $prp->execute();
    $data = $prp->fetchall(PDO::FETCH_ASSOC);
    echo json_encode($data);
    //{"nome":"valor"}
    //http://localhost/Projetos_ETEC_PWEB-III_Div1/api/spusuarios.php?json={%22nome%22:%22Pedro%22}

?>