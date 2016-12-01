/**
 * Created by philippe on 10/18/16.
 */

$(document).ready( function() {

  var substitutesGrid = $("#substituteGrid");
  substitutesGrid.jqxGrid({
    width: 885, height: 446, theme: 'jys', columnsheight: 18, altrows: true,
    source: substituteGridAdapter,
    columns: substitutesColumns,
    sortable: true,
    pageable: true,
    pagermode: 'simple'
  });

  var tabs = $("#tabs");
  tabs.jqxTabs({ width: 897, height: 525, position: 'top', theme: 'jys' });

  btnNewSubstitute = $("#addSubstituteButton").jqxButton({ width: 150, theme: 'jys' });
  btnEditSubstitute = $("#editSubstituteButton").jqxButton({ width: 150, theme: 'jys' });
  btnEndSubstitute = $("#endSubstituteButton").jqxButton({ width: 150, theme: 'jys' });
  btnDeleteSubstitute = $("#deleteSubstituteButton").jqxButton({ width: 150, theme: 'jys' });

  var pnlSubstitutesButtons = $("#substitutesButtonBar");
  pnlSubstitutesButtons.jqxPanel({ width: 876, height: 30, theme: 'jys' });

  btnNewJobClassPermission = $("#addJobClassPermissionButton").jqxButton({ width: 150, theme: 'jys' });
  btnEditJobClassPermission = $("#editJobClassPermissionButton").jqxButton({ width: 150, theme: 'jys' });
  btnDeleteJobClassPermission = $("#deleteJobClassPermissionButton").jqxButton({ width: 150, theme: 'jys' });

  var pnlJobClassPermissionsButtons = $("#positionPermissionsButtonBar");
  pnlJobClassPermissionsButtons.jqxPanel({ width: 620, height: 30, theme: 'jys' });

  var positionPermissionsGrid = $("#positionPermissionsGrid");
  positionPermissionsGrid.jqxGrid({
    width: 628, height: 446, theme: 'jys', altrows: true, columnsHeight: 18,
    source: jobClassRolesAdapter,
    columns: jobClassRolesColumns,
    sortable: true,
    pageable: true,
    pagerMode: 'simple'
  });

  var individualPermissionsGrid = $("#individualPermissionsGrid");
  individualPermissionsGrid.jqxGrid({
    width: 628, height: 446, theme: 'jys', altrows: true, columnsHeight: 18,
    source: individualAdapter,
    columns: individualColumns,
    sortable: true
  });

  var pnlIndividualPermissionsButtons = $("#individualPermissionsButtonBar");
  pnlIndividualPermissionsButtons.jqxPanel({ width: 620, height: 30, theme: 'jys' });

  btnNewIndividualPermission = $("#addIndividualPermissionButton").jqxButton({ width: 150, theme: 'jys' });
  btnEditIndividualPermission = $("#editIndividualPermissionButton").jqxButton({ width: 150, theme: 'jys' });
  btnDeleteIndividualPermission = $("#deleteIndividualPermissionButton").jqxButton({ width: 150, theme: 'jys' });

  var exclusionsGrid = $("#exclusionsGrid");
  exclusionsGrid.jqxGrid({
    width: 628, height: 446, theme: 'jys', altrows: true, columnsHeight: 18,
    source: exclusionsAdapter,
    columns: exclusionsColumns,
    sortable: true
  });

  var pnlExclusionsButtons = $("#exclusionsButtonBar");
  pnlExclusionsButtons.jqxPanel({ width: 620, height: 30, theme: 'jys' });

  btnNewExclusion = $("#addExclusionButton").jqxButton({ width: 150, theme: 'jys' });
  btnEditExclusion = $("#editExclusionButton").jqxButton({ width: 150, theme: 'jys' });
  btnDeleteExclusion = $("#deleteExclusionButton").jqxButton({ width: 150, theme: 'jys' });

  var pnlUserAccessButtons = $("#userAccessButtonBar");
  pnlUserAccessButtons.jqxPanel({ width: 876, height: 30, theme: 'jys' });

  var userAccessGrid = $("#userAccessGrid");
  userAccessGrid.jqxGrid({
    width: 885, height: 446, theme: 'jys', altrows: true, columnsHeight: 18,
    source: userAccessAdapter, columns: userAccessColumns,
    sortable: true, pageable: true, pagerMode: 'simple'
  });

  btnGrantUserAccess = $("#grantAccessButton").jqxButton({ width: 150, theme: 'jys' });
  btnDenyUserAccess = $("#denyAccessButton").jqxButton({ width: 150, theme: 'jys' });
  btnResetPassword = $("#resetPasswordButton").jqxButton({ width: 150, theme: 'jys' });
  btnEMIwindow = $("#EMIButton").jqxButton({ width: 150, theme: 'jys' });

});
