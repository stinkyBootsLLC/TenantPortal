-- create a general OWNER account
select password('owner4TenantPortal');
GRANT SELECT, INSERT, UPDATE ON TenantPortal.TenantMaintIssues TO tenant_owner@localhost IDENTIFIED 
BY PASSWORD '*8012517F762DF977CB615BA4377AAE934C2EB3FD';
GRANT SELECT, INSERT, UPDATE ON TenantPortal.Tenants TO tenant_owner@localhost IDENTIFIED 
BY PASSWORD '*8012517F762DF977CB615BA4377AAE934C2EB3FD';
GRANT SELECT, INSERT, UPDATE ON TenantPortal.Apartments TO tenant_owner@localhost IDENTIFIED 
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

-- show privileges
SHOW GRANTS FOR tenant_user@localhost;