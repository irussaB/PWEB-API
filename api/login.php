<?php
    require '../app/conexao.php';
    $pdo = Conexao::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //$json = $_GET['jsn'];//{"nome":"valor"}
    $json = filter_input(INPUT_GET,'json');
    $data3 = json_decode($json,true);
    $usuario = $data3['usuario'];
    $data4 = json_decode($json,true);
    $senha = $data4['senha'];
    //echo $usuario;
    //echo $senha;  
    $sql = "select * from usuarios where usulogin = '$usuario' and ususenha = MD5($senha);";
    $prp = $pdo->prepare($sql);
    $prp->execute();
    $data = $prp->fetchall(PDO::FETCH_ASSOC);
    echo json_encode($data);
    //{"usuario":"valor","senha":"valor"}
    //http://localhost/Projetos_ETEC_PWEB-III_Div1/api/spusuarios.php?json={"usuario":"irussaB","senha":"19062008"}

?>