

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `simpleTagger_dummyArticles`
-- ----------------------------
DROP TABLE IF EXISTS `simpleTagger_dummyArticles`;
CREATE TABLE `simpleTagger_dummyArticles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `simpleTagger_dummyArticles`
-- ----------------------------
BEGIN;
INSERT INTO `simpleTagger_dummyArticles` VALUES ('1', 'Once you have installed the package with the installer, all you need to do is include the script libraries and call a few lines of code!', 'Simple Setup!'), ('2', 'The code has been split into chunks for easy customisation. No advanced PHP knowledge is needed to get started, but you have full control!', 'Customisable'), ('3', 'Creating keywords and tags happens on the fly. There is no need to reload the page as all the work is done in the background!', 'Ajax based!'), ('4', 'The tags are stored in their own local database on your system, so you can plug them into any content already existing on your site!', 'Database Driven!');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
