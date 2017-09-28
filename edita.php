<?php
    require 'cabecalho.php';
    require 'servico.class.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = addslashes($_GET['id']);
    
    $os = new Servico();
    $servico = $os->selecionaOsPeloId($id);

}else{
    header('Location: acompanhar.php');
}
?>

<h3 style='color:#FFF'>Selecione os Itens que deseja Editar</h3>

<form class='formulario' method='POST' action='processa-edita.php'>
    Empresa:<br/>
    <input type='text' name='empresa' value='<?=$servico['empresa']?>'><br/><br/>
    Email:<br/>
    <input type='email' name='email' value='<?=$servico['email']?>'><br/><br/>
    Tipo:<br/>
    <input type='text' name='tipo' value='<?=$servico['tipo']?>'><br/><br/>
    Categoria:<br/>
    <input type='text' name='categoria' value='<?=$servico['categoria']?>'><br/><br/>
    Descrição:<br/>
    <textarea name='descricao'><?=$servico['descricao']?></textarea><br/><br/>
    <input type='hidden' name='id' value='<?=$servico['id']?>'>
    <input type='submit' value='Atualizar' />
</form>

<?php
    require 'rodape.php'
?>
