
CREATE TABLE IF NOT EXISTS otp (
  id 	  	bigint(20)  	NOT NULL AUTO_INCREMENT,
  risorsa 	varchar(255) 	NOT NULL,
  otp 	  	varchar(255) 	NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
