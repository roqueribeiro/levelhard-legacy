DELIMITER &&
CREATE PROCEDURE sp_novoUsuario (
	strNome 		VARCHAR(150), 
	strSobrenome 	VARCHAR(255),
	strApelido 		VARCHAR(14), 
	strSenha 		VARCHAR(14),
	strEmail 		VARCHAR(150),
	strFoto 		VARCHAR(255)
)
BEGIN
	IF(SELECT NOT EXISTS(SELECT 1 FROM usuarios WHERE apelido = strApelido)) THEN
		INSERT INTO usuarios (
			`nome`, 
			`sobrenome`, 
			`apelido`, 
			`senha`, 
			`email`, 
			`foto`, 
			`diretorio`, 
			`data_criado`
		) VALUES (
			LOWER(strNome), 
			LOWER(strSobrenome), 
			strApelido, 
			strSenha, 
			LOWER(strEmail), 
			strFoto, 
			LEFT(REPLACE(LOWER(UUID()),'-',''),32), 
			CURRENT_TIMESTAMP
		);
		SELECT 'criado' AS retorno;
	ELSE
		SELECT 'existe' AS retorno;
	END IF;
END
&&

SELECT * FROM usuarios;
TRUNCATE usuarios;

CALL sp_novoUsuario('Roque','Ribeiro','root','m1c2r3t4','roque.ribeiro@hotmail.com.br','photo.jpg');
DROP PROCEDURE sp_novoUsuario;
