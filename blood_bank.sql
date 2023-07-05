DROP TABLE blood_bank_blood_recipient cascade;
DROP TABLE blood_bank_blood cascade;
DROP TABLE blood_donor_blood_bank cascade;
DROP TABLE blood_recipient cascade;
DROP TABLE blood_bank cascade;
DROP TABLE blood cascade;
DROP TABLE blood_donor cascade;
DROP TABLE admin cascade;

CREATE TABLE admin(ADMIN_ID int check(ADMIN_ID>0) primary key,ADMIN_NAME varchar(120) NOT NULL,ADMIN_PASSWORD varchar(120) NOT NULL,ADMIN_ADDRESS text NOT NULL,PHONE_NO numeric(13) check(PHONE_NO>0000000000 and PHONE_NO<9999999999) NOT NULL);
\d admin  

INSERT INTO admin VALUES(9342,'Sourabh','&2*%p^9','Model Colony',8549934534);
SELECT * FROM admin; 

CREATE TABLE blood_donor(DONOR_ID serial check(DONOR_ID>0)NOT NULL,USERNAME varchar(120) NOT NULL,DR_PASSWORD varchar(150)NOT NULL,GENDER varchar(7) check(GENDER IN( 'MALE','FEMALE','OTHER','F','M','O','Male','Female','Other','m','f','o'))NOT NULL,DOB date NOT NULL,BLOOD_GROUPD varchar(10) check(BLOOD_GROUPD IN( 'O+','O-','A+','A-','B+','B-','AB+','AB-','A1B+','A1B-','A2B+','A2B-','Bombay O+','Bombay O-'))NOT NULL,BODY_WEIGHT real check(BODY_WEIGHT>0) NOT NULL,EMAIL varchar(120) NOT NULL,ADDRESS text NOT NULL,AREA text NOT NULL,CITY varchar(120) NOT NULL,PINCODE numeric(7)NOT NULL,STATE varchar(120)NOT NULL,COUNTRY varchar(120)NOT NULL,CONTACT numeric(13)  check(CONTACT>=0000000000 AND CONTACT<=9999999999)NOT NULL,NEW_DONOR char(3) check(NEW_DONOR IN('YES','NO','Y','N','Yes','No','yes','no','y','n'))NOT NULL,LAST_D_DATE date,DONOR_PIC varchar(120) NOT NULL,STATUS char(4) check(STATUS IN('YES','NO','Y','N','yes','no','Yes','No','y','n')),ADMIN_ID int references admin(ADMIN_ID)ON DELETE CASCADE ON UPDATE SET NULL,primary key(DONOR_ID,BLOOD_GROUPD));
\d blood_donor

INSERT INTO blood_donor VALUES(1,'AAA','$Rj2&#9','Male','2017-08-02','O+',60,'aa@gmail.com','ABC','Bibwewadi','Pune',411037,'Maharashtra','India',7364824198,'YES',NULL,'aaa.jpg','NO',9342);
INSERT INTO blood_donor VALUES(2,'AAA','$Rj2&#9','Male','2017-08-02','O+',60,'aa@gmail.com','ABC','Bibwewadi','Pune',411037,'Maharashtra','India',7364824198,'YES',NULL,'aaa.jpg','NO',9342);
SELECT * FROM blood_donor;

CREATE TABLE blood(BID serial check(BID>0)primary key NOT NULL,COLLECTION_DATE date NOT NULL,EXPIRY_DATE date NOT NULL,STATUS char(4) check(STATUS IN ('YES','NO','Y','N','Yes','No','y','n','yes','no')),DONOR_ID serial check(DONOR_ID>0)NOT NULL,BLOOD_GROUPD varchar(10) check(BLOOD_GROUPD IN( 'O+','O-','A+','A-','B+','B-','AB+','AB-','A1B+','A1B-','A2B+','A2B-','Bombay O+','Bombay O-'))NOT NULL,foreign key(DONOR_ID,BLOOD_GROUPD) references blood_donor(DONOR_ID,BLOOD_GROUPD)ON DELETE CASCADE ON UPDATE SET NULL);
\d blood 

