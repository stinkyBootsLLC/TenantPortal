-- 12/27/2018
-- Eduardo Estrada
-- Tenant Portal Application

-- create the database
CREATE DATABASE TenantPortal;
-- use database
use TenantPortal;
-- create apartments table
CREATE TABLE Apartments (
    Apartment_ID int(3) NOT NULL AUTO_INCREMENT,
    Apt_street varchar(25),
    Apt_number varchar(4),
    Apt_City varchar(30),
    Apt_State varchar(2),
    Apt_Zip int(5),
    Apt_Mnth_Rent DECIMAL(5,2),
    PRIMARY KEY (Apartment_ID)
);

-- create Tenants table
CREATE TABLE Tenants (
    Tenant_ID int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    TenantEmail varchar(30) NOT NULL,
    TenantPassword varchar(55) NOT NULL,
    TenantFirstName varchar(30) NOT NULL,
    TenantLastName  varchar(30) NOT NULL,
    TenantHomeNumber varchar(12),
    TenantMobileNumber varchar(12),
    TenantWorkNumber varchar(12),
    TenantAddress_FK int(3),
    TenantCity_FK int(3),
    TenantState_FK int(3),
    TenantZip_FK int(3),
    TenantAptNum_FK int(3),
    Constraint Foreign Key (TenantAddress_FK) references Apartments(Apartment_ID),
	Constraint Foreign Key (TenantCity_FK) references Apartments(Apartment_ID),
	Constraint Foreign Key (TenantState_FK) references Apartments(Apartment_ID),
    Constraint Foreign Key (TenantZip_FK) references Apartments(Apartment_ID),
	Constraint Foreign Key (TenantAptNum_FK) references Apartments(Apartment_ID)
);

-- create Security Questions table
CREATE TABLE TenantSecQuestions (
	secQues_ID int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
	secquest varchar(100)NOT NULL
);

-- create the Maint Issue Table
CREATE TABLE TenantMaintIssues (
    TenantMaintIssue_ID int(6) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    IssueReportDate DATE,
    IssuePriority varchar(10),
    IssueStatus varchar (10),
    IssueDescription varchar (100) NOT NULL,
    IssueSolution varchar(100),
    IssueRepairDate DATE,
    ScheduledDate DATE,
    IssueRepairPrice DECIMAL(5,2),
    Tenant_FK int(3),
    Tenant_Apt_FK int(3),
    Constraint Foreign Key (Tenant_FK) references Tenants(Tenant_ID),
	Constraint Foreign Key (Tenant_Apt_FK) references Tenants(Tenant_ID)
);

-- create the tenant profile for login
CREATE TABLE TenantProfiles(
    TenantProfile_ID int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Tenant_FK int(3) NOT NULL,
    TenantSecQues1_FK int(3) NOT NULL,
    TenantSecAns1 varchar(55) NOT NULL,
    TenantSecQues2_FK int(3) NOT NULL,
    TenantSecAns2 varchar(55) NOT NULL,
    TenantSecQues3_FK int(3) NOT NULL,
    TenantSecAns3 varchar(55) NOT NULL,
    Constraint Foreign Key (Tenant_FK) references Tenants(Tenant_ID),
	Constraint Foreign Key (TenantSecQues1_FK) references TenantSecQuestions(secQues_ID ),
	Constraint Foreign Key (TenantSecQues2_FK) references TenantSecQuestions(secQues_ID ),
    Constraint Foreign Key (TenantSecQues3_FK) references TenantSecQuestions(secQues_ID )
);

-- create Maintainer table
CREATE TABLE Maintainers (
    Maintainer_ID int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    MaintainerEmail varchar(30) NOT NULL,
    MaintainertPassword varchar(55) NOT NULL,
    MaintainerFirstName varchar(30) NOT NULL,
    MaintainerLastName  varchar(30) NOT NULL,
    MaintainerNumber varchar(12)
);

