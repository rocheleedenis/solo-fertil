# SoloFértil

Projeto desenvolvido em 2017 como parte do meu [TCC (Trabalho de Conclusão de Curso)](https://www.sje.ifmg.edu.br/portal/images/artigos/biblioteca/TCCs/Sistemas_de_informacao/2017/KENIA_ALVES_PEREIRA_ARAUJO_ROCHELE_EDENIS_MIRANDA.pdf) apresentado ao Instituto Federal de Minas Gerais – Campus São João Evangelista, como exigência parcial para obtenção do título de Bacharel em Sistemas de Informação.

Recomende adubos e corretivos e realize sugestão de sucessão de culturas considerando as necessidades de nutrientes apresentadas pelas culturas e as condições de solo que podem ser obtidas através de uma análise de solo.

O sistema construído realiza a interpretação de análise, gerando uma classificação de cada um de seus elementos e também realiza o cálculo da calagem, com a finalidade de prover a sugestão de correção de solo para regularizar seus níveis de acidez.

## Instalação

- Rode `docker-compose up -d`;
- Abra o gerenciador de banco de dados de sua preferência, conecte-se ao container com o MySQL e crie um banco de dados chamado `solo-fertil`.
- Dentro da pasta _config existe o arquivo `soloFertil.sql`. Execute-o para gerar as tabelas do sistema.
