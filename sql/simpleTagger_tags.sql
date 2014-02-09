

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `simpleTagger_tags`
-- ----------------------------
DROP TABLE IF EXISTS `simpleTagger_tags`;
CREATE TABLE `simpleTagger_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keywordID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `dataTaggedID` int(11) DEFAULT NULL,
  `dataTaggedTable` varchar(150) DEFAULT NULL,
  `dataTaggedDatabase` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `simpleTagger_tags`
-- ----------------------------
BEGIN;
INSERT INTO `simpleTagger_tags` VALUES ('1', '3', '1', '1', 'simpleTagger_photos', 'dataTagger'), ('2', '2', '1', '1', 'simpleTagger_photos', 'dataTagger'), ('3', '1', '1', '1', 'simpleTagger_photos', 'dataTagger'), ('4', '13', '1', '1', 'simpleTagger_dummyArticles', 'dataTagger'), ('5', '14', '1', '1', 'simpleTagger_dummyArticles', 'dataTagger'), ('6', '10', '1', '2', 'simpleTagger_dummyArticles', 'dataTagger'), ('7', '11', '1', '2', 'simpleTagger_dummyArticles', 'dataTagger'), ('8', '12', '1', '2', 'simpleTagger_dummyArticles', 'dataTagger'), ('9', '8', '1', '3', 'simpleTagger_dummyArticles', 'dataTagger'), ('10', '7', '1', '3', 'simpleTagger_dummyArticles', 'dataTagger'), ('11', '9', '1', '3', 'simpleTagger_dummyArticles', 'dataTagger'), ('12', '4', '1', '4', 'simpleTagger_dummyArticles', 'dataTagger'), ('13', '5', '1', '4', 'simpleTagger_dummyArticles', 'dataTagger'), ('14', '6', '1', '4', 'simpleTagger_dummyArticles', 'dataTagger');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