-- create the Maintainer profile for login
CREATE TABLE MaintainerProfiles(
    MaintainerProfile_ID int(3) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    Maintainer_FK int(3) NOT NULL,
    MaintainerSecQues1_FK int(3) NOT NULL,
    MaintainerSecAns1 varchar(55) NOT NULL,
    MaintainerSecQues2_FK int(3) NOT NULL,
    MaintainerSecAns2 varchar(55) NOT NULL,
    MaintainerSecQues3_FK int(3) NOT NULL,
    MaintainerSecAns3 varchar(55) NOT NULL,
    Constraint Foreign Key (Maintainer_FK) references Maintainers(Maintainer_ID),
	Constraint Foreign Key (MaintainerSecQues1_FK) references TenantSecQuestions(secQues_ID ),
	Constraint Foreign Key (MaintainerSecQues2_FK) references TenantSecQuestions(secQues_ID ),
    Constraint Foreign Key (MaintainerSecQues3_FK) references TenantSecQuestions(secQues_ID )
);

-- 12/27/2018
-- Eduardo Estrada
-- Tenant Portal Application

-- populate apartments tables
INSERT INTO Apartments (Apt_number,Apt_City,Apt_State,Apt_Zip,Apt_Mnth_Rent)
VALUES ('T123', 'Emmaus', 'PA',18099, 123.12);
INSERT INTO Apartments (Apt_number,Apt_City,Apt_State,Apt_Zip,Apt_Mnth_Rent)
VALUES ('T124', 'Lilitz', 'PA',18099, 555.12);
INSERT INTO Apartments (Apt_number,Apt_City,Apt_State,Apt_Zip,Apt_Mnth_Rent)
VALUES ('T125', 'Allentown', 'PA',18099, 666.12);
INSERT INTO Apartments (Apt_number,Apt_City,Apt_State,Apt_Zip,Apt_Mnth_Rent)
VALUES ('T126', 'Tobyhanna', 'PA',18099, 777.12);
INSERT INTO Apartments (Apt_number,Apt_City,Apt_State,Apt_Zip,Apt_Mnth_Rent)
VALUES ('T127', 'QuakerTown', 'PA',18099, 888.12);
INSERT INTO Apartments (Apt_number,Apt_City,Apt_State,Apt_Zip,Apt_Mnth_Rent)
VALUES ('T128', 'Pillow', 'PA',18099, 999.12);

-- populate tenants table
INSERT INTO Tenants (TenantEmail, TenantPassword, TenantFirstName,TenantLastName,TenantHomeNumber,TenantMobileNumber,TenantWorkNumber,
                                TenantAddress_FK,TenantCity_FK,TenantState_FK,TenantZip_FK,TenantAptNum_FK)
VALUES ('tenant@mail.com',password('1234'),'ed','smith','123-456-7891','123-456-7891','123-456-7891',1,1,1,1,1);

INSERT INTO Tenants (TenantEmail, TenantPassword, TenantFirstName,TenantLastName,TenantHomeNumber,TenantMobileNumber,TenantWorkNumber,
                                TenantAddress_FK,TenantCity_FK,TenantState_FK,TenantZip_FK,TenantAptNum_FK)
VALUES ('tenant@mail.com',password('1234'),'Fran','smith','123-456-7891','123-456-7891','123-456-7891',1,1,1,1,1);

INSERT INTO Tenants (TenantEmail, TenantPassword, TenantFirstName,TenantLastName,TenantHomeNumber,TenantMobileNumber,TenantWorkNumber,
                                TenantAddress_FK,TenantCity_FK,TenantState_FK,TenantZip_FK,TenantAptNum_FK)
VALUES ('john@mail.com',password('1234'),'john','doe','123-456-7891','123-456-7891','123-456-7891',2,2,2,2,2);

-- populate TenantSecQuestions table
INSERT INTO TenantSecQuestions (secquest) VALUES ('In what city were you born');
INSERT INTO TenantSecQuestions (secquest)VALUES ('What high school did you attend');
INSERT INTO TenantSecQuestions (secquest)VALUES ('What is the name of your first school');
INSERT INTO TenantSecQuestions (secquest)VALUES ('What is your favorite movie');
INSERT INTO TenantSecQuestions (secquest)VALUES ('What is your mothers maiden name');
INSERT INTO TenantSecQuestions (secquest)VALUES ('What street did you grow up on');
INSERT INTO TenantSecQuestions (secquest)VALUES ('What was the make of your first car');
INSERT INTO TenantSecQuestions (secquest)VALUES ('When is your anniversary');
INSERT INTO TenantSecQuestions (secquest)VALUES ('What is your favorite color');
INSERT INTO TenantSecQuestions (secquest)VALUES ('What is your fathers middle name');