INSERT INTO blood VALUES(339,'2017-02-01','2017-02-03','NO',1,'O+');
SELECT * FROM blood;

CREATE TABLE blood_bank(BBID serial check(BBID>0)primary key NOT NULL,ADMIN_ID int references admin(ADMIN_ID)ON DELETE CASCADE ON UPDATE SET NULL,NO_OF_UNITS int check(NO_OF_UNITS>0)NOT NULL);
\d blood_bank 

INSERT INTO blood_bank VALUES(1,9342,3);
SELECT * FROM blood_bank;

CREATE TABLE blood_recipient(REC_ID serial check(REC_ID>0)NOT NULL,USERNAME varchar(120)NOT NULL,RC_PASSWORD varchar(120)NOT NULL,GENDER varchar(7) check(GENDER IN( 'MALE','FEMALE','OTHER','F','M','O','Male','Female','Other','m','f','o'))NOT NULL,BLOOD_GROUPR varchar(10) check(BLOOD_GROUPR IN( 'O+','O-','A+','A-','B+','B-','AB+','AB-','A1B+','A1B-','A2B+','A2B-','Bombay O+','Bombay O-'))NOT NULL,BUNIT int check(BUNIT>0)NOT NULL,HOSP varchar(120)NOT NULL,CITY varchar(120)NOT NULL,PIN numeric(7) check(PIN>=000000 and PIN<=999999)NOT NULL,DOC_NAME varchar(120)NOT NULL,RDATE date NOT NULL,CNAME varchar(120)NOT NULL,CADDRESS text NOT NULL,EMAIL varchar(120)NOT NULL,CON numeric(13) check(CON>0000000000 and CON<9999999999)NOT NULL,REASON text NOT NULL,RPIC varchar(120)NOT NULL,STATUS char(4) check(STATUS IN('YES','NO','Y','N','yes','no','Yes','No','y','n')),CDATE date NOT NULL,DOC_PRES char(4) check(DOC_PRES IN('YES','NO','Y','N','yes','no','Yes','No','y','n'))NOT NULL,ADMIN_ID int references admin(ADMIN_ID)ON DELETE CASCADE ON UPDATE SET NULL,primary key(REC_ID,BLOOD_GROUPR));
\d blood_recipient

INSERT INTO blood_recipient VALUES(1,'ABCD','U@7iJ4','Male','AB+',4,'Sahiyadri','Pune',411037,'Dr.Harshavardhan','2017-05-09','ABC','XXX','abc@gmail.com',3651089542,'Blood Loss in an Accident','abc.jpg','NO','2017-05-12','YES',9342);
SELECT * FROM blood_recipient;

CREATE TABLE blood_donor_blood_bank(DONOR_ID serial NOT NULL,BLOOD_GROUPD varchar(10)NOT NULL,foreign key(DONOR_ID,BLOOD_GROUPD) references blood_donor(DONOR_ID,BLOOD_GROUPD)ON DELETE CASCADE ON UPDATE SET NULL,BBID serial references blood_bank(BBID)ON DELETE CASCADE ON UPDATE SET NULL);
\d blood_donor_blood_bank

CREATE TABLE blood_bank_blood(BBID serial references blood_bank(BBID)ON DELETE CASCADE ON UPDATE SET NULL,BID serial references blood(BID)ON DELETE CASCADE ON UPDATE SET NULL);
\d blood_bank_blood

CREATE TABLE blood_bank_blood_recipient(BBID serial references blood_bank(BBID) ON DELETE CASCADE ON UPDATE SET NULL,REC_ID serial check(REC_ID>0)NOT NULL,BLOOD_GROUPR varchar(10) check(BLOOD_GROUPR IN( 'O+','O-','A+','A-','B+','B-','AB+','AB-','A1B+','A1B-','A2B+','A2B-','Bombay O+','Bombay O-'))NOT NULL,foreign key(REC_ID,BLOOD_GROUPR)references blood_recipient(REC_ID,BLOOD_GROUPR)ON DELETE CASCADE ON UPDATE SET NULL);
\d blood_bank_blood_recipient  
