/**
 * Created by philippe on 10/7/16.
 */

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
  pagesize: 14
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

var individualSource = {
  url: "helpers/individualRoles.php",
  dataType: 'json',
  dataFields: [
    {name: 'userNum', type: 'int'},
    {name: 'grp', type: 'string'},
    {name: 'startDate', map: 'startDate>date', type: 'date'},
    {name: 'endDate', map: 'endDate>date', type: 'date'}
  ],
  id: 'ugId'
};

var individualColumns = [
  {text: 'User Name', dataField: 'userNum'},
  {text: 'Group', dataField: 'grp'},
  {text: 'startDate', dataField: 'startDate', cellsFormat: 'MM/dd/yyyy'},
  {text: 'endDate', dataField: 'endDate', cellsFormat: 'MM/dd/yyyy'}
];

var individualAdapter = new $.jqx.dataAdapter(individualSource);

var exclusionsSource = {
  url: "helpers/exclusions.php",
  dataType: 'json',
  dataFields: [
    {name: 'eid', type: 'int'},
    {name: 'cid', type: 'int'},
    {name: 'exStart', map: 'exStart>date', type: 'date'},
    {name: 'exEnd', map: 'exEnd>date', type: 'date'}
  ],
  id: 'uid'
};

var exclusionsColumns = [
  {text: "Employee", dataField: 'eid'},
  {text: "Client", dataField: 'cid'},
  {text: "Start", dataField: 'exStart', cellsFormat: 'MM/dd/yyyy'},
  {text: "End", dataField: 'exEnd', cellsFormat: 'MM/dd/yyyy'}
];

var exclusionsAdapter = new $.jqx.dataAdapter(exclusionsSource);

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
  pagesize: 14
};

var userAccessColumns = [
  {text: "HR ID", dataField: 'hrID', width: 50},
  {text: "First Name", dataField: 'firstName'},
  {text: "Last Name", dataField: 'lastName'},
  {text: "EMI ID", dataField: 'emiID'},
  {text: "JYS ID", dataField: 'jysID'},
  {text: "User Access #", dataField: 'userJYSNumber'},
  {text: "SQL Login GUID", dataField: 'sqlLogin'},
  {text: "User Login", dataField: 'userLogin'},
  {text: "EMI Dupes", dataField: 'emiDuplicates'}
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
var btnEMIwindow;