--
-- Wie sich Beziehungen in Tabellen auswirken bei SELECT
--

-- JOIN über 2 Tabellen: 1:N Beziehung
SELECT `post`.*, `user`.`email` 
FROM `post`
JOIN `user` ON `post`.`user_ID`= `user`.`ID`

-- JOIN über 3 Tabellen: N:M Beziehung
SELECT * 
FROM `post` 
JOIN `post_tag` ON `post`.`ID`=`post_tag`.`post_ID` 
JOIN `tag` ON `post_tag`.`tag_ID`=`tag`.`ID`;

-- JOIN für einen Filter
SELECT *
FROM `post`
JOIN `post_tag` ON `post`.`ID`=`post_tag`.`post_ID`
JOIN `tag` ON `post_tag`.`tag_ID`=`tag`.`ID`
WHERE `tag`.`name` = 'PHP'

-- JOIN für eine Suche
SELECT *
FROM `post`
JOIN `post_tag` ON `post`.`ID`=`post_tag`.`post_ID`
JOIN `tag` ON `post_tag`.`tag_ID`=`tag`.`ID`
WHERE `post`.`title`  LIKE '%PHP%' 
OR `post`.`content` LIKE '%PHP%'
OR `tag`.`name` LIKE '%PHP%'