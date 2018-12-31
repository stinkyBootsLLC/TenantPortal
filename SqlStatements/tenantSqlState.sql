


SELECT IssueReportDate,IssuePriority,IssueStatus,IssueDescription,IssueSolution,IssueRepairDate,ScheduledDate,
Tenant_FK,  Tenant_Apt_FK FROM TenantMaintIssues WHERE IssueStatus='closed';







SELECT IssueReportDate,IssuePriority,IssueStatus,IssueDescription,IssueSolution,IssueRepairDate,ScheduledDate,
CONCAT(tenantFname.TenantFirstName,' ',tenantLname.TenantLastName) AS Name,
tenantApt.Apt_number AS aptNumber
FROM TenantMaintIssues 
JOIN Tenants tenantFname ON TenantMaintIssues.Tenant_FK = tenantFname.Tenant_ID
JOIN Tenants tenantLname ON TenantMaintIssues.Tenant_FK = tenantLname.Tenant_ID
JOIN Apartments tenantApt ON TenantMaintIssues.Tenant_Apt_FK = tenantApt.Apartment_ID
WHERE IssueStatus='closed';

