CREATE TABLE TERMINAL_KUYRUK(
	`id` bigint AUTO_INCREMENT NOT NULL,
	`TerminalID` int NULL,
	`BirimNo` int NULL,
	`tarih` datetime(3) NULL,
 CONSTRAINT `PK_TERMINAL_KUYRUK` PRIMARY KEY 
(
	`id` ASC
) 
);
ALTER DATABASE `TERMINAL_KUYRUK` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;