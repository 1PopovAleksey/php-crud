# PHP CRUD

This is a simple CRUD in PHP, where you can create a user, read, update and delete.

## How to start?

### SQL:

```
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
   primary key (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
```

```
INSERT INTO `users` (`name`, `email`, `password`) VALUES
('Aleksey', 'aleksey@gmail.com', '978612345'),
('Egor', 'egor@gmail.com', '978612345'),
('Lisa', 'lisa@gmail.com', '978612345');
```

### Use XAMPP or OpenServer