-- populate TenantMaintIssues table
INSERT INTO TenantMaintIssues(IssueReportDate ,IssuePriority ,IssueStatus ,IssueDescription ,
    IssueSolution ,IssueRepairDate,ScheduledDate ,IssueRepairPrice,Tenant_FK ,Tenant_Apt_FK)
VALUES ('20181205','low','pending','Burnt LightBulb', 'Replaced Bulb','20181210','20181210',002.55,1,1);
INSERT INTO TenantMaintIssues(IssueReportDate ,IssuePriority ,IssueStatus ,IssueDescription ,
    IssueSolution ,IssueRepairDate,ScheduledDate,Tenant_FK ,Tenant_Apt_FK)
VALUES ('20181205','low','pending','clogged toilet', '20181225',' ','20181231',2,2);
INSERT INTO TenantMaintIssues(IssueReportDate ,IssuePriority ,IssueStatus ,IssueDescription ,
    IssueSolution ,IssueRepairDate,ScheduledDate,Tenant_FK ,Tenant_Apt_FK)
VALUES ('20181205','High','pending','clogged toilet', '20181225',' ','20181231',1,1);
INSERT INTO TenantMaintIssues(IssueReportDate ,IssuePriority ,IssueStatus ,IssueDescription ,
    IssueSolution ,IssueRepairDate,ScheduledDate ,IssueRepairPrice,Tenant_FK ,Tenant_Apt_FK)
VALUES ('20181205','low','closed','Burnt LightBulb', 'Replaced Bulb','20181210','20181210',002.55,3,3);
INSERT INTO TenantMaintIssues(IssueReportDate ,IssuePriority ,IssueStatus ,IssueDescription ,
    IssueSolution ,IssueRepairDate,ScheduledDate ,IssueRepairPrice,Tenant_FK ,Tenant_Apt_FK)
VALUES ('20181205','low','closed','clogged toilet', 'unclogged toilet','20181210','20181210',055.55,3,3);
INSERT INTO TenantMaintIssues(IssueReportDate ,IssuePriority ,IssueStatus ,IssueDescription ,
    IssueSolution ,IssueRepairDate,ScheduledDate ,IssueRepairPrice,Tenant_FK ,Tenant_Apt_FK)
VALUES ('20181205','High','closed','no pwr in kitched', 'reset cb','20181210','20181210',000.00,3,3);
INSERT INTO TenantMaintIssues(IssueReportDate ,IssuePriority ,IssueStatus ,IssueDescription ,
    IssueSolution ,IssueRepairDate,ScheduledDate ,IssueRepairPrice,Tenant_FK ,Tenant_Apt_FK)
VALUES ('20181206','low','closed','Burnt LightBulb', 'Replaced Bulb','20181211','20181211',002.55,3,3);
-- this will be what the tenant can enter
INSERT INTO TenantMaintIssues(IssueReportDate ,IssueStatus ,IssueDescription,Tenant_FK ,Tenant_Apt_FK)
VALUES ('20181225','open','Burnt LightBulb',2,2);
INSERT INTO TenantMaintIssues(IssueReportDate ,IssueStatus ,IssueDescription,Tenant_FK ,Tenant_Apt_FK)
VALUES ('20181225','open','Burnt LightBulb',3,3);

-- populate TenantProfiles table
INSERT INTO TenantProfiles(Tenant_FK,TenantSecQues1_FK,TenantSecAns1,TenantSecQues2_FK,TenantSecAns2,
    TenantSecQues3_FK,TenantSecAns3)
VALUES(1,2,password('answer'),2,password('answer'),2,password('answer'));

