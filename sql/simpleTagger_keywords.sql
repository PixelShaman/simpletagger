

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `simpleTagger_keywords`
-- ----------------------------
DROP TABLE IF EXISTS `simpleTagger_keywords`;
CREATE TABLE `simpleTagger_keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(150) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `keyword` (`keyword`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `simpleTagger_keywords`
-- ----------------------------
BEGIN;
INSERT INTO `simpleTagger_keywords` VALUES ('1', 'Anything', '1'), ('2', 'Absolutely', '1'), ('3', 'Tag', '1'), ('4', 'Database', '1'), ('5', 'Driven', '1'), ('6', 'Tagging', '1'), ('7', 'Ajax', '1'), ('8', 'Realtime', '1'), ('9', 'Updates', '1'), ('10', 'Easily', '1'), ('11', 'Customisable', '1'), ('12', 'Design', '1'), ('13', 'Simple', '1'), ('14', 'Setup', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
