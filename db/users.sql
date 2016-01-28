CREATE TABLE IF NOT EXISTS `users` (
	`id` int(11) NOT NULL,
	`first_name` varchar(50) COLLATE utf8_unicode_ci NULL,
	`last_name` varchar(50) COLLATE utf8_unicode_ci NULL,
	`username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
	`email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
	`password` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
	`salt` char(16) COLLATE utf8_unicode_ci NOT NULL,
	`admin` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
	`protected` char(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
)ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1;