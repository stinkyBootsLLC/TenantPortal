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
    IssueDescription varchar (100),
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
    MaintainerQues2_FK int(3) NOT NULL,
    MaintainerSecAns2 varchar(55) NOT NULL,
    MaintainerSecQues3_FK int(3) NOT NULL,
    MaintainerSecAns3 varchar(55) NOT NULL,
    Constraint Foreign Key (Maintainer_FK) references Maintainers(Maintainer_ID),
	Constraint Foreign Key (MaintainerSecQues1_FK) references TenantSecQuestions(secQues_ID ),
	Constraint Foreign Key (MaintainerSecQues2_FK) references TenantSecQuestions(secQues_ID ),
    Constraint Foreign Key (MaintainerSecQues3_FK) references TenantSecQuestions(secQues_ID )
);

