<?php
    require '../app/conexao.php';
    $pdo = Conexao::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $json = filter_input(INPUT_GET,'json');
    $data = json_decode($json,true);
    $nome = $data['nome'];
    $login = $data['login'];
    $senha = $data['senha'];
    $id = $data['id'];
    if(!empty($data['senha'])){
        $sql = "update usuarios set usunome = ?, usulogin = ?, ususenha = MD5(?) where usuid = ?;";
        $prp = $pdo->prepare($sql);
        $prp->execute([$nome,$login,$senha,$id]);
    }
    else{
        $sql = "update usuarios set usunome = ?, usulogin = ? where usuid = ? ;";        
        $prp = $pdo->prepare($sql);
        $prp->execute([$nome,$login,$id]);
    }
    Conexao::desconectar();
    //{"nome":"valor","login":"valor","senha":"valor","id":"valor"}
    //http://localhost/Projetos_ETEC_PWEB-III_Div1/api/uusuarios.php?json={"nome":"Matheus","login":"mbrussi","senha":"5467","id":"8"}

?>