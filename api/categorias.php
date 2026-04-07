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
            $sql = "insert into categorias(catnome) values(?);";
            $prp = $pdo->prepare($sql);
            $prp->execute([$nome]);
            Conexao::desconectar();
            break;
        case 'Read':
            $pdo = Conexao::conectar();
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql = "select catid as id, catnome as nome, catativo as ativo from categorias;";
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
            $sql = "select catid as id, catnome as nome, catativo as ativo from categorias where catnome like ?;";
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
            $ativo = $data['ativo'];
            $id = $data['id'];
            $sql = "update categorias set catnome = ?, catativo = ? where catid = ? ;";        
            $prp = $pdo->prepare($sql);
            $prp->execute([$nome,$ativo,$id]);
            Conexao::desconectar();
            break;
        case 'Delete':
            echo "Pendente";
            break;    
    }


    //{"nome":"valor"}
    //http://localhost/Projetos_ETEC_PWEB-III_Div1/api/categorias/icategorias.php?json={"nome":"Promoção do dia"}

?>