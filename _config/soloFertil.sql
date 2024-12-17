-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 27/03/2017 às 09:41
-- Versão do servidor: 10.1.18-MariaDB
-- Versão do PHP: 7.0.12

-- init.sql
CREATE DATABASE IF NOT EXISTS `solo-fertil`;
USE `solo-fertil`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `soloFertil`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `adubacaoMineral`
--

CREATE TABLE `adubacaoMineral` (
  `id` int(11) NOT NULL,
  `disponibNutriente` tinyint(1) NOT NULL,
  `p2o5soloArgiloso` varchar(5) DEFAULT NULL,
  `p2o5soloMedio` varchar(5) NOT NULL,
  `p2o5soloArenoso` varchar(5) DEFAULT NULL,
  `k2o` varchar(5) NOT NULL,
  `nitrogenio` varchar(5) NOT NULL,
  `idCultura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `adubacaoMineral`
--

INSERT INTO `adubacaoMineral` (`id`, `disponibNutriente`, `p2o5soloArgiloso`, `p2o5soloMedio`, `p2o5soloArenoso`, `k2o`, `nitrogenio`, `idCultura`) VALUES
(5, 2, NULL, '300', NULL, '240', '150', 1),
(6, 3, NULL, '240', NULL, '180', '150', 1),
(7, 4, NULL, '100', NULL, '100', '150', 1),
(8, 5, NULL, '50', NULL, '0/1', '150', 1),
(9, 2, '200', '170', '140', '360', '430', 2),
(10, 3, '170', '140', '110', '330', '430', 2),
(11, 4, '140', '110', '80', '300', '430', 2),
(12, 5, '110', '80', '60', '270', '430', 2),
(13, 2, '200', '160', '120', '240', '120', 3),
(14, 2, '150', '100', '60', '100', '60', 4),
(15, 2, NULL, '400', NULL, '120', '150', 5),
(16, 3, NULL, '300', NULL, '90', '150', 5),
(17, 4, NULL, '100', NULL, '60', '150', 5),
(18, 5, NULL, '50', NULL, '0', '150', 5),
(19, 3, '160', '120', '80', '180', '120', 3),
(20, 4, '120', '80', '40', '120', '120', 3),
(21, 5, '80', '40', '0', '60', '120', 3),
(22, 3, '100', '60', '40', '80', '60', 4),
(23, 4, '60', '40', '20', '60', '60', 4),
(24, 5, '40', '20', '0', '40', '60', 4),
(25, 2, NULL, '250', NULL, '80', '80', 6),
(26, 3, NULL, '200', NULL, '60', '80', 6),
(27, 4, NULL, '150', NULL, '40', '80', 6),
(28, 5, NULL, '100', NULL, '20', '80', 6),
(29, 2, NULL, '420', NULL, '350', '190', 7),
(30, 3, NULL, '300', NULL, '220', '190', 7),
(31, 4, NULL, '120', NULL, '150', '190', 7),
(32, 5, NULL, '50', NULL, '0', '190', 7),
(33, 2, NULL, '180', NULL, '90', '60', 8),
(34, 3, NULL, '120', NULL, '60', '60', 8),
(35, 4, NULL, '60', NULL, '30', '60', 8),
(36, 5, NULL, '0', NULL, '0', '60', 8),
(37, 2, NULL, '200', NULL, '160', '100', 9),
(38, 3, NULL, '160', NULL, '120', '100', 9),
(39, 4, NULL, '120', NULL, '80', '100', 9),
(40, 5, NULL, '80', NULL, '50', '100', 9),
(41, 2, NULL, '300', NULL, '240', '100', 10),
(42, 3, NULL, '240', NULL, '180', '100', 10),
(43, 4, NULL, '180', NULL, '120', '100', 10),
(44, 5, NULL, '0', NULL, '0', '100', 10),
(45, 2, NULL, '400', NULL, '240', '150', 11),
(46, 3, NULL, '300', NULL, '180', '150', 11),
(47, 4, NULL, '100', NULL, '100', '150', 11),
(48, 5, NULL, '50', NULL, '0', '150', 11),
(49, 2, NULL, '300', NULL, '180', '120', 12),
(50, 3, NULL, '220', NULL, '120', '120', 12),
(51, 4, NULL, '100', NULL, '50', '120', 12),
(52, 5, NULL, '50', NULL, '0', '120', 12),
(53, 2, '400', '320', '240', '320', '120', 13),
(54, 3, '320', '240', '160', '240', '120', 13),
(55, 4, '240', '160', '80', '160', '120', 13),
(56, 5, '160', '80', '0', '80', '120', 13),
(57, 2, '280', '230', '180', '120', '150', 14),
(58, 3, '230', '180', '130', '90', '150', 14),
(59, 4, '180', '130', '80', '60', '150', 14),
(60, 5, '130', '80', '50', '30', '150', 14),
(61, 2, NULL, '180', NULL, '90', '60', 15),
(62, 3, NULL, '120', NULL, '60', '60', 15),
(63, 4, NULL, '60', NULL, '30', '60', 15),
(64, 5, NULL, '0', NULL, '0', '60', 15),
(65, 2, NULL, '200', NULL, '160', '100', 16),
(66, 3, NULL, '160', NULL, '120', '100', 16),
(67, 4, NULL, '120', NULL, '80', '100', 16),
(68, 5, NULL, '80', NULL, '50', '100', 16),
(69, 2, NULL, '180', NULL, '90', '0', 17),
(70, 3, NULL, '120', NULL, '60', '0', 17),
(71, 4, NULL, '60', NULL, '30', '0', 17),
(72, 5, NULL, '0', NULL, '0', '0', 17),
(73, 2, '200', '160', '120', '150', '120', 18),
(74, 3, '160', '120', '80', '120', '120', 18),
(75, 4, '120', '80', '40', '90', '120', 18),
(76, 5, '80', '40', '0', '60', '120', 18),
(77, 2, NULL, '240', NULL, '300', '200', 19),
(78, 3, NULL, '200', NULL, '250', '170', 19),
(79, 4, NULL, '160', NULL, '200', '140', 19),
(80, 5, NULL, '120', NULL, '100', '100', 19),
(81, 2, NULL, '80', NULL, '50', '60', 21),
(82, 3, NULL, '60', NULL, '40', '60', 21),
(83, 4, NULL, '40', NULL, '30', '60', 21),
(84, 5, NULL, '0', NULL, '0', '60', 21),
(85, 2, NULL, '400', NULL, '350', '220', 22),
(86, 3, NULL, '300', NULL, '250', '220', 22),
(87, 4, NULL, '200', NULL, '150', '220', 22),
(88, 5, NULL, '100', NULL, '80', '220', 22),
(89, 2, '300', '240', '180', '250', '120', 23),
(90, 3, '240', '180', '120', '180', '120', 23),
(91, 4, '180', '120', '60', '120', '120', 23),
(92, 5, '120', '60', '0', '60', '120', 23),
(93, 2, NULL, '300', NULL, '240', '150', 24),
(94, 3, NULL, '240', NULL, '180', '150', 24),
(95, 4, NULL, '100', NULL, '80', '150', 24),
(96, 5, NULL, '50', NULL, '0', '150', 24),
(97, 2, '240', '200', '160', '240', '120', 25),
(98, 3, '200', '160', '120', '180', '120', 25),
(99, 4, '160', '120', '80', '120', '120', 25),
(100, 5, '120', '80', '40', '60', '120', 25),
(101, 2, NULL, '400', NULL, '240', '150', 26),
(102, 3, NULL, '300', NULL, '180', '150', 26),
(103, 4, NULL, '100', NULL, '100', '150', 26),
(104, 5, NULL, '50', NULL, '0', '150', 26),
(105, 2, '600', '500', '400', '200', '120', 27),
(106, 3, '500', '400', '300', '150', '100', 27),
(107, 4, '400', '300', '200', '100', '80', 27),
(108, 5, '300', '200', '100', '60', '50', 27),
(109, 2, '1200', '900', '600', '800', '400', 28),
(110, 3, '1000', '800', '500', '600', '300', 28),
(111, 4, '700', '600', '400', '400', '200', 28),
(112, 5, '500', '400', '300', '200', '100', 28);

-- --------------------------------------------------------

--
-- Estrutura para tabela `analise`
--

CREATE TABLE `analise` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `local` varchar(45) NOT NULL,
  `profundidade` int(11) NOT NULL,
  `pH` decimal(3,2) NOT NULL,
  `fosforo` decimal(5,2) NOT NULL,
  `potassio` decimal(5,2) NOT NULL,
  `calcio` decimal(5,2) NOT NULL,
  `magnesio` decimal(5,2) NOT NULL,
  `aluminio` decimal(5,2) NOT NULL,
  `somaBases` decimal(5,2) NOT NULL,
  `acidezPotencial` decimal(5,2) NOT NULL,
  `matOrganica` decimal(5,2) NOT NULL,
  `prem` decimal(5,2) DEFAULT NULL,
  `teorArgila` decimal(5,2) NOT NULL,
  `idProdutor` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `analise`
--

INSERT INTO `analise` (`id`, `data`, `local`, `profundidade`, `pH`, `fosforo`, `potassio`, `calcio`, `magnesio`, `aluminio`, `somaBases`, `acidezPotencial`, `matOrganica`, `prem`, `teorArgila`, `idProdutor`, `idUsuario`) VALUES
(33, '2017-03-27', 'Talhão01', 30, '5.32', '12.80', '200.00', '2.99', '0.81', '0.00', '4.31', '3.74', '2.77', '22.90', '28.98', 21, 50);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cultura`
--

CREATE TABLE `cultura` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `familia` varchar(20) NOT NULL,
  `saturacaoAl` tinyint(2) NOT NULL,
  `indiceX` decimal(2,1) NOT NULL,
  `saturacaoBases` tinyint(2) NOT NULL,
  `producaoEsperada` mediumtext NOT NULL,
  `espacamento` mediumtext NOT NULL,
  `calagem` mediumtext NOT NULL,
  `adubacaoOrg` mediumtext NOT NULL,
  `observacoes` varchar(45) DEFAULT NULL,
  `parcelamentoNPK` mediumtext,
  `obsQuadroNPK` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `cultura`
--

INSERT INTO `cultura` (`id`, `nome`, `familia`, `saturacaoAl`, `indiceX`, `saturacaoBases`, `producaoEsperada`, `espacamento`, `calagem`, `adubacaoOrg`, `observacoes`, `parcelamentoNPK`, `obsQuadroNPK`) VALUES
(1, 'Couve-Flor', 'Brassicaceae', 5, '3.0', 70, '25.000 kg ou 1.400 dúzias ou 3.000 engradados.', '1,0 x 0,5 m', 'Elevar a saturação por bases do solo a 70% ou pelo método Al<sup>3+</sup> e o do Ca<sup>2+</sup> + Mg<sup>2+</sup> com o valor de X = 3,0 e mt = 5 %.', 'Aplicar 20 t/ha de esterco de curral curtido ou 5 t/ha de esterco de galinha nos sulcos de plantio.', 'Exigente em magnésio.', 'Aplicar todo o fósforo e parte dos fertilizantes que contêm NK no sulco, por ocasião do transplantio das mudas. Aplicar o restante dos fertilizantes com nitrogênio e potássio em cobertura aos 20, 40 e 60 dias do transplantio. Sugere-se aplicar micronutrientes , especialmente o boro no solo e o molibdênio via foliar.', 'Podem-se colocar 100 kg/ha para repor a quantidade retirada pelas cabeças.'),
(2, 'Chuchu', 'Cucurbitaceae', 5, '3.5', 80, '60.000 a 65.000 kg/ha', '4,0 x 3,0 m', 'Aplicar calcário para elevar a saturação por bases do solo a 80%.', 'Adicionar 10 t/ha de esterco de curral curtido ou 2,5 t/ha de esterco de galinha, 10 a 20 dias antes do plantio. Após seis meses, repetir a aplicação na mesma quantidade.', 'Exigentes em magnésio.', '<b>N</b> - Aplicar 30 kg/ha no plantio e, a partir do início da produção, aplicar mensalmente 40 kg/ha.<br><b>K</b> - Aplicar 20% da quantidade recomendada no plantio e, a partir do início de produção, fazer adubações mensais com 30 kg/ha.<br><b>P</b> - Aplicar 70% da quantidade recomendada no plantio, e o restante dividir em duas aplicações em cobertura, com chegamento de terra, sendo a primeira 4 meses após o plantio e a segunda 4 meses após a primeira. Utilizar adubos que contêm cálcio solúvel, como nitrocálcio e superfosfato simples, para evitar a deficiência do cálcio (“fruto sem pescoço”).', 'Somente em cobertura.'),
(3, 'Abóbora Italiana', 'Cucurbitaceae', 5, '3.0', 70, '15.000 a 18.000 kg/ha', '1,0 x 0,7 m', 'Elevar a saturação por bases do solo a 70% e o teor de magnésio do solo a um mínimo de 1,0 cmol<sub>c</sub>/dm<sup>3</sup>, ou pelo método do Al<sup>3+</sup> e do Ca<sup>2+</sup> + Mg<sup>2+</sup> levando em consideração o valor de Y, variável em função da capacidade tampão da acidez do solo e X = 3 e m<sub>t</sub> = 5%.', 'Aplicar 15 t/ha de esterco de curral curtido, ou 5 t/ha de esterco de aves curtido ou 1,5 t/ha de torta de mamona fermentada.', 'Exigentes em magnésio', 'O fósforo deve ser aplicado todo no plantio, juntamente com o adubo orgânico, 40 % do nitrogênio e 50 % do potássio recomendado, colocados na cova ou sulco de plantio, 15 a 20 dias antes do semeio ou transplantio. O restante do nitrogênio e potássio deve ser aplicado em cobertura, 20 dias após o semeio ou 25 dias após o transplantio das mudas.', NULL),
(4, 'Abóbora Menina', 'Cucurbitaceae', 5, '3.0', 70, '20.000 a 24.000 kg/ha', '3,0 x 2,0 m', 'Elevar a saturação por bases a 65-70% e o teor de magnésio do solo a um mínimo de 1,0 cmol<sub>c</sub>/dm<sup>3</sup>.', 'Aplicar 15 t/ha de esterco de curral ou 5 t/ha de esterco de galinha curtidos ou 500 kg/ha de torta de mamona fermentada.', 'Exigentes em magnésio', 'o fósforo, 30 % do nitrogênio e 40 % do potássio devem ser aplicados junto com a adubação orgânica, 15 a 20 dias antes do semeio ou transplantio. O restante do nitrogênio e potássio (70 % e 60 % respectivamente) deve ser aplicado em duas coberturas, sendo a primeira 30 dias após a emergência e a segunda 25 dias após a primeira.', 'Somente em cobertura.'),
(5, 'Alface', 'Asteraceae', 5, '3.0', 70, '21.000 kg/ha ou 9.000 dúzias ou 1.500 engradados/ha.', '25 x 25 cm', 'Elevar a saturação por bases do solo a 70% ou pelo método do Al<sup>3+</sup> do Ca<sup>2+</sup> Mg<sup>2+</sup> com o valor de X = 3,0 e m<sub>t</sub> = 5%.', 'Adicionar 50 t/ha de esterco de curral curtido ou 12 t/ha de esterco de galinha curtido, com incorporação ao solo do canteiro.', '', 'Aplicar todo o fósforo e parte dos fertilizantes que contêm NK ao solo, por ocasião do transplantio das mudas. Aplicar o restante dos fertilizantes com nitrogênio e potássio em coberturas 15, 30 e 40 dias após o transplantio. Sugere-se aplicar micronutrientes.', 'Podem-se colocar 60 kg para repor a quantidade retirada pela alface colhida.'),
(6, 'Alho', 'Liliaceae', 5, '3.0', 70, '10.000 a 12.000 kg/ha', '25 a 30 cm entre fileiras e 7,5 a 10 cm entre plantas.', 'Elevar a saturação por bases a 70% com calcário dolomítico.', 'Aplicar 20 a 40 t/ha de esterco de curral curtido ou 5 a\r\n10 t/ha de esterco de galinha curtido, 15 a 30 dias antes do plantio, nos sulcos e\r\nincorporado. As maiores doses são para os solos arenosos.', NULL, 'Aplicar todo o fósforo e partes dos fertilizantes que contêm NK nos sulcos, 10 dias antes do plantio. Acrescentar à adubação de plantio 3 kg/ha de B e de 3 a 5 kg/ha de Zn. O restante dos fertilizantes com N e K deve ser aplicado em coberturas aos 50 e 100 dias do plantio. Dependendo do estado vegetativo da cultura, usar quantidades menores de N (até 1/3 da recomendação).', NULL),
(7, 'Batata', 'Solanaceae', 15, '2.0', 60, '30.000 kg/ha', '80 x 30 cm', 'Elevar a saturação por bases a 60% ou pelo método do Al<sup>3+</sup> e do Ca<sup>2+</sup> + Mg<sup>2+</sup> com Y variável em função da capacidade tampão da acidez do solo\r\ne X = 2,0 e m<sub>t</sub> = 15%.', '', 'Exigentes em magnésio.', 'Aplicar parte dos fertilizantes que contêm NPK no sulco, por ocasião do plantio. Imediatamente antes da amontoa, aplicar o restante do fertilizante e proceder à amontoa. Caso haja duas operações de amontoa, dividir a quantidade dos fertilizantes que serão aplicados no parcelamento em ambas as amontoas. Sugere-se aplicar micronutrientes.', 'Podem-se colocar 150 kg para repor a quantidade retirada pela batata colhida.'),
(8, 'Batata-Doce', 'Convolvulaceae', 15, '2.0', 60, '20.000 kg/ha (909 caixas K)', 'Entre fileiras 0,80 m e entre plantas 0,30 m', 'Elevar a saturação por bases a 60% e o teor de magnésio do solo a um mínimo de 1,0 cmol<sub>c</sub>/dm<sup>3</sup>.', 'Em solos arenosos, aplicar 10 t/ha de esterco de curral curtido ou de composto orgânico, ou 2,5 t/ha de esterco de aves curtido ou 1,0 t/ha de torta de mamona fermentada.', 'Exigentes em magnésio', 'O fósforo deve ser aplicado todo no plantio juntamente com o adubo orgânico, o potássio e 50 % do nitrogênio. Em cobertura, aplica-se o restante do nitrogênio 30 dias após o plantio das ramas.', NULL),
(9, 'Berinjela', 'Solanaceae', 5, '3.0', 70, '25.000 a 70.000 kg/ha', '1,20 x 0,70 m', 'Elevar a saturação por bases a 70% e o teor de magnésio do solo a um mínimo de 1,0 cmol<sub>c</sub>/dm<sup3</sup>.', 'Adicionar 20 a 40 t/ha de esterco de curral curtido ou 5 a 10 t/ha de esterco de galinha, aplicados 10 a 15 dias antes do plantio, nos sulcos ou nas covas, devendo ser incorporados. As maiores doses são para\r\nsolos arenosos.', NULL, 'Aplicar todo o fósforo e parte dos fertilizantes NK (preferencial-mente nitrato e sulfato de potássio) no sulco ou covas, 10 a 15 dias antes do plantio. O restante dos fertilizantes com nitrogênio e potássio deve ser aplicado em cobertura a cada 15 dias.', NULL),
(10, 'Beterraba', 'Amaranthaceae', 5, '3.0', 65, '40.000 kg/ha (1.818 caixas K)', 'Entre fileiras 0,25 m e entre plantas 0,10 a 0,15 m', 'Elevar a saturação por bases a 70% e o teor de magnésio do solo a um mínimo de 1,0 cmol<sub>c</sub>/dm<sup3</sup>.', 'Aplicar 30 a 50 t/ha de esterco de curral curtido ou de composto orgânico, ou 8 a 10 t/ha de esterco de aves curtido, ou 3 a 5 t/ha de torta de mamona fermentada, sendo a quantidade maior para os solos arenosos.', 'Exigentes em magnésio', 'O fósforo deve ser aplicado todo no plantio juntamente com o adubo orgânico, o potássio e 60 % do nitrogênio. Em cobertura, aplica-se o restante do nitrogênio 30 dias após a germinação.', NULL),
(11, 'Brócolos', 'Brassicaceae', 5, '3.0', 70, '20.000 kg ou 2.000 dúzias ou 13.000 maços.', '1,0 x 0,5 m', 'Elevar a saturação por bases do solo a 70% ou pelo método do Al<sup>3+</sup> e do Ca<sup>2+</sup> + Mg<sup>2+</sup> com o valor de X = 3,0 e m<sub>t</sub> = 5%.', 'Aplicar 20 t/ha de esterco de curral curtido ou 5 t/ha de esterco de galinha nos sulcos de plantio.', 'Exigentes em magnésio', 'Aplicar todo o fósforo e parte dos fertilizantes que contêm NK no sulco, por ocasião do transplantio das mudas. Aplicar o restante dos fertilizantes com nitrogênio e potássio em cobertura aos 20, 40 e 60 dias do transplantio. Sugere-se aplicar micronutrientes, especialmente o boro no solo e o molibdênio via foliar.', 'Podem-se colocar 100 kg/ha para repor a quantidade retirada pelas partes colhidas.'),
(12, 'Cebola', 'Amaryllidaceae', 5, '3.0', 70, '25.000 kg/ha', '20 x 10 cm', 'Elevar a saturação por bases do solo a 70% ou pelo método do do Al<sup>3+</sup> e do Ca<sup>2+</sup> + Mg<sup>2+</sup> com o valor de X = 3,0 e m<sub>t</sub> = 5%.', 'Aplicar 40 t/ha de esterco de curral curtido em toda a área de plantio.', NULL, 'Aplicar todo o fósforo e partes do nitrogênio e do potássio no sulco e o restante destes em cobertura, aos 40 dias do transplantio. Sugere-se aplicar micronutrientes.', 'Podem-se colocar 50 kg/ha para repor a quantidade retirada pelos bulbos.'),
(13, 'Cenoura', 'Apiaceae', 5, '3.0', 65, '35.000 a 40.000 kg/ha', '15 a 20 cm x 4 a 5 cm', 'Elevar a saturação por bases para 60-70% e o teor de magnésio do solo a um mínimo de 0,8 cmol<sub>c</sub>/dm<sup>3</sup>.', 'Aplicar 30 a 40 t/ha de esterco de curral curtido ou 10 a 13 t/ha de esterco de galinha curtido, sendo a quantidade maior para solos arenosos.', 'Exigentes em magnésio.', '<b>Plantio</b> - Todo o fósforo recomendado, 30% do nitrogênio e 40 % do potássio devem ser aplicados no canteiro junto com o adubo orgânico e incorporados até 15 cm de profundidade, 5 a 10 dias antes do semeio. Se o terreno for deficiente em boro e, ou, em zinco, aplicar 1 a 2 kg/ha de B e, ou, 2 a 3 kg/ha de Zn.<br>\n<b>Adubação de cobertura</b> - O restante do nitrogênio e do potássio (70% e 60% respectivamente) deve ser aplicado em 2 coberturas, aos 20 e aos 40 dias da emergência.', NULL),
(14, 'Feijão-Vagem', 'Fabaceae', 5, '3.0', 70, '13.000 a 15.000 kg/ha', '1,0 x 0,5 m', 'Aplicar calcário para elevar a saturação por bases a 70% e atingir, no mínimo, 1 cmol<sub>c</sub>/dm<sup>3</sup> de magnésio ou pelo método do Al<sup>3+</sup> e do Ca<sup>2+</sup> + Mg<sup>2+</sup> com o valor de X = 3,0 e m<sub>t</sub> = 5%.', 'Aplicar calcário para elevar a saturação por bases a 70 % e atingir, no mínimo, 1 cmolc/dm3 de magnésio ou pelo método do Al3+ e do Ca2+ + Mg2+ com o valor de X = 3,0 e mt = 5 %.', 'Exigentes em magnésio.', '<b>Plantio</b> - Aplicar 30% do nitrogênio, 50% do potássio e todo fósforo no plantio.<br><b> Cobertura</b> - Parcelar em duas aplicações o restante do nitrogênio (70%) e do potássio (50 %), aos 30 e aos 60 dias da emergência das plântulas. Fazer uma aplicação foliar de molibdato de amônio (0,4 g/L) antes da floração.', NULL),
(15, 'Inhame', 'Dioscoreaceae', 10, '2.5', 60, '30.000 kg/ha (1.500 sacos ou 1.363 caixas).', 'Entre fileiras, 0,80 a 0,60 m e entre plantas, 0,50 a 0,40 m.', 'Elevar a saturação por bases a 60% e o teor de magnésio do solo a um mínimo de 1,0 cmol<sub>c</sub>/dm<sup>3</sup>.', 'Em solos arenosos, aplicar 10 t/ha de esterco de\r\ncurral curtido ou de composto orgânico, ou 2,5 t/ha de esterco de aves curtido\r\nou 2,0 t/ha de torta de mamona fermentada.', 'Exigentes em magnésio.', 'O fósforo deve ser aplicado todo no plantio, juntamente com o adubo\r\norgânico, o potássio e 50 % do nitrogênio. Em cobertura, aplica-se o restante do\r\nnitrogênio, 30 dias após a brotação dos rizomas.', NULL),
(16, 'Jiló', 'Solanaceae', 5, '3.0', 70, '20.000 a 50.000 kg/ha', '1,20 x 0,70 m', 'Elevar a saturação por bases a 70% com calcário dolomítico ou pelo método do Al<sup>3+</sup> e do Ca<sup>2+</sup> + Mg<sup>2+</sup> com Y variável em função da capacidade tampão da acidez do solo e X = 3,0 e m<sub>t</sub> = 5%.', 'Aplicar 20 a 40 t/ha de esterco de curral curtido ou 5 a 10 t/ha de esterco de galinha curtido, 10 a 15 dias antes do plantio, nos sulcos ou nas covas, devendo ser incorporados. As maiores quantidades são para solos arenosos.', NULL, 'Aplicar todo o fósforo e parte dos fertilizantes que contêm NK\r\n(preferencialmente nitrato e sulfato de potássio) no sulco ou covas, 10 a 15 dias\r\nantes do plantio. O restante dos fertilizantes com nitrogênio e potássio deve ser\r\naplicado em cobertura a cada 15 dias.', NULL),
(17, 'Mandioquinha-Salsa', 'Apiaceae', 5, '3.0', 65, '12.000 kg/ha (545 caixas K).', 'Entre fileiras, 0,80 a 0,60 m, e entre plantas, 0,50 a 0,40 m.', 'Elevar a saturação por bases a 60% e o teor de magnésio do solo a um mínimo de 1,0 cmol<sub>c</sub>/dm<sup>3</sup>.', 'Em solos arenosos, aplicar 5 t/ha de composto\r\norgânico ou de esterco de curral curtido.', 'Exigentes em magnésio', 'O fósforo deve ser aplicado todo no plantio juntamente com o potássio.', NULL),
(18, 'Melancia', 'Cucurbitaceae', 5, '3.0', 70, '30.000 kg/ha', '2,0 a 2,5 x 2,0 m', 'Aplicar calcário para elevar a saturação por bases a 65 - 70% e o teor de magnésio para, no mínimo, 1,0 cmol<sub>c</sub>/dm<sup>3</sup>.', 'Adicionar 10 t/ha de esterco de curral ou 3 t/ha de esterco de galinha, aplicados na cova 20 dias antes do semeio ou transplantio.', 'Exigentes em magnésio.', '<b>Plantio</b> - Colocar junto com o adubo orgânico, 30% do nitrogênio, 40% do potássio e todo o fósforo recomendado.<br><b>Cobertura</b> - Aplicar o restante do nitrogênio e do potássio (70% e 60%, respectivamente), parcelado em três vezes, sendo a primeira 15 dias após o transplantio ou 20 dias após a germinação, e as demais espaçadas de 20 dias uma da outra.', 'Somente em cobertura.'),
(19, 'Melão', 'Cucurbitaceae', 5, '3.5', 80, '25.000 a 35.000 kg/ha.', '2,00 x 0,5 m', 'Elevar a saturação por bases a 80% com calcário dolomítico ou magnesiano, se inferior a 70%.', 'Adicionar 20 a 40 t/ha de esterco de curral curtido ou 5 a 10 t/ha de esterco de galinha, 30 dias antes do plantio. Aplicar na superfície do solo e incorporar até 20 cm de profundidade. As maiores quantidades são para solos arenosos, preferencialmente do esterco de curral.', 'Exigentes em magnésio.', 'Aplicar todo o fósforo e parte dos fertilizantes que contêm NK nos sulcos ou covas, 15 dias antes do plantio. O restante dos fertilizantes com nitrogênio e potássio deve ser aplicado em cobertura a cada 10 dias. Caso a cultura seja fertirrigada, as quantidades de N e K devem ser distribuídas diariamente.<br><br>É recomendável aplicar a solução 5 g/L de cloreto de cálcio e 1,5 g/L de ácido bórico ou soluções quelatizadas em pulverizações foliares a partir do início do aparecimento dos frutos e a intervalos de 10 dias. Podem ser aplicados juntos com os defensivos.', NULL),
(21, 'Moranga Híbrida', 'Curcubitaceae', 5, '3.0', 70, '1.200 kg/ha (480 sacos)', 'Entre fileiras 2,0 m, entre covas 2,0 m', 'Elevar a saturação por bases a 70% e o teor de magnésio do solo a um mínimo de 1,0 cmol<sub>c</sub>/dm<sup>3</sup>.', 'Aplicar 5 t/ha de esterco de curral curtido ou de composto orgânico, ou 1,5 t/ha de esterco de aves curtido, ou 0,5 t/ha de torta de mamona fermentada.', 'Exigentes em magnésio.', 'O fósforo deve ser aplicado todo, 20 dias antes do plantio, juntamente com o adubo orgânico, o potássio e 1/3 do nitrogênio. Em cobertura, aplica-se o restante do nitrogênio 20 dias após a germinação.', NULL),
(22, 'Morango', 'Rosaceae', 5, '3.0', 70, '50.000 a 80.000 kg/ha', '0,25 x 0,25 m (indústria) e 0,30 x 0,30 m (mesa).', 'Aplicar calcário quando a saturação por bases for inferior a 70%, devendo elevá-la a 80% com calcário dolomítico ou magnesiano, buscando elevar o teor de Mg no solo ao mínimo de 1 cmol<sub>c</sub>/dm<sup>3</sup>.', 'Aplicar 20 a 40 t/ha de esterco de curral curtido ou 5 a 10 t/ha de esterco de galinha, 30 dias antes do plantio. Aplicar na superfície do canteiro e incorporar até 20 cm de profundidade, As maiores quantidades são para solos arenosos, preferencialmente do esterco de curral.', 'Exigentes em magnésio', 'Aplicar todo o fósforo e parte dos fertilizantes que contêm NK 15 dias antes do plantio, misturando nos 10 cm superiores do solo. O restante dos fertilizantes com nitrogênio e potássio deve ser aplicado a cada mês. Pelo menos a metade do potássio deve ser fornecida como sulfato de potássio.<br><br> É recomendável fazer quatro aplicações foliares de solução de uréia a 5 g/L por semana, a partir do plantio. Caso haja produção de frutos deformados recomendam-se três aplicações de solução de ácido bórico a 1,5 g/L, a cada semana, durante o florescimento.', NULL),
(23, 'Pepino', 'Cucurbitaceae', 5, '3.0', 70, '30.000 a 35.000 kg/ha.', '1,0 x 0,4 a 0,6 m', 'Aplicar calcário para elevar a saturação por bases a 75% e o teor de magnésio a 1 cmol<sub>c<sub>/dm<sup>3</sup>.', 'Aplicar 25 t/ha esterco de curral ou 8 t/ha de esterco de\r\naves ou 2,5 t/ha de torta de mamona fermentada, 20 a 30 dias antes do semeio\r\nou transplantio das mudas.', 'Exigentes em magnésio.', '<b>Plantio</b> - Aplicar junto com o adubo orgânico 30 % do nitrogênio, 40 % do potássio e todo o fósforo recomendados. Em solos deficientes, acrescentar 1 kg/ha de B e 3 kg/ha de Zn.<br><b>Cobertura</b> - Aplicar o restante do nitrogênio e potássio (70% e 60% respectivamente), parcelado em três vezes, sendo a primeira 15 dias após o transplantio ou 20 dias após a germinação, e as demais parcelas espaçadas de 20 dias uma da outra.', 'Somente em cobertura.'),
(24, 'Pimentão', 'Solanaceae', 5, '3.0', 70, '30.000 kg/ha (3.000 caixas K).', 'Entre fileiras 1,2 m a 1,0 m, entre plantas 0,60 a 0,40 m', 'Elevar a saturação por bases a 70% e o teor de magnésio do solo a um mínimo de 1,0 cmol<sub>c</sub>/dm<sup>3</sup>.', 'Aplicar 30 dias antes do plantio, 25 t/ha de esterco de curral curtido ou de composto orgânico, ou 5 t/ha de esterco de aves curtido, ou 2,5 t/ha de torta de mamona fermentada.', NULL, 'Aplicar parte dos fertilizantes que contêm NPK no sulco, por ocasião do transplantio das mudas. Aplicar o restante dos fertilizantes com nitrogênio e potássio em coberturas, a cada 15 dias após o transplantio. Sugere-se aplicar micronutrientes', 'Podem-se colocar 80 kg/ha para repor a quantidade retirada pelos frutos.'),
(25, 'Quiabo', 'Malvaceae', 5, '3.0', 70, '15.000 a 20.000 kg/ha', '1,0 x 0,20 a 0,30 m', 'Aplicar calcário para elevar o índice de saturação por bases para 70%.', 'Aplicar 50 t/ha de esterco de curral curtido nos sulcos\r\nde plantio.', 'Exigentes em magnésio.', '<b>Plantio</b> - Aplicar no plantio 20% do nitrogênio, 40% do potássio e todo o fósforo recomendados.<br><b>Cobertura</b> - O restante do nitrogênio (80%) e do potássio (60%) deve ser parcelado em três vezes, aos 20, 40 e 60 dias da emergência das plântulas.', 'Somente em cobertura.'),
(26, 'Repolho', 'Brassicaceae', 5, '3.0', 70, '50.000 kg/ha ou 2.000 sc/ha.', '0,8 x 0,3 m', 'Aplicar calcário para elevar a saturação por bases do solo a 70 % ou pelo método do Al<sup>3+</sup> e do Ca<sup>2+</sup> + Mg<sup>2+</sup> com o valor de X = 3,0 e m<sub>t</sub> = 5%.', 'Adicionar 30 t/ha de esterco de curral curtido ou 8 t/ha de esterco de galinha nos sulcos de plantio.', 'Exigentes em magnésio.', 'Aplicar todo o fósforo e parte dos fertilizantes que contêm NK no sulco, por ocasião do transplantio das mudas. Aplicar o restante dos fertilizantes com nitrogênio e potássio em coberturas aos 20, 40 e 60 dias do transplantio.<br><br>Sugere-se aplicar micronutrientes, especialmente o boro no solo e o molibdênio via foliar.', 'Podem-se colocar 100 kg/ha para repor a quantidade retirada pelas cabeças.'),
(27, 'Tomate rasteiro', 'Solanaceae', 5, '3.0', 70, '70 t/ha de frutos com boas características\r\nagroindustriais.', 'Há duas opções para espaçamento: em fileira simples, 1,3 x 0,2 m; em linhas duplas, 1,3 x 0,5 x 0,2 ', 'Aplicar calcário para elevar a saturação por bases do solo a 70 - 80%, pH entre 6,0 e 6,5.', '', 'Utilizar relação Ca/Mg = 1.', 'A primeira aplicação de fertilizantes em cobertura é efetuada após o desbaste das plantas, com leve incorporação promovida por capina mecânica ou amontoa.<br><br>Sugere-se aplicar 2 a 3 kg/ha de B e 4 kg/ha de Zn no sulco, em solos de baixa fertilidade.', NULL),
(28, 'Tomate Tutorado', 'Solanaceae', 5, '3.0', 70, '100 t/ha de frutos de boa aceitação comercial.', '100 x 70 cm, transplantando-se 2 plantas, por vez, deixandose cada uma com a haste principal.', 'Elevar a saturação por bases do solo a 70-80%, pH entre 6,0 e 6,5.', 'É recomendável.', 'Utilizar relação Ca/Mg = 1.', 'Aplicar 2 a 3 kg/ha de B e 4 kg/ha de Zn no sulco, em solo de baixa fertilidade.<br><br>Caso ocorra “podridão apical”, devem-se pulverizar os frutos em formação com solução 6 g/L de cloreto de cálcio comercial, semanalmente, enquanto persistir a ocorrência nos frutos novos.<br><br>A deficiência de magnésio (“amarelo baixeiro”) pode ser corrigida com pulverizações nas folhas de solução 1,5 g/L de sulfato de magnésio, duas a três vezes. A adição de uréia (5 g/L) favorece a absorção foliar do magnésio.<br><br>O termofosfato magnesiano aplicado ao sulco de plantio pode substituir parte do adubo fosfatado mais solúvel e fornece quantidades apreciáveis de magnésio, cálcio, silício e micronutrientes.', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `parcelamentoAdubNPK`
--

CREATE TABLE `parcelamentoAdubNPK` (
  `id` int(11) NOT NULL,
  `nutriente` char(1) NOT NULL,
  `ciclo` tinyint(1) NOT NULL,
  `porcentagem` tinyint(3) NOT NULL,
  `idCultura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `parcelamentoAdubNPK`
--

INSERT INTO `parcelamentoAdubNPK` (`id`, `nutriente`, `ciclo`, `porcentagem`, `idCultura`) VALUES
(1, 'N', 0, 20, 1),
(2, 'N', 1, 20, 1),
(3, 'N', 2, 30, 1),
(4, 'N', 3, 30, 1),
(5, 'P', 0, 100, 1),
(6, 'K', 0, 20, 1),
(7, 'K', 1, 20, 1),
(8, 'K', 2, 30, 1),
(9, 'K', 3, 30, 1),
(10, 'N', 0, 10, 28),
(11, 'N', 1, 10, 28),
(12, 'N', 2, 10, 28),
(13, 'N', 3, 20, 28),
(14, 'N', 4, 20, 28),
(15, 'N', 5, 15, 28),
(16, 'N', 6, 15, 28),
(17, 'P', 0, 70, 28),
(18, 'P', 1, 30, 28),
(19, 'K', 0, 10, 28),
(20, 'K', 1, 15, 28),
(21, 'K', 2, 15, 28),
(22, 'K', 3, 20, 28),
(23, 'K', 4, 20, 28),
(24, 'K', 5, 15, 28),
(25, 'K', 6, 5, 28),
(26, 'N', 0, 20, 27),
(27, 'N', 1, 40, 27),
(28, 'N', 2, 40, 27),
(29, 'P', 0, 70, 27),
(30, 'P', 1, 30, 27),
(31, 'K', 0, 50, 27),
(32, 'K', 1, 30, 27),
(33, 'K', 2, 20, 27),
(34, 'N', 0, 20, 26),
(35, 'N', 1, 20, 26),
(36, 'N', 2, 30, 26),
(37, 'N', 3, 30, 26),
(38, 'P', 0, 100, 26),
(39, 'K', 0, 20, 26),
(40, 'K', 1, 20, 26),
(41, 'K', 2, 30, 26),
(42, 'K', 3, 30, 26),
(43, 'N', 0, 20, 24),
(44, 'N', 1, 10, 24),
(45, 'N', 2, 10, 24),
(46, 'N', 3, 15, 24),
(47, 'N', 4, 15, 24),
(48, 'N', 5, 20, 24),
(49, 'N', 6, 10, 24),
(50, 'P', 0, 100, 24),
(51, 'K', 0, 20, 24),
(52, 'K', 1, 10, 24),
(53, 'K', 2, 10, 24),
(54, 'K', 3, 10, 24),
(55, 'K', 4, 15, 24),
(56, 'K', 5, 20, 24),
(57, 'K', 6, 15, 24),
(58, 'N', 0, 14, 22),
(59, 'N', 1, 14, 22),
(60, 'N', 2, 14, 22),
(61, 'N', 3, 14, 22),
(62, 'N', 4, 14, 22),
(63, 'N', 5, 14, 22),
(64, 'N', 6, 14, 22),
(65, 'P', 0, 100, 22),
(66, 'K', 0, 70, 22),
(67, 'K', 1, 5, 22),
(68, 'K', 2, 5, 22),
(69, 'K', 3, 5, 22),
(70, 'K', 4, 5, 22),
(71, 'K', 5, 5, 22),
(72, 'K', 6, 5, 22),
(73, 'N', 0, 20, 19),
(74, 'N', 1, 15, 19),
(75, 'N', 2, 15, 19),
(76, 'N', 3, 20, 19),
(77, 'N', 4, 20, 19),
(78, 'N', 5, 10, 19),
(79, 'P', 0, 100, 19),
(80, 'K', 0, 10, 19),
(81, 'K', 1, 10, 19),
(82, 'K', 2, 10, 19),
(83, 'K', 3, 10, 19),
(84, 'K', 4, 15, 19),
(85, 'K', 5, 15, 19),
(86, 'K', 6, 30, 19),
(87, 'N', 0, 40, 16),
(88, 'N', 1, 10, 16),
(89, 'N', 2, 10, 16),
(90, 'N', 3, 10, 16),
(91, 'N', 4, 10, 16),
(92, 'N', 5, 10, 16),
(93, 'N', 6, 10, 16),
(94, 'P', 0, 100, 16),
(95, 'K', 0, 40, 16),
(96, 'K', 1, 10, 16),
(97, 'K', 2, 10, 16),
(98, 'K', 3, 10, 16),
(99, 'K', 4, 10, 16),
(100, 'K', 5, 10, 16),
(101, 'K', 6, 10, 16),
(102, 'N', 0, 30, 12),
(103, 'N', 1, 70, 12),
(104, 'P', 0, 100, 12),
(105, 'K', 0, 30, 12),
(106, 'K', 1, 70, 12),
(107, 'N', 0, 20, 11),
(108, 'N', 1, 20, 11),
(109, 'N', 2, 30, 11),
(110, 'N', 3, 30, 11),
(111, 'P', 0, 100, 11),
(112, 'K', 0, 20, 11),
(113, 'K', 1, 20, 11),
(114, 'K', 2, 30, 11),
(115, 'K', 3, 30, 11),
(116, 'N', 0, 40, 9),
(117, 'N', 1, 10, 9),
(118, 'N', 2, 10, 9),
(119, 'N', 3, 10, 9),
(120, 'N', 4, 10, 9),
(121, 'N', 5, 10, 9),
(122, 'N', 6, 10, 9),
(123, 'P', 0, 100, 9),
(124, 'K', 0, 40, 9),
(125, 'K', 1, 10, 9),
(126, 'K', 2, 10, 9),
(127, 'K', 3, 10, 9),
(128, 'K', 4, 10, 9),
(129, 'K', 5, 10, 9),
(130, 'K', 6, 10, 9),
(131, 'N', 0, 20, 7),
(132, 'N', 1, 80, 7),
(133, 'P', 0, 80, 7),
(134, 'P', 1, 20, 7),
(135, 'K', 0, 20, 7),
(136, 'K', 1, 80, 7),
(137, 'N', 0, 30, 6),
(138, 'N', 1, 35, 6),
(139, 'N', 2, 35, 6),
(140, 'P', 0, 100, 6),
(141, 'K', 0, 30, 6),
(142, 'K', 1, 35, 6),
(143, 'K', 2, 35, 6),
(144, 'N', 0, 20, 5),
(145, 'N', 1, 20, 5),
(146, 'N', 2, 30, 5),
(147, 'N', 3, 30, 5),
(148, 'P', 0, 100, 5),
(149, 'K', 0, 20, 5),
(150, 'K', 1, 20, 5),
(151, 'K', 2, 30, 5),
(152, 'K', 3, 30, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `producao`
--

CREATE TABLE `producao` (
  `id` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idCultura` int(11) NOT NULL,
  `data` date NOT NULL,
  `areaPlantada` float NOT NULL,
  `unidadeArea` enum('m²','ha') NOT NULL,
  `producao` float NOT NULL,
  `unidade` enum('kg','dz','un','saco') NOT NULL,
  `precoVenda` decimal(5,2) NOT NULL,
  `qtdVendida` float NOT NULL,
  `qtdAduboOrganico` float NOT NULL,
  `precoAduboOrganico` decimal(5,2) NOT NULL,
  `gastosNPK` decimal(5,2) NOT NULL,
  `qtdCalcario` float NOT NULL,
  `precoCalcario` decimal(5,2) NOT NULL,
  `idProdutor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `producao`
--

INSERT INTO `producao` (`id`, `idUsuario`, `idCultura`, `data`, `areaPlantada`, `unidadeArea`, `producao`, `unidade`, `precoVenda`, `qtdVendida`, `qtdAduboOrganico`, `precoAduboOrganico`, `gastosNPK`, `qtdCalcario`, `precoCalcario`, `idProdutor`) VALUES
(13, 50, 12, '2017-03-27', 30, 'm²', 45, 'kg', '3.90', 40, 30, '0.00', '56.00', 30, '15.00', 21);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtor`
--

CREATE TABLE `produtor` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `fazenda` varchar(45) NOT NULL,
  `logradouro` varchar(45) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `area` enum('Urbana','Rural') NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `telefone` varchar(10) DEFAULT NULL,
  `celular` varchar(11) DEFAULT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `produtor`
--

INSERT INTO `produtor` (`id`, `nome`, `fazenda`, `logradouro`, `bairro`, `area`, `cidade`, `telefone`, `celular`, `idUsuario`) VALUES
(21, 'Rochele Edenís Miranda', 'Céu Azul', 'Avenida Primeiro de Junho', 'Centro', 'Urbana', 'São João Evangelista', '3334122923', '33987027496', 50);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `email` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `senha`, `email`) VALUES
(50, 'Rochele Edenís', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'rochele.edenis@gmail.com');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `adubacaoMineral`
--
ALTER TABLE `adubacaoMineral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_adubacaoMineral_cultura_idx` (`idCultura`);

--
-- Índices de tabela `analise`
--
ALTER TABLE `analise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_analise_usuario_idx` (`idUsuario`),
  ADD KEY `fk_analise_produtor_idx` (`idProdutor`);

--
-- Índices de tabela `cultura`
--
ALTER TABLE `cultura`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `parcelamentoAdubNPK`
--
ALTER TABLE `parcelamentoAdubNPK`
  ADD PRIMARY KEY (`id`,`idCultura`),
  ADD KEY `fk_parcelamentoAdubNPK_cultura1_idx` (`idCultura`);

--
-- Índices de tabela `producao`
--
ALTER TABLE `producao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_producao_usuario_idx` (`idProdutor`),
  ADD KEY `fk_producao_cultura_idx` (`idCultura`),
  ADD KEY `fk_producao_usuario_idx1` (`idUsuario`);

--
-- Índices de tabela `produtor`
--
ALTER TABLE `produtor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_produtor_usuario1_idx` (`idUsuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `adubacaoMineral`
--
ALTER TABLE `adubacaoMineral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT de tabela `analise`
--
ALTER TABLE `analise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de tabela `cultura`
--
ALTER TABLE `cultura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de tabela `parcelamentoAdubNPK`
--
ALTER TABLE `parcelamentoAdubNPK`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT de tabela `producao`
--
ALTER TABLE `producao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT de tabela `produtor`
--
ALTER TABLE `produtor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `adubacaoMineral`
--
ALTER TABLE `adubacaoMineral`
  ADD CONSTRAINT `fk_adubacaoMineral_cultura` FOREIGN KEY (`idCultura`) REFERENCES `cultura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `analise`
--
ALTER TABLE `analise`
  ADD CONSTRAINT `fk_analise_produtor` FOREIGN KEY (`idProdutor`) REFERENCES `produtor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_analise_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `parcelamentoAdubNPK`
--
ALTER TABLE `parcelamentoAdubNPK`
  ADD CONSTRAINT `fk_parcelamentoAdubNPK_cultura1` FOREIGN KEY (`idCultura`) REFERENCES `cultura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `producao`
--
ALTER TABLE `producao`
  ADD CONSTRAINT `fk_producao_cultura` FOREIGN KEY (`idCultura`) REFERENCES `cultura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producao_produtor` FOREIGN KEY (`idProdutor`) REFERENCES `produtor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_producao_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `produtor`
--
ALTER TABLE `produtor`
  ADD CONSTRAINT `fk_produtor_usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
