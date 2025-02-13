/* Aula OO - Persistência */

/*Os dados de uma tabela pode ser conhecido como Tupla ou Registros*/

CREATE TABLE jogadores (
    id INT AUTO_INCREMENT NOT NULL,
    tipo CHAR(1) NOT NULL CHECK (tipo IN ('A', 'G')), /* Tipo de jogador: A (Atacante) ou G (Goleiro) */
    nome VARCHAR(70) NOT NULL,
    idade INT NOT NULL,
    posicao VARCHAR(30) NOT NULL,
    time VARCHAR(70) NOT NULL,
    gols INT DEFAULT 0, /* Número de gols para atacantes */
    defesas INT DEFAULT 0, /* Número de defesas para goleiros */
    PRIMARY KEY (id),
    CONSTRAINT chk_gols CHECK (tipo = 'A' AND gols IS NOT NULL OR tipo = 'G' AND gols IS NULL), /* Gols apenas para atacantes */
    CONSTRAINT chk_defesas CHECK (tipo = 'G' AND defesas IS NOT NULL OR tipo = 'A' AND defesas IS NULL) /* Defesas apenas para goleiros */
);



