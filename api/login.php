<?php
    require '../app/conexao.php';
    $pdo = Conexao::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //$json = $_GET['jsn'];//{"nome":"valor"}
    $json = filter_input(INPUT_GET,'json');
    $data = json_decode($json,true);
    $usuario = $data['usuario'];
    $senha = $data['senha'];
    $sql = "select 
    usuid as id, 
    usunome as nome,
    usulogin as usuario,
    usulogado as logado
    from usuarios where usulogin = ? and ususenha = MD5(?);";
    $prp = $pdo->prepare($sql);
    $prp->execute([$usuario,$senha]);
    $data = $prp->fetchall(PDO::FETCH_ASSOC);
    echo json_encode($data);
    Conexao::desconectar();
    //{"usuario":"valor","senha":"valor"}
    //http://localhost/Projetos_ETEC_PWEB-III_Div1/api/spusuarios.php?json={"usuario":"irussaB","senha":"19062008"}

?>