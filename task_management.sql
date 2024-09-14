-- Estructura de la tabla `task`
CREATE TABLE `task` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `description` VARCHAR(255),
    `status` ENUM('pending', 'in-progress', 'completed') NOT NULL DEFAULT 'pending',
    PRIMARY KEY (`id`)
);

-- Datos de prueba para la tabla `task`
INSERT INTO `task` (`name`, `description`, `status`) VALUES
('Task 1', 'This is the first task', 'pending'),
('Task 2', 'This task is currently in progress', 'in-progress'),
('Task 3', 'This task has been completed', 'completed'),
('Task 4', 'Another pending task', 'pending');
