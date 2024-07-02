DELIMITER &&
CREATE PROCEDURE sp_verificaLogin (
	strApelido 	VARCHAR(14), 
	strSenha 	VARCHAR(14)
)
BEGIN
	
	IF(SELECT EXISTS(SELECT 1 FROM usuarios WHERE apelido = strApelido AND senha = strSenha)) THEN
		IF(SELECT EXISTS(SELECT 1 FROM usuarios WHERE apelido = strApelido AND senha = strSenha AND situacao <> 0)) THEN
			SELECT 'aceito' AS retorno;
		ELSE
			SELECT 'desativado' AS retorno;
		END IF;
	ELSE
		SELECT 'recusado' AS retorno;
	END IF;

END
&&

CALL sp_verificaLogin('root','m1c2r3t4');
DROP PROCEDURE sp_verificaLogin;