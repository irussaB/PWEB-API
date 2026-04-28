<?php
    require '../../app/conexao.php';
    $pdo = Conexao::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $json = filter_input(INPUT_GET,'json');
    $data = json_decode($json,true);
    $nome = $data['nome'];
    $ativo = $data['ativo'];
    $id = $data['id'];
    $sql = "update categorias set catnome = ?, catativo = ? where catid = ? ;";        
    $prp = $pdo->prepare($sql);
    $prp->execute([$nome,$ativo,$id]);

    Conexao::desconectar();
    //{"nome":"valor","ativo":"valor","id":"valor"}
    //http://localhost/Projetos_ETEC_PWEB-III_Div1/api/uusuarios.php?json={"nome":"Matheus","login":"mbrussi","senha":"5467","id":"8"}

?>