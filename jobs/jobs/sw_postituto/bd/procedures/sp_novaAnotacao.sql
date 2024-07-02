DELIMITER &&
CREATE PROCEDURE sp_novaAnotacao (
	intUsuario 		INT(11)
)
BEGIN
	INSERT INTO anotacoes (
		`usuario_codigo`, 
		`data_criacao`
	) VALUES (
		intUsuario, 
		CURRENT_TIMESTAMP
	);
END
&&

SELECT * FROM anotacoes;
TRUNCATE anotacoes;

CALL sp_novaAnotacao(1);
DROP PROCEDURE sp_novaAnotacao;
