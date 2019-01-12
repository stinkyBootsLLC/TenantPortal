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


    