INSERT INTO TenantProfiles(Tenant_FK,TenantSecQues1_FK,TenantSecAns1,TenantSecQues2_FK,TenantSecAns2,
    TenantSecQues3_FK,TenantSecAns3)
VALUES(2,2,password('answer'),2,password('answer'),2,password('answer'));
INSERT INTO TenantProfiles(Tenant_FK,TenantSecQues1_FK,TenantSecAns1,TenantSecQues2_FK,TenantSecAns2,
    TenantSecQues3_FK,TenantSecAns3)
VALUES(3,3,password('answer'),3,password('answer'),3,password('answer'));



-- populate Maintainers table
INSERT INTO Maintainers (MaintainerEmail,MaintainertPassword,MaintainerFirstName,MaintainerLastName,MaintainerNumber)
VALUES ('maint@mail.com',password('1234'),'ed','jones','123-456-7891');

-- populate MaintainerProfiles table
INSERT INTO MaintainerProfiles (Maintainer_FK,MaintainerSecQues1_FK,MaintainerSecAns1,MaintainerSecQues2_FK,
MaintainerSecAns2,MaintainerSecQues3_FK,MaintainerSecAns3)
VALUES(1,2,password('answer'),2,password('answer'),2,password('answer'));

-- create a general OWNER account
select password('owner4TenantPortal');
GRANT SELECT, INSERT, UPDATE ON TenantPortal.TenantMaintIssues TO tenant_owner@localhost IDENTIFIED 
BY PASSWORD '*8012517F762DF977CB615BA4377AAE934C2EB3FD';
GRANT SELECT, INSERT, UPDATE ON TenantPortal.Tenants TO tenant_owner@localhost IDENTIFIED 
BY PASSWORD '*8012517F762DF977CB615BA4377AAE934C2EB3FD';
GRANT SELECT, INSERT, UPDATE ON TenantPortal.Apartments TO tenant_owner@localhost IDENTIFIED 
BY PASSWORD '*8012517F762DF977CB615BA4377AAE934C2EB3FD';
GRANT SELECT, INSERT, UPDATE ON TenantPortal.Maintainers TO tenant_owner@localhost IDENTIFIED 
BY PASSWORD '*8012517F762DF977CB615BA4377AAE934C2EB3FD';
GRANT SELECT, INSERT, UPDATE ON TenantPortal.MaintainerProfiles TO tenant_owner@localhost IDENTIFIED 
BY PASSWORD '*8012517F762DF977CB615BA4377AAE934C2EB3FD';
GRANT SELECT, INSERT, UPDATE ON TenantPortal.TenantSecQuestions TO tenant_owner@localhost IDENTIFIED 
BY PASSWORD '*8012517F762DF977CB615BA4377AAE934C2EB3FD';
-- show privileges
SHOW GRANTS FOR tenant_owner@localhost;

-- create a general USER account
select password('user4TenantPortal');
GRANT SELECT, INSERT ON TenantPortal.TenantMaintIssues TO tenant_user@localhost IDENTIFIED 
BY PASSWORD '*2D4C0C4F17074CCF71731A11B3CECBE0E02BB896';
GRANT SELECT, INSERT ON TenantPortal.Tenants TO tenant_user@localhost IDENTIFIED 
BY PASSWORD '*2D4C0C4F17074CCF71731A11B3CECBE0E02BB896';
GRANT SELECT ON TenantPortal.TenantSecQuestions TO tenant_user@localhost IDENTIFIED 
BY PASSWORD '*2D4C0C4F17074CCF71731A11B3CECBE0E02BB896';
GRANT SELECT, INSERT ON TenantPortal.TenantProfiles TO tenant_user@localhost IDENTIFIED 
BY PASSWORD '*2D4C0C4F17074CCF71731A11B3CECBE0E02BB896';
GRANT SELECT ON TenantPortal.Apartments TO tenant_user@localhost IDENTIFIED 
BY PASSWORD '*2D4C0C4F17074CCF71731A11B3CECBE0E02BB896';

-- show privileges
SHOW GRANTS FOR tenant_user@localhost;
    
