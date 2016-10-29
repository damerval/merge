/**
 * Created by philippe on 10/15/16.
 */

var groupOptionsSource = {
  url: "helpers/groupOptions.php",
  dataType: 'json',
  dataFields: [
    { name: 'gName', type: 'string' },
    { name: 'gDesc', type: 'string' }
  ],
  id: 'gName',
  async: false
};

var groupOptionsAdapter = new $.jqx.dataAdapter(groupOptionsSource, { autoBind: true });

var individualSource = {
  url: "helpers/individualRoles.php",
  dataType: 'json',
  dataFields: [
    { name: 'userNum', type: 'int' },
    { name: 'grp', type: 'string' },
    { name: 'startDate', map: 'startDate>date', type: 'date' },
    { name: 'endDate', map: 'endDate>date', type: 'date' },
    { name: 'grpName', value: 'grp', values: {source: groupOptionsAdapter.records, value: 'gName', name: 'gDesc'} }
  ],
  id: 'ugId'
};

var individualColumns = [
  { text: 'User Name', dataField: 'userNum' },
  { text: 'Group', dataField: 'grp', displayField: 'grpName' },
  { text: 'startDate', dataField: 'startDate', cellsFormat: 'MM/dd/yyyy' },
  { text: 'endDate', dataField: 'endDate', cellsFormat: 'MM/dd/yyyy' }
];

var individualAdapter = new $.jqx.dataAdapter(individualSource);

