

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `simpleTagger_photos`
-- ----------------------------
DROP TABLE IF EXISTS `simpleTagger_photos`;
CREATE TABLE `simpleTagger_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caption` varchar(250) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `userid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `simpleTagger_photos`
-- ----------------------------
BEGIN;
INSERT INTO `simpleTagger_photos` VALUES ('1', 'A lovely picture', 'example images/raspberrys.png', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
