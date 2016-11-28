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

  var btnNewSubstitute = $("#addSubstituteButton").jqxButton({ width: 150, theme: 'jys' });
  var btnEditSubstitute = $("#editSubstituteButton").jqxButton({ width: 150, theme: 'jys' });
  var btnEndSubstitute = $("#endSubstituteButton").jqxButton({ width: 150, theme: 'jys' });
  var btnDeleteSubstitute = $("#deleteSubstituteButton").jqxButton({ width: 150, theme: 'jys' });

  var pnlSubstitutesButtons = $("#substitutesButtonBar");
  pnlSubstitutesButtons.jqxPanel({ width: 876, height: 30, theme: 'jys' });

  var btnNewJobClassPermission = $("#addJobClassPermissionButton").jqxButton({ width: 150, theme: 'jys' });
  var btnEditJobClassPermission = $("#editJobClassPermissionButton").jqxButton({ width: 150, theme: 'jys' });
  var btnDeleteJobClassPermission = $("#deleteJobClassPermissionButton").jqxButton({ width: 150, theme: 'jys' });

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

  var btnNewIndividualPermission = $("#addIndividualPermissionButton").jqxButton({ width: 150, theme: 'jys '});
  var btnEditIndividualPermission = $("#editIndividualPermissionButton").jqxButton({ width: 150, theme: 'jys '});
  var btnDeleteIndividualPermission = $("#deleteIndividualPermissionButton").jqxButton({ width: 150, theme: 'jys '});

  var exclusionsGrid = $("#exclusionsGrid");
  exclusionsGrid.jqxGrid({
    width: 628, height: 446, theme: 'jys', altrows: true, columnsHeight: 18,
    source: exclusionsAdapter,
    columns: exclusionsColumns,
    sortable: true
  });

  var pnlExclusionsButtons = $("#exclusionsButtonBar");
  pnlExclusionsButtons.jqxPanel({ width: 620, height: 30, theme: 'jys' });

  var btnNewExclusion = $("#addExclusionButton").jqxButton({ width: 150, theme: 'jys' });
  var btnEditExclusion = $("#editExclusionButton").jqxButton({ width: 150, theme: 'jys' });
  var btnDeleteExclusion = $("#deleteExclusionButton").jqxButton({ width: 150, theme: 'jys' });

});
