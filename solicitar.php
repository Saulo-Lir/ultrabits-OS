<?php
    require "cabecalho.php";
?>

<div class="formulario">
    
    <form action="processa-solicitacao.php" method="POST" enctype="multipart/form-data">
        Email:<br/><br/>
            <input type="email" name="email" required/><br/><br/>
        Empresa:<br/><br/>
            <input type="text" name="empresa" required/><br/><br/>
        Tipo:<br/><br/>
            <input type="radio" name="tipo" value="remoto" />Acesso Remoto<br/>
            <input type="radio" name="tipo" value="presencial" />Presencial<br/><br/>
        Categoria:<br/><br/>
            <select name="categoria">
                <option value="">Manutenção de Computadores</option>
                <option value="">Configuração</option>
                <option value="">Instalação de Software</option>
                <option value="">Roteadores / Modens / Switches</option>
                <option value="">Formatação</option>
                <option value="">Remoção de Vírus</option>
                <option value="">Upgrade</option>
            </select> <br/><br/>                
        Descrição:<br/><br/>
        <textarea name='descricao'></textarea><br/><br/>
        Anexos:<br/><br/>
        <input type="file" name="anexos[]" multiple /><br/><br/> <!-- Envio Múltiplo de arquivos -->
        
        <input type="submit" value="Solicitar"/>
    </form>
</div>

<div class="btn-votar">
    <a href="index.php">
        <img src="imagens/voltar.png"/>
    </a>
</div>

<?php
    require "rodape.php";
?>