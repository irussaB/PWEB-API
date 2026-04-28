<?php
    require '../../app/conexao.php';
    $pdo = Conexao::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $json = filter_input(INPUT_GET,'json');
    $data = json_decode($json,true);
    $nome = '%'.$data['nome'].'%';
    $sql = "select 
    catid as id, 
    catnome as nome,
    catativo as ativo
    from categorias where catnome like ?;";
    $prp = $pdo->prepare($sql);
    $prp->execute([$nome]);
    $data = $prp->fetchall(PDO::FETCH_ASSOC);
    echo json_encode($data);
    Conexao::desconectar();
    //{"nome":"valor"}
    //http://localhost/Projetos_ETEC_PWEB-III_Div1/api/spusuarios.php?json={%22nome%22:%22Pedro%22}

?>