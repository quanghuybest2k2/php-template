DROP DATABASE IF EXISTS `example`;

-- Create a new database with utf8mb4 character set and utf8mb4_unicode_ci collation
CREATE DATABASE `example` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Switch to the newly created database
USE `example`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Đoàn Quang Huy', 'abc@gmail.com', '$2y$10$ujuFAafQjV76BGbhfzvLV.4gkTGj7TYMRVRJpBePaguTi7EFoFLq2', '2025-05-14 09:54:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
