/**
 * Created by philippe on 10/7/16.
 */

var substitutesGridSource = {
  url: 'helpers/substitutesData.php',
  dataFields: [
    { name: 'ProgramKey', type: 'int' },
    { name: 'Name' },
    { name: 'Program' },
    { name: 'Position' },
    { name: 'StartDate', map: 'StartDate>date', type: 'date' },
    { name: 'EndDate', map: 'EndDate>date', type: 'date' }
  ],
  dataType: 'json',
  id: 'ProgramKey',
  pagesize: 14
};

var substituteGridAdapter = new $.jqx.dataAdapter(substitutesGridSource);

var substitutesColumns = [
  { text: "Employee", dataField: 'Name', width: 150 },
  { text: "Program", dataField: 'Program', width: 222 },
  { text: "Position", dataField: 'Position', width: 312 },
  { text: "Start Date", dataField: 'StartDate', width: 100, cellsformat: 'dd/MM/yyyy' },
  { text: "End Date", dataField: 'EndDate', width: 100, cellsformat: 'dd/MM/yyyy' }
];

var jobClassRolesSource = {
  url: "helpers/jobClassRoles.php",
  dataType: 'json',
  dataFields: [
    { name: 'id', type: 'int' },
    { name: 'prg', type: 'string' },
    { name: 'jobClass', type: 'string' },
    { name: 'grp', type: 'string' }
  ],
  id: 'id',
  pageSize: 14
};

var jobClassRolesAdapter = new $.jqx.dataAdapter(jobClassRolesSource);

var jobClassRolesColumns = [
  { text: "Program", dataField: 'prg', width: 200 },
  { text: "Job Class", dataField: 'jobClass', width: 228 },
  { text: "Permissions group", dataField: 'grp', width: 200 }
];

var individualSource = {
  url: "helpers/individualRoles.php",
  dataType: 'json',
  dataFields: [
    { name: 'userNum', type: 'int' },
    { name: 'grp', type: 'string' },
    { name: 'startDate', map: 'startDate>date', type: 'date' },
    { name: 'endDate', map: 'endDate>date', type: 'date' }
  ],
  id: 'ugId'
};

var individualColumns = [
  { text: 'User Name', dataField: 'userNum' },
  { text: 'Group', dataField: 'grp' },
  { text: 'startDate', dataField: 'startDate', cellsFormat: 'MM/dd/yyyy' },
  { text: 'endDate', dataField: 'endDate', cellsFormat: 'MM/dd/yyyy' }
];

var individualAdapter = new $.jqx.dataAdapter(individualSource);
