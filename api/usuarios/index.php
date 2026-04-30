<?php
    require '../../app/conexao.php';
    $pdo = Conexao::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $json = filter_input(INPUT_GET,'json');
    $data = json_decode($json,true);
    $op = $data['op']??'';
    $id = $data['id']??'';
    $nome = $data['nome']??'';
    $login = $data['login']??'';
    $senha = $data['senha']??'';
    $logado = $data['logado']??'';
 
    switch ($op) {
        case 'i':
            $sql = "insert into usuarios(usunome,usulogin,ususenha) values(?,?,MD5(?));";
            $prp = $pdo->prepare($sql);
            $prp->execute([$nome,$login,$senha]);
            break;
        case 's':
            $sql = "select usuid as id, usunome as nome, usulogin as usuario, usulogado as logado from usuarios;";
            $prp = $pdo->prepare($sql);
            $prp->execute();
            $data = $prp->fetchall(PDO::FETCH_ASSOC);
            echo json_encode($data);
            break;
        case 'sp':
            $nome = '%'.$data['nome'].'%';
            $sql = "select usuid as id, usunome as nome, usulogin as usuario, usulogado as logado from usuarios where usunome like ?;";
            $prp = $pdo->prepare($sql);
            $prp->execute([$nome]);
            $data = $prp->fetchall(PDO::FETCH_ASSOC);
            echo json_encode($data);
            break;
        case 'u':
            if(!empty($data['senha'])){
                $sql = "update usuarios set usunome = ?, usulogin = ?, ususenha = MD5(?), usulogado = ? where usuid = ?;";
                $prp = $pdo->prepare($sql);
                $prp->execute([$nome,$login,$senha,$logado,$id]);
            }
            else{
                $sql = "update usuarios set usunome = ?, usulogin = ?, usulogado = ? where usuid = ? ;";        
                $prp = $pdo->prepare($sql);
                $prp->execute([$nome,$login,$logado,$id]);
            }
            break;
        case 'd':
            echo "Pendente";
            break;    
        case 'l':
            $sql = "select usuid as id, usunome as nome, usulogin as usuario, usulogado as logado from usuarios where usulogin = ? and ususenha = MD5(?);";
            $prp = $pdo->prepare($sql);
            $prp->execute([$login,$senha]);
            $data = $prp->fetchall(PDO::FETCH_ASSOC);
            echo json_encode($data);
            break; 
        default:
            echo "Parametro Inválido";
        }
        
    Conexao::desconectar();

//?json={"op":"sp","id":0,"nome":"P","login":"","senha":"","logado":true}

?>