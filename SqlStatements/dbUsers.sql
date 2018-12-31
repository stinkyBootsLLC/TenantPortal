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