			<?php @ session_start() ?>
			<div id="topo">
				<span><b>ORG</b>anize</span>
			</div>
			<div id="menu">
				<span id="welcome">
					<?php
						if ($_SESSION["islog"]){
							echo <<<HTML
					Seja bem-vindo <b>{$_SESSION["usr"]}</b>!
HTML;
						}else{
							echo <<<HTML
					<form action="includes/php/login.php" method="POST" id="logf"> 
						<b>Usuário</b> <input type="text" name="user" /></td>
						<b>Senha</b> <input type="password" name="psw" />
						<input type="submit" value="Entrar" />
					</form>
HTML;
						}
					?>
				</span>
				<span id="links">
					<a href="index.php">Página Inicial</a> | 
					<a href="consulta.php">Consulta</a> |  
					<?php
						if ($_SESSION["islog"]){
							echo <<<HTML
					<a href="cadastro.php">Cadastro</a> |
					<a href="includes/php/logoff.php">Sair</a>
HTML;
						}else{
							echo <<<HTML
					<a href="#" id="login">Login</a>
HTML;
						}
					?>
				</span>
			</div>
