
CREATE TABLE IF NOT EXISTS dns_pc (
  id	bigint(20) 		NOT NULL AUTO_INCREMENT,
  pc 	varchar(50) 	NOT NULL,
  ip 	varchar(15) 	NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY pc (pc)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
