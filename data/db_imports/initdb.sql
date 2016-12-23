/* Initialize an empty database with required values */

delimiter $
DROP PROCEDURE IF EXISTS initdb$
CREATE PROCEDURE initdb()
BEGIN

    IF NOT EXISTS(
        SELECT * FROM `applications` WHERE `name` = 'Pulsee'
    ) THEN
        INSERT INTO `applications` (`id`, `name`, `app_secret`) VALUES
        (1, 'Pulsee', '50b9d04e28e1380bf522a7430b7a9b5c08a8cc16');
    END IF;

    IF NOT EXISTS(
        SELECT COUNT(*) FROM `role`
    ) THEN
       INSERT INTO `role` (`id`, `parent_id`, `role_id`) VALUES
        (1, NULL, 'user'),
        (2, 1, 'owner'),
        (3, 2, 'admin');
    END IF;

    IF NOT EXISTS(
        SELECT COUNT(*) FROM `user`
    ) THEN
       INSERT INTO `user` (`id`, `username`, `email`, `displayName`, `first_name`, `last_name`) VALUES
        (1, 'root', 'root@root.com', '$2y$14$YmLmCWtgnKpV/qlyROdVueeJKMwn6Rn99Rx9gucRv5Uv8s4TE1RWe', 'root', 'root');
        INSERT INTO `user_role_linker` (`user_id`, `role_id`) VALUES
        (1, 3);
    END IF;

END$

CALL initdb()$
delimiter ;

DROP PROCEDURE IF EXISTS initdb;
