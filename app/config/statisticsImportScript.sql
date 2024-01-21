INSERT INTO users (name, email, password, role) VALUES ('Иван Иванов', 'ivan.ivanov@example.com', '$2y$10$mXa88xx6PCmDHd.B1Gs71OuV2w8W8Om71QliJRRuhywmSubnYOLGe', '');
INSERT INTO users (name, email, password, role) VALUES ('Мария Петрова', 'maria.petrova@example.com', '$2y$10$dLdmztKkcSdpbh4AvECMiuBRpjWyHn09aDchzsNKoBF7MXiYbUEbC', '');
INSERT INTO users (name, email, password, role) VALUES ('Георги Георгиев', 'georgi.georgiev@example.com', '$2y$10$mXa88xx6PCmDHd.B1Gs71OuV2w8W8Om71QliJRRuhywmSubnYOLGe', '');
INSERT INTO users (name, email, password, role) VALUES ('Елена Иванова', 'elena.ivanova@example.com', '$2y$10$dLdmztKkcSdpbh4AvECMiuBRpjWyHn09aDchzsNKoBF7MXiYbUEbC', '');
INSERT INTO users (name, email, password, role) VALUES ('Николай Николов', 'nikolay.nikolov@example.com', '$2y$10$mXa88xx6PCmDHd.B1Gs71OuV2w8W8Om71QliJRRuhywmSubnYOLGe', '');
INSERT INTO users (name, email, password, role) VALUES ('Стефани Георгиева', 'stefani.georgieva@example.com', '$2y$10$dLdmztKkcSdpbh4AvECMiuBRpjWyHn09aDchzsNKoBF7MXiYbUEbC', '');
INSERT INTO users (name, email, password, role) VALUES ('Петър Иванов', 'petar.ivanov@example.com', '$2y$10$mXa88xx6PCmDHd.B1Gs71OuV2w8W8Om71QliJRRuhywmSubnYOLGe', '');
INSERT INTO users (name, email, password, role) VALUES ('Анна Маркова', 'anna.markova@example.com', '$2y$10$dLdmztKkcSdpbh4AvECMiuBRpjWyHn09aDchzsNKoBF7MXiYbUEbC', '');
INSERT INTO users (name, email, password, role) VALUES ('Владимир Владимиров', 'vladimir.vladimirov@example.com', '$2y$10$mXa88xx6PCmDHd.B1Gs71OuV2w8W8Om71QliJRRuhywmSubnYOLGe', '');
INSERT INTO users (name, email, password, role) VALUES ('Маргарита Георгиева', 'margarita.georgieva@example.com', '$2y$10$dLdmztKkcSdpbh4AvECMiuBRpjWyHn09aDchzsNKoBF7MXiYbUEbC', '');

-- User: Ivan_Ivanov
INSERT INTO users_disciplines (userId, disciplineId) VALUES (3, 1);
INSERT INTO users_disciplines (userId, disciplineId) VALUES (3, 2);
INSERT INTO users_disciplines (userId, disciplineId) VALUES (3, 3);

-- User: Maria_Petrova
INSERT INTO users_disciplines (userId, disciplineId) VALUES (4, 1);
INSERT INTO users_disciplines (userId, disciplineId) VALUES (4, 2);
INSERT INTO users_disciplines (userId, disciplineId) VALUES (4, 3);

-- User: Georgi_Georgiev
INSERT INTO users_disciplines (userId, disciplineId) VALUES (5, 1);
INSERT INTO users_disciplines (userId, disciplineId) VALUES (5, 2);

-- User: Elena_Ivanova
INSERT INTO users_disciplines (userId, disciplineId) VALUES (6, 1);

-- User: Nikolay_Nikolov
INSERT INTO users_disciplines (userId, disciplineId) VALUES (7, 2);
INSERT INTO users_disciplines (userId, disciplineId) VALUES (7, 3);

-- User: Stefani_Georgieva
INSERT INTO users_disciplines (userId, disciplineId) VALUES (8, 2);
INSERT INTO users_disciplines (userId, disciplineId) VALUES (8, 3);

-- User: Petar_Ivanov
INSERT INTO users_disciplines (userId, disciplineId) VALUES (9, 1);

-- User: Anna_Markova
INSERT INTO users_disciplines (userId, disciplineId) VALUES (10, 2);

-- User: Vladimir_Vladimirov
INSERT INTO users_disciplines (userId, disciplineId) VALUES (11, 1);
INSERT INTO users_disciplines (userId, disciplineId) VALUES (11, 2);

-- User: Margarita_Georgieva
INSERT INTO users_disciplines (userId, disciplineId) VALUES (12, 2);
INSERT INTO users_disciplines (userId, disciplineId) VALUES (12, 3);
