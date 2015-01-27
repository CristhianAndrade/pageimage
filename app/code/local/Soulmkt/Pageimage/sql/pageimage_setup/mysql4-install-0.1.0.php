<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Estrutura da tabela `pageimage`
--

CREATE TABLE IF NOT EXISTS `pageimage` (
`id_pageimage` int(11) NOT NULL,
  `id_page` varchar(100) NOT NULL,
  `enable` char(1) NOT NULL,
  `image` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `datecreate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pageimage`
--
ALTER TABLE `pageimage`
 ADD PRIMARY KEY (`id_pageimage`), ADD UNIQUE KEY `id_page` (`id_page`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pageimage`
--
ALTER TABLE `pageimage`
MODIFY `id_pageimage` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
SQLTEXT;

$installer->run($sql);

$installer->endSetup();
	 