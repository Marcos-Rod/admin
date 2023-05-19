
CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `configuracion` (
  `id` int(1) NOT NULL,
  `proyecto` varchar(100) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `public_key` varchar(255) DEFAULT NULL,
  `secret_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
 

INSERT INTO `configuracion` (`id`, `proyecto`, `url`, `keywords`, `descripcion`, `public_key`, `secret_key`) VALUES
(1, 'Proyecto', 'http://localhost', 'Keywords', 'Una descripcion', '', '');

 
CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `mail` varchar(200) NOT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `create_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

 
CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL,
  `imageable_id` bigint(20) NOT NULL,
  `imageable_type` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

 
CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `description` varchar(500) NOT NULL,
  `body` text DEFAULT NULL,
  `keywords` varchar(250) DEFAULT NULL,
  `status` enum('1','2') NOT NULL DEFAULT '1',
  `category_id` int(11) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
 
INSERT INTO `users` (`id`, `name`, `email`, `password`, `create_at`, `update_at`) VALUES
(1, 'Marcos', 'admin@mail.mx', '$2y$10$fIvtdVEKxPrspxVuPzZJoOsoIybSlbha1z8hc3KV8nmik/DgxChDi', '2023-03-30 23:21:32', '2023-03-30 23:21:32');

 
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

 
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);
 
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);
 
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

 
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);
 
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
 
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

 
ALTER TABLE `configuracion`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;
 
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

 
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
 
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
 
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
 
ALTER TABLE `posts`
  ADD CONSTRAINT `category_post` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

