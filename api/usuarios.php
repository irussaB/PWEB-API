<?php
    require '../app/conexao.php';

    $json = filter_input(INPUT_GET,'json');
    $data = json_decode($json,true);
    $i = $data['i'];
    switch ($i) {
        case 'Create':
            $pdo = Conexao::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $nome = $data['nome'];
            $login = $data['login'];
            $senha = $data['senha'];
            $sql = "insert into usuarios(usunome,usulogin,ususenha) values(?,?,MD5(?));";
            $prp = $pdo->prepare($sql);
            $prp->execute([$nome,$login,$senha]);
            Conexao::desconectar();
            break;
        case 'Read':
            $pdo = Conexao::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "select usuid as id, usunome as nome, usulogin as usuario, usulogado as logado from usuarios;";
            $prp = $pdo->prepare($sql);
            $prp->execute();
            $data = $prp->fetchall(PDO::FETCH_ASSOC);
            echo json_encode($data);
            Conexao::desconectar();
            break;
        case 'ReadP':
            $pdo = Conexao::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $nome = '%'.$data['nome'].'%';
            $sql = "select usuid as id, usunome as nome, usulogin as usuario, usulogado as logado from usuarios where usunome like ?;";
            $prp = $pdo->prepare($sql);
            $prp->execute([$nome]);
            $data = $prp->fetchall(PDO::FETCH_ASSOC);
            echo json_encode($data);
            Conexao::desconectar();
            break;
        case 'Update':
            $pdo = Conexao::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
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
            break;
        case 'Delete':
            echo "Pendente";
            break;    
        case 'Login':
            $pdo = Conexao::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $usuario = $data['usuario'];
            $senha = $data['senha'];
            $sql = "select usuid as id, usunome as nome, usulogin as usuario, usulogado as logado from usuarios where usulogin = ? and ususenha = MD5(?);";
            $prp = $pdo->prepare($sql);
            $prp->execute([$usuario,$senha]);
            $data = $prp->fetchall(PDO::FETCH_ASSOC);
            echo json_encode($data);
            Conexao::desconectar();
            break;    
        }


    //{"nome":"valor"}
    //http://localhost/Projetos_ETEC_PWEB-III_Div1/api/categorias/icategorias.php?json={"nome":"Promoção do dia"}

?>