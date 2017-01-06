/**
 * Created by philippe on 10/9/16.
 */

/* Client exclusions tab & dialog */
$(document).ready(function () {

  btnNewExclusion.on('click', function () {
    clientExclusionDetailWindow.jqxWindow('open');
    clearExclusionsDialog();
    clientExclusionDetailWindow['editMode'] = 'insert';
  });

  cewEmployee.on('select', function() {
    btnCewOK.jqxButton({ disabled: !checkExclusionsDialog() });
  });

  cewClient.on('select', function() {
    btnCewOK.jqxButton({ disabled: !checkExclusionsDialog() });
  });

  btnCewOK.on('click', function() {
    var nullEndDate = cewEndDate.val() === '';
    $.post('helpers/saveExclusion.php',
        {
          employeeId: cewEmployee.val(),
          clientId: cewClient.val(),
          startDate: cewStartDate.jqxDateTimeInput('getDate').toString('yyyy-MM-dd'),
          endDate: !nullEndDate ? cewEndDate.jqxDateTimeInput('getDate').toString('yyyy-MM-dd') : null,
          createdBy: currentUser, updBy: currentUser, editMode: clientExclusionDetailWindow['editMode'],
          clientExclusionID: clientExclusionDetailWindow['key']
        },
        function () {
          //alert(data);
          exclusionsGrid.jqxGrid('updatebounddata');
        }
    ).fail(function (jqXHR) {
      alert(jqXHR.toString());
    });
  });

  exclusionsGrid.on('rowselect', function() {
    btnEditExclusion.jqxButton({ disabled: false });
    btnDeleteExclusion.jqxButton({ disabled: false });
  });

  btnEditExclusion.on('click', function() {
    var obj = exclusionsGrid.jqxGrid('getrowdata', exclusionsGrid.jqxGrid('getselectedrowindex'));
    clientExclusionDetailWindow['key'] = obj['uid'];
    loadExclusionsDialog(obj['eid'], obj['cid'], obj['exStart'], obj['exEnd']);
    clientExclusionDetailWindow.jqxWindow('open');
    clientExclusionDetailWindow['editMode'] = 'update';
  });

  btnDeleteExclusion.on('click', function() {
    var obj = exclusionsGrid.jqxGrid('getrowdata', exclusionsGrid.jqxGrid('getselectedrowindex'));
    $.post('helpers/saveExclusion.php',
        {
          clientExclusionID: obj['uid'],
          editMode: 'delete'
        },
        function() {
          exclusionsGrid.jqxGrid('updatebounddata');
        }
    ).fail(function (jqXHR) {
      alert(jqXHR.toString());
    });
  });

});