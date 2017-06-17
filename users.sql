-- Database: `logsys`
-- --------------------------------------------------------

-- Table structure for table `users`
CREATE TABLE `users` (
  `id` INT NOT NULL,
  `name` VARCHAR(255) NOT NULL,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `bio` VARCHAR(255) DEFAULT NULL,
  `passwd` VARCHAR(255) NOT NULL,
  `privileges` ENUM('1' , '2') NOT NULL DEFAULT 2,
  `ban` BOOLEAN NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `username`, `email`, `bio`, `passwd`, `privileges`, `ban`) VALUES
(1, 'Administrator', 'admin', 'admin@localhost.localdomain', 'Admin is The BOSS!', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 0),
(2, 'Demo User', 'demo', 'demo@localhost.localdomain', 'This is Demo User!', '89e495e7941cf9e40e6980d14a16bf023ccd4c91', 2, 0);

-- Indexes for table `users`
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);
  
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;