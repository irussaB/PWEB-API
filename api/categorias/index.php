<?php
    require '../../app/conexao.php';
    $pdo = Conexao::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    $json = filter_input(INPUT_GET,'json');
    $data = json_decode($json,true);
    $op = $data['op'];
    $nome = $data['nome'];
    $id = $data['id'];
    $ativo = $data['ativo'];
    switch ($op) {
        case 'i':
            $sql = "insert into categorias(catnome) values(?);";
            $prp = $pdo->prepare($sql);
            $prp->execute([$nome]);
            break;
        case 's':
            $sql = "select catid as id, catnome as nome, catativo as ativo from categorias;";
            $prp = $pdo->prepare($sql);
            $prp->execute();
            $data = $prp->fetchall(PDO::FETCH_ASSOC);
            echo json_encode($data);
            break;
        case 'sp':
            $nome = '%'.$data['nome'].'%';
            $sql = "select catid as id, catnome as nome, catativo as ativo from categorias where catnome like ?;";
            $prp = $pdo->prepare($sql);
            $prp->execute([$nome]);
            $data = $prp->fetchall(PDO::FETCH_ASSOC);
            echo json_encode($data);
            break;
        case 'u':
            $sql = "update categorias set catnome = ?, catativo = ? where catid = ? ;";        
            $prp = $pdo->prepare($sql);
            $prp->execute([$nome,$ativo,$id]);
            break;
        case 'd':
            echo "Pendente";
            break; 
        default:
            echo "Parametro Inváilido";
    }

    Conexao::desconectar();

// ?json={"op:"sp","id":"0","nome":"P","login":"0","Senha":"0"}

?>