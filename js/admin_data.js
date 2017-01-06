/**
 * Created by philippe on 10/7/16.
 */

var currentUser = 600;

var substitutesGridSource = {
  url: 'helpers/substitutesData.php',
  dataFields: [
    {name: 'ProgramKey', type: 'int'},
    {name: 'Name'},
    {name: 'Program'},
    {name: 'Position'},
    {name: 'StartDate', map: 'StartDate>date', type: 'date'},
    {name: 'EndDate', map: 'EndDate>date', type: 'date'}
  ],
  dataType: 'json',
  id: 'ProgramKey',
  pageSize: 14
};

var substituteGridAdapter = new $.jqx.dataAdapter(substitutesGridSource);

var substitutesColumns = [
  {text: "Employee", dataField: 'Name', width: 150},
  {text: "Program", dataField: 'Program', width: 222},
  {text: "Position", dataField: 'Position', width: 312},
  {text: "Start Date", dataField: 'StartDate', width: 100, cellsformat: 'dd/MM/yyyy'},
  {text: "End Date", dataField: 'EndDate', width: 100, cellsformat: 'dd/MM/yyyy'}
];

var jobClassRolesSource = {
  url: "helpers/jobClassRoles.php",
  dataType: 'json',
  dataFields: [
    {name: 'id', type: 'int'},
    {name: 'prg', type: 'string'},
    {name: 'jobClass', type: 'string'},
    {name: 'grp', type: 'string'}
  ],
  id: 'id',
  pageSize: 14
};

var jobClassRolesAdapter = new $.jqx.dataAdapter(jobClassRolesSource);

var jobClassRolesColumns = [
  {text: "Program", dataField: 'prg', width: 200},
  {text: "Job Class", dataField: 'jobClass', width: 228},
  {text: "Permissions group", dataField: 'grp', width: 200}
];

var activeEmployeesAdapter = new $.jqx.dataAdapter({
  url: "helpers/activeEmployees.php",
  dataType: 'json',
  dataFields: [
    { name: 'uid', type: 'int' },
    { name: 'employeeFullName', map: 'en', type: 'string' }
  ],
  id: 'uid',
  async: false
}, { autoBind: true });

var activeClientsAdapter = new $.jqx.dataAdapter({
  localData: activeClientsStatic,
  dataType: 'json',
  dataFields: [
    { name: 'uid', type: 'int' },
    { name: 'clientFullName', map: 'cf', type: 'string' }
  ],
  id: 'uid'
}, { autoBind: true });

var groupsAdapter = new $.jqx.dataAdapter({
  url: 'helpers/groups.php',
  dataType: 'json',
  dataFields: [
    { name: 'gn', type: 'string' },
    { name: 'gd', type: 'string' }
  ],
  id: 'gn',
  async: false
}, { autoBind: true });

var exclusionsSource = {
  url: "helpers/exclusions.php",
  dataType: 'json',
  dataFields: [
    {name: 'uid', type: 'int'},
    {name: 'eid', type: 'int'},
    {name: 'employee', value: 'eid', values: {
        source: activeEmployeesAdapter.records,
        value: 'uid',
        name: 'employeeFullName' }
    },
    {name: 'cid', type: 'int'},
    {name: 'client', value: 'cid', values: {
      source: activeClientsAdapter.records,
      value: 'uid',
      name: 'clientFullName' }
    },
    {name: 'exStart', map: 'exStart>date', type: 'date'},
    {name: 'exEnd', map: 'exEnd>date', type: 'date'}
  ],
  id: 'uid'
};

var exclusionsColumns = [
  { text: "Employee", dataField: 'eid', displayField: 'employee', width: 225 },
  { text: "Client", dataField: 'cid', displayField: 'client', width: 225 },
  { text: "Start", dataField: 'exStart', cellsFormat: 'MM/dd/yyyy', width: 89 },
  { text: "End", dataField: 'exEnd', cellsFormat: 'MM/dd/yyyy', width: 89 }
];

var exclusionsAdapter = new $.jqx.dataAdapter(exclusionsSource);

var exclusionsGrid;

var individualAdapter = new $.jqx.dataAdapter({
  url: "helpers/individualRoles.php",
  dataType: 'json',
  dataFields: [
    {name: 'userNum', type: 'int'},
    {name: 'employee', value: 'userNum', values: {
      source: activeEmployeesAdapter.records,
      value: 'uid',
      name: 'employeeFullName' }
    },
    {name: 'grp', type: 'string'},
    {name: 'startDate', map: 'startDate>date', type: 'date'},
    {name: 'endDate', map: 'endDate>date', type: 'date'}
  ],
  id: 'ugId'
});

var individualColumns = [
  {text: 'User Name', dataField: 'userNum', displayField: 'employee'},
  {text: 'Group', dataField: 'grp', displayField: 'group'},
  {text: 'startDate', dataField: 'startDate', cellsFormat: 'MM/dd/yyyy'},
  {text: 'endDate', dataField: 'endDate', cellsFormat: 'MM/dd/yyyy'}
];

var individualPermissionsGrid;

var userAccessSource = {
  url: "helpers/userAccess.php",
  dataType: 'json',
  dataFields: [
    {name: 'hrID', type: 'int'},
    {name: 'firstName', map: 'fn'},
    {name: 'lastName', map: 'ln'},
    {name: 'emiID', type: 'int'},
    {name: 'jysID', type: 'int'},
    {name: 'userLogin', map: 'ul'},
    {name: 'userJYSNumber', map: 'un', type: 'int'},
    {name: 'sqlLogin', map: 'sl'},
    {name: 'emiDuplicates', map: 'dupes', type: 'int'}
  ],
  id: 'hrID',
  pageSize: 14
};

var userAccessColumns = [
  {text: "HR ID", dataField: 'hrID', width: 40, cellsAlign: 'middle' },
  {text: "First Name", dataField: 'firstName', width: 150 },
  {text: "Last Name", dataField: 'lastName', width: 150 },
  {text: "EMI ID", dataField: 'emiID', width: 40, cellsAlign: 'middle' },
  {text: "JYS ID", dataField: 'jysID', width: 40, cellsAlign: 'middle' },
  {text: "User Access #", dataField: 'userJYSNumber', width: 70, cellsAlign: 'middle' },
  {text: "SQL Login GUID", dataField: 'sqlLogin', width: 249 },
  {text: "User Login", dataField: 'userLogin', width: 85 },
  {text: "EMI Dupes", dataField: 'emiDuplicates', width: 60, cellsAlign: 'middle' }
];

var userAccessAdapter = new $.jqx.dataAdapter(userAccessSource);


var btnNewSubstitute;
var btnEditSubstitute;
var btnEndSubstitute;
var btnDeleteSubstitute;

var btnNewExclusion;
var btnEditExclusion;
var btnDeleteExclusion;

var btnNewJobClassPermission;
var btnEditJobClassPermission;
var btnDeleteJobClassPermission;

var btnNewIndividualPermission;
var btnEditIndividualPermission;
var btnDeleteIndividualPermission;

var btnGrantUserAccess;
var btnDenyUserAccess;
var btnResetPassword;
var btnEMIWindow;

/* Exclusion detail window */
var clientExclusionDetailWindow;
var btnCewOK;
var btnCewCancel;
var cewEmployee;
var cewClient;
var cewStartDate;
var cewEndDate;
